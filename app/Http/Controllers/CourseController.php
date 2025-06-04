<?php

namespace App\Http\Controllers;

use App\Models\BannerSection;
use App\Models\Course;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        // Get sorting and search query
        $sort = $request->query('sort', 'latest');
        $search = $request->query('search', '');
        $location = $request->query('location');  // Location filter if provided
        $tagId = $request->query('tag');  // Tag filter if provided
        $language = $request->query('language');  // Get the language filter if provided

        // Build the query
        $query = Course::query();

        // Filter by search term
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('details', 'like', "%$search%")
                    ->orWhere('objective', 'like', "%$search%")
                    ->orWhere('material', 'like', "%$search%")
                    ->orWhere(
                        'requirement',
                        'like',
                        "%$search%"
                    );
            });
        }

        // Filter by location (call_type)
        if ($location) {
            $query->where('call_type', $location);
        }

        // Filter by tag (tag_id)
        if ($tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tags.id', $tagId);
            });
        }

        // Filter by language
        if ($language) {
            $query->where('language', $language);  // Adjust this to match your actual language field
        }

        // Sorting
        if ($sort === 'title') {
            $query->orderBy('title', 'asc');
        } elseif ($sort === 'start-date') {
            $query->orderBy('call_date', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Fetch tags dynamically with course counts
        $tags = Tag::select('tags.id', 'tags.name', DB::raw('COUNT(course_tag.course_id) as count'))
            ->join('course_tag', 'tags.id', '=', 'course_tag.tag_id')
            ->groupBy('tags.id', 'tags.name')
            ->get();

        // Get locations dynamically
        $locations = [
            'Face To Face' => Course::where('call_type', 'face-to-face')->count(),
            'Online' => Course::where('call_type', 'online')->count(),
        ];

        // Get languages dynamically with course counts
        $languages = [
            'English' => Course::where('language', 'English')->count(),
            'French' => Course::where('language', 'French')->count(),
        ];

        $banner = BannerSection::firstOrFail();

        // Paginate courses
        $courses = $query->orderBy('created_at', 'desc')->paginate(4);

        return view('layouts.pages.course', compact('courses', 'sort', 'tags', 'locations', 'search', 'location', 'tagId', 'languages', 'language', 'banner'));
    }

    public function show(Course $course)
    {
        $banner = BannerSection::firstOrFail();
        return view('layouts.pages.course-details', compact('course', 'banner'));
    }

    public function enroll(Course $course)
    {
        $student = Auth::guard('student')->user(); // Get the authenticated student

        if (!$student) {
            return redirect()->back()->with('error', 'You need to be logged in to enroll.');
        }

        // Check if the student is already enrolled
        if ($course->students()->where('student_id', $student->id)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Enroll the student
        $course->students()->syncWithoutDetaching([$student->id => ['created_at' => now()]]);

        return redirect()->back()->with('success', 'You have successfully enrolled!');
    }
}
