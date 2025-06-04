<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ConnectInfo extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ConnectInfo>
     */
    public static $model = \App\Models\ConnectInfo::class;

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
            ID::make()->sortable(),

            Text::make('Phone')
                ->rules('nullable', 'string', 'max:255'),

            Text::make('Whatsapp')
                ->rules('nullable', 'string', 'max:255'),

            Text::make('Email')
                ->rules('nullable', 'email', 'max:255'),

            Text::make('Facebook')
                ->rules('nullable', 'url', 'max:255'),

            Text::make('LinkedIn')
                ->rules('nullable', 'url', 'max:255'),

            Text::make('Instagram')
                ->rules('nullable', 'url', 'max:255'),

            Text::make('YouTube')
                ->rules('nullable', 'url', 'max:255'),

            Text::make('Location')
                ->rules('nullable', 'string', 'max:255'),

            Number::make('Latitude')
                ->step(0.0000001)
                ->rules('nullable', 'numeric', 'between:-90,90'),

            Number::make('Longitude')
                ->step(0.0000001)
                ->rules('nullable', 'numeric', 'between:-180,180'),

            Text::make('Title', 'title'),

            Textarea::make('Description', 'description'),
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
