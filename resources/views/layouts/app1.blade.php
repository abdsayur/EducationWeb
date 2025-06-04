<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links of CSS files -->
    <link rel="stylesheet" href="{{ asset('css/aoss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>@yield('title', 'Home Page')</title>
    <link rel="icon" type="image/png" href="http://127.0.0.1:8000/img/all-img/favicon.png">
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
</head>

<body>
    <!-- preloader -->
    <div class="preloader-container" id="preloader">
        <div class="preloader-dot"></div>
        <div class="preloader-dot"></div>
        <div class="preloader-dot"></div>
        <div class="preloader-dot"></div>
        <div class="preloader-dot"></div>
    </div>
    <!-- preloader -->

    <!-- Start Navbar Area Start && Start Responsive Navbar Area -->
    @php
    $info = \App\Models\ConnectInfo::firstOrFail();
    @endphp
    @include('partials.header',['info'=>$info])
    <!-- End Navbar Area Start -->

    @yield('content')

    <!-- Start Footer Area -->
    @include('partials.footer',['info'=>$info])
    <!-- End Footer Area -->

    <!-- Scroll Top Button -->
    <div class="go-top active">
        <i class="bx bx-up-arrow-alt"></i>
    </div>

    <!-- Links of JS files -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>