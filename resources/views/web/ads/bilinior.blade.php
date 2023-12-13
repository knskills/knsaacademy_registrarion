@extends('web.ads.layouts.app2')

@section('title')
    <title>From Beginner to Billionaire: Kamal Narayan Sahu's Network Marketing Journey</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/gaurd/css/custom.css') }}">
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- <link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi:ital@1&display=swap" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi:ital@0;1&family=Tiro+Devanagari+Sanskrit&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css"
        integrity="sha512-ioRJH7yXnyX+7fXTQEKPULWkMn3CqMcapK0NNtCN8q//sW7ZeVFcbMJ9RvX99TwDg6P8rAH2IqUSt2TLab4Xmw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@200;300;400;600&family=Noto+Serif+Devanagari:wght@100;400;700;900&display=swap"
        rel="stylesheet">

    <style>
        .yellow {
            color: #ffd700;
        }

        .s_bg {
            background-color: #333;
        }

        .larger-icon {
            font-size: 24px;
            /* Adjust the font-size as needed */
        }

        .f18 {
            font-size: 18px;
        }
    </style>

    <style>
        /* Responsive video container */
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* Aspect ratio 16:9 (9/16 = 0.5625) */
            overflow: hidden;
            border-radius: 20px;
            /* Rounded border */
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 20px;
            /* Match the container's border-radius */
            transition: transform 0.5s ease;
            /* Add a transition effect */
        }

        .video-container:hover iframe {
            transform: scale(1.05);
            /* Scale up the iframe on hover */
        }
    </style>
@endsection

{{-- @section('hero_area')
    <div class="hero_area">
        <!-- header section strats -->
        <div class="hero_bg_box">
            <div class="img-box">
                <img src="images/hero-bg.jpg" alt="">
            </div>
        </div>

        <header class="header_section">
            <div class="header_top">
                <div class="container-fluid">
                    <div class="contact_link-container">
                        <a href="" class="contact_link1">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                                Lorem ipsum dolor sit amet,
                            </span>
                        </a>
                        <a href="" class="contact_link2">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>
                                Call : +01 1234567890
                            </span>
                        </a>
                        <a href="" class="contact_link3">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                                demo@gmail.com
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container">
                        <a class="navbar-brand" href="index.html">
                            <span>
                                Guarder
                            </span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""></span>
                        </button>

                        <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                            <ul class="navbar-nav  ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html"> About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="service.html"> Services </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="guard.html"> Guards </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact us</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class=" slider_section ">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="detail-box">
                                        <h1>
                                            Your Saftey <br>
                                            <span>
                                                Our Responsibility
                                            </span>
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod magna aliqua. Ut enim ad minim veniam
                                        </p>
                                        <div class="btn-box">
                                            <a href="" class="btn-1"> Read more </a>
                                            <a href="" class="btn-2">Get A Quote</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="detail-box">
                                        <h1>
                                            Your Saftey <br>
                                            <span>
                                                Our Responsibility
                                            </span>
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod magna aliqua. Ut enim ad minim veniam
                                        </p>
                                        <div class="btn-box">
                                            <a href="" class="btn-1"> Read more </a>
                                            <a href="" class="btn-2">Get A Quote</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="detail-box">
                                        <h1>
                                            Your Saftey <br>
                                            <span>
                                                Our Responsibility
                                            </span>
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod magna aliqua. Ut enim ad minim veniam
                                        </p>
                                        <div class="btn-box">
                                            <a href="" class="btn-1"> Read more </a>
                                            <a href="" class="btn-2">Get A Quote</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container idicator_container">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>
@endsection --}}

@section('content')
    <!-- service section -->
    <section class="service_section">
        <div class="container" id="top1" style="padding: 20px 0px 70px;">
            <div class="text-center">
                {{-- <img src="{{ asset('assets/img/test.png') }}" alt="kns" class="img-fluid mt-4" height="150px"
                    width="200px"> --}}

                {{-- <h2 class="text-white" style="font-family: 'Noto Sans Devanagari', sans-serif; text-align: center; padding: 20px 0; background-color: #333;">
                        Earn <span style="color: #ffd700;">1 crore</span> in 1 year
                    </h2> --}}

                <h2 class="text-white" style="font-family: 'Noto Sans Devanagari', sans-serif;">
                    Earn <span style="color: #ffd700;">1 crore</span> in 1 year
                </h2>

            </div>
            <div class="heading_container heading_center hindi">
                <h2 class="mt-3" id="m1">
                    नौसिखिया से उल्लेखनीय तक: 21 दिनों में बिना विज्ञापन खर्च के लीड जनरेशन और आसमान छूती बिक्री में महारत
                    हासिल करना
                </h2>

                <h3 id="m11">
                    21 दिवसीय चुनौती <span class="text-warning">कमल नारायण साहू </span>द्वारा
                </h3>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="video-container">
                        <iframe id="yframe"
                            src="https://www.youtube.com/embed/6Xr8UZiA7Zg?si=FgHjIjw61Q2FZKdV?rel=0?version=3&autoplay=1&controls=0&&showinfo=0&loop=1"
                            frameborder="0"
                            allow="accelerometer; autoplay; modestbranding; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6 m-auto">
                    <div class="row" id="first_sr">
                        <div class="col-md-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f-btn">
                                            <i class="fas fa-video icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Duration</span><br>
                                        <span class="big-bold-text">7 Hours</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat the structure for the next columns -->
                        <div class="col-md-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f-btn">
                                            <i class="fas fa-language icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Language</span><br>
                                        <span class="big-bold-text">Hindi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat the structure for the subsequent columns -->
                        <div class="col-md-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f-btn">
                                            <i class="far fa-calendar-alt icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Date</span><br>
                                        <span class="big-bold-text">17 Dec 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat the structure for the last columns -->
                        <div class="col-md-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f-btn">
                                            <i class="far fa-clock icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Time</span><br>
                                        <span class="big-bold-text">9AM to 4PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-2">
                        <div class="col-12 text-center mt-3">
                            <button type="button" class="save-my-seat-now-button">
                                SAVE MY SEAT NOW FOR ₹199
                            </button>

                            {{-- <p class="text-white mt-3" id="rp">
                                Register today to get a bonus of ₹14,995/-
                            </p> --}}

                            <p class="mt-3 text-white">Offer Ends in <span id="timer2"
                                    class="text-warning font-weight-bold"></span> Mins </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="about_section">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-6 px-0">
                    <div class="img_container">
                        <div class="img-box">
                            <img src="images/about-img.jpg" alt="" />
                        </div>
                    </div>
                </div> --}}

                <div class="col-12 px-0">
                    <div class="detail-box">
                        <div class="row">
                            <div class="col-md-8 text-center m-auto">
                                <div class="heading_container">
                                    <h2 class=""
                                        style="font-family: 'Noto Sans Devanagari', sans-serif; text-align: center; padding: 20px 0; color: #333; background-color: #fff;">
                                        Have Delivered Training in all over <span style="color: #ff4500;">India</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center" style="margin-top:-40px;">
                            <img src="{{ asset('assets/img/india2.png') }}" alt="ytm" class="img-fluid">
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                            enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                            in reprehenderit in voluptate velit
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->

    <!-- service section -->
    <section class="service_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Top 6 reasons why you should join this training?
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">This is some text within a card body.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">This is some text within a card body.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">This is some text within a card body.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">This is some text within a card body.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">This is some text within a card body.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">This is some text within a card body.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end service section -->

    <!-- client section -->
    <section class="client_section mt-5">
        <div class="container ">
            <div class="heading_container heading_center">
                <h2>
                    INDIA'S NO.1 TRANING PROGRAM
                </h2>
            </div>

            <div class="row mt-4">
                <div class="col-md-6 mt-5">
                    {{-- <h3><span>Contact Us</span></h3> --}}
                    <p>Explore our courses on <a
                            href="https://www.youtube.com/channel/UCzRxWktCEzHvHNRUAmcWJzA?embeds_referring_euri=http%3A%2F%2F127.0.0.1%3A8001%2F&source_ve_path=MzY5MjU&feature=emb_ch_name_ex"
                            target="_blank">YouTube</a> and stay updated on our latest offerings, success stories, and
                        expert insights.</p>
                    <p>
                        Join our community on <a href="https://www.facebook.com/profile.php?id=61551921226266"
                            target="_blank">Facebook</a> Marketplace to discover more about our courses, connect with
                        like-minded individuals, and access exclusive resources.
                    </p>
                </div>
                <div class="col-md-6 m-auto">
                    <div class="row" id="first_sr">
                        <div class="col-md-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f2-btn">
                                            <i class="fas fa-video icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Duration</span><br>
                                        <span class="big-bold-text">7 Hours</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat the structure for the next columns -->
                        <div class="col-md-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f2-btn">
                                            <i class="fas fa-language icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Language</span><br>
                                        <span class="big-bold-text">Hindi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat the structure for the subsequent columns -->
                        <div class="col-md-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f2-btn">
                                            <i class="far fa-calendar-alt icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Date</span><br>
                                        <span class="big-bold-text">17 Dec 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat the structure for the last columns -->
                        <div class="col-md-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f2-btn">
                                            <i class="far fa-clock icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Time</span><br>
                                        <span class="big-bold-text">9AM to 4PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-2">
                        <div class="col-12 text-center mt-3">
                            <button type="button" class="save-my-seat-now-button">
                                SAVE MY SEAT NOW FOR ₹199
                            </button>

                            {{-- <p class="text-white mt-3" id="rp">
                                Register today to get a bonus of ₹14,995/-
                            </p> --}}

                            <p class="mt-3 text-white">Offer Ends in <span id="timer2"
                                    class="text-warning font-weight-bold"></span> Mins </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- <div class="row">
                <div class="col-md-8 m-auto">
                    <img src="{{ asset('assets/img/kns2.jpg') }}" alt="knsa" class="img-fluid">
                </div>
            </div> --}}
        </div>
    </section>
    <!-- end client section -->

    <!-- contact section -->
    <section class="service_section" style="padding-top: 40px;
    padding-bottom: 50px;">
        <div class="container">
            <div class="heading_container heading_center mb-3">
                <h2>
                    What People Say About Training Event?
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6 m-auto">
                    <div class="video-container">
                        <iframe id="yframe"
                            src="https://www.youtube.com/embed/6Xr8UZiA7Zg?si=FgHjIjw61Q2FZKdV?rel=0?version=3&autoplay=1&controls=0&&showinfo=0&loop=1"
                            frameborder="0"
                            allow="accelerometer; autoplay; modestbranding; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>


                <div class="col-md-6 m-auto">
                    <div class="video-container">
                        <iframe id="yframe"
                            src="https://www.youtube.com/embed/6Xr8UZiA7Zg?si=FgHjIjw61Q2FZKdV?rel=0?version=3&autoplay=1&controls=0&&showinfo=0&loop=1"
                            frameborder="0"
                            allow="accelerometer; autoplay; modestbranding; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-md-6 m-auto">
                    <div class="video-container mt-3">
                        <iframe id="yframe"
                            src="https://www.youtube.com/embed/6Xr8UZiA7Zg?si=FgHjIjw61Q2FZKdV?rel=0?version=3&autoplay=1&controls=0&&showinfo=0&loop=1"
                            frameborder="0"
                            allow="accelerometer; autoplay; modestbranding; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->

    <!-- team section -->
    <section class="team_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Guards
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, non odio tincidunt ut ante, lorem a euismod suspendisse vel, sed quam nulla
                    mauris
                    iaculis. Erat eget vitae malesuada, tortor tincidunt porta lorem lectus.
                </p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 mx-auto ">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/t1.jpg" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Martin Anderson
                            </h5>
                            <h6 class="">
                                supervisor
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mx-auto ">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/t2.jpg" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Denny Butler
                            </h5>
                            <h6 class="">
                                supervisor
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mx-auto ">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/t3.jpg" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Nathan Mcpherson
                            </h5>
                            <h6 class="">
                                supervisor
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <a href="">
                    View All
                </a>
            </div>
        </div>
    </section>
    <!-- end team section -->

    <!-- Register Now button -->
    <div class="register-btn" id="registerButton">
        <div class="row">
            <div class="col-md-6 text-center" id="gh">
                <div class="hindi" id="cs1">
                    <span class="" style="" id="mprice">
                        ₹199
                    </span>
                    <sub>
                        <span class="twt" style="">
                            <del>₹1999</del>
                        </span>
                    </sub>
                </div>

                <div class="twt" style="">
                    Offer Ends in <span id="timer" class="text-warning font-weight-bold"></span> Mins
                </div>
            </div>
            <div class="col-md-6 text-center">
                <button type="button" class="reg_btn">
                    Register Now
                </button>
            </div>
        </div>
    </div>


    <!-- end info_section -->
@endsection

@section('script')
    <script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>
    <script>
        // JavaScript to show/hide "Go to Top" button on scroll
        const goTopBtn = document.getElementById("registerButton");

        window.addEventListener('scroll', function() {
            if (window.scrollY > 250) {
                // Show button when scrolling down more than 300px
                goTopBtn.style.display = "block";
            } else {
                // Hide button when at the top or not scrolled enough
                goTopBtn.style.display = "none";
            }
        });
    </script>

    <script>
        // Get the timer element
        const timerElement = document.getElementById('timer');
        const timerElement2 = document.getElementById('timer2');

        // Set the end time of the offer (in milliseconds)
        const endTime = Date.now() + 60 * 60 * 1000; // One hour from now

        // Update the timer every second
        const timerInterval = setInterval(updateTimer, 1000);

        // Function to update the timer
        function updateTimer() {
            // Get the current time
            const currentTime = Date.now();

            // Calculate the remaining time
            const remainingTime = endTime - currentTime;

            // Check if the offer has ended
            if (remainingTime <= 0) {
                clearInterval(timerInterval);
                timerElement.textContent = 'Offer Ended';
                timerElement2.textContent = 'Offer Ended';
                return;
            }

            // Calculate minutes and seconds
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

            // Display the remaining time
            timerElement.textContent = `${formatTime(minutes)}:${formatTime(seconds)}`;
            timerElement2.textContent = `${formatTime(minutes)}:${formatTime(seconds)}`;
        }

        // Function to format time (add leading zero if less than 10)
        function formatTime(time) {
            return time < 10 ? `0${time}` : time;
        }

        // Initial call to start the timer
        updateTimer();
    </script>
@endsection
