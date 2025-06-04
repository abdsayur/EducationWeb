<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class BannerSection extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BannerSection>
     */
    public static $model = \App\Models\BannerSection::class;

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

            new Panel('Home Page', [
                Image::make('Image', 'home_image')
                    ->disk('banner-section-image')
                    ->disableDownload()
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->home_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (400 × 484) | Formats: jpeg, png, jpg, webp, gif'),
                Text::make('Text 1', 'home_text_1')->maxlength(20)->nullable(),
                Text::make('Text 2', 'home_text_2')->maxlength(20)->nullable(),
                Text::make('Text 3', 'home_text_3')->maxlength(20)->nullable(),
            ]),

            new Panel('Project Page', [
                Image::make('Image', 'project_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->project_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                Textarea::make('Description', 'project_description')
                    ->alwaysShow()->rules('required'),
                Image::make('Details Image', 'project_details_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->project_details_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
            ]),

            new Panel('Theme Page', [
                Image::make('Image', 'theme_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->theme_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                Textarea::make('Description', 'theme_description')
                    ->alwaysShow()->rules('required'),
                Image::make('Details Image', 'theme_details_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->theme_details_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
            ]),

            new Panel('Course Page', [
                Image::make('Image', 'course_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->course_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                Textarea::make('Description', 'course_description')
                    ->alwaysShow()->rules('required'),
                Image::make('Details Image', 'course_details_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->course_details_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                Textarea::make('Details Description', 'course_details_description')
                    ->alwaysShow()->rules('required'),
            ]),

            new Panel('Student Service', [
                Image::make('Image', 'student_service_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->student_service_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                Text::make('Title', 'student_service_title')->rules('required'),
                Textarea::make('Description', 'student_service_description')->alwaysShow()->rules('required'),
            ]),

            new Panel('Professor Service', [
                Image::make('Image', 'professor_service_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->professor_service_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                Text::make('Title', 'professor_service_title')->rules('required'),
                Textarea::make('Description', 'professor_service_description')->alwaysShow()->rules('required'),
            ]),

            new Panel(
                'University Service',
                [
                    Image::make('Image', 'university_service_image')
                        ->disk('banner-section-image')
                        // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                        // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                        ->disableDownload()
                        // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                        ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                        ->updateRules(function () {
                            return [
                                Rule::requiredIf(is_null($this->university_service_image)),
                                'image',
                                'mimes:jpeg,png,jpg,webp,gif',
                            ];
                        })
                        ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                    Text::make('Title', 'university_service_title')->rules('required'),
                    Textarea::make('Description', 'university_service_description')->alwaysShow()->rules('required'),
                ]
            ),

            new Panel('Company Service', [
                Image::make('Image', 'company_service_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->company_service_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                Text::make('Title', 'company_service_title')->rules('required'),
                Textarea::make('Description', 'company_service_description')->alwaysShow()->rules('required'),
            ]),

            new Panel('Create Student', [
                Image::make('Image', 'create_student_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->create_student_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                Textarea::make('Description', 'create_student_description')->alwaysShow()->rules('required'),
            ]),

            new Panel('Create Professor', [
                Image::make('Image', 'create_professor_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->create_professor_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                Textarea::make('Description', 'create_professor_description')->alwaysShow()->rules('required'),
            ]),

            new Panel('Contact Page', [
                Image::make('Image', 'contact_image')
                    ->disk('banner-section-image')
                    // ->preview(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    // ->thumbnail(fn ($value, $disk) => $value ? Storage::disk($disk)->url($value) : url('service-images/placeholder.png'))
                    ->disableDownload()
                    // ->rules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->creationRules('required', 'image', 'mimes:jpeg,png,jpg,webp,gif')
                    ->updateRules(function () {
                        return [
                            Rule::requiredIf(is_null($this->contact_image)),
                            'image',
                            'mimes:jpeg,png,jpg,webp,gif',
                        ];
                    })
                    ->help('size (1920 × 400) | Formats: jpeg, png, jpg, webp, gif'),
                Textarea::make('Description', 'contact_description')->alwaysShow()->rules('required'),
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
