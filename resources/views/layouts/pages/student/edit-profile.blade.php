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

<!-- Start Contact Area -->
<div class="contact-area ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-content">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
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
                        <form method="POST" action="{{ route('student.profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- First Name -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>First Name *</label>
                                        <input type="text" name="first_name"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name', $student->first_name) }}" required>
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
                                            value="{{ old('last_name', $student->last_name) }}" required>
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
                                            value="{{ old('email', $student->email) }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Phone *</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $student->phone) }}" required>
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
                                            <option value="" disabled>Select Level</option>
                                            @foreach($academicYears as $value => $label)
                                            <option value="{{ $value }}" {{ old('academic_year', $student->
                                                academic_year) == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                            @endforeach
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
                                            <option value="" disabled>Select Country</option>
                                            @foreach($countries as $code => $name)
                                            <option value="{{ $code }}" {{ old('country', $student->country) == $code ?
                                                'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password Change Section -->
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

                                <div class="col-lg-12 col-md-12 mt-4">
                                    <button type="submit" class="default-btn">Update Profile</button>
                                    <a href="{{ route('student.profile') }}" class="default-btn black">Cancel</a>
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
