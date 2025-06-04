@extends('layouts.app1')

@section('title', 'Create Professor')

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

<div class="section-banner"
    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->create_professor_image) }}')">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Create Professor Account</h2>
                <p data-aos="fade-up" data-aos-delay="200">{!! Str::limit($banner->create_professor_description, 100)
                    !!}</p>
            </div>
        </div>
    </div>
</div>

<div class="contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-content">
                    <div class="header-content">
                        <h2>For Better Service</h2>
                        <p>Kindly complete all required fields to set up your professor account. Fields marked with an
                            (*) are required.</p>
                        <p>For credential verification or academic-related inquiries, please contact us at <a
                                href="#">registrar@clgununiversity.edu</a>.</p>
                    </div>

                    <div class="contact-form">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form id="contactForm" method="POST" action="{{ route('professor.register.post') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- First Name -->
                                <div class="col-lg-6">
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
                                <div class="col-lg-6">
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
                                <div class="col-lg-6">
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
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Expertises -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Expertises</label>
                                        <div class="row">
                                            @foreach($expertises as $expertise)
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="expertises[]"
                                                        value="{{ $expertise->id }}" id="expertise_{{ $expertise->id }}"
                                                        class="form-check-input"
                                                        style="border-color:{{ $expertise->color }}" {{
                                                        in_array($expertise->id, old('expertises', [])) ? 'checked' : ''
                                                    }}>
                                                    <label for="expertise_{{ $expertise->id }}" class="form-check-label"
                                                        style="color:{{ $expertise->color }}">
                                                        {{ $expertise->name }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @error('expertises')
                                        <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Teaching Type -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Teaching Type *</label>
                                        <select name="teaching_type" id="teaching_type"
                                            class="form-select @error('teaching_type') is-invalid @enderror" required>
                                            <option value="" disabled>Select Type</option>
                                            <option value="fixed_time" {{ old('teaching_type')=='fixed_time'
                                                ? 'selected' : '' }}>Fixed Time</option>
                                            <option value="permanent" {{ old('teaching_type')=='permanent' ? 'selected'
                                                : '' }}>Permanent</option>
                                        </select>
                                        @error('teaching_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Additional Fields for Fixed Time -->
                                <div id="fixed_time_fields"
                                    style="display: {{ old('teaching_type') == 'fixed_time' ? 'block' : 'none' }};">
                                    <!-- LinkedIn -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>LinkedIn</label>
                                            <input type="url" name="linked_in"
                                                class="form-control @error('linked_in') is-invalid @enderror"
                                                value="{{ old('linked_in') }}">
                                            @error('linked_in')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select name="country"
                                                class="form-select @error('country') is-invalid @enderror">
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
                                                <option value="{{ $code }}" {{ old('country')==$code ? 'selected' : ''
                                                    }}>{{
                                                    $name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- More Info -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>More Info</label>
                                            <textarea name="more_info"
                                                class="form-control @error('more_info') is-invalid @enderror">{{ old('more_info') }}</textarea>
                                            @error('more_info')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Teaching Mode -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Teaching Mode</label>
                                            <select name="teaching_mode"
                                                class="form-select @error('teaching_mode') is-invalid @enderror">
                                                <option value="" selected disabled>Select Mode</option>
                                                <option value="Online" {{ old('teaching_mode')=='Online' ? 'selected'
                                                    : '' }}>Online</option>
                                                <option value="Paris" {{ old('teaching_mode')=='Paris' ? 'selected' : ''
                                                    }}>Paris</option>
                                            </select>
                                            @error('teaching_mode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- CV Upload -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Upload CV</label>
                                        <input type="file" name="cv"
                                            class="form-control @error('cv') is-invalid @enderror">
                                        @error('cv')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Share Data -->
                                <div class="col-lg-6">
                                    <div class="form-group form-check">
                                        <input type="hidden" name="share_data" value="0">
                                        <input type="checkbox" name="share_data" id="share_data"
                                            class="form-check-input" value="1" {{ old('share_data', 0) ? 'checked' : ''
                                            }}>
                                        <label for="share_data" class="form-check-label">Share my data</label>
                                        @error('share_data')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="default-btn">Submit Now</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('bx-show', 'bx-hide');
                } else {
                    input.type = 'password';
                    icon.classList.replace('bx-hide', 'bx-show');
                }
            });
        });
    });

    document.getElementById('teaching_type').addEventListener('change', function () {
        var fixedTimeFields = document.getElementById('fixed_time_fields');
        if (this.value === 'fixed_time') {
            fixedTimeFields.style.display = 'block';

            // Make LinkedIn field required when shown
            document.querySelector('input[name="linked_in"]').required = true;
        } else {
            fixedTimeFields.style.display = 'none';

            // Remove required attribute when hidden
            document.querySelector('input[name="linked_in"]').required = false;
        }
    });

    // Initialize the display based on old input when page loads
    document.addEventListener('DOMContentLoaded', function() {
        const teachingType = document.getElementById('teaching_type');
        if (teachingType.value === 'fixed_time') {
            document.getElementById('fixed_time_fields').style.display = 'block';
        }
    });
</script>

@endsection
