@extends('layouts.app1')

@section('title', 'Theme Details')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner"
    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->theme_details_image) }}')">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">{{$theme->title}}</h2>
                {{-- <h2 data-aos="fade-up" data-aos-delay="100">{!! Str::limit($theme->title, 100) !!}</h2> --}}
                {{-- <p data-aos="fade-up" data-aos-delay="200">{!! Str::limit($theme->description, 60) !!}</p> --}}
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
                        <img src="{{ Storage::disk('project-image')->url($theme->image) }}" alt="{{ $theme->title }}">
                    </div>

                    <div class="article-content">
                        <div class="entry-meta">
                            <ul>
                                <li>{{ $theme->writer }}</li>
                                <li>
                                    @foreach ($theme->domains as $domain)
                                    {{ $domain->name }}/
                                    @endforeach
                                </li>
                                <li>{{ optional($theme->release_date)->format('M d, Y') ?? 'N/A' }}</li>
                            </ul>
                        </div>

                        <h3>{{ $theme->title }}</h3>
                        <p>{!! $theme->description !!}</p>

                        @if($theme->note)
                        <blockquote class="wp-block-quote">
                            <p>“{!! $theme->note !!}”</p>
                        </blockquote>
                        @endif

                        <ul class="wp-block-gallery columns-2">
                            <li class="blocks-gallery-item">
                                <figure>
                                    <!-- Video Wrapper -->
                                    <div class="video-wrapper">
                                        <!-- Thumbnail Image with Play Button -->
                                        <div class="video-thumbnail" onclick="playVideo('video-{{ $theme->id }}')">
                                            <img src="{{ $theme->video_image ? Storage::disk('project-thumbnail-image')->url($theme->video_image) : asset('assets/img/default-thumbnail.png') }}"
                                                alt="Thumbnail">
                                            <div class="play-button-overlay">
                                                <span class="play-icon">▶</span>
                                            </div>
                                        </div>
                                        <!-- Video Element -->
                                        <video id="video-{{ $theme->id }}" controls
                                            onended="resetThumbnail('video-{{ $theme->id }}')">
                                            <source
                                                src="{{ $theme->video ? Storage::disk('project-video')->url($theme->video) : '' }}"
                                                type="video/mp4">Your browser does not support video playback.
                                        </video>
                                    </div>
                                </figure>
                            </li>
                        </ul>

                        <p>{!! $theme->second_description !!}</p>
                    </div>

                    <div class="article-footer">
                        <div class="article-tags">
                            <span>GitHub URL:</span>
                            <a href="{{ $theme->github_link }}" target="_blank">{{ $theme->github_link }}</a>
                        </div>
                    </div>

                    <div class="article-footer">
                        <div class="article-tags">
                            <span>Tags:</span>
                            @foreach($theme->tags as $tag)
                            <a href="#">{{ strtoupper($tag->name) }}</a>
                            @endforeach
                        </div>
                        <div class="article-share">
                            <ul class="social">
                                <li><span>Share:</span></li>
                                <li><a href="#" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li><a href="#" class="twitter" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li><a href="#" class="linkedin" target="_blank"><i class="bx bxl-linkedin"></i></a>
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
                            @foreach($theme->tags as $tag)
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
