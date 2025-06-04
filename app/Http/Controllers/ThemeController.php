<?php

namespace App\Http\Controllers;

use App\Models\BannerSection;
use App\Models\Domain;
use App\Models\Tag;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $query = Theme::query();

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
        $themes = $query->orderBy('created_at', 'desc')->paginate(4);

        $domains = Domain::withCount('themes')->get();


        // Get all tags for filtering purposes
        $tags = Tag::all();

        $banner = BannerSection::firstOrFail();

        return view('layouts.pages.themes.index', compact('themes', 'domains', 'tags', 'banner'));
    }

    public function show(Theme $theme)
    {
        $theme->load('tags');

        $banner = BannerSection::firstOrFail();

        return view('layouts.pages.themes.show', compact('theme', 'banner'));
    }
}
