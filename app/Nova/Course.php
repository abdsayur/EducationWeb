<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Course extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Course>
     */
    public static $model = \App\Models\Course::class;

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
        'id', 'title', 'location', 'language', 'call_type', 'university'
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

            Text::make('Title', 'title')->rules('required'),

            Text::make('Location', 'location')->nullable(),

            Select::make('Language', 'language')->options([
                'english' => 'English',
                'french' => 'French'
            ])->displayUsingLabels()->nullable()->filterable(),

            Select::make('Call Type', 'call_type')->options([
                'online' => 'Online',
                'face-to-face' => 'Face To Face'
            ])->displayUsingLabels()->nullable()->filterable()->hideFromIndex(),

            Trix::make('About This Course', 'details')->nullable()->hideFromIndex(),

            Textarea::make('Learning Objectives', 'objective')->nullable()->hideFromIndex(),

            Textarea::make('Material Includes', 'material')->nullable()->hideFromIndex(),

            Textarea::make('Requirements', 'requirement')->nullable()->hideFromIndex(),

            Text::make('University', 'university')->nullable()->hideFromIndex(),

            Number::make('Number of Hours', 'nb_of_hours')->nullable()->hideFromIndex(),

            Date::make('Start Date', 'call_date')->nullable(),

            Text::make('Course Time', 'course_timing')->nullable()->hideFromIndex(),

            Image::make('Image', 'image')
                ->disk('course-image')
                ->preview(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : url('course-images/placeholder.png');
                })
                ->thumbnail(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : url('course-images/placeholder.png');
                })
                ->disableDownload()
                ->rules('sometimes')
                ->nullable()
                ->help(
                    'SIZE ( any size )'
                ),

            Tag::make('Tags')
                ->showCreateRelationButton()
                ->preload()
                ->withPreview(),

            HasOne::make('How To Apply', 'howToApply', HowToApply::class),
            // HasOne::make('How To Apply', 'howToApply', 'App\Nova\HowToApply'),

            BelongsToMany::make('Students')
                ->rules('unique:course_student,student_id,NULL,id,course_id,' . $request->resourceId),
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
