@extends('layouts.app1')

@section('title', 'Student Profile')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner bg-4">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info text-center">
                {{-- <h2 class="mb-3" data-aos="fade-up" data-aos-delay="100">Student Profile</h2> --}}
                <p class="lead" data-aos="fade-up" data-aos-delay="200">Welcome back, {{ $student->first_name }}! Access
                    your dashboard to manage your courses, track your progress, and view your academic records.</p>
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
                            <h3 class="mb-3">{{ $student->first_name }} {{ $student->last_name }}</h3>
                            <div class="d-flex justify-content-center mb-3">
                                <span class="badge bg-success">{{ $student->academic_year }}</span>
                            </div>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bx bx-envelope me-2"></i>{{ $student->email }}
                                </li>
                                <li class="mb-2">
                                    <i class="bx bx-phone me-2"></i>{{ $student->phone ?? 'Not provided' }}
                                </li>
                                <li>
                                    <i class="bx bx-map me-2"></i>{{ $student->country }}
                                </li>
                            </ul>
                            <a href="{{ route('student.profile.edit') }}" class="btn btn-outline-primary mt-3">
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
                            {{-- <a href="#" class="btn btn-sm btn-outline-secondary">View Full Details</a> --}}
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">First Name</h6>
                                    <p class="mb-0">{{ $student->first_name }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Last Name</h6>
                                    <p class="mb-0">{{ $student->last_name }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Email</h6>
                                    <p class="mb-0">{{ $student->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Phone</h6>
                                    <p class="mb-0">{{ $student->phone ?? 'Not provided' }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Academic Level</h6>
                                    <p class="mb-0">{{ $student->academic_year }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <h6 class="text-muted mb-1">Country</h6>
                                    <p class="mb-0">{{ $student->country }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrolled Courses Card -->
                    <div class="profile-section">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="mb-0"><i class="bx bx-book me-2"></i>Enrolled Courses</h3>
                            <a href="{{ route('course.index') }}" class="btn btn-sm btn-outline-primary">Browse
                                Courses</a>
                        </div>

                        @if($enrolledCourses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Course</th>
                                        <th>Institution</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrolledCourses as $course)
                                    <tr>
                                        <td>
                                            <strong>{{ $course->title }}</strong>
                                            <div class="small text-muted">{{ $course->nb_of_hours ?? 'N/A' }} hours
                                            </div>
                                        </td>
                                        <td>
                                            {{ $course->university ?? 'N/A' }}
                                            <div class="small text-muted">{{ $course->location ?? 'N/A' }}</div>
                                        </td>
                                        <td>
                                            <div class="small">
                                                <span class="badge bg-light text-dark">{{ $course->language ?? 'N/A'
                                                    }}</span>
                                                <div>Enrolled: {{ $course->pivot->created_at ?
                                                    $course->pivot->created_at->format('M d, Y') : 'N/A' }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('course.show', $course->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="bx bx-info-circle me-2" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h5 class="alert-heading">No Enrolled Courses</h5>
                                    <p class="mb-0">You haven't enrolled in any courses yet. Browse our catalog to find
                                        interesting courses.</p>
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
<!-- End Profile Area -->

<style>
    .profile-area {
        background-color: #f8f9fa;
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
