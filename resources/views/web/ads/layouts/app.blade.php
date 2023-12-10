<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    {{-- <title>Kamal Narayan Sahu - Network Marketing</title> --}}
    @yield('title')

    <meta
        content="Join Kamal Narayan Sahu's Network Marketing Webinar for expert insights, strategies, and success stories. Discover the secrets to building a thriving network marketing business. Register now!"
        name="description">
    <meta
        content="Kamal Narayan Sahu,Network Marketing Webinar,MLM Seminar,Direct Selling Training,Network Marketing Strategies,Lead Generation Techniques,Success Stories,Business Growth Tips,limited offer,offer"
        name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon_io2/site.webmanifest') }}" rel="icon">
    <link href="{{ asset('assets/img/favicon_io2/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('assets/img/favicon_io2/favicon-32x32.png') }}" rel="icon" type="image/png" sizes="32x32">
    <link href="{{ asset('assets/img/favicon_io2/favicon-16x16.png') }}" rel="icon" type="image/png" sizes="16x16">
    <link href="{{ asset('assets/img/favicon_io2/android-chrome-512x512.png') }}" rel="icon" type="image/png"
        sizes="512x512">
    <link href="{{ asset('assets/img/favicon_io2/android-chrome-192x192.png') }}" rel="icon" type="image/png"
        sizes="192x192">


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <style>
        .align-items-center {
            display: flex;
            align-items: center;
        }

        @media (max-width: 767px) {
            img.h_img {
                max-width: 100%;
                height: auto;
            }

            .btn-custom {
                display: inline-block;
                padding: 10px 20px;
                font-size: 24px;
                background-color: #df2d2d;
                color: #ffffff;
                border: 2px solid #df2d2d;
                border-radius: 10px;
                text-decoration: none;
                transition: background-color 0.3s, color 0.3s;
                margin-bottom: 10%;
            }

            #header {
                display: none;
            }
        }

        @media (min-width: 768px) {
            img.h_img {
                max-width: 400px;
                max-height: 200px;
            }

            .btn-custom {
                display: inline-block;
                padding: 20px 40px;
                /* Adjust the padding to make the button bigger */
                font-size: 24px;
                /* Adjust the font size to make the text bigger */
                background-color: #df2d2d;
                /* Change the background color to your desired color */
                color: #ffffff;
                /* Change the text color to contrast with the background */
                border: 2px solid #df2d2d;
                /* Add a border with the same color as the background */
                border-radius: 10px;
                /* Add rounded corners to the button */
                text-decoration: none;
                /* Remove underlines from links */
                transition: background-color 0.3s, color 0.3s;
                /* Add a smooth transition effect */
            }

            /** hide header */
            #header {
                display: none;
            }
        }

        /* Hover effect: Change background color and text color on hover */
        .btn-custom:hover {
            background-color: #f01c1c;
            /* Change the background color on hover */
            /* color: #333; */
            color: #ffffff;
            /* Change the text color on hover */
        }

        .wha {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 140px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-float {
            margin-top: 16px;
        }
    </style>

    <style>
        #timer_body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 15vh;
            background: #0D1A29;
            font-family: sans-serif;
            font-weight: lighter;
        }

        #timer {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2em;
            /* Adjust as needed */
            font-weight: 100;
            color: white;
            text-shadow: 0 0 20px #48ffe0;
        }

        #timer .hours,
        #timer .minutes,
        #timer .seconds {
            text-align: center;
            margin: 0 10px;
        }

        #timer .time {
            color: #020202;
            font-size: 1em;
            /* Adjust as needed */
            font-weight: 400;
        }

        #timer .unit {
            color: #020202;
            font-size: 0.35em;
            font-weight: 400;
        }

        @media (max-width: 768px) {
            #timer {
                font-size: 1.2em;
                /* Adjust the font size for small screens */
            }

            #timer {
                font-size: 1.1em;
                /* Adjust the font size for small screens */
                margin-bottom: 6%;
            }

            /* #main_t {
                margin-top: -10%;
            } */
        }
    </style>

    <style>
        #big_s {
            display: block;
        }

        #small_s {
            display: none;
        }

        @media (max-width: 768px) {
            #big_s {
                display: none;
            }

            #small_s {
                display: block;
            }
        }
    </style>

    @yield('style')
</head>

<body>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:knsaacdemy@gmail.com">knsaacdemy@gmail.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4">
                    <a href="tel:+917582918000">+91 7582918000</a>
                </i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                {{-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a> --}}
                <a href="https://www.facebook.com/p/KAMAL-NARAYAN-SAHU-100063653929924/" class="facebook"><i
                        class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/kamal_narayan_sahu/?hl=en" class="instagram"><i
                        class="bi bi-instagram"></i></a>
                <a href="https://www.linkedin.com/in/kamal-narayan-sahu-34003983/?originalSubdomain=in"
                    class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
        </div>
    </section>

    {{-- <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <span></span>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Videos</a></li>
                    <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
                    <li>
                        <select class="form-control changeLang">
                            <option value="hi" {{ session()->get('locale') == 'hi' ? 'selected' : '' }}>🇮🇳 Hindi
                            </option>
                            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>🇬🇧
                                English
                            </option>
                        </select>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header --> --}}

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100" id="main_t">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <h2 class="text-black" style="height: 10%">Selling is a Science, Art and A Skill</h2>
                    <span>
                        <b>Science</b> - sales Science has to be Learned,
                        <b>Art</b> - sales Art has to be Practiced,
                        <b>Skill</b> - sales Skill has to be mastered.
                    </span>
                </div>

                <div class="col-md-6 justify-content-center">
                    <h1>Learn the science and art of sales by <span>Shiv Arora</span></h1>

                    {{-- <span>
                        <b>Science</b> - sales Science has to be Learned
                        <b>Art</b> - sales Art has to be Practiced
                        <b>Skill</b> - sales Skill has to be mastered.
                    </span> --}}

                    {{-- <div id="big_s"> --}}
                    <div class="text-center m-auto mt-4">
                        <a href="#skills" class="btn-custom mb-3" {{ $disabled }}>
                            <span>Book Now Your Seat <b>₹99</b> </span>
                        </a>
                    </div><br>
                    {{-- </div> --}}


                    <div class="d-flex justify-content-center">
                        <div id="timer">
                            <b class="text-dark">Offer Expired:</b>
                            <div class="hours">
                                <span class="time" id="hr">00</span>
                                <span class="unit">HRS</span>
                            </div>
                            <div class="minutes">
                                <span class="time" id="min">00</span>
                                <span class="unit">MINS</span>
                            </div>
                            <div class="seconds">
                                <span class="time" id="sec">00</span>
                                <span class="unit">SECS</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9" style="width: 100%;height: 100%;">
                        <iframe src="https://www.youtube.com/embed/X13jh94WpQw?si=hZPyRgUYN9jDs8sq"
                            title="Art of sales" frameborder="0"
                            style="border: none;
                            box-shadow: 0 1px 0 #000;width: 100%;height: 100%;"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div id="small_s">
                        <div class="text-center m-auto mt-4">
                            <a href="#skills" class="btn-custom mb-3" {{ $disabled }}>
                                <span>Book Now Your Seat <b>₹99</b> </span>
                            </a>
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <div id="timer">
                                <b class="text-dark">Offer Expired:</b>
                                <div class="hours">
                                    <span class="time" id="hr">00</span>
                                    <span class="unit">HRS</span>
                                </div>
                                <div class="minutes">
                                    <span class="time" id="min">00</span>
                                    <span class="unit">MINS</span>
                                </div>
                                <div class="seconds">
                                    <span class="time" id="sec">00</span>
                                    <span class="unit">SECS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->

    @yield('hero')

    <main id="main">
        @yield('content')

        <a href="https://api.whatsapp.com/send?phone=+917582918000&text=Hello." class="wha" target="_blank">
            <i class="fa fa-whatsapp my-float"></i>
        </a>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        &copy; Copyright <strong><span>Kamal Narayan Sahu</span></strong>. All Rights Reserved
                    </div>

                    <div class="float-end">
                        <a href="{{ route('terms') }}" class="ml-3">Term & Conditions</a>,
                        <a href="{{ route('privacy') }}" class="ml-3">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @yield('script')


    <script>
        $(document).ready(function() {

            $('#submit').click(function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();

                $.ajax({
                    url: "{{ route('audience.store') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        email: email,
                        phone: phone,
                        event_name: 'art of sale', // event name
                    },
                    success: function(response) {
                        $('#registration')[0].reset();
                        $('#submit').attr('disabled', false);
                        $('#submit').html('Submit');
                        $('#success').show();
                        $('#success').html(response.message);
                        if (response.message) {
                            // $('#success').show();
                            // $('#success').html(response.message);
                            // $('#msg').show();
                            // show confirm modal
                            // $('#confirm_msg').modal('show');

                            // redirect https://pages.razorpay.com/pl_N2hfUxhbaumGiZ/view
                            window.location.href =
                                "https://pages.razorpay.com/pl_N2hfUxhbaumGiZ/view";
                        } else if (response.errors) {
                            let errors = response.errors;
                            $('#success').hide();
                            $('#err_div').show();
                            $('#errors').html('');
                            $('#errors').parent().hide();
                            $.each(errors, function(key, value) {
                                $('#errors').parent().show();
                                $('#errors').append('<li>' + value + '</li>');
                            });
                            $('#err_div').show();

                        }
                        setTimeout(function() {
                            $('.alert').hide();
                        }, 5000);
                    },
                    error: function(response) {
                        $('#errors').html('');
                        $('#errors').parent().hide();
                        $('#submit').attr('disabled', false);
                        $('#submit').html('Submit');
                        $.each(response.responseJSON.errors, function(key, value) {
                            $('#errors').parent().show();
                            $('#errors').append('<li>' + value + '</li>');
                        });

                        $('.alert').removeClass('alert-success');
                        $('.alert').addClass('alert-danger');
                        setTimeout(function() {
                            $('.alert').hide();
                        }, 3000);

                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        var url = "{{ route('changeLang') }}";

        $(".changeLang").change(function() {
            window.location.href = url + "?lang=" + $(this).val();
        });
    </script>
    <script>
        // Set the target date and time (1 hour from the current time)
        const targetDate = new Date();
        targetDate.setHours(targetDate.getHours() + 1);

        // Function to update the countdown timer
        function updateCountdown() {
            const currentDate = new Date();
            const timeDifference = targetDate - currentDate;

            if (timeDifference <= 0) {
                // The countdown has expired
                document.getElementById("countdown").textContent = "Countdown expired!";
                return;
            }

            const hours = Math.floor(timeDifference / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            // Display the countdown timer
            document.getElementById("hr").textContent = hours;
            document.getElementById("min").textContent = minutes;
            document.getElementById("sec").textContent = seconds;
        }

        // Update the countdown every second
        setInterval(updateCountdown, 1000);

        // Initial call to set the timer immediately
        updateCountdown();
    </script>
</body>

</html>
