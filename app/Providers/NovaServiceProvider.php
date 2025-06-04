<?php

namespace App\Providers;

use App\Nova\BannerSection;
use App\Nova\CompanyService;
use App\Nova\ConnectInfo;
use App\Nova\ContactUsEmail;
use App\Nova\Course;
use App\Nova\Domain;
use App\Nova\Expertise;
use App\Nova\FooterPage;
use App\Nova\HomeSlider;
use App\Nova\HowToApply;
use App\Nova\Offer;
use App\Nova\Professor;
use App\Nova\ProfessorService;
use App\Nova\Project;
use App\Nova\Student;
use App\Nova\StudentService;
use App\Nova\Tag;
use App\Nova\Theme;
use App\Nova\UniversityService;
use App\Nova\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::footer(function ($request) {
            return '<p class="text-center">Staging Version</p>';
        });


        Nova::mainMenu(
            function (Request $request) {
                return
                    [
                        MenuSection::make('Dashboard')->path('/dashboards/main')->icon('chart-bar'),

                        MenuSection::make('Home', [
                            MenuItem::resource(HomeSlider::class),
                            MenuItem::resource(Offer::class),
                        ])->icon('home')->collapsable(),

                        MenuSection::make('Course', [
                            MenuItem::resource(Course::class),
                            MenuItem::resource(HowToApply::class),
                            MenuItem::resource(Tag::class),
                        ])->icon('folder-open')->collapsable(),

                        MenuSection::make('Projects And Themes', [
                            MenuItem::resource(Project::class),
                            MenuItem::resource(Theme::class),
                            MenuItem::resource(Tag::class),
                            MenuItem::resource(Domain::class),
                        ])->icon('book-open')->collapsable(),

                        MenuSection::make('Students And Professors', [
                            MenuItem::resource(Student::class),
                            MenuItem::resource(Professor::class),
                            MenuItem::resource(Expertise::class),
                        ])->icon('users')->collapsable(),

                        MenuSection::make('Services', [
                            // MenuItem::resource(StudentService::class),
                            MenuItem::link(
                                'Student',
                                '/resources/student-services/1'
                            ),
                            // MenuItem::resource(ProfessorService::class),
                            MenuItem::link(
                                'Professor',
                                '/resources/professor-services/1'
                            ),
                            // MenuItem::resource(UniversityService::class),
                            MenuItem::link(
                                'University',
                                '/resources/university-services/1'
                            ),
                            // MenuItem::resource(CompanyService::class),
                            MenuItem::link(
                                'Company',
                                '/resources/company-services/1'
                            ),
                        ])->icon('server')->collapsable(),

                        MenuSection::make('Settings', [
                            MenuItem::resource(BannerSection::class),
                            MenuItem::resource(ContactUsEmail::class),
                            // MenuItem::resource(ConnectInfo::class),
                            MenuItem::link(
                                'Contact Info',
                                '/resources/connect-infos/1'
                            ),
                            MenuItem::resource(FooterPage::class),
                            MenuItem::resource(User::class),
                        ])->icon('cog')->collapsable(),
                    ];
            }
        );
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
