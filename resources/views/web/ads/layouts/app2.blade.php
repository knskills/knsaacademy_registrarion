<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    @yield('title')

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon_io/site.webmanifest') }}" rel="icon">
    <link href="{{ asset('assets/img/favicon_io/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('assets/img/favicon_io/favicon-32x32.png') }}" rel="icon" type="image/png" sizes="32x32">
    <link href="{{ asset('assets/img/favicon_io/favicon-16x16.png') }}" rel="icon" type="image/png" sizes="16x16">
    <link href="{{ asset('assets/img/favicon_io/android-chrome-512x512.png') }}" rel="icon" type="image/png"
        sizes="512x512">
    <link href="{{ asset('assets/img/favicon_io/android-chrome-192x192.png') }}" rel="icon" type="image/png"
        sizes="192x192">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon_io/favicon-16x16.png') }}" type="image/x-icon">

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/gaurd/css/bootstrap.css') }}" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
        rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href=" {{ asset('assets/gaurd/css/style.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/gaurd/css/custom.css') }}"> --}}


    <!-- responsive style -->
    <link href="{{ url('assets/gaurd/css/responsive.css') }}" rel="stylesheet" />

    @yield('style')
</head>

<body>
    @yield('hero_area')

    @yield('content')

    {{-- <!-- footer section -->
    <footer class="container-fluid footer_section">
        <p>
            &copy; <span id="currentYear"></span> Copyright <strong><span>K Narayan Skill Academy</span></strong> All
            Rights Reserved.
        </p>
        <div class="float-end">
            <a href="{{ route('terms') }}" class="ml-3">Term & Conditions</a>,
            <a href="{{ route('privacy') }}" class="ml-3">Privacy Policy</a>
        </div>
    </footer>
    <!-- footer section --> --}}

    <script src=" {{ url('assets/gaurd/js/jquery-3.4.1.min.js') }}"></script>
    <script src=" {{ url('assets/gaurd/js/bootstrap.js') }}"></script>
    <script src="{{ url('assets/gaurd/js/custom.js') }}"></script>

    @yield('script')
</body>

</html>
