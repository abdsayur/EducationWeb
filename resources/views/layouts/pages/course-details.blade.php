@extends('layouts.app1')

@section('title', 'Course Details')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner"
    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->course_details_image) }}')">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Courses Details</h2>
                <p data-aos="fade-up" data-aos-delay="200">{{ $banner->course_details_description }}</p>
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->

<!-- Start Courses Details Area -->
<div class="courses-details-section pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <div class="courses-details">
                    <div class="header-title">
                        <h2>{{ $course->title }}</h2>
                        {{-- <a href="#" class="top-enroll-btn">Enroll Now</a> --}}
                        <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="top-enroll-btn enroll-now-btn">Enroll Now</button>
                        </form>
                        <ul>
                            <li>
                                <div class="enrolls-count">
                                    <img src="{{ asset('img/icon/reading-2.png') }}" class="ikon" alt="icon">
                                    <p>{{ $course->students->count() }} already enrolled</p>
                                </div>
                            </li>
                            <li>
                                <p>{{ optional($course->call_date)->format('F j, Y') ?? 'No Date Available' }}</p>
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <div class="content-pra">
                            <div class="title">
                                <h3>About This Course</h3>
                            </div>
                            <p>{!! $course->details !!}</p>

                            <div class="tag">
                                <span>Tag:</span>
                                <ul>
                                    @foreach($course->tags as $tag)
                                    <li><a href="#">{{ strtoupper($tag->name) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="content-pra">
                            <div class="title">
                                <h3>Learning Objectives</h3>
                            </div>
                            <ul class="lists">
                                <li>
                                    <div class="icon">
                                        <i class='bx bx-check'></i>
                                    </div>
                                    <p>{!! $course->objective !!}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="content-pra">
                            <div class="title">
                                <h3>Material Includes</h3>
                            </div>
                            <ul class="lists">
                                <li>
                                    <div class="icon">
                                        <i class='bx bx-check'></i>
                                    </div>
                                    <p>{!! $course->material !!}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="content-pra">
                            <div class="title">
                                <h3>Requirements</h3>
                            </div>
                            <ul class="lists">
                                <li>
                                    <div class="icon">
                                        <i class='bx bx-check'></i>
                                    </div>
                                    <p>{!! $course->requirement !!}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="content-pra">
                            <div class="title">
                                <h3>How To Apply</h3>
                            </div>
                            <p>{!! optional($course->howToApply)->instructions ?? 'No information available' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="course-widget-area">
                    <div class="image">
                        <img src="{{ Storage::disk('course-image')->url($course->image) }}" alt="image">
                        {{-- <div class="play-btn">
                            <a href="https://youtu.be/SbuRnwgG8rs?si=Oew2tM_U0WQPjJte" class="popup-youtube"><i
                                    class='bx bx-play'></i></a>
                        </div> --}}
                    </div>
                    <div class="content">
                        <ul>
                            <li>
                                <span>Location</span>
                                <p>{{ $course->location }}</p>
                            </li>
                            <li>
                                <span>Language</span>
                                <p>{{ $course->language }}</p>
                            </li>
                            <li>
                                <span>Type Of Call</span>
                                <p>{{ $course->call_type }}</p>
                            </li>
                            <li>
                                <span>University</span>
                                <p>{{ $course->university }}</p>
                            </li>
                            <li>
                                <span>Duration</span>
                                <p>{{ $course->nb_of_hours }} hours</p>
                            </li>
                            <li>
                                <span>Start Date</span>
                                <p>{{ optional($course->call_date)->format('F j, Y') ?? 'No Date Available' }}</p>
                            </li>
                            <li>
                                <span>Time</span>
                                <p>{{ optional($course->call_date)->format('H:m:s A') ?? 'No Time Available' }}</p>
                            </li>
                        </ul>
                        {{-- <a class="enroll-btn" href="{{ route('courses.enroll', $course->id) }}">Enroll Now</a> --}}
                        <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="top-enroll-btn enroll-now-btn">Enroll Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Courses Details Area -->

<script>
    const isStudentLoggedIn = {{ Auth::guard('student')->check() ? 'true' : 'false' }};

    const enrollBtns = document.querySelectorAll('.enroll-now-btn');
    // const originalText = enrollBtn.textContent;

    enrollBtns.forEach(btn => {
        const originalText = btn.textContent;

        btn.addEventListener('mouseenter', () => {
            if (!isStudentLoggedIn) {
                btn.textContent = 'You need to log in as a student first';
            }
        });

        btn.addEventListener('mouseleave', () => {
            btn.textContent = originalText;
        });
    });
    document.querySelector('.enroll-now-btn').addEventListener('click', function () {
        if (!isStudentLoggedIn) {
            alert('You need to log in as a student first.');
            return;
        }
        document.querySelector('form').submit(); // or whatever form ID
    });
</script>

@endsection
