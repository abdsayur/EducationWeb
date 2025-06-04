<div class="footer-area-3">
    <div class="container">
        <div class="footer-top-info ptb-70">
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-6 col-12">
                    @if($info->phone)
                    <div class="left-content">
                        <p><i class='bx bx-support'></i> Speak to our expert at <a href="tel:{{ $info->phone }}">{{
                                $info->phone }}</a></p>
                    </div>
                    @endif
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="right-content">
                        <span>Follow Us</span>
                        <ul>
                            @if($info->facebook)
                            <li><a href="{{ $info->facebook }}" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                            @endif
                            @if($info->instagram)
                            <li><a href="{{ $info->instagram }}" target="_blank"><i
                                        class='bx bxl-instagram-alt'></i></a></li>
                            @endif
                            @if($info->twitter)
                            <li><a href="{{ $info->twitter }}" target="_blank"><i class='bx bxl-twitter'></i></a></li>
                            @endif
                            @if($info->linkedin)
                            <li><a href="{{ $info->linkedin }}" target="_blank"><i
                                        class='bx bxl-linkedin-square'></i></a></li>
                            @endif
                            @if($info->youtube)
                            <li><a href="{{ $info->youtube }}" target="_blank"><i class='bx bxl-youtube'></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="footer-widget-info ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="footer-widget">
                        <div class="image">
                            <img src="{{ asset('img/logo/logo.png') }}" alt="image">
                        </div>
                        <p>Suspendisse non sem ante cras pretiu gravida leo a convallis. Nam malesuada interdum metus
                            sit amet dictum.</p>
                        <div class="info-links">
                            <a href="tel:+125344456345" target="_blank">+1-2534-4456-345</a>
                            @if($info->email)
                            <a href="mailto:{{ $info->email }}" target="_blank">{{ $info->email }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="footer-widget">
                        <h4>Campus Life</h4>
                        <ul>
                            <li><a href="alumni.html"><i class='bx bx-chevron-right'></i> Accessibility</a></li>
                            <li><a href="financial-aid.html"><i class='bx bx-chevron-right'></i> Financial Aid</a></li>
                            <li><a href="online-education.html"><i class='bx bx-chevron-right'></i> Food Services</a>
                            </li>
                            <li><a href="financial-aid.html"><i class='bx bx-chevron-right'></i> Housing</a></li>
                            <li><a href="fitness-athletics.html"><i class='bx bx-chevron-right'></i> Information
                                    Technologies</a></li>
                            <li><a href="student-activities.html"><i class='bx bx-chevron-right'></i> Student Life</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="footer-widget">
                        <h4>Our Campus</h4>
                        <ul>
                            <li><a href="academics.html"><i class='bx bx-chevron-right'></i> Academic</a></li>
                            <li><a href="admission.html"><i class='bx bx-chevron-right'></i> Planning &
                                    Administration</a></li>
                            <li><a href="the-campus-experience.html"><i class='bx bx-chevron-right'></i> Campus
                                    Safety</a></li>
                            <li><a href="alumni.html"><i class='bx bx-chevron-right'></i> Office of the Chancellor</a>
                            </li>
                            <li><a href="the-campus-experience.html"><i class='bx bx-chevron-right'></i> Facility
                                    Services</a></li>
                            <li><a href="graduate.html"><i class='bx bx-chevron-right'></i> Human Resources</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="footer-widget">
                        <h4>Academics</h4>
                        <ul>
                            <li><a href="university-life.html"><i class='bx bx-chevron-right'></i> Canvas</a></li>
                            <li><a href="undergraduate.html"><i class='bx bx-chevron-right'></i> Catalyst</a></li>
                            <li><a href="academics.html"><i class='bx bx-chevron-right'></i> Library</a></li>
                            <li><a href="date-deadlines.html"><i class='bx bx-chevron-right'></i> Time Schedule</a></li>
                            <li><a href="how-to-apply.html"><i class='bx bx-chevron-right'></i> Apply For Admissions</a>
                            </li>
                            <li><a href="tuition-fees.html"><i class='bx bx-chevron-right'></i> Pay My Tuition</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="copy-right-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xm-6">
                    <div class="cpr-left">
                        <p>Copyright© <a href="#">LearnX</a>, All rights reserved.</p>
                    </div>
                </div>
                <div class="col-lg-8 col-xm-6">
                    <div class="cpr-right">
                        <ul>
                            <li><a href="{{ route('footer.pages.show', 'terms-of-service') }}">Terms of Service</a></li>
                            <li><a href="{{ route('footer.pages.show', 'privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('footer.pages.show', 'cookie-policy') }}">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="footer-area">
    <div class="footer-top-info pb-100">
        <div class="content">
            <div class="image">
                <img src="{{ asset('img/logo/footer-logo.png') }}" alt="image">
            </div>
            <p>University Life Nurtures an Inclusive Campus Life Environment Where Students Grow Intellectually and
                Engage in Meaningful Experiential Opportunities.</p>
            <ul>
                <li><a href="https://www.fb.com" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                <li><a href="https://www.instagram.com" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                <li><a href="https://www.twitter.com"><i class='bx bxl-twitter'></i></a></li>
                <li><a href="https://www.linkedin.com" target="_blank"><i class='bx bxl-linkedin-square'></i></a></li>
            </ul>
        </div>
    </div>
    <div class="footer-widget-info ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="footer-widget">
                        <h4>Campus Life</h4>
                        <ul>
                            <li><a href="alumni.html"><i class='bx bx-chevron-right'></i> Accessibility</a></li>
                            <li><a href="financial-aid.html"><i class='bx bx-chevron-right'></i> Financial Aid</a></li>
                            <li><a href="online-education.html"><i class='bx bx-chevron-right'></i> Food Services</a>
                            </li>
                            <li><a href="financial-aid.html"><i class='bx bx-chevron-right'></i> Housing</a></li>
                            <li><a href="fitness-athletics.html"><i class='bx bx-chevron-right'></i> Information
                                    Technologies</a></li>
                            <li><a href="student-activities.html"><i class='bx bx-chevron-right'></i> Student Life</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="footer-widget">
                        <h4>Our Campus</h4>
                        <ul>
                            <li><a href="academics.html"><i class='bx bx-chevron-right'></i> Academic</a></li>
                            <li><a href="admission.html"><i class='bx bx-chevron-right'></i> Planning &
                                    Administration</a></li>
                            <li><a href="the-campus-experience.html"><i class='bx bx-chevron-right'></i> Campus
                                    Safety</a></li>
                            <li><a href="alumni.html"><i class='bx bx-chevron-right'></i> Office of the Chancellor</a>
                            </li>
                            <li><a href="the-campus-experience.html"><i class='bx bx-chevron-right'></i> Facility
                                    Services</a></li>
                            <li><a href="graduate.html"><i class='bx bx-chevron-right'></i> Human Resources</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="footer-widget">
                        <h4>Academics</h4>
                        <ul>
                            <li><a href="university-life.html"><i class='bx bx-chevron-right'></i> Canvas</a></li>
                            <li><a href="undergraduate.html"><i class='bx bx-chevron-right'></i> Catalyst</a></li>
                            <li><a href="academics.html"><i class='bx bx-chevron-right'></i> Library</a></li>
                            <li><a href="date-deadlines.html"><i class='bx bx-chevron-right'></i> Time Schedule</a></li>
                            <li><a href="how-to-apply.html"><i class='bx bx-chevron-right'></i> Apply For Admissions</a>
                            </li>
                            <li><a href="tuition-fees.html"><i class='bx bx-chevron-right'></i> Pay My Tuition</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="footer-widget">
                        <h4>Information For</h4>
                        <ul>
                            <li><a href="application-form.html"><i class='bx bx-chevron-right'></i> How To Apply</a>
                            </li>
                            <li><a href="date-deadlines.html"><i class='bx bx-chevron-right'></i> Dates & Deadlines</a>
                            </li>
                            <li><a href="student-activities.html"><i class='bx bx-chevron-right'></i> Student
                                    Activities</a></li>
                            <li><a href="support-guidance.html"><i class='bx bx-chevron-right'></i> Support &
                                    Guidance</a></li>
                            <li><a href="schedule-tour.html"><i class='bx bx-chevron-right'></i> Schedule A Tour</a>
                            </li>
                            <li><a href="faculty.html"><i class='bx bx-chevron-right'></i> Faculty & Staffs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12 col-xm-6">
                    <div class="cpr-left">
                        <p>Copyright© <a href="#">Clgun</a>, All rights reserved.</p>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12 col-xm-6">
                    <div class="cpr-right">
                        <ul>
                            <li><a href="#">Term of services</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
