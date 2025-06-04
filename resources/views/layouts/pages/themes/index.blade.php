@extends('layouts.app1')

@section('title', 'Themes')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner"
    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->theme_image) }}')">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Our Themes</h2>
                <p data-aos="fade-up" data-aos-delay="200">{!! Str::limit($banner->theme_description, 100) !!}</p>
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
                <div class="row">
                    @foreach($themes as $theme)
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <div class="blog-single-card">
                            <div class="image">
                                <img src="{{ Storage::disk('project-image')->url($theme->image) }}" alt="image">
                            </div>
                            <div class="content">
                                <div class="meta">
                                    <ul>
                                        <li><a href="#">{{ $theme->writer }}</a></li>
                                        <li>{{ optional($theme->release_date)->format('M d, Y') ?? 'N/A' }}</li>
                                        @foreach ($theme->domains as $domain)
                                        <li>{{ $domain->name }}</li>
                                        @endforeach

                                    </ul>
                                </div>
                                <h3><a href="{{ route('theme.show', ['theme' => $theme->id]) }}">{{
                                        $theme->title }}</a></h3>

                                <!-- Description: Limit to 2 lines -->
                                <p>
                                    {{ \Str::limit(strip_tags($theme->description), 100, '...') }}
                                </p>

                                <a class="butn" href="{{ route('theme.show', ['theme' => $theme->id]) }}">Read
                                    More <i class="bx bx-right-arrow-alt"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="blog-pagi">
                    {{ $themes->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="widget-area">
                    <!-- Search -->
                    <div class="widget widget-search">
                        <h3 class="widget-title">Search</h3>
                        <form class="search-form" method="GET" action="{{ route('theme.index') }}">
                            <label>
                                <span class="screen-reader-text">Search for:</span>
                                <input type="search" name="search" class="search-field" placeholder="Search..."
                                    value="{{ request('search') }}">
                            </label>
                            <button type="submit"><i class='bx bx-search'></i></button>
                        </form>
                    </div>

                    <!-- Domain Filter -->
                    <div class="widget widget-catagories">
                        <h3 class="widget-title">Domain</h3>
                        <ul>
                            @foreach($domains as $domain)
                            <li>
                                <h3>
                                    <a href="{{ route('theme.index', array_merge(request()->all(), ['domain' => $domain->name])) }}"
                                        class="{{ request()->get('domain') == $domain->name ? 'active' : '' }}">
                                        {{ $domain->name }}
                                    </a>
                                </h3>
                                <span>({{ $domain->themes->count() }})</span>
                                <!-- Display theme count using relationship -->
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Popular Tags Filter -->
                    <div class="widget widget-tags">
                        <h3 class="widget-title">Popular Tags</h3>
                        <ul>
                            @foreach($tags as $tag)
                            <li>
                                <a href="{{ route('theme.index', ['tag' => $tag->name]) }}"
                                    class="{{ request()->get('tag') == $tag->name ? 'active' : '' }}">
                                    {{ strtoupper($tag->name) }}
                                </a>
                            </li>
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
