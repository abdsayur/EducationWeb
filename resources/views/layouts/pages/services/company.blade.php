@extends('layouts.app1')

@section('title', 'Company')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner"
    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->company_service_image) }}')">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">{!! Str::limit($banner->company_service_title, 20) !!}</h2>
                <p data-aos="fade-up" data-aos-delay="200">{!! Str::limit($banner->company_service_description, 100) !!}
                </p>
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->

<!-- Start Academics Section Area -->
<div class="academics-section ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="academics-left">
                    {{-- <div class="ac-category">
                        <ul>
                            <li><a class="active" href="university-life.html">Overview</a></li>
                            <li><a href="the-campus-experience.html">The Campus Experience</a></li>
                            <li><a href="fitness-athletics.html">Fitness & Athletics</a></li>
                            <li><a href="support-guidance.html">Support & Guidance</a></li>
                            <li><a href="student-activities.html">Student Activities</a></li>
                        </ul>
                    </div> --}}
                    @include('partials.service-sidebar')
                    <div class="ac-contact">
                        <span>DO IT NOW</span><a href="{{ route('contact') }}">Kindly leave your details, and we will
                            contact you shortly</a>
                        {{-- <a class="darkbtn" href="{{ route('student.register') }}">Create Student Account</a>
                        <a class="darkbtn" href="{{ route('professor.register') }}">Create Professor Account</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ac-overview">
                    <div class="pera-dec">

                        {{-- desc_d --}}
                        @if(!empty($service->desc_d))
                        <p>{!! $service->desc_d !!}</p>
                        @endif

                        {{-- Apply Program 1 --}}
                        <div class="apply-program">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-5">
                                    <div class="content">
                                        {{-- title_tdi_1 --}}
                                        @if(!empty($service->title_tdi_1))
                                        <h3>{{ $service->title_tdi_1 }}</h3>
                                        @endif

                                        {{-- desc_tdi_1 --}}
                                        @if(!empty($service->desc_tdi_1))
                                        <p>{!! $service->desc_tdi_1 !!}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="image">
                                        {{-- image_tdi_1 --}}
                                        @if(!empty($service->image_tdi_1))
                                        <img src="{{ Storage::disk('service-image')->url($service->image_tdi_1) }}"
                                            alt="image">
                                        @else
                                        <img src="{{ url('service-images/placeholder.png') }}" alt="image">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Apply Program 2 --}}
                        <div class="apply-program">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-7">
                                    <div class="image">
                                        {{-- image_tdi_2 --}}
                                        @if(!empty($service->image_tdi_2))
                                        <img src="{{ Storage::disk('service-image')->url($service->image_tdi_2) }}"
                                            alt="image">
                                        @else
                                        <img src="{{ url('service-images/placeholder.png') }}" alt="image">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <div class="content">
                                        {{-- title_tdi_2 --}}
                                        @if(!empty($service->title_tdi_2))
                                        <h3>{{ $service->title_tdi_2 }}</h3>
                                        @endif

                                        {{-- desc_tdi_2 --}}
                                        @if(!empty($service->desc_tdi_2))
                                        <p>{!! $service->desc_tdi_2 !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- title_td --}}
                        @if(!empty($service->title_td))
                        <h3>{{ $service->title_td }}</h3>
                        @endif

                        {{-- desc_td --}}
                        @if(!empty($service->desc_td))
                        <p>{!! $service->desc_td !!}</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Academics Section Area -->

@endsection
