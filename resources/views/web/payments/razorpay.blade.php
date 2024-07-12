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

    <link
        href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}"
        rel="stylesheet">
    <script src="{{ asset('admin/js/jquery.js') }}"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 50px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .alert {
            margin-top: 20px;
        }

        .img-fluid {
            border-bottom: 1px solid #dee2e6;
        }

        .btn-pay-now {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-pay-now:hover {
            background-color: #0056b3;
        }

        .btn-pay-now:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }
    </style>
</head>

<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show"
                            role="alert">
                            <button type="button" class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            <strong>Error!</strong> {{ $message }}
                        </div>
                    @endif

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show"
                            role="alert">
                            <button type="button" class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                    @endif

                    {{-- <div class="card">
                        <div class="card-header text-center">
                            KNSA - kya kyo aur kaise?
                        </div>

                        <img src="{{ asset('ads/img/b2b/thumbnail.jpeg') }}"
                            alt="KNSA" class="img-fluid">

                        <div class="card-body text-center">
                            <form action="{{ route('razorpay.store') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="audiance_id"
                                    id="audiance_id" value="5">
                                <button type="button" id="rzp-button1"
                                    class="btn-pay-now">Pay Now</button>
                            </form>
                        </div>
                    </div> --}}

                    <div class="card">
                        <div class="card-header text-center">
                            KNSA - kya kyo aur kaise?
                        </div>

                        <img src="{{ asset('ads/img/b2b/thumbnail.jpeg') }}"
                            alt="KNSA" class="img-fluid">

                        <div class="card-body text-center">
                            <form action="{{ route('razorpay.store') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="audiance_id"
                                    id="audiance_id" value="491">
                                <input type="hidden" name="event_id"
                                    id="event_id" value="5">
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ env('RAZORPAY_KEY') }}" data-amount="1000"
                                    data-buttontext="Pay 10 INR" data-name="https://knsacademy.in/"
                                    data-description="Rozerpay"
                                    data-image="https://knsacademy.in/store/1/log%20knsa%20we.png"
                                    data-prefill.name="name" data-prefill.email="email"
                                    data-theme.color="#1d812f"></script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

{{-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ env('RAZORPAY_KEY') }}",
        "amount": "1000", // Amount is in currency subunits. Default currency is INR. Hence, 1000 refers to 1000 paise or ₹10.
        "currency": "INR",
        "name": "KNSA",
        "description": "Rozerpay",
        "image": "https://knsacademy.in/store/1/log%20knsa%20we.png",
        "handler": function(response) {
            document.getElementById('razorpay_payment_id').value =
                response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value =
                response.razorpay_order_id;
            document.getElementById('razorpay_signature').value =
                response.razorpay_signature;
            document.getElementById('paymentForm').submit();
        },
        "prefill": {
            "name": "name",
            "email": "email"
        },
        "theme": {
            "color": "#1d812f"
        }
    };
    var rzp1 = new Razorpay(options);

    document.getElementById('rzp-button1').onclick = function(e) {
        rzp1.open();
        e.preventDefault();
    }
</script> --}}

</html>
