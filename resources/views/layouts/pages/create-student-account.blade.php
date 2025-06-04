@extends('layouts.app1')

@section('title', 'Create Student')

@section('content')

<style>
    /* Make the input group look cohesive */
    .input-group {
        display: flex;
        align-items: stretch;
    }

    /* Style the toggle button to match input height */
    .toggle-password {
        background-color: #f8f9fa;
        border-radius: 0 0.25rem 0.25rem 0;
        padding: 0.375rem 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* Remove default button styling */
    .toggle-password:hover {
        background-color: #e9ecef;
    }

    /* Ensure the input has no right border */
    .input-group .form-control {
        border-right: none;
        border-radius: 0.25rem 0 0 0.25rem;
    }

    /* Fix for error state */
    .input-group .form-control.is-invalid {
        border-right: none;
        background-image: none;
        /* Remove default Bootstrap invalid icon */
    }

    /* Adjust invalid feedback position */
    .input-group~.invalid-feedback {
        display: block;
    }
</style>

<!-- Start Section Banner Area -->
<div class="section-banner"
    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->create_student_image) }}')">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Create Student Account</h2>
                <p data-aos="fade-up" data-aos-delay="200">{!! Str::limit($banner->create_student_description, 100) !!}
                </p>
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->

<!-- Start Contact Area -->
<div class="contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-content">
                    <div class="header-content">
                        <h2>Student Registration</h2>
                        <p>Please complete all required fields to create your student account. Fields marked with an
                            asterisk (*) are required.</p>
                        <p>For official verifications or support, please contact us at <a href="mailto:">{{ $info->email
                                }}</a>.</p>
                    </div>

                    <div class="contact-form">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form id="contactForm" method="POST" action="{{ route('student.register') }}">
                            @csrf
                            <div class="row">
                                <!-- First Name -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>First Name *</label>
                                        <input type="text" name="first_name"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name') }}" required>
                                        @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Last Name *</label>
                                        <input type="text" name="last_name"
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            value="{{ old('last_name') }}" required>
                                        @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Password *</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror" required
                                                minlength="6">
                                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                                style="border: 1px solid #ced4da; border-left: none; height: calc(2.25rem + 2px);">
                                                <i class="bx bx-show"></i>
                                            </button>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Confirm Password *</label>
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation" class="form-control" required minlength="6">
                                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                                style="border: 1px solid #ced4da; border-left: none; height: calc(2.25rem + 2px);">
                                                <i class="bx bx-show"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Phone *</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" required>
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Academic Year -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Academic Year *</label>
                                        <select name="academic_year"
                                            class="form-select @error('academic_year') is-invalid @enderror" required>
                                            <option value="" disabled {{ old('academic_year') ? '' : 'selected' }}>
                                                Select Level</option>
                                            <option value="undergraduate" {{ old('academic_year')=='undergraduate'
                                                ? 'selected' : '' }}>Undergraduate</option>
                                            <option value="bachelor_1" {{ old('academic_year')=='bachelor_1'
                                                ? 'selected' : '' }}>Bachelor - Year 1</option>
                                            <option value="bachelor_2" {{ old('academic_year')=='bachelor_2'
                                                ? 'selected' : '' }}>Bachelor - Year 2</option>
                                            <option value="bachelor_3" {{ old('academic_year')=='bachelor_3'
                                                ? 'selected' : '' }}>Bachelor - Year 3</option>
                                            <option value="master" {{ old('academic_year')=='master' ? 'selected' : ''
                                                }}>Master</option>
                                            <option value="master_1" {{ old('academic_year')=='master_1' ? 'selected'
                                                : '' }}>Master - Year 1</option>
                                            <option value="master_2" {{ old('academic_year')=='master_2' ? 'selected'
                                                : '' }}>Master - Year 2</option>
                                            <option value="phd" {{ old('academic_year')=='phd' ? 'selected' : '' }}>PhD
                                            </option>
                                        </select>
                                        @error('academic_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Country -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Country *</label>
                                        <select name="country"
                                            class="form-select @error('country') is-invalid @enderror" required>
                                            <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select
                                                Country</option>
                                            @foreach([
                                            'AF' => 'Afghanistan',
                                            'AL' => 'Albania',
                                            'DZ' => 'Algeria',
                                            'AD' => 'Andorra',
                                            'AO' => 'Angola',
                                            'AR' => 'Argentina',
                                            'AM' => 'Armenia',
                                            'AU' => 'Australia',
                                            'AT' => 'Austria',
                                            'AZ' => 'Azerbaijan',
                                            'BH' => 'Bahrain',
                                            'BD' => 'Bangladesh',
                                            'BY' => 'Belarus',
                                            'BE' => 'Belgium',
                                            'BR' => 'Brazil',
                                            'BG' => 'Bulgaria',
                                            'CA' => 'Canada',
                                            'CN' => 'China',
                                            'CO' => 'Colombia',
                                            'HR' => 'Croatia',
                                            'CZ' => 'Czech Republic',
                                            'DK' => 'Denmark',
                                            'EG' => 'Egypt',
                                            'FR' => 'France',
                                            'DE' => 'Germany',
                                            'GR' => 'Greece',
                                            'IN' => 'India',
                                            'ID' => 'Indonesia',
                                            'IR' => 'Iran',
                                            'IQ' => 'Iraq',
                                            'IE' => 'Ireland',
                                            'IT' => 'Italy',
                                            'JP' => 'Japan',
                                            'JO' => 'Jordan',
                                            'KW' => 'Kuwait',
                                            'LB' => 'Lebanon',
                                            'MY' => 'Malaysia',
                                            'MX' => 'Mexico',
                                            'MA' => 'Morocco',
                                            'NL' => 'Netherlands',
                                            'NZ' => 'New Zealand',
                                            'NG' => 'Nigeria',
                                            'NO' => 'Norway',
                                            'PK' => 'Pakistan',
                                            'PH' => 'Philippines',
                                            'PL' => 'Poland',
                                            'PT' => 'Portugal',
                                            'QA' => 'Qatar',
                                            'RO' => 'Romania',
                                            'RU' => 'Russia',
                                            'SA' => 'Saudi Arabia',
                                            'RS' => 'Serbia',
                                            'SG' => 'Singapore',
                                            'ZA' => 'South Africa',
                                            'KR' => 'South Korea',
                                            'ES' => 'Spain',
                                            'SE' => 'Sweden',
                                            'CH' => 'Switzerland',
                                            'TH' => 'Thailand',
                                            'TR' => 'Turkey',
                                            'UA' => 'Ukraine',
                                            'AE' => 'United Arab Emirates',
                                            'GB' => 'United Kingdom',
                                            'US' => 'United States',
                                            'VN' => 'Vietnam',
                                            'YE' => 'Yemen',
                                            'LB' => 'Lebanon' // Ensure 'LB' is in the array once
                                            ] as $code => $name)
                                            <option value="{{ $code }}" {{ old('country')==$code ? 'selected' : '' }}>{{
                                                $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn">Register Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="contact-info">
                    <div class="info-details">
                        <h4>Contact Information</h4>
                        <ul>
                            @if($info->phone)
                            <li><i class='bx bxs-phone-call'></i> General Inquiries - <a
                                    href="tel:{{ $info->phone }}">{{ $info->phone
                                    }}</a></li>
                            @endif

                            @if($info->whatsapp)
                            <li><i class='bx bxl-whatsapp'></i> WhatsApp - <a href="https://wa.me/{{ $info->whatsapp }}"
                                    target="_blank">{{
                                    $info->whatsapp }}</a></li>
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
<!-- End Contact Area -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling; // Get the associated input field
                const icon = this.querySelector('i'); // Get the icon

                // Toggle the input type between password and text
                if (input.type === 'password') {
                    input.type = 'text'; // Show password
                    icon.classList.replace('bx-show', 'bx-hide'); // Change the icon to hide
                } else {
                    input.type = 'password'; // Hide password
                    icon.classList.replace('bx-hide', 'bx-show'); // Change the icon to show
                }
            });
        });
    });
</script>

@endsection
