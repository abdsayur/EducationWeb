<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class UniversityService extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\UniversityService>
     */
    public static $model = \App\Models\UniversityService::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            // ID::make()->sortable(),

            // DI Panel (Description)
            new Panel('Just Description Section', [
                Textarea::make('Description', 'desc_d')
                    ->alwaysShow(),
            ]),

            // TDI Panel (Title + Description + Image)
            new Panel('Title, Description and Image Section', [
                Text::make('Title 1', 'title_tdi_1'),
                Textarea::make('Description 1', 'desc_tdi_1')->alwaysShow(),
                Image::make('Image 1', 'image_tdi_1')
                    ->disk('service-image')
                    ->preview(function ($value, $disk) {
                        return $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png');
                    })
                    ->thumbnail(function ($value, $disk) {
                        return $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png');
                    })
                    ->disableDownload()
                    ->rules('sometimes')
                    ->nullable(),

                Text::make('Title 2', 'title_tdi_2'),
                Textarea::make('Description 2', 'desc_tdi_2')->alwaysShow(),
                Image::make('Image 2', 'image_tdi_2')
                    ->disk('service-image')
                    ->preview(function ($value, $disk) {
                        return $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png');
                    })
                    ->thumbnail(function ($value, $disk) {
                        return $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png');
                    })
                    ->disableDownload()
                    ->rules('sometimes')
                    ->nullable(),
            ]),

            // TD Panel (Title + Description)
            new Panel('Title and Description Section', [
                Text::make('Title', 'title_td'),
                Textarea::make('Description', 'desc_td')->alwaysShow(),
            ]),
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

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }
}
