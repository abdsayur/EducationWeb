<?php

namespace App\Nova;

use App\Nova\Actions\SendEmail;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Panel;
use Laravel\Nova\Http\Requests\NovaRequest;

class Professor extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Professor>
     */
    public static $model = \App\Models\Professor::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'first_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'first_name', 'last_name'
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

            Select::make('Teaching Type', 'teaching_type')
                ->options([
                    'fixed_time' => 'Fixed Time',
                    'permanent' => 'Permanent',
                ])
                ->sortable()
                ->filterable()
                ->displayUsingLabels()
                ->rules('required'),

            Text::make('First Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Last Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Email::make('Email')
                ->sortable()
                ->creationRules('required', 'email', 'unique:professors,email', 'unique:students,email')
                ->updateRules('required', 'email', 'unique:professors,email,{{resourceId}}', 'unique:students,email'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'min:6')
                ->updateRules('nullable', 'min:6'),

            Text::make('Phone')
                ->sortable()
                ->rules('nullable', 'max:20'),

            File::make('CV')
                ->disk('public')
                ->rules($request->isMethod('post') ? 'required' : 'nullable')
                ->prunable(),

            // Extra fields only for "fixed_time" professors
            Panel::make('Additional Details (Fixed Time Only)', [
                Text::make('LinkedIn', 'linked_in')
                    ->sortable()
                    ->hide()
                    ->dependsOn(
                        ['teaching_type'],
                        function (Text $field, NovaRequest $request, FormData $formData) {
                            if ($formData->teaching_type === 'fixed_time') {
                                $field->show()->rules(['required']);
                            }
                        }
                    ),

                Country::make('Country')
                    ->sortable()
                    ->filterable()
                    ->hide()
                    ->dependsOn(
                        ['teaching_type'],
                        function (Country $field, NovaRequest $request, FormData $formData) {
                            if ($formData->teaching_type === 'fixed_time') {
                                $field->show()->rules(['required']);
                            }
                        }
                    ),

                Textarea::make('More Info', 'more_info')
                    ->hide()
                    ->dependsOn(
                        ['teaching_type'],
                        function (Textarea $field, NovaRequest $request, FormData $formData) {
                            if ($formData->teaching_type === 'fixed_time') {
                                $field->show()->rules(['nullable']);
                            }
                        }
                    ),

                Text::make('Teaching Mode', 'teaching_mode')
                    ->filterable()
                    ->suggestions([
                        'Online',
                        'Paris',
                    ])
                    ->sortable()
                    ->hide()
                    ->dependsOn(
                        ['teaching_type'],
                        function (Text $field, NovaRequest $request, FormData $formData) {
                            if ($formData->teaching_type === 'fixed_time') {
                                $field->show()->rules(['required']);
                            }
                        }
                    ),
            ]),

            Boolean::make('Share Data', 'share_data')
                ->filterable(),

            // BelongsToMany::make('Expertises', 'expertises', Expertise::class),
            Tag::make('Expertises')
                ->showCreateRelationButton()
                ->preload()
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
        return [
            new SendEmail(),

            ExportAsCsv::make()->nameable()->withFormat(function ($model) {
                return [
                    'ID' => $model->getKey(),
                    'First Name' => $model->first_name,
                    'Last Name' => $model->last_name,
                    'Email Address' => $model->email,
                    'Teaching Type' => $model->teaching_type,
                ];
            }),
        ];
    }
}
