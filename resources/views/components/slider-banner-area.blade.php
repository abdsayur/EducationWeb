<div class="slider-banner-area">
    <div class="slider-courser owl-carousel owl-theme">
        @foreach ($sliders as $slider)
        <div class="slider-content dynamic-slider"
            style="background-image: url('{{ Storage::disk('home-slider')->url($slider->image) }}');">
            <div class="content">
                <div class="text">
                    <div class="container">
                        <h1 data-aos="fade-up" data-aos-delay="100">{{ $slider->title }}</h1>
                    </div>
                    <hr>
                </div>

                <div class="container">
                    <div class="row">
                        @if(!empty($slider->notice))
                        <div class="col-lg-4">
                            <p data-aos="fade-up" data-aos-delay="100">{{ $slider->notice }}</p>
                        </div>
                        @endif

                        @if(!empty($slider->slogan) || !empty($slider->link))
                        <div class="col-lg-5">
                            <div class="short-info">
                                @if(!empty($slider->slogan))
                                <h3 data-aos="fade-up" data-aos-delay="200">{{ $slider->slogan }}</h3>
                                @endif

                                @if(!empty($slider->link))
                                <a class="default-btn" href="{{ $slider->link }}" data-aos="fade-zoom-in"
                                    data-aos-delay="100">VISIT</a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- <div class="slider-content slider-bg-1">
    <div class="content">
        <div class="text">
            <div class="container">
                <h1 data-aos="fade-up" data-aos-delay="100">Welcome to Canyon</h1>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <p data-aos="fade-up" data-aos-delay="100">Fall 2024 Applications are Now Open</p>
                </div>
                <div class="col-lg-5">
                    <div class="short-info">
                        <h3 data-aos="fade-up" data-aos-delay="200">Discover the World of Possibility with
                            Canyon</h3>
                        <a class="default-btn" href="application-form.html" data-aos="fade-zoom-in"
                            data-aos-delay="100">Apply to USD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
