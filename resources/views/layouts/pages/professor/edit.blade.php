@extends('layouts.app1')

@section('title', 'Edit Student Profile')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner bg-4">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2>Edit Profile</h2>
                <p>Update your personal information</p>
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->

<div class="contact-area ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-content">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="contact-form">
                        <form method="POST" action="{{ route('professor.profile.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- First Name -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First Name *</label>
                                        <input type="text" name="first_name"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name', $professor->first_name) }}" required>
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
                                            value="{{ old('last_name', $professor->last_name) }}" required>
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
                                            value="{{ old('email', $professor->email) }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $professor->phone) }}">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                @php
                                $selectedExpertises = old('expertises', $professor->expertises->pluck('id')->toArray());
                                @endphp
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
                                                        in_array($expertise->id, $selectedExpertises) ?
                                                    'checked' : '' }}>
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

                                <!-- Country -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select name="country"
                                            class="form-select @error('country') is-invalid @enderror">
                                            <option value="" disabled>Select Country</option>
                                            @foreach($countries as $code => $name)
                                            <option value="{{ $code }}" {{ old('country', $professor->country) == $code
                                                ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Teaching Type -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Teaching Type</label>
                                        <select name="teaching_type"
                                            class="form-select @error('teaching_type') is-invalid @enderror" required>
                                            <option value="" disabled>Select Type</option>
                                            <option value="fixed_time" {{ old('teaching_type')=='fixed_time'
                                                ? 'selected' : '' }}>Fixed Time</option>
                                            <option value="permanent" {{ old('teaching_type')=='permanent' ? 'selected'
                                                : '' }}>Permanent</option>
                                        </select>
                                        {{-- <select name="teaching_type"
                                            class="form-select @error('teaching_type') is-invalid @enderror">
                                            <option value="" disabled>Select Type</option>
                                            @foreach($teachingTypes as $type)
                                            <option value="{{ $type }}" {{ old('teaching_type', $professor->
                                                teaching_type) == $type ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $type)) }}
                                            </option>
                                            @endforeach
                                        </select> --}}
                                        @error('teaching_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Teaching Mode -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Teaching Mode</label>
                                        <input type="text" name="teaching_mode" list="teachingTypesList"
                                            class="form-control @error('teaching_mode') is-invalid @enderror"
                                            value="{{ old('teaching_mode', $professor->teaching_mode) }}">
                                        <datalist id="teachingTypesList">
                                            <option value="online">
                                            <option value="paris">
                                            <option value="onsite">
                                            <option value="hybrid">
                                        </datalist>
                                        @error('teaching_mode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- LinkedIn -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>LinkedIn URL</label>
                                        <input type="url" name="linked_in"
                                            class="form-control @error('linked_in') is-invalid @enderror"
                                            value="{{ old('linked_in', $professor->linked_in) }}">
                                        @error('linked_in')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- More Info -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>More Information</label>
                                        <textarea name="more_info"
                                            class="form-control @error('more_info') is-invalid @enderror"
                                            rows="3">{{ old('more_info', $professor->more_info) }}</textarea>
                                        @error('more_info')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- CV Upload -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Upload CV (PDF)</label>
                                        <input type="file" name="cv" accept="application/pdf"
                                            class="form-control @error('cv') is-invalid @enderror">
                                        @error('cv')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if($professor->cv)
                                    <p class="mt-1">Current CV: <a
                                            href="{{ Storage::disk('public')->url($professor->cv) }}"
                                            target="_blank">View CV</a></p>
                                    @endif
                                </div>

                                <!-- Share Data -->
                                {{-- <div class="col-lg-12">
                                    <div class="form-group form-check mt-2">
                                        <input type="checkbox" name="share_data" class="form-check-input" {{
                                            old('share_data', $professor->share_data) ? 'checked' : '' }}>
                                        <label class="form-check-label">Willing to share data with collaborators</label>
                                    </div>
                                </div> --}}
                                <!-- Share Data -->
                                <div class="col-lg-6">
                                    <div class="form-group form-check">
                                        <input type="hidden" name="share_data" value="0">
                                        <input type="checkbox" name="share_data" id="share_data"
                                            class="form-check-input" value="1" {{ old('share_data',
                                            $professor->share_data) ? 'checked' : ''
                                        }}>
                                        <label for="share_data" class="form-check-label">Share my data</label>
                                        @error('share_data')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password Section -->
                                <div class="col-lg-12 mt-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Change Password</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <input type="password" name="current_password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" name="new_password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm New Password</label>
                                                <input type="password" name="new_password_confirmation"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-lg-12 mt-4">
                                    <button type="submit" class="default-btn">Update Profile</button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Area -->

@endsection