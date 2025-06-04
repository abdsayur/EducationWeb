<!-- Start Navbar Area Start -->
<div class="navbar-area style-2" id="navbar">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="logo-light" src="{{ asset('img/logo/white-logo.png') }}" alt="logo">
                <img class="logo-dark" src="{{ asset('img/logo/logo.png') }}" alt="logo">
            </a>
            @if(request()->is('/') || Route::currentRouteName() == 'home')
            <div class="other-option d-lg-none">
                <div class="option-item">
                    <button type="button" class="search-btn" data-bs-toggle="offcanvas"
                        data-bs-target="#staticBackdrop">
                        <i class='bx bx-search'></i>
                    </button>
                </div>
            </div>
            @endif
            <a class="navbar-toggler" data-bs-toggle="offcanvas" href="#navbarOffcanvas" role="button"
                aria-controls="navbarOffcanvas">
                <i class='bx bx-menu'></i>
            </a>
            <div class="collapse navbar-collapse justify-content-between">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/project" class="nav-link {{ Request::is('project') ? 'active' : '' }}">
                            Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/theme" class="nav-link {{ Request::is('theme') ? 'active' : '' }}">
                            Themes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/course" class="nav-link {{ Request::is('course') ? 'active' : '' }}">
                            Courses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)"
                            class="dropdown-toggle nav-link {{ Request::is('student', 'professor', 'university', 'company') ? 'active' : '' }}">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="{{ route('services.student') }}"
                                    class="nav-link {{ Request::is('student') ? 'active' : '' }}">For Student</a>
                            </li>
                            <li class="nav-item"><a href="{{ route('services.professor') }}"
                                    class="nav-link {{ Request::is('professor') ? 'active' : '' }}">For Professor</a>
                            </li>
                            <li class="nav-item"><a href="{{ route('services.university') }}"
                                    class="nav-link {{ Request::is('university') ? 'active' : '' }}">For University</a>
                            </li>
                            <li class="nav-item"><a href="{{ route('services.company') }}"
                                    class="nav-link {{ Request::is('company') ? 'active' : '' }}">For Company</a></li>
                        </ul>
                    </li>
                    @if(Auth::guard('student')->check())
                    {{-- If the user is logged in, show profile --}}
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle nav-link">
                            Welcome {{ Auth::guard('student')->user()->first_name }}! <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="{{ route('student.profile') }}" class="nav-link">Profile</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('student.logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @elseif(Auth::guard('professor')->check())
                    {{-- If the user is logged in, show profile --}}
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle nav-link">
                            Welcome Pof. {{ Auth::guard('professor')->user()->first_name }}! <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="{{ route('professor.profile') }}" class="nav-link">Profile</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('professor.logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    {{-- If the user is NOT logged in, show Create Account & Login --}}
                    <li class="nav-item">
                        <a href="javascript:void(0)"
                            class="dropdown-toggle nav-link {{ Request::is('create-student-account', 'create-professor-account') ? 'active' : '' }}">
                            Create Account
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="{{ route('student.register') }}"
                                    class="nav-link {{ Request::is('create-student-account') ? 'active' : '' }}">Student</a>
                            </li>
                            <li class="nav-item"><a href="{{ route('professor.register') }}"
                                    class="nav-link {{ Request::is('create-professor-account') ? 'active' : '' }}">Professor</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.login') }}"
                            class="nav-link {{ Request::is('student/login') ? 'active' : '' }}">
                            Login
                        </a>
                    </li>
                    @endif
                </ul>
                <div class="others-option d-flex align-items-center">
                    <div class="option-item">
                        <div class="nav-btn">
                            <a href="/contact" class="default-btn">Contact Us</a>
                        </div>
                    </div>
                    @if(request()->is('/') || Route::currentRouteName() == 'home')
                    <div class="option-item">
                        <div class="nav-search">
                            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
                                aria-controls="staticBackdrop" class="search-button"><i class='bx bx-search'></i></a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- End Navbar Area Start -->

<!-- Start Responsive Navbar Area -->
<div class="responsive-navbar offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="navbarOffcanvas">
    <div class="offcanvas-header">
        <a href="{{route('home')}}" class="logo d-inline-block">
            <img class="logo-light" src="{{ asset('img/logo/logo.png') }}" alt="logo">
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="accordion" id="navbarAccordion">
            <div class="accordion-item">
                <a class="accordion-link without-icon {{ Request::is('/') ? 'active' : '' }}" href="/">
                    Home
                </a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link without-icon {{ Request::is('project') ? 'active' : '' }}" href="/project">
                    Projects
                </a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link without-icon {{ Request::is('themes') ? 'active' : '' }}" href="/themes">
                    Themes
                </a>
            </div>
            <div class="accordion-item">
                <a class="accordion-link without-icon {{ Request::is('course') ? 'active' : '' }}" href="/course">
                    Courses
                </a>
            </div>
            <div class="accordion-item">
                <button
                    class="accordion-button collapsed {{ Request::is('student', 'professor', 'university', 'company') ? 'active' : '' }}"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                    aria-controls="collapseOne">
                    Services
                </button>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#navbarAccordion">
                    <div class="accordion-body">
                        <div class="accordion" id="navbarAccordion7">
                            <div class="accordion-item">
                                <a href="{{ route('services.student') }}"
                                    class="accordion-link {{ Request::is('student') ? 'active' : '' }}">
                                    For Student
                                </a>
                            </div>
                            <div class="accordion-item">
                                <a href="/professor"
                                    class="accordion-link {{ Request::is('professor') ? 'active' : '' }}">
                                    For Professor
                                </a>
                            </div>
                            <div class="accordion-item">
                                <a href="/university"
                                    class="accordion-link {{ Request::is('university') ? 'active' : '' }}">
                                    For University
                                </a>
                            </div>
                            <div class="accordion-item">
                                <a href="/company" class="accordion-link {{ Request::is('company') ? 'active' : '' }}">
                                    For Company
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                @if(Auth::guard('student')->check())
                <button class="accordion-button collapsed
                    {{-- {{ Request::is('create-student-account', 'create-professor-account') ? 'active' : '' }} --}}
                    " type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    Welcome S. {{ Auth::guard('student')->user()->first_name }}!
                </button>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#navbarAccordion">
                    <div class="accordion-body">
                        <div class="accordion" id="navbarAccordion8">
                            <div class="accordion-item">
                                <a href="{{ route('student.profile') }}" class="accordion-link">
                                    Profile
                                </a>
                            </div>
                            <div class="accordion-item">
                                <a href="{{ route('student.logout') }}" class="accordion-link ">
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(Auth::guard('professor')->check())
                <button class="accordion-button collapsed
                    {{-- {{ Request::is('create-student-account', 'create-professor-account') ? 'active' : '' }} --}}
                    " type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    Welcome S. {{ Auth::guard('professor')->user()->first_name }}!
                </button>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#navbarAccordion">
                    <div class="accordion-body">
                        <div class="accordion" id="navbarAccordion8">
                            <div class="accordion-item">
                                <a href="{{ route('professor.profile') }}" class="accordion-link">
                                    Profile
                                </a>
                            </div>
                            <div class="accordion-item">
                                <a href="{{ route('professor.logout') }}" class="accordion-link ">
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <button
                    class="accordion-button collapsed {{ Request::is('create-student-account', 'create-professor-account') ? 'active' : '' }}"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    Create Account
                </button>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#navbarAccordion">
                    <div class="accordion-body">
                        <div class="accordion" id="navbarAccordion8">
                            <div class="accordion-item">
                                <a href="{{ route('student.register') }}"
                                    class="accordion-link {{ Request::is('create-student-account') ? 'active' : '' }}">
                                    Student
                                </a>
                            </div>
                            <div class="accordion-item">
                                <a href="{{ route('professor.register') }}"
                                    class="accordion-link {{ Request::is('create-professor-account') ? 'active' : '' }}">
                                    Professor
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="accordion-item">
                <a class="accordion-link without-icon" href="/contact">
                    Contact Us
                </a>
            </div>
        </div>
        <div class="offcanvas-contact-info">
            <h4>Contact Info</h4>
            <ul class="contact-info list-style">
                @if($info?->email)
                <li>
                    <i class="bx bxs-envelope"></i>
                    <a href="mailto:{{ $info->email }}">{{ $info->email }}</a>
                </li>
                @endif

                @if($info?->phone)
                <li>
                    <i class="bx bxs-phone"></i>
                    <a href="tel:{{ $info->phone }}">{{ $info->phone }}</a>
                </li>
                @endif

                @if($info?->whatsapp)
                <li>
                    <i class="bx bxl-whatsapp"></i>
                    <a href="https://wa.me/{{ $info->whatsapp }}" target="_blank">WhatsApp</a>
                </li>
                @endif

                {{-- <li>
                    <i class="bx bxs-time"></i>
                    <p>Mon - Fri: 9:00 - 18:00</p>
                </li> --}}
            </ul>

            <ul class="social-profile list-style">
                @if($info?->facebook)
                <li><a href="{{ $info->facebook }}" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                @endif

                @if($info?->instagram)
                <li><a href="{{ $info->instagram }}" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                @endif

                @if($info?->linkedin)
                <li><a href="{{ $info->linkedin }}" target="_blank"><i class='bx bxl-linkedin'></i></a></li>
                @endif

                @if($info?->youtube)
                <li><a href="{{ $info->youtube }}" target="_blank"><i class='bx bxl-youtube'></i></a></li>
                @endif
            </ul>
        </div>
        <div class="offcanvas-other-options">
            <div class="option-item">
                <a href="/contact" class="default-btn">Contact Us</a>
            </div>
        </div>
    </div>
</div>
<!-- End Responsive Navbar Area -->
