<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    {{-- <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" /> --}}

    @yield('meatdata')

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template -->
    <link href=" {{ asset('assets/gaurd/css/style.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/gaurd/css/custom.css') }}"> --}}


    <!-- Responsive style -->
    <link href="{{ url('assets/gaurd/css/responsive.css') }}" rel="stylesheet" />

    <!-- Facebook meta tags -->
    <meta name="facebook-domain-verification" content="v15nfn4tot57f46sv6e1uway7qqiue" />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"
        integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- facebook script -->
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '902904171224060');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=902904171224060&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    @yield('script')
</body>

</html>
