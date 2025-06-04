<?php

namespace App\Http\Controllers;

use App\Models\BannerSection;
use App\Models\CompanyService;
use App\Models\ConnectInfo;
use App\Models\Course;
use App\Models\Domain;
use App\Models\HomeSlider;
use App\Models\Offer;
use App\Models\ProfessorService;
use App\Models\Project;
use App\Models\StudentService;
use App\Models\Tag;
use App\Models\Theme;
use App\Models\UniversityService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all home sliders
        $homeSliders = HomeSlider::orderBy('created_at', 'desc')->get();

        // Fetch all distinct projectDomains
        $projectDomains = Domain::whereHas('projects')->distinct()->pluck('name');

        // Fetch all distinct themeDomains
        $themeDomains = Domain::whereHas('themes')->distinct()->pluck('name');

        // Fetch all distinct tags
        $tags = Tag::whereHas('courses')->distinct()->get();

        // Fetch all distinct projectTitles
        $projectTitles = Project::select('title')->distinct()->pluck('title');

        // Fetch all distinct themeTitles
        $themeTitles = Theme::select('title')->distinct()->pluck('title');

        // Fetch all distinct courseTitles
        $courseTitles = Course::select('title')->distinct()->pluck('title');

        // Fetch all Offers
        $offers = Offer::all();

        // Fetch all Theme And Projects
        $themes = Theme::orderBy('release_date', 'desc')->paginate(3);
        $projects = Project::orderBy('release_date', 'desc')->paginate(2);

        $info = ConnectInfo::firstOrFail();

        $banner = BannerSection::firstOrFail();
        // Pass the data to the view
        return view('layouts.pages.home', compact('homeSliders', 'projectDomains', 'themeDomains', 'projectTitles', 'themeTitles', 'offers', 'themes', 'projects', 'info', 'tags', 'courseTitles', 'banner'));
    }

    public function globalSearch(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }

        $results = collect();

        // Helper to check multiple fields
        $likeQuery = function ($queryBuilder, array $fields, $query) {
            return $queryBuilder->where(function ($q) use ($fields, $query) {
                foreach ($fields as $field) {
                    $q->orWhere($field, 'like', '%' . $query . '%');
                }
            });
        };

        // Courses
        $courses = $likeQuery(Course::query(), ['title', 'objective', 'material', 'requirement'], $query)
            ->limit(5)
            ->get()
            ->map(function ($course) {
                return [
                    'type'        => 'Course',
                    'title'       => $course->title,
                    'objective'   => $course->objective,
                    'material'    => $course->material,
                    'requirement' => $course->requirement,
                    'link'        => route('course.show', $course->id),
                ];
            });

        $results = $results->concat($courses);

        // Projects
        $projects = $likeQuery(Project::query(), ['title', 'description', 'second_description', 'note'], $query)
            ->limit(5)
            ->get()
            ->map(function ($project) {
                return [
                    'type'               => 'Project',
                    'title'              => $project->title,
                    'description'        => $project->description,
                    'second_description' => $project->second_description,
                    'note'               => $project->note,
                    'link'               => route('project.show', $project->id),
                ];
            });

        $results = $results->concat($projects);

        // Themes
        $themes = $likeQuery(Theme::query(), ['title', 'description', 'second_description', 'note'], $query)
            ->limit(5)
            ->get()
            ->map(function ($theme) {
                return [
                    'type'               => 'Theme',
                    'title'              => $theme->title,
                    'description'        => $theme->description,
                    'second_description' => $theme->second_description,
                    'note'               => $theme->note,
                    'link'               => route('theme.show', $theme->id),
                ];
            });

        $results = $results->concat($themes);

        // Services: since you have only one row of each service, no need for `limit`
        $serviceSearchFields = [
            'StudentService' => [
                'model' => StudentService::first(),
                'fields' => ['desc_di', 'title_td_1', 'desc_td_1', 'title_td_2', 'desc_td_2', 'title_td_3', 'desc_td_3', 'title_tdi_1', 'desc_tdi_1', 'title_tdi_2', 'desc_tdi_2'],
                'route' => route('services.student'),
                'title' => 'Student Services'
            ],
            'ProfessorService' => [
                'model' => ProfessorService::first(),
                'fields' => ['desc_di', 'title_td_1', 'desc_td_1', 'title_td_2', 'desc_td_2', 'title_td_3', 'desc_td_3', 'title_tdi_1', 'desc_tdi_1', 'title_tdi_2', 'desc_tdi_2'],
                'route' => route('services.professor'),
                'title' => 'Professor Services'
            ],
            'UniversityService' => [
                'model' => UniversityService::first(),
                'fields' => ['desc_d', 'title_td', 'desc_td', 'title_tdi_1', 'desc_tdi_1', 'title_tdi_2', 'desc_tdi_2'],
                'route' => route('services.university'),
                'title' => 'University Services'
            ],
            'CompanyService' => [
                'model' => CompanyService::first(),
                'fields' => ['desc_d', 'title_td', 'desc_td', 'title_tdi_1', 'desc_tdi_1', 'title_tdi_2', 'desc_tdi_2'],
                'route' => route('services.company'),
                'title' => 'Company Services'
            ],
        ];

        foreach ($serviceSearchFields as $type => $service) {
            $model = $service['model'];
            if ($model) {
                foreach ($service['fields'] as $field) {
                    if (stripos($model->$field, $query) !== false) {
                        $results->push(array_merge(['type' => $type, 'title' => $service['title'], 'link' => $service['route']], $model->toArray()));
                        break;
                    }
                }
            }
        }

        return response()->json($results->values());
    }
}
