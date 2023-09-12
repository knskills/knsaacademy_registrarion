<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Kamal Narayan Sahu - Network Marketing</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon_io/site.webmanifest') }}" rel="icon">
    <link href="{{ asset('assets/img/favicon_io/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('assets/img/favicon_io/favicon-32x32.png') }}" rel="icon" type="image/png" sizes="32x32">
    <link href="{{ asset('assets/img/favicon_io/favicon-16x16.png') }}" rel="icon" type="image/png" sizes="16x16">
    <link href="{{ asset('assets/img/favicon_io/android-chrome-512x512.png') }}" rel="icon" type="image/png"
        sizes="512x512">
    <link href="{{ asset('assets/img/favicon_io/android-chrome-192x192.png') }}" rel="icon" type="image/png"
        sizes="192x192">


    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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
</head>

<body>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:knsaacdemy@gmail.com">knsaacdemy@gmail.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4">
                    <a href="tel:+919343643552">+91 9343643552</a>
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

    <!-- ======= Header ======= -->
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
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="row">
                <div class="col-md-6 justify-content-center">
                    <h1> {{ __('lang.title_m') }}<span> {{ __('lang.title_s') }}</span></h1>
                    <h2>in our live sessions</h2>

                    <a href="#skills" class="btn-custom mb-3" {{$disabled}}>
                        <span>Book Now Your Free Seat <b>₹<del>399</del></b> </span>
                    </a><br>
                    <b id="timerDisplay" class="h4 bg-white text-dark">Time remaining: 60:00</b>
                </div>

                <div class="col-md-6">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/yWoQljL6zRw?si=aAiYRBXE_fGSFlEB"
                            title="YouTube video player" frameborder="1" style="border: 5px solid #000;"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>About</h2>
                    <h3>Find Out More About <span>Network Marketing</span></h3>
                </div>

                <div class="row">
                    <div class="col-lg-6 text-center" data-aos="fade-right" data-aos-delay="100">
                        <div class="tutorial container text-center my-2 ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/KbedXSOMAt8?si=1-FrgeB5IDnEoLiA"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                        <h4 class="text-primary">16+ Years Experience</h4>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center"
                        data-aos="fade-up" data-aos-delay="100">
                        <h3>The Network Marketing Success Formula: The Ultimate Guide to Building a Thriving Business
                        </h3>
                        <p class="fst-italic">
                            Are you looking to build a successful network marketing business? If so, you need The
                            Network Marketing Success Formula. This comprehensive e-book will teach you everything you
                            need to know to achieve success in this industry.
                            <br>
                            In this Class, you will learn:
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= why2 Section ======= -->
        <section id="about" class="about ">
            <div class="container" data-aos="fade-up">
                {{-- <div class="section-title">
                <h3>{{ __('lang.some_reasons') }} <span>{{ __('lang.some_reasons_1') }}</span></h3>
            </div> --}}
                <div class="section-title">
                    <h3>Some Reasons<span> Why People Failed in Network Marketing:</span></h3>
                </div>

                <div class="row">
                    <div class="col-lg-6 text-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{ asset('assets/img/marketing.jpg') }}" alt="network" class="img-fluid">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center"
                        data-aos="fade-up" data-aos-delay="100">
                        <b>
                            {{ __('lang.reasion_content_1') }}
                        </b>
                        <br>
                        <p class="fst-italic">
                            {{ __('lang.reasion_content_2') }}
                        </p>
                        <p>
                            {{ __('lang.reasion_content_3') }}
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= why Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h3>Why People Get Failed on <span>Network Marketing ?</span></h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/img/think.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>What network marketing is and how it works</li>
                            <li>How to choose the right company</li>
                            <li>How to find your target market</li>
                            <li>How to build your network</li>
                            <li>How to present your products or services</li>
                            <li>How to follow up with customers</li>
                            <li>How to build your team</li>
                            <li>How to overcome challenges</li>
                            <li>How to stay motivated And more!</li>
                        </ul>
                        <p>
                            The Network Marketing Success Formula is the perfect resource for anyone who wants to build
                            a successful network marketing business. Get your copy today and start your journey to
                            success!
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Services Section -->

        <!-- ======= Registration Section ======= -->
        <section id="skills" class="skills ">
            <div class="container" data-aos="fade-up">
                <div class="row skills-content">
                    <div class="col-lg-7">
                        <div class="card">

                            <!-- Modal -->
                            <div class="modal fade" id="confirm_msg" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Dear Sir/Madam,</p>
                                            <p>
                                                We are delighted to confirm your registration for the seminar. Your
                                                seat has been successfully reserved, and we are excited to have you
                                                join us for this enlightening event.
                                            </p>
                                            <p>
                                                <strong>Please confirm your seat by clicking on the link below</strong>.
                                            </p>
                                            <a href="https://chat.whatsapp.com/JBWY02DtUUIG7iTyDB43NM"
                                                class="btn btn-success">Join Whatsapp Group</a>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="card-title mb-3">Registration Form</h5>
                                </div>

                                <div class="alert alert-success" id="success" style="display: none">
                                </div>

                                <div class="alert alert-danger" style="display: none" id="err_div">
                                    <ul id="errors">

                                    </ul>
                                </div>

                                <form method="post" id="registration">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="phone"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" minlength="10"
                                            name="phone" maxlength="10" placeholder="" required>
                                    </div>
                                    <button class="btn btn-primary" type="button" id="submit">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 mt-5">
                        <div class="align-items-center">
                            <img src="{{ asset('assets/img/zoom-q4lxq0brpwmn1u1k7eah0gv2ntwyqp3nn2e2gqykpo.png') }}"
                                alt="meeting" class="img-fluid">
                            <h5 style="margin-left: 10%">
                                With 1 Hour
                                Live Zoom
                                Webinar​
                            </h5>
                        </div>
                        <div class="mt-5 text-center">
                            <img src="{{ asset('assets/img/star.jpg') }}" alt="rating" class="img-fluid h_img">
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Skills Section -->

        <!-- ======= videos Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Videos</h2>
                    <h3>Our youtube <span>videos</span></h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in"
                        data-aos-delay="100">
                        <div class="tutorial container text-center my-2 ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/NfRD3cDW61I?si=RrnocvtUQloqN5dC"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div class="tutorial container text-center my-2 ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/n_qyxcx6qZA?si=pq_H6F07E2WIlf0-"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                        data-aos-delay="300">
                        <div class="tutorial container text-center my-2 ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/2kaPtYikGZ0?si=Rj_1r2J7LDrMgnn6"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in"
                        data-aos-delay="100">
                        <div class="tutorial container text-center my-2 ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/l4AtEtQIkrM?si=LYOLNJYhIacuPBrM"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div class="tutorial container text-center my-2 ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/BC0ZvtW0hNk?si=-Eovfj127ZHd5Nkx"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                        data-aos-delay="300">
                        <div class="tutorial container text-center my-2 ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/M80GBZLkCc4?si=uCx7HnmHUF4F8JBW"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Services Section -->

        <!-- ======= Networker ======= -->
        <section id="team" class="services">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Trainers</h2>
                    <h3>Our Multimillionaires <span>Networker</span></h3>
                    <p>Some of Our Multimillionaires Network Marketing leaders
                        Who transforms their Life & achived Big success in Network Marketing industry ...</p>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/team/jitendra.jpeg') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="member-info">
                                <h4>Jitendra Dhever</h4>
                                <span class="text-dark">Income - ₹ 6 crore</span><br>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/team/WhatsApp Image 2023-09-09 at 11.56.10 AM.jpeg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>Mukesh Sharma</h4>
                                <span class="text-dark">Income - ₹ 2.5 crore</span><br>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/team/jst.jpeg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>Devbrat Mourya</h4>
                                <span class="text-dark">Income - ₹ 4.5 crore</span><br>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/team/munib.jpeg') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="member-info">
                                <h4>Munib Nishad</h4>
                                <span class="text-dark">Income - ₹ 2.5 crore</span><br>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/team/dharmendra.jpeg') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="member-info">
                                <h4>Dharmendra Yadav</h4>
                                <span class="text-dark">Income - ₹ 1.5 crore</span><br>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/team/WhatsApp Image 2023-09-09 at 11.55.46 AM (1).jpeg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>Manteshwar</h4>
                                <span class="text-dark">Income - ₹ 81 lac</span><br>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/team/ramprasad.jpeg') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="member-info">
                                <h4>DAYANAND PRASAD </h4>
                                <span class="text-dark">Income - ₹ 49 lac</span><br>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/img/team/WhatsApp Image 2023-09-09 at 11.54.57 AM.jpeg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>Panku Sharma </h4>
                                <span class="text-dark">Income - ₹ 37 lac</span><br>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Team Section -->

        <!-- ======= Team Section ======= -->
        <section id="portfolio" class="team section-bg">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('assets/img/sirji2.png') }}" alt="sirji" class="img-fluid">
                    </div>

                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        <div class="section-title">
                            <h3><span>Who Is</span> Kamal Narayan Sahu</h3>
                        </div>
                        <p>
                            Kamal Narayan Sahu Kamal Narayan Sahu, an Entrepreneur, Motivational speaker, Leadership &
                            Direct Selling Coach. He is only matriculate and a school dropper student, and at the early
                            age of 16, Came to the world’s biggest industry “Sales” Now he has 10 years of sales and
                            leadership experience. He works to inspire the youth of India and helping people to realize
                            their true potential. Kamal Narayan Sahu is C.E.O And Managing Director on one of the
                            Leading Network Marketing/Direct selling Company- (YTM) YASHIKA TRADING & MARKETING PVT.
                            LTD.
                        </p>

                        <div class="d-flex justify-content-center mt-5">
                            <a href="#skills" class="btn-custom">
                                <span>Book Now Your Free Seat</span>
                            </a>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <h4>Limited Seats, Filling Fast...</h4>
                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End Team Section -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <a href="https://api.whatsapp.com/send?phone=+917582918000&text=Hello." class="wha" target="_blank">
            <i class="fa fa-whatsapp my-float"></i>
        </a>

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <a href="https://www.facebook.com/p/KAMAL-NARAYAN-SAHU-100063653929924/">
                        <img src="{{ asset('assets/img/facebook.jpg') }}" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="row">
                    <a href="https://www.facebook.com/p/KAMAL-NARAYAN-SAHU-100063653929924/">
                        <img src="{{ asset('assets/img/facebook.png') }}" class="img-fluid" alt="">
                    </a>
                </div>

            </div>
        </section><!-- End Pricing Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright">
                        &copy; Copyright <strong><span>Kamal Narayan Sahu</span></strong>. All Rights Reserved
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
                        phone: phone
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
                            $('#confirm_msg').modal('show');
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
        const timerDisplay = document.getElementById('timerDisplay');
        const registerButton = document.getElementById('registerButton');

        let remainingTime = 3600; // 1 hour in seconds

        function updateTimerDisplay() {
            const minutes = Math.floor(remainingTime / 60);
            const seconds = remainingTime % 60;

            timerDisplay.textContent = `Time remaining: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }

        function disableRegisterButton() {
            registerButton.disabled = true;
            timerDisplay.textContent = 'Time expired';
        }

        const countdownInterval = setInterval(() => {
            if (remainingTime <= 0) {
                disableRegisterButton();
                clearInterval(countdownInterval);

                // after 60 min disabled btn-custom class
                $('.btn-custom').addClass('disabled');
            } else {
                remainingTime--;
                updateTimerDisplay();
            }
        }, 1000);
    </script>

</body>

</html>
