@extends('layouts.app1')

@section('title', 'Company')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner"
    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->contact_image) }}')">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Contact Us</h2>
                <p data-aos="fade-up" data-aos-delay="200">{{ $banner->contact_description }}</p>
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->

<!-- Start Contact  Area-->
<div class="contact-area ptb-100">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-content">
                    <div class="header-content">
                        @if($info->phone)
                        <h2>{{ $info->title }}</h2>
                        @endif

                        @if($info->description)
                        <p>{!! $info->description !!}</p>
                        @endif
                        <p>For verifications, please email <a href="#">{{ $info->email }}</a></p>
                    </div>

                    <div class="contact-form">
                        <form action="{{ route('contact.submit') }}" method="POST" id="contactForm">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control"
                                            value="{{ old('first_name') }}" required>
                                        @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control"
                                            value="{{ old('last_name') }}" required>
                                        @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                            required>
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Phone (optional)</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                        @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Inquiry Type</label>
                                        <select name="type" class="form-select" required>
                                            <option value="" disabled selected>Select One</option>
                                            <option value="Student" {{ old('type')=='Student' ? 'selected' : '' }}>
                                                Student</option>
                                            <option value="Professor" {{ old('type')=='Professor' ? 'selected' : '' }}>
                                                Professor</option>
                                            <option value="University" {{ old('type')=='University' ? 'selected' : ''
                                                }}>University</option>
                                            <option value="Company" {{ old('type')=='Company' ? 'selected' : '' }}>
                                                Company</option>
                                        </select>
                                        @error('type')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Inquiry</label>
                                        <textarea name="description" class="form-control" rows="6"
                                            required>{{ old('description') }}</textarea>
                                        @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 mb-3">
                                    {{-- <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                    --}}
                                    @error('g-recaptcha-response')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info">

                    <!-- Start Map Area -->
                    <div id="map" class="map-pd">
                        <iframe
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAfUj6-Lt7f_Nv8uy_puSzlXHKtekgQYjs&q={{ $info->latitude }},{{ $info->longitude }}"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                    <!-- End Map Area -->

                    <div class="info-details">
                        <ul>
                            @if($info->phone)
                            <li><i class='bx bxs-phone-call'></i> General Inquiries - <a
                                    href="tel:{{ $info->phone }}">{{ $info->phone
                                    }}</a></li>
                            @endif

                            @if($info->whatsapp)
                            <li><i class='bx bxl-whatsapp'></i> WhatsApp - <a href="https://wa.me/{{ $info->whatsapp }}"
                                    target="_blank">{{ $info->whatsapp }}</a></li>
                            @endif

                            @if($info->email)
                            <li><i class='bx bxs-envelope'></i> <a class="info-mail" href="mailto:{{ $info->email }}">{{
                                    $info->email
                                    }}</a></li>
                            @endif

                            @if($info->facebook)
                            <li><i class='bx bxl-facebook'></i> <a href="{{ $info->facebook }}"
                                    target="_blank">Facebook</a></li>
                            @endif

                            @if($info->linkedin)
                            <li><i class='bx bxl-linkedin'></i> <a href="{{ $info->linkedin }}"
                                    target="_blank">LinkedIn</a></li>
                            @endif

                            @if($info->instagram)
                            <li><i class='bx bxl-instagram'></i> <a href="{{ $info->instagram }}"
                                    target="_blank">Instagram</a></li>
                            @endif

                            @if($info->youtube)
                            <li><i class='bx bxl-youtube'></i> <a href="{{ $info->youtube }}"
                                    target="_blank">YouTube</a></li>
                            @endif

                            @if($info->location)
                            <li><i class='bx bxs-map'></i> {{ $info->location }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Contact Area-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    grecaptcha.ready(function() {
    document.getElementById("contactForm").addEventListener("submit", function(e) {
        e.preventDefault();
        grecaptcha.execute("{{ env('RECAPTCHA_SITE_KEY') }}", {action: "submit"}).then(function(token) {
            // append token to form
            var recaptchaResponse = document.createElement("input");
            recaptchaResponse.type = "hidden";
            recaptchaResponse.name = "g-recaptcha-response";
            recaptchaResponse.value = token;
            document.getElementById("contactForm").appendChild(recaptchaResponse);

            document.getElementById("contactForm").submit();
        });
    });
});

</script>
@endsection