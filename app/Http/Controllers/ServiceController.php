<?php

namespace App\Http\Controllers;

use App\Models\BannerSection;
use App\Models\CompanyService;
use App\Models\ProfessorService;
use App\Models\StudentService;
use App\Models\UniversityService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function student()
    {
        $service = StudentService::firstOrFail();

        $banner = BannerSection::firstOrFail();

        return view('layouts.pages.services.student', compact('service', 'banner'));
    }

    public function professor()
    {
        $service = ProfessorService::firstOrFail();
        $banner = BannerSection::firstOrFail();
        return view('layouts.pages.services.professor', compact('service', 'banner'));
    }

    public function university()
    {
        $service = UniversityService::firstOrFail();
        $banner = BannerSection::firstOrFail();
        return view('layouts.pages.services.university', compact('service', 'banner'));
    }

    public function company()
    {
        $service = CompanyService::firstOrFail();
        $banner = BannerSection::firstOrFail();
        return view('layouts.pages.services.company', compact('service', 'banner'));
    }
}
