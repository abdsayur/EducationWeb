@extends('layouts.app1')

@section('title', 'Course Details')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner"
    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->project_details_image) }}')">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">{{ $project->title }}</h2>
                {{-- <h2 data-aos="fade-up" data-aos-delay="100">{!! Str::limit($project->title, 20) !!}</h2> --}}
                {{-- <p data-aos="fade-up" data-aos-delay="200">{!! Str::limit($project->description, 100) !!}</p> --}}
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->

<!-- Start Blog Area -->
<div class="blog-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details-desc">
                    <div class="article-image">
                        <img src="{{ Storage::disk('project-image')->url($project->image) }}"
                            alt="{{ $project->title }}">
                    </div>

                    <div class="article-content">
                        <div class="entry-meta">
                            <ul>
                                <li>{{ $project->writer }}</li>
                                <li>
                                    @foreach ($project->domains as $domain)
                                    {{ $domain->name }}/
                                    @endforeach
                                </li>
                                <li>{{ optional($project->release_date)->format('M d, Y') ?? 'N/A' }}</li>
                            </ul>
                        </div>

                        <h3>{{ $project->title }}</h3>
                        <p>{!! $project->description !!}</p>

                        @if($project->note)
                        <blockquote class="wp-block-quote">
                            <p>“{!! $project->note !!}”</p>
                        </blockquote>
                        @endif

                        <ul class="wp-block-gallery columns-2">
                            <li class="blocks-gallery-item">
                                <figure>
                                    <!-- Video Wrapper -->
                                    <div class="video-wrapper">
                                        <!-- Thumbnail Image with Play Button -->
                                        <div class="video-thumbnail" onclick="playVideo('video-{{ $project->id }}')">
                                            <img src="{{ $project->video_image ? Storage::disk('project-thumbnail-image')->url($project->video_image) : asset('assets/img/default-thumbnail.png') }}"
                                                alt="Thumbnail">
                                            <div class="play-button-overlay">
                                                <span class="play-icon">▶</span>
                                            </div>
                                        </div>
                                        <!-- Video Element -->
                                        <video id="video-{{ $project->id }}" controls
                                            onended="resetThumbnail('video-{{ $project->id }}')">
                                            <source
                                                src="{{ $project->video ? Storage::disk('project-video')->url($project->video) : '' }}"
                                                type="video/mp4">Your browser does not support video playback.
                                        </video>
                                    </div>
                                </figure>
                            </li>
                        </ul>

                        <p>{!! $project->second_description !!}</p>
                    </div>

                    <div class="article-footer">
                        <div class="article-tags">
                            <span>GitHub URL:</span>
                            <a href="{{ $project->github_link }}" target="_blank">{{ $project->github_link }}</a>
                        </div>
                    </div>

                    <div class="article-footer">
                        <div class="article-tags">
                            <span>Tags:</span>
                            @foreach($project->tags as $tag)
                            <a href="#">{{ strtoupper($tag->name) }}</a>
                            @endforeach
                        </div>
                        <div class="article-share">
                            <ul class="social">
                                <li><span>Share:</span></li>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                        class="facebook" target="_blank">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($project->title) }}&url={{ urlencode(request()->fullUrl()) }}"
                                        class="twitter" target="_blank">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                                        class="linkedin" target="_blank">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Section -->
            <div class="col-lg-4">
                <div class="widget-area">
                    <div class="widget widget-search">
                        <h3 class="widget-title">Search</h3>
                        <form class="search-form">
                            <label>
                                <input type="search" class="search-field" placeholder="Search...">
                            </label>
                            <button type="submit"><i class='bx bx-search'></i></button>
                        </form>
                    </div>

                    <div class="widget widget-tags">
                        <h3 class="widget-title">Popular Tags</h3>
                        <ul>
                            @foreach($project->tags as $tag)
                            <li><a href="#">{{ strtoupper($tag->name) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Blog Area -->
@endsection
