@extends('layouts.app1')

@section('title', 'Courses')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner"
    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->course_image) }}')">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Courses</h2>
                <p data-aos="fade-up" data-aos-delay="200">{{ $banner->course_description }}</p>
                {{-- LearnX is more than just a place of learning; it's
                a place where dreams take flight, where ideas flourish, and where you'll find the support and... --}}
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->

<!-- Start Courses Section Area -->
<div class="courses-section pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="grid-sorting">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-6">
                            <div class="title">
                                <p>We found {{ $courses->total() }} courses available for you</p>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="select-box">
                                <div class="form-group">
                                    <label>Sort by:</label>
                                    <select class="form-select" onchange="location = this.value;">
                                        <option value="{{ route('course.index', ['sort' => 'latest']) }}" {{
                                            $sort=='latest' ? 'selected' : '' }}>Latest</option>
                                        <option value="{{ route('course.index', ['sort' => 'title']) }}" {{
                                            $sort=='title' ? 'selected' : '' }}>Title (A-Z)</option>
                                        <option value="{{ route('course.index', ['sort' => 'start-date']) }}" {{
                                            $sort=='start-date' ? 'selected' : '' }}>Start Date</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($courses as $course)
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <div class="course-item">
                            <div class="image">
                                <img src="{{ Storage::disk('course-image')->url($course->image) }}" alt="image">
                            </div>
                            <div class="content">
                                <span>{{ optional($course->call_date)->format('F j, Y') ?? 'No Date Available' }}</span>
                                <h2><a href="{{ route('course.show', ['course' => $course->id]) }}">
                                        {{ $course->title }} </a>
                                </h2>
                                <ul>
                                    <li>
                                        <div class="image-circle">
                                            <img src="{{ asset('img/icon/icon-1.png') }}" alt="image">
                                        </div>
                                        <span>{{ $course->students->count() }}</span>
                                    </li>
                                    <li>
                                        <div class="image-circle">
                                            <img src="{{ asset('img/icon/icon-2.png') }}" alt="image">
                                        </div>
                                        <span>0</span>
                                    </li>
                                    <li>
                                        <div class="image-circle">
                                            <img src="{{ asset('img/icon/icon-3.png') }}" alt="image">
                                        </div>
                                        <span>5.0</span>
                                    </li>
                                </ul>

                                <div class="teacher-info">
                                    <div class="image">
                                        {{-- <img src="{{ asset('img/all-img/teacher-img.png') }}" alt="image"> --}}
                                        <p>{{ $course->location }} <span>{{ $course->call_type }}</span></p>
                                    </div>
                                    <div class="price">
                                        <p>{{ $course->language }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="blog-pagi">
                    {{ $courses->appends(['sort' => request('sort')])->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget-area">
                    <!-- Search Widget -->
                    <div class="widget widget-search">
                        <h3 class="widget-title">Search</h3>
                        <form class="search-form" method="GET" action="{{ route('course.index') }}">
                            <input type="search" name="search" class="search-field" placeholder="Search..."
                                value="{{ request('search') }}">
                            <button type="submit"><i class='bx bx-search'></i></button>
                        </form>
                    </div>

                    <!-- Tags Widget -->
                    <div class="widget widget-catagories">
                        <h3 class="widget-title">Tags</h3>
                        <ul>
                            @foreach ($tags as $tag)
                            <li>
                                <h3>
                                    <a
                                        href="{{ route('course.index', array_merge(request()->all(), ['tag' => $tag->id])) }}">
                                        {{ strtoupper($tag->name) }}
                                    </a>
                                </h3>
                                <span>({{ $tag->count }})</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Locations Widget -->
                    <div class="widget widget-list location">
                        <h3 class="widget-title">Call Type</h3>
                        <form action="{{ url()->current() }}" method="GET">
                            <ul>
                                @foreach ($locations as $locationName => $count)
                                <li>
                                    <div class="radio-from">
                                        <input type="radio" id="{{ Str::slug($locationName) }}" class="radio-input"
                                            name="location" value="{{ $locationName }}" {{
                                            request('location')==$locationName ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label for="{{ Str::slug($locationName) }}" class="radio-label">
                                            <span class="radio-border"></span> {{ $locationName }}
                                        </label>
                                    </div>
                                    <span>({{ $count }})</span>
                                </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>

                    <!-- Language Widget -->
                    <div class="widget widget-list languages">
                        <h3 class="widget-title">Languages</h3>
                        <form action="{{ url()->current() }}" method="GET">
                            <ul>
                                @foreach ($languages as $languageName => $count)
                                <li>
                                    <div class="radio-from">
                                        <input type="radio" id="rdoo-{{ $loop->index }}" class="radio-input"
                                            name="language" value="{{ $languageName }}" {{
                                            request('language')==$languageName ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label for="rdoo-{{ $loop->index }}" class="radio-label">
                                            <span class="radio-border"></span> {{ $languageName }}
                                        </label>
                                    </div>
                                    <span>({{ $count }})</span>
                                </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>
            </div>

            {{-- dd --}}
            {{-- <div class="col-lg-4">
                <div class="widget-area">
                    <div class="widget widget-search">
                        <h3 class="widget-title">
                            Search
                        </h3>
                        <form class="search-form">
                            <label>
                                <span class="screen-reader-text">Search for:</span>
                                <input type="search" class="search-field" placeholder="Search...">
                            </label>
                            <button type="submit"><i class='bx bx-search'></i></button>
                        </form>
                    </div>
                    <div class="widget widget-catagories">
                        <h3 class="widget-title">
                            Categories
                        </h3>

                        <ul>
                            <li>
                                <h3><a href="#">Admission</a></h3> <span>(6)</span>
                            </li>
                            <li>
                                <h3><a href="#">Alumni</a></h3> <span>(11)</span>
                            </li>
                            <li>
                                <h3><a href="#">Career</a></h3> <span>(9)</span>
                            </li>
                            <li>
                                <h3><a href="#">Research</a></h3> <span>(12)</span>
                            </li>
                            <li>
                                <h3><a href="#">Spotlight</a></h3> <span>(2)</span>
                            </li>
                            <li>
                                <h3><a href="#">Student life</a></h3> <span>(5)</span>
                            </li>
                            <li>
                                <h3><a href="#">Student story</a></h3> <span>(21)</span>
                            </li>
                        </ul>

                    </div>
                    <div class="widget widget-list location">
                        <h3 class="widget-title">
                            Locations
                        </h3>

                        <ul>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdo1" checked class="radio-input" name="radio-group">
                                    <label for="rdo1" class="radio-label">
                                        <span class="radio-border"></span> Face To Face
                                    </label>
                                </div>
                                <span>(6)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdo2" class="radio-input" name="radio-group">
                                    <label for="rdo2" class="radio-label">
                                        <span class="radio-border"></span> Online
                                    </label>
                                </div>
                                <span>(6)</span>
                            </li>
                        </ul>

                    </div>
                    <div class="widget widget-list rating">
                        <h3 class="widget-title">
                            Ratings
                        </h3>
                        <ul>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-1" class="radio-input" name="radio-group">
                                    <div class="radio-label">
                                        <span class="radio-border"></span>
                                        <ul>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star active'></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>(12)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-2" class="radio-input" name="radio-group">
                                    <div class="radio-label">
                                        <span class="radio-border"></span>
                                        <ul>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star'></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>(12)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-3" class="radio-input" name="radio-group">
                                    <div class="radio-label">
                                        <span class="radio-border"></span>
                                        <ul>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star'></i></li>
                                            <li><i class='bx bxs-star'></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>(12)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-15" class="radio-input" name="radio-group">
                                    <div class="radio-label">
                                        <span class="radio-border"></span>
                                        <ul>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star'></i></li>
                                            <li><i class='bx bxs-star'></i></li>
                                            <li><i class='bx bxs-star'></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>(12)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-5" class="radio-input" name="radio-group">
                                    <div class="radio-label">
                                        <span class="radio-border"></span>
                                        <ul>
                                            <li><i class='bx bxs-star active'></i></li>
                                            <li><i class='bx bxs-star'></i></li>
                                            <li><i class='bx bxs-star'></i></li>
                                            <li><i class='bx bxs-star'></i></li>
                                            <li><i class='bx bxs-star'></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>(12)</span>
                            </li>
                        </ul>

                    </div>
                    <div class="widget widget-list price">
                        <h3 class="widget-title">
                            Price
                        </h3>
                        <ul>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdo-1" class="radio-input" name="radio-group">
                                    <label for="rdo-1" class="radio-label">
                                        <span class="radio-border"></span> All
                                    </label>
                                </div>
                                <span>(12)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdo-2" class="radio-input" name="radio-group">
                                    <label for="rdo-2" class="radio-label">
                                        <span class="radio-border"></span> Free
                                    </label>
                                </div>
                                <span>(6)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdo-3" class="radio-input" name="radio-group">
                                    <label for="rdo-3" class="radio-label">
                                        <span class="radio-border"></span> Paid
                                    </label>
                                </div>
                                <span>(9)</span>
                            </li>
                        </ul>

                    </div>
                    <div class="widget widget-list languages">
                        <h3 class="widget-title">
                            Languages
                        </h3>
                        <ul>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-6" class="radio-input" name="radio-group">
                                    <label for="rdoo-6" class="radio-label">
                                        <span class="radio-border"></span> English
                                    </label>
                                </div>
                                <span>(12)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-9" class="radio-input" name="radio-group">
                                    <label for="rdoo-9" class="radio-label">
                                        <span class="radio-border"></span> French
                                    </label>
                                </div>
                                <span>(6)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-14" class="radio-input" name="radio-group">
                                    <label for="rdoo-14" class="radio-label">
                                        <span class="radio-border"></span> German
                                    </label>
                                </div>
                                <span>(9)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-4" class="radio-input" name="radio-group">
                                    <label for="rdoo-4" class="radio-label">
                                        <span class="radio-border"></span> Italian
                                    </label>
                                </div>
                                <span>(9)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="16" class="radio-input" name="radio-group">
                                    <label class="radio-label">
                                        <span class="radio-border"></span> Japanese
                                    </label>
                                </div>
                                <span>(9)</span>
                            </li>
                        </ul>

                    </div>
                    <div class="widget widget-list level">
                        <h3 class="widget-title">
                            Level
                        </h3>
                        <ul>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-7" class="radio-input" name="radio-group">
                                    <label for="rdoo-7" class="radio-label">
                                        <span class="radio-border"></span> Graduate
                                    </label>
                                </div>
                                <span>(12)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-10" class="radio-input" name="radio-group">
                                    <label for="rdoo-10" class="radio-label">
                                        <span class="radio-border"></span> Undergraduate
                                    </label>
                                </div>
                                <span>(6)</span>
                            </li>
                        </ul>

                    </div>
                    <div class="widget widget-list duration">
                        <h3 class="widget-title">
                            Duration
                        </h3>
                        <ul>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-8" class="radio-input" name="radio-group">
                                    <label for="rdoo-8" class="radio-label">
                                        <span class="radio-border"></span> Less than 2 hours
                                    </label>
                                </div>
                                <span>(12)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-11" class="radio-input" name="radio-group">
                                    <label for="rdoo-11" class="radio-label">
                                        <span class="radio-border"></span> 3 - 6 hours
                                    </label>
                                </div>
                                <span>(6)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-12" class="radio-input" name="radio-group">
                                    <label for="rdoo-12" class="radio-label">
                                        <span class="radio-border"></span> 7 - 16 hours
                                    </label>
                                </div>
                                <span>(6)</span>
                            </li>
                            <li>
                                <div class="radio-from">
                                    <input type=radio id="rdoo-13" class="radio-input" name="radio-group">
                                    <label for="rdoo-13" class="radio-label">
                                        <span class="radio-border"></span> 17+ Hours
                                    </label>
                                </div>
                                <span>(6)</span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!-- End Courses Section Area -->

@endsection
