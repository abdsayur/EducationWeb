<?php

namespace App\Http\Controllers;

use App\Models\BannerSection;
use App\Models\FooterPage;
use Illuminate\Http\Request;

class FooterPageController extends Controller
{
    public function show($slug)
    {
        $page = FooterPage::where('slug', $slug)->firstOrFail();
        $banner = BannerSection::firstOrFail();
        return view('layouts.pages.footer-pages', compact('page', 'banner'));
    }
}
