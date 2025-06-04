@extends('layouts.app1')

@section('title', 'Student')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner"
    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->student_service_image) }}')">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">{!! Str::limit($banner->student_service_title, 20) !!}</h2>
                <p data-aos="fade-up" data-aos-delay="200">{!! Str::limit($banner->student_service_description, 100) !!}
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
                    @include('partials.service-sidebar')
                    <div class="ac-contact">
                        <span>DO IT NOW</span>
                        <a href="{{ route('student.register') }}">Create Student Account</a>
                        <a href="{{ route('professor.register') }}">Create Professor Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ac-overview">
                    <div class="pera-dec">
                        {{-- desc_di --}}
                        @if(!empty($service->desc_di))
                        <p>{!! $service->desc_di !!}</p>
                        @endif

                        <div class="univercity-life">
                            <div class="image">
                                {{-- image_di --}}
                                <img src="{{ $service->image_di ? Storage::disk('service-image')->url($service->image_di) : asset('service-images/placeholder.png') }}"
                                    alt="image">
                            </div>

                            {{-- Title TD 1 --}}
                            @if(!empty($service->title_td_1))
                            <div class="aid-pra">
                                <h3>{{ $service->title_td_1 }}</h3>
                                @if(!empty($service->desc_td_1))
                                <p>{!! $service->desc_td_1 !!}</p>
                                @endif
                            </div>
                            @endif

                            {{-- Title TD 2 --}}
                            @if(!empty($service->title_td_2))
                            <div class="aid-pra">
                                <h3>{{ $service->title_td_2 }}</h3>
                                @if(!empty($service->desc_td_2))
                                <p>{!! $service->desc_td_2 !!}</p>
                                @endif
                            </div>
                            @endif

                            {{-- Title TD 3 --}}
                            @if(!empty($service->title_td_3))
                            <div class="aid-pra">
                                <h3>{{ $service->title_td_3 }}</h3>
                                @if(!empty($service->desc_td_3))
                                <p>{!! $service->desc_td_3 !!}</p>
                                @endif
                            </div>
                            @endif

                            {{-- TDI 1 --}}
                            @if(!empty($service->title_tdi_1) || !empty($service->desc_tdi_1) ||
                            !empty($service->image_tdi_1))
                            <div class="apply-program">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="content">
                                            @if(!empty($service->title_tdi_1))
                                            <h3>{{ $service->title_tdi_1 }}</h3>
                                            @endif
                                            @if(!empty($service->desc_tdi_1))
                                            <p>{!! $service->desc_tdi_1 !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7">
                                        <div class="image">
                                            <img src="{{ $service->image_tdi_1 ? Storage::disk('service-image')->url($service->image_tdi_1) : asset('service-images/placeholder.png') }}"
                                                alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            {{-- TDI 2 --}}
                            @if(!empty($service->title_tdi_2) || !empty($service->desc_tdi_2) ||
                            !empty($service->image_tdi_2))
                            <div class="apply-program">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-md-7">
                                        <div class="image">
                                            <img src="{{ $service->image_tdi_2 ? Storage::disk('service-image')->url($service->image_tdi_2) : asset('service-images/placeholder.png') }}"
                                                alt="image">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5">
                                        <div class="content">
                                            @if(!empty($service->title_tdi_2))
                                            <h3>{{ $service->title_tdi_2 }}</h3>
                                            @endif
                                            @if(!empty($service->desc_tdi_2))
                                            <p>{!! $service->desc_tdi_2 !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Academics Section Area -->

@endsection
