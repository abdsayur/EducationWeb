@extends('layouts.app1')

@section('title', 'Create Student')

@section('content')

<!-- Start Simple Gray Background Section -->
<div class="section-banner" style="background-color: #9b9999;">
    <div class="container">
        <div class="banner-spacing" style="padding: 100px 0 !important;">
            <div class="section-info" style="bottom:-20%">
                <h2 data-aos="fade-up" data-aos-delay="100">{{ $page->title }}</h2>
            </div>
        </div>
    </div>
</div>
<!-- End Simple Gray Background Section -->

{{-- style just for this --}}
<div class="container py-5">
    <div class="page-content" style="
        padding-top: 1rem !important;
        max-width: 850px;
        margin: 0 auto;
        font-size: 18px;
        line-height: 1.9;
        color: #333;
    ">
        {!! nl2br($page->content) !!}
    </div>
</div>
@endsection
