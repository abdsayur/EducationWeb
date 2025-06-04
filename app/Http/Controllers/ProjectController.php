<?php

namespace App\Http\Controllers;

use App\Models\BannerSection;
use App\Models\Domain;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere(
                        'second_description',
                        'like',
                        '%' . $request->search . '%'
                    )
                    ->orWhere('note', 'like', '%' . $request->search . '%');
            });
        }

        // Search by title
        if ($request->has('title') && $request->title != '') {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filter by domain functionality
        if ($request->has('domain') && $request->domain != '') {
            $query->whereHas('domains', function ($q) use ($request) {
                $q->where('name', $request->domain);
            });
        }

        // Filter by tag functionality
        if ($request->has('tag') && $request->tag != '') {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        // Pagination
        $projects = $query->orderBy('created_at', 'desc')->paginate(4);

        // Get all distinct domains with the count of projects in each domain
        // $domains = DB::table('projects')
        //     ->select('domain', DB::raw('count(*) as count'))
        //     ->groupBy('domain')
        //     ->get();

        // change to this:

        $domains = Domain::withCount('projects')->get();


        // Get all tags for filtering purposes
        $tags = Tag::all();

        $banner = BannerSection::firstOrFail();

        return view('layouts.pages.project', compact('projects', 'domains', 'tags', 'banner'));
    }

    public function show(Project $project)
    {
        $project->load('tags');

        $banner = BannerSection::firstOrFail();

        return view('layouts.pages.project-details', compact('project', 'banner'));
    }

    public function search(Request $request)
    {
        $query = Project::query();

        // Filter by domain
        if ($request->has('domain') && $request->domain) {
            $query->where('domain', $request->domain);
        }

        // Filter by title
        if ($request->has('title') && $request->title) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        // Get the filtered projects
        $projects = $query->get();

        return view('projects.index', compact('projects'));
    }
}
