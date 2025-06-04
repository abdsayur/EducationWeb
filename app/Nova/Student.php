<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Student extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Student>
     */
    public static $model = \App\Models\Student::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

    public function title()
    {
        return "{$this->first_name} {$this->last_name}";
    }

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

            Text::make('First Name', 'first_name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Last Name', 'last_name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email', 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:students,email', 'unique:professors,email')
                ->updateRules('unique:students,email,{{resourceId}}', 'unique:professors,email'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),

            Text::make('Phone', 'phone')->nullable(),

            Select::make('Academic Year', 'academic_year')
                ->options([
                    'undergraduate' => 'Undergraduate',
                    'bachelor_1' => 'Bachelor - Year 1',
                    'bachelor_2' => 'Bachelor - Year 2',
                    'bachelor_3' => 'Bachelor - Year 3',
                    'master' => 'Master',
                    'master_1' => 'Master - Year 1',
                    'master_2' => 'Master - Year 2',
                    'phd' => 'PhD',
                ])
                ->displayUsingLabels()
                ->nullable(),


            Country::make('Country', 'country')->nullable(),

            BelongsToMany::make('Courses')
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
        return [
            ExportAsCsv::make()->nameable()->withFormat(function ($model) {
                return [
                    'ID' => $model->getKey(),
                    'First Name' => $model->first_name,
                    'Last Name' => $model->last_name,
                    'Email Address' => $model->email,
                ];
            }),
        ];
    }
}
