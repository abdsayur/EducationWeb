@extends('layouts.app1')

@section('title', 'Professor Profile')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner bg-4">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info text-center">
                <h2 class="mb-3" data-aos="fade-up" data-aos-delay="100">Professor Profile</h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">Welcome back, Pr. {{ $professor->first_name }}!
                    You can manage your profile, courses, and academic contributions from here.</p>
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->

<!-- Start Profile Area -->
<div class="find-degree ptb-70">
    <div class="container">
        <div class="row">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <!-- Profile Sidebar -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="profile-sidebar" style="top: 20px;">
                    <div class="profile-card text-center">
                        <div class="profile-image mb-4">
                            <div class="user-icon-wrapper d-flex align-items-center justify-content-center
                                        bg-light rounded-circle border mx-auto" style="width: 150px; height: 150px;">
                                <i class="bx bx-user user-icon" style="font-size: 4.5rem; color: #6c757d;"></i>
                            </div>
                        </div>
                        <div class="profile-info">
                            <h3 class="mb-3">{{ $professor->first_name }} {{ $professor->last_name }}</h3>

                            <div class="d-flex justify-content-center mb-3">
                                <span class="badge bg-success">{{ ucfirst(str_replace('_', ' ',
                                    $professor->teaching_type))
                                    }}</span>
                            </div>

                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bx bx-envelope me-2"></i> {{ $professor->email }}
                                </li>
                                <li class="mb-2">
                                    <i class="bx bx-phone me-2"></i> {{ $professor->phone ?? 'Not provided' }}
                                </li>
                                <li class="mb-2">
                                    <i class="bx bx-map me-2"></i> {{ $professor->country ?? 'Not provided' }}
                                </li>
                                <li class="mb-2">
                                    <i class="bx bxl-linkedin me-2"></i>
                                    @if($professor->linked_in)
                                    <a href="{{ $professor->linked_in }}" target="_blank" rel="noopener noreferrer"
                                        class="long-link">LinkedIn
                                    </a>
                                    @else
                                    Not provided
                                    @endif
                                </li>
                                <li class="mb-2">
                                    <i class="bx bx-world me-2"></i> {{ $professor->teaching_mode ?? 'Not provided' }}
                                </li>
                                <li class="mb-2">
                                    <i class="bx bx-file me-2"></i>
                                    @if($professor->cv)
                                    <a href="{{ Storage::disk('public')->url($professor->cv) }}" target="_blank">View
                                        CV</a>
                                    @else
                                    Not uploaded
                                    @endif
                                </li>
                                <li>
                                    <i class="bx bx-data me-2"></i>
                                    {{ $professor->share_data ? 'Willing to share data' : 'Private data' }}
                                </li>
                            </ul>

                            <a href="{{ route('professor.profile.edit') }}" class="btn btn-outline-primary mt-3">
                                <i class="bx bx-edit me-1"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="profile-content">
                    <!-- Personal Information Card -->
                    <div class="profile-section mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="mb-0"><i class="bx bx-user-circle me-2"></i>Personal Information</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">First Name</h6>
                                    <p class="mb-0">{{ $professor->first_name }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Last Name</h6>
                                    <p class="mb-0">{{ $professor->last_name }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Email</h6>
                                    <p class="mb-0">{{ $professor->email }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Phone</h6>
                                    <p class="mb-0">{{ $professor->phone ?? 'Not provided' }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Teaching Type</h6>
                                    <p class="mb-0">{{ ucfirst(str_replace('_', ' ', $professor->teaching_type)) }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Country</h6>
                                    <p class="mb-0">{{ $professor->country ?? 'Not provided' }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">LinkedIn</h6>
                                    <p class="mb-0">
                                        @if($professor->linked_in)
                                        <a href="{{ $professor->linked_in }}" target="_blank" rel="noopener noreferrer"
                                            class="long-link">{{
                                            $professor->linked_in
                                            }}</a>
                                        @else
                                        Not provided
                                        @endif
                                    </p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Teaching Mode</h6>
                                    <p class="mb-0">{{ $professor->teaching_mode ?? 'Not provided' }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">More Info</h6>
                                    <p class="mb-0">{{ $professor->more_info ?? 'None' }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">CV</h6>
                                    <p class="mb-0">
                                        @if($professor->cv)
                                        <a href="{{ Storage::disk('public')->url($professor->cv) }}"
                                            target="_blank">View CV</a>
                                        @else
                                        Not uploaded
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expertises -->
                    <div class="profile-section mb-4">
                        <h3 class="mb-3"><i class="bx bx-star me-2"></i>Expertises</h3>
                        @if($professor->expertises->count())
                        <ul class="list-inline">
                            @foreach($professor->expertises as $expertise)
                            <li class="list-inline-item badge bg-secondary">{{ $expertise->name }}</li>
                            @endforeach
                        </ul>
                        @else
                        <p>No expertises added yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Profile Area -->

<style>
    .profile-area {
        /* background-color: #f8f9fa; */
    }

    .profile-card {
        background: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 2px var(--mainColor);
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 20px;
        border: 5px solid #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .profile-info h3 {
        margin-bottom: 15px;
        color: #2c2c2c;
        font-weight: 600;
    }

    .profile-section {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .profile-section h3 {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
        font-weight: 600;
        color: #333;
    }

    .info-item {
        padding: 10px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background-color: #f8f9fa;
    }

    .table th {
        font-weight: 600;
        color: #495057;
    }

    .badge {
        font-weight: 500;
        padding: 5px 10px;
    }

    .btn-outline-primary {
        color: var(--mainColor);
        /* Button text color */
        border-color: var(--mainColor);
        /* Outline color */
        transition: var(--transition);
    }

    .btn-outline-primary:hover,
    .btn-outline-primary:focus {
        background-color: var(--mainColor);
        /* Background on hover */
        color: var(--whiteColor);
        /* Text color on hover */
        border-color: var(--mainColor);
        /* Keep the border same */
    }

    .user-icon-wrapper {
        transition: all 0.3s ease;
        border: 3px solid #dee2e6 !important;
    }

    .user-icon-wrapper:hover {
        background-color: #f8f9fa !important;
        transform: scale(1.05);
    }

    .user-icon {
        transition: all 0.3s ease;
    }

    .user-icon-wrapper:hover .user-icon {
        color: var(--mainColor) !important;
    }

    .long-link {
        display: inline-block;
        max-width: 100%;
        overflow-wrap: break-word;
        word-break: break-word;
        white-space: normal;
        color: var(--blackColor);
    }
</style>
<script>
    // Add any interactive functionality here
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Add click event for course rows
        document.querySelectorAll('.table tbody tr').forEach(row => {
            row.addEventListener('click', function() {
                const link = this.querySelector('a[href]');
                if (link) {
                    window.location.href = link.href;
                }
            });
        });
    });
</script>

@endsection
