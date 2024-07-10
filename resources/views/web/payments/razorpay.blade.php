<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KNSA | Payment</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon_io/site.webmanifest') }}"
        rel="icon">
    <link href="{{ asset('assets/img/favicon_io/apple-touch-icon.png') }}"
        rel="apple-touch-icon">
    <link href="{{ asset('assets/img/favicon_io/favicon-32x32.png') }}"
        rel="icon" type="image/png" sizes="32x32">
    <link href="{{ asset('assets/img/favicon_io/favicon-16x16.png') }}"
        rel="icon" type="image/png" sizes="16x16">
    <link
        href="{{ asset('assets/img/favicon_io/android-chrome-512x512.png') }}"
        rel="icon" type="image/png" sizes="512x512">
    <link
        href="{{ asset('assets/img/favicon_io/android-chrome-192x192.png') }}"
        rel="icon" type="image/png" sizes="192x192">
    <link rel="shortcut icon"
        href="{{ asset('assets/img/favicon_io/favicon-16x16.png') }}"
        type="image/x-icon">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('admin/js/jquery.js') }}"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3 col-md-offset-6">

                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade in"
                                role="alert">
                                <button type="button" class="close"
                                    data-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error!</strong>
                                {{ $message }}
                            </div>
                        @endif

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}"
                                role="alert">
                                <button type="button" class="close"
                                    data-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success!</strong>
                                {{ $message }}
                            </div>
                        @endif

                        <div class="card card-default">
                            <div class="card-header">
                                KNSA - kya kyo aur kaise?
                            </div>

                            <div class="card-body text-center">
                                <form
                                    action="{{ route('razorpay.store') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="audiance_id" id="audiance_id" value="5">
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="{{ env('RAZORPAY_KEY') }}"
                                        data-amount="1000"
                                        data-buttontext="Pay 10 INR"
                                        data-name="https://knsacademy.in/"
                                        data-description="Rozerpay"
                                        data-image="https://knsacademy.in/store/1/log%20knsa%20we.png"
                                        data-prefill.name="name"
                                        data-prefill.email="email"
                                        data-theme.color="#1d812f">
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
