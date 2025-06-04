<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;

class Project extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Project>
     */
    public static $model = \App\Models\Project::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'github_link'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Tag::make('Domains')
                ->rules('required')
                ->showCreateRelationButton()
                ->preload()
                ->withPreview(),

            Text::make('Title', 'title')->rules('required'),

            Text::make('The Writer', 'writer')->nullable(),

            Textarea::make('First Description', 'description')->rules('required'),

            Textarea::make('Second Description', 'second_description')->nullable(),

            Textarea::make('Note', 'note')->nullable(),

            Date::make('Release Date', 'release_date')->nullable(),

            // Image::make('Image', 'image'),
            Image::make('Image', 'image')
                ->disk('project-image')
                ->preview(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : url('project-images/placeholder.png');
                })
                ->thumbnail(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : url('project-images/placeholder.png');
                })
                ->disableDownload()
                ->rules('sometimes', 'image', 'mimes:jpeg,png,jpg,webp,gif') // Ensure it's required but doesn't reset on update
                ->nullable()
                ->help('SIZE (Any Size) | Formats: jpeg, png, jpg, webp, gif'),

            File::make('Video', 'video')
                ->disk('project-video')
                ->onlyOnForms()
                ->disableDownload()
                ->rules('sometimes', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv')
                ->acceptedTypes('.mp4,.mov,.avi,.wmv')
                ->nullable()
                ->help('Upload a video file (MP4, MOV, AVI, or WMV).'),

            Text::make('Preview')->onlyOnDetail()->asHtml()->displayUsing(function ($value, $resource) {
                if (!$resource->video) {
                    return null;
                }

                $url = Storage::disk('project-video')->url($resource->video); // Get video URL

                return '<div style="display: flex; justify-content: center; align-items: center; padding: 10px; background: #f9f9f9; border-radius: 10px;">
                            <video width="40%" height="auto" style="max-width: 600px; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);" controls muted>
                                <source src="' . $url . '" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>';
            }),

            Image::make('Thumbnail Video Image', 'video_image')
                ->disk('project-thumbnail-image')
                ->preview(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : url('project-thumbnail-images/placeholder.png');
                })
                ->thumbnail(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : url('project-thumbnail-images/placeholder.png');
                })
                ->disableDownload()
                ->rules('sometimes') // Ensure it's required but doesn't reset on update
                ->nullable()
                ->rules('nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                ->help('SIZE (600 × 600) | Formats: jpeg, png, jpg, webp, gif'),

            URL::make('GitHub URL', 'github_link'),

            Tag::make('Tags')
                ->showCreateRelationButton()
                ->preload()
                ->rules('required')
                ->withPreview(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
