@extends('web.ads.layouts.app2')

@section('meatdata')
    <meta name="keywords"
        content="Beginner to Billionaire,Network Marketing Success,Kamal Narayan Sahu,Exponential Growth Strategies,Guaranteed Success,Network Marketing Business Tips,Entrepreneurial Growth,Wealth Creation Techniques,Business Expansion Tactics,Network Marketing Mastery" />
    <meta name="description"
        content="Embark on a transformative journey from novice to billionaire within the realm of network marketing guided by Kamal Narayan Sahu. Learn proven strategies for exponential growth and assured success in the network marketing industry." />
    <meta name="author" content="" />

    <meta name="google-site-verification" content="JUFL02GuiTUG5SPtb7_7opD5z5TVjYeQL0hdKBda38o" />
    <meta name="msvalidate.01" content="4B0B39016B338C3058F48C0FCA42DF57" />
@endsection

@section('title')
    <title>BEGINNER TO BILLIONAIRE</title>
@endsection

@section('style')
    {{-- <link rel="stylesheet" href="{{ asset('assets/gaurd/css/custom.css') }}"> --}}
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

    {{-- <link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi:ital@1&display=swap" rel="stylesheet"> --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi:ital@0;1&family=Tiro+Devanagari+Sanskrit&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css"
        integrity="sha512-ioRJH7yXnyX+7fXTQEKPULWkMn3CqMcapK0NNtCN8q//sW7ZeVFcbMJ9RvX99TwDg6P8rAH2IqUSt2TLab4Xmw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        /* Styles for the horizontal line */
        .black-bg-section {
            position: relative;
        }

        .black-bg-section::before {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background-color: rgba(29, 28, 28, 0.212);
            /* Adjust the color and transparency as desired */
            position: absolute;
            top: 50%;
            z-index: 1;
            /* Adjust the z-index to control the shadow stacking */
            box-shadow: 0 2px 5px rgba(255, 255, 255, 0.4);
            /* Shadow effect */
        }

        .card-cs {
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
            background-color: #333232;
        }

        .coupon {
            background-image: url('{{ asset('assets/img/whos/copoun.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: white;
            /* height: 300px; */
            min-height: 200px;
            width: 100%;
            position: relative;
            /* Add a positioning context for the text */
            margin: 2px;
        }

        .coupon-content {
            position: absolute;
            /* Position the text absolutely */
            top: 50%;
            /* Position from the top */
            left: 50%;
            /* Position from the left */
            transform: translate(-50%, -50%);
            /* Center the text */
            /* color: #ffffff; */
            /* Set text color */
            text-align: center;
            /* Align text to the center */
        }


        .top {
            background-color: #3498db;
            /* Background color for the top section */
            border-radius: 8px;
            border-radius: 8px;
            box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.1);
            /* Add shadow to the top section */
        }

        .shadowed-image {
            box-shadow: 0px 4px 8px rgba(66, 65, 65, 0.1);
            /* Add shadow effect to the image */
            background-color: black;
            /* Set a black background for the div */
            border-radius: 8px;
            /* Add border-radius for rounded corners */
            padding: 10px;
            /* Add padding for the image */
        }

        .m-layout {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        /**========================== Added css =====================//**/


        .hindi {
            font-family: 'Tiro Devanagari Hindi', serif;
        }

        /* Custom video player styles */
        .custom-video {
            width: 100%;
            height: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style adjustments for the text content */
        .h-black {
            padding: 10px;
            background-color: #333;
            border-radius: 8px;
            color: white;
        }

        /******** first registration button **********/
        .save-my-seat-now-button {
            background-color: #fece00;
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(240, 243, 60, 0.2);
        }

        .save-my-seat-now-button {
            /* Add a linear gradient to the button background */
            background-image: linear-gradient(to right, #fece00 0%, #f2b200 100%);

            /* Add a border to the button */
            border: 1px solid #fece00;

            /* Add a text shadow to the button text */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);

            /* Add a transition to the button so that it changes color when the user hovers over it */
            transition: background-color 0.2s ease-in-out;
        }

        .save-my-seat-now-button:hover {
            /* Change the button background color when the user hovers over it */
            background-color: #f2b200;
        }

        /** shadow effect on #rp  text**/
        #rp {
            text-shadow: 1px 1px 2px rgba(54, 52, 52, 0.2);
        }

        /********** End first registration button ***********/

        .icon-lg {
            font-size: 24px;
            width: 20px;
            height: 20px;
        }

        .f-btn {
            background-color: #030303b7;
            border-radius: 15px;
        }

        .small-text {
            font-size: 14px;
        }

        .big-bold-text {
            font-size: 24px;
            font-weight: bold;
        }

        /* Default styles for larger screens */
        #m1 {
            font-size: 30px;
            /*24*/
            font-weight: bold;
        }

        #m11 {
            font-size: 20px;
            /*18*/
        }

        .twt {
            font-size: 20px;
        }

        #mprice {
            font-size: 30px;
            font-weight: bold;
        }

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .small-text {
                font-size: 12px;
            }

            .big-bold-text {
                font-size: 12px;
                font-weight: bold;
            }

            .icon-lg {
                font-size: 18px;
                width: 12px;
                height: 12px;
            }

            #m1 {
                font-size: 26px;
                font-weight: normal;
            }

            #m11 {
                font-size: 18px;
            }

            .reg_btn {
                width: 70%;
                margin-top: 3%;
                height: 50px;
                font-size: 12x;
            }

            .twt {
                font-size: 16px;
            }

            #mprice {
                font-size: 25px;
                font-weight: bold;
            }

            #cs1 {
                margin-top: -14px;
                margin-bottom: -2px;
            }

            .register-btn {
                height: 22%;
            }

            #end {
                padding-top: 40px;
                padding-bottom: 40%
            }
        }

        /* Media query for even smaller screens */
        @media (max-width: 576px) {
            .small-text {
                font-size: 12px;
            }

            .big-bold-text {
                font-size: 12px;
                font-weight: bold;
            }

            .icon-lg {
                font-size: 18px;
                width: 12px;
                height: 12px;
            }

            #m1 {
                font-size: 22px;
                font-weight: normal;
            }

            #m11 {
                font-size: 16px;
            }

            .reg_btn {
                width: 70%;
                margin-top: 3%;
                height: 50px;
                font-size: 12x;
            }

            .twt {
                font-size: 16px;
            }

            #mprice {
                font-size: 25px;
                font-weight: bold;
            }

            #cs1 {
                margin-top: -14px;
                margin-bottom: -2px;
            }

            .register-btn {
                height: 22%;
            }


            #end {
                padding-top: 40px;
                padding-bottom: 40%
            }
        }


        /* Styles for the fixed button */
        .register-btn {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #0c0b0b;
            color: white;
            padding: 15px 0;
            border: none;
            border-radius: 0;
            cursor: pointer;
            z-index: 999;
        }

        /* Styles for the registration button */
        .reg_btn {
            background-color: #f2b200;
            color: white;
            padding: 15px 30px;
            font-size: 20px;
            border: none;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(168, 168, 168, 0.336);
            transition: all 0.3s ease;
        }

        .reg_btn:hover {
            background-color: #e0a100;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.473);
        }

        #end {
            padding-top: 40px;
            padding-bottom: 30px;
        }

        .m-layout {
            padding-top: 40px;
            padding-bottom: 50px;
        }

        li {
            list-style: none;
        }

        .enst {
            font-family: 'Merriweather', serif;
        }

        #price-img {
            /* width: 100%;
                                            height: 100%; */

            max-width: 20%;
            max-height: 20%;
        }

        /* hide if small size screen  id repre  */
        @media (max-width: 768px) {
            #repre {
                display: none;
            }
        }

        /* CSS for styling b_price on a dark background */
        #b_price {
            color: #ffffff;
            /* Set text color to white or any contrasting color */
            background-color: #333333;
            /* Set a dark background color */
            padding: 4px 8px;
            /* Add padding for better visibility */
            border-radius: 4px;
            /* Optionally, add border-radius for rounded corners */
        }
    </style>
@endsection

@section('content')
    <!-- main section -->
    <section class="service_section">
        <div class="container" id="top1" style="padding: 20px 0px 70px;">
            <div class="text-center">
                <h2 class="text-white" style="font-family: 'Noto Sans Devanagari', sans-serif;">
                    {{-- How to Grow Exponentially and get Guaranteed success on <span class="text-warning font-weight-bold">Network Marketing Business</span> --}}

                    <span class="text-warning font-weight-bold">BEGINNER TO BILLIONAIRE</span>
                </h2>

            </div>
            <div class="heading_container heading_center">
                <h2 class="mt-3" id="m1">
                    How to Grow Exponentially and get Guaranteed success on Network Marketing Business
                </h2>

                <h3 id="m11" class="hindi">
                    Secret Foundations of A <span class="text-warning">Network Marketer</span>
                </h3>
            </div>
            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="video-container">
                        <iframe id="yframe"
                            src="https://www.youtube.com/embed/6Xr8UZiA7Zg?si=FgHjIjw61Q2FZKdV?rel=0?version=3&autoplay=0&controls=0&&showinfo=0&loop=1&modestbranding=0"
                            frameborder="0"
                            allow="accelerometer; autoplay; modestbranding; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6 m-auto">
                    <div class="row">
                        <div class="col-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f2-btn">
                                            <i class="fas fa-video icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Duration</span><br>
                                        <span class="big-bold-text">1 Hour</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Repeat the structure for the next columns -->
                        <div class="col-6">
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
                        <div class="col-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f2-btn">
                                            <i class="far fa-calendar-alt icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Date</span><br>
                                        <span class="big-bold-text">1 Jan 2024</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f2-btn">
                                            <i class="far fa-clock icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Time</span><br>
                                        <span class="big-bold-text">7PM to 8PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-center mt-3">
                            <button type="button" class="save-my-seat-now-button payment">
                                Book Now Your Free Seat
                            </button>

                            {{-- <p class="text-white mt-3" id="rp">
                                Register today to get a bonus of ₹30,000/-
                            </p> --}}

                            <p class="mt-3 text-white">Offer Ends in <span id="timer2"
                                    class="text-warning font-weight-bold"></span> Mins </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Have Delivered Training -->
    <section class="about_section">
        <div class="container">
            <div class="row">
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

                        <div class="row enst">
                            <div class="col-md-4 m-auto">
                                <ul class="text-center">
                                    <li class="font-weight-bold">
                                        <h5>Mumbai</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Delhi</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Bangalore</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Hyderabad</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Ahmedabad</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Chennai</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Kolkata</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Surat</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Pune</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Jaipur</h5>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-4 m-auto">
                                <ul class="text-center">
                                    <li class="font-weight-bold">
                                        <h5>Raipur</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Lucknow</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Kanpur</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Nagpur</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Indore</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Visakhapatnam</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Patna</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Vadodara</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Ghaziabad</h5>
                                    </li>
                                    <li class="font-weight-bold">
                                        <h5>Agra</h5>
                                    </li>
                                </ul>
                            </div>

                            {{-- <div class="col-md-8">
                                <div class="d-flex justify-content-center" style="margin-top:-40px;">
                                    <img src="{{ asset('assets/img/india2.png') }}" alt="ytm" class="img-fluid">
                                </div>
                            </div> --}}
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-10 m-auto">
                                <p class="hindi">
                                    <b>नेटवर्क मार्केटिंग</b> में सफल होने के लिए सबसे ज्यादा काम अपने ऊपर करना होता है,
                                    जबकि लोग दूसरों में कमियां निकाल रहे होते हैं, "यह सुनता नहीं है" "वह सुनता नहीं है" अरे
                                    वह सुनेगा, उसका खानदान भी सुनेगा, पहले अपने आप को <b>"सुनाने"</b> लायक तो बनाइए।

                                <ul class="mb-4">
                                    <li>
                                        👉 BEGINNER TO BILLIONAIRE कोर्स नेटवर्क मार्केटर्स के लिए ब्रह्मास्त्र है।
                                    </li>
                                    <li>
                                        👉 दुनिया के हर एक नेटवर्क मार्केटर्स को एक बार Beginner to billionaire कोर्स अवश्य
                                        करना चाहिए।
                                    </li>
                                    <li>
                                        👉 BEGINNER TO BILLIONAIRE कोर्स श्री कमल नारायण साहू सर के 16 साल के टीम वर्क और
                                        लीडरशिप के अनुभव का निचोड़ हैं जो कोच ने बतौर नेटवर्क मार्केटिंग बिजनेस में
                                        प्रैक्टिकल रहते हुवे सीखा हैं और लोगो को करोड़पति बनाया हैं वही सारी सफलता का
                                        महामंत्र हैं।
                                    </li>
                                    <li>
                                        👉 21ST CENTURY की सबसे बड़ी Free Lancing बिजनेस नेटवर्क मार्केटिंग में नई ऊंचाइयों
                                        तक पहुंचने के लिए अभी ज्वाइन करे।
                                    </li>
                                </ul>

                                <span class="hindi">
                                    To Make yourself Network Marketing PRO get Trained By The Master Trainer <b>Kamal
                                        Narayan Sahu</b>.
                                </span>
                                </p>

                                <p class="text-left">BEGINNER TO BILLIONAIRE Network marketing success blueprint</p>

                                by<b> Kamal Narayan Sahu</b> <br>
                                Passionate Networker, <br>
                                Founder of K narayan skill Academic

                                {{-- <div class="col-md-4 d-flex float-right">
                                    by Kamal Narayan Sahu <br>
                                    Passionate Networker,  <br>
                                    Founder of K narayan skill Academic
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->

    <!-- service section -->
    <section class="service_section m-layout">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    मुख्य ६ कारण जिससे आपको यह training में शामिल होना चाहिए
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">
                                <b>Expert Guidance</b>: Gain insights from seasoned professionals who have navigated the
                                challenges of Network Marketing successfully.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">
                                <b>Strategic Approach</b>: Acquire a systematic roadmap and strategies tailored to help you
                                grow exponentially in the Network Marketing industry.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">
                                <b>Proven Success Stories</b>: Access real-life success stories that demonstrate how
                                individuals, much like yourself, achieved remarkable success in Network Marketing, providing
                                you with inspiration and motivation.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">
                                <b>Effective Networking Techniques</b>: Discover the art of networking effectively. Learn
                                how to build and expand your network, nurture relationships, and leverage connections to
                                accelerate your business growth.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">
                                <b>Guaranteed Results</b>: This training promises a results-driven approach. Understand the
                                proven methodologies and techniques that guarantee success when applied diligently and
                                consistently.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">
                                <b>Ongoing Support and Resources</b>: Beyond the training, access ongoing support,
                                resources, and tools essential for your continuous growth and development in Network
                                Marketing. Stay updated with the latest trends and strategies.
                            </span>
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
                <div class="col-md-6 mt-1">
                    {{-- <h3><span>Contact Us</span></h3> --}}
                    <p>Explore our courses on <a
                            href="https://www.youtube.com/channel/UCzRxWktCEzHvHNRUAmcWJzA?embeds_referring_euri=http%3A%2F%2F127.0.0.1%3A8001%2F&source_ve_path=MzY5MjU&feature=emb_ch_name_ex"
                            target="_blank">YouTube <img src="{{ asset('assets/img/social/youtube.png') }}"
                                alt="kns" class="img-fluid" width="40px;" height="30px;"></a> and stay updated on
                        our latest offerings, success stories, and
                        expert insights.</p>
                    <p>
                        Join our community on <a href="https://www.facebook.com/profile.php?id=61551921226266"
                            target="_blank">Facebook <img src="{{ asset('assets/img/social/facebook.png') }}"
                                alt="kns" class="img-fluid" width="40px;" height="10px;"></a> Marketplace to
                        discover more about our courses, connect with
                        like-minded individuals, and access exclusive resources.
                    </p>
                </div>
                <div class="col-md-6 m-auto">
                    <div class="row">
                        <div class="col-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f2-btn">
                                            <i class="fas fa-video icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Duration</span><br>
                                        <span class="big-bold-text">1 Hour</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat the structure for the next columns -->
                        <div class="col-6">
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
                        <div class="col-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f2-btn">
                                            <i class="far fa-calendar-alt icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Date</span><br>
                                        <span class="big-bold-text">1 Jan 2024</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat the structure for the last columns -->
                        <div class="col-6">
                            <div class="h-black m-1">
                                <div class="d-flex align-items-center">
                                    <div class="text-left">
                                        <button class="btn btn-lg text-white f2-btn">
                                            <i class="far fa-clock icon-lg"></i>
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <span class="small-text">Time</span><br>
                                        <span class="big-bold-text">7PM to 8PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12 text-center mt-3">
                            <button type="button" class="save-my-seat-now-button payment">
                                Book Now Your Free Seat
                            </button>

                            {{-- <p class="text-white mt-3" id="rp">
                                Register today to get a bonus of ₹30,000/-
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

    <!-- feedback video section -->
    <section class="service_section m-layout">
        <div class="container">
            <div class="heading_container heading_center mb-3">
                <h2>
                    The story of the leaders in their own words
                </h2>

                {{-- <h2>
                    Training Event के बारे में लोग क्या कहते हैं?
                </h2> --}}
            </div>
            <div class="row">
                <div class="col-md-6 m-auto">
                    <div class="video-container mt-3">
                        <iframe id="yframe"
                            src="https://www.youtube.com/embed/se2_3oghGpA?si=IqaQt4BXKYpZzO8n?rel=0?version=3&autoplay=0&controls=0&&showinfo=0&loop=1"
                            frameborder="0"
                            allow="accelerometer; autoplay; modestbranding; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-md-6 m-auto">
                    <div class="video-container mt-3">
                        <iframe id="yframe"
                            src="https://www.youtube.com/embed/6Xr8UZiA7Zg?si=FgHjIjw61Q2FZKdV?rel=0?version=3&autoplay=0&controls=0&&showinfo=0&loop=1"
                            frameborder="0"
                            allow="accelerometer; autoplay; modestbranding; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-md-6 m-auto">
                    <div class="video-container mt-3">
                        <iframe id="yframe"
                            src="https://www.youtube.com/embed/6Xr8UZiA7Zg?si=FgHjIjw61Q2FZKdV?rel=0?version=3&autoplay=0&controls=0&&showinfo=0&loop=1"
                            frameborder="0"
                            allow="accelerometer; autoplay; modestbranding; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end feedback video section -->

    <section class="black-bg-section">
    </section>

    <!-- About section -->
    <section class="service_section m-layout">
        <div class="container text-whitw">
            <div class="heading_container heading_center">
                <h2>
                    About Trainer
                </h2>
            </div>

            <div class="row">
                <div class="col-lg-8 d-flex flex-column justify-content-center text-white text-center" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="section-title">
                        <h3><span>Who Is</span> Kamal Narayan Sahu</h3>
                    </div>
                    <ul class="text-left">
                        <li class="mt-2">1) His name is Kamal Narayan Sahu and he is famous as the youngest CMD of
                            network marketing industry.</li>
                        <li class="mt-2">2) He is 31 years young, and always ready to teach and educate people about the
                            top 3 skills of success.</li>
                        <li class="mt-2">3) They have been helping people look smarter, stay healthy and achieve
                            financial freedom for the last 8 years</li>
                        <li class="mt-2">4) His Achievements – He is the founder of YTM India (a direct selling company).
                            At the young age of 23, he achieved a turnover of Rs 100 crore in the financial year 2022-2023.
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 m-auto" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/img/sirji2.png') }}" alt="sirji" class="img-fluid shadowed-image"
                        id="sirimg">
                </div>

                <div class="row m-auto">
                    <div class="col-12 text-center">
                        <div class="text-center mt-5 text-white">
                            👇 Secure your spot at no cost👇
                        </div>
                        <button type="button" class="save-my-seat-now-button text-center mt-2 payment">
                            <span class="mx-5 text-center">Claim your seat
                                today!</span> <br>
                        </button>
                        <div class="d-flex justify-content-center mt-3 text-white">
                            <h4>Limited Seats, Filling Fast...</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="black-bg-section">
    </section>

    <!-- Why Register Now section -->
    <section class="service_section m-layout">
        <div class="container">
            <div class="heading_container heading_center mb-3">
                <h2>
                    Why Register Now?
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6 m-auto text-white">
                    <div class="card card-cs mt-3">
                        <div class="card-body">
                            <h3 class="card-title">Get ebook of sales and marketing techniques</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 m-auto text-white">
                    <div class="card card-cs mt-3">
                        <div class="card-body">
                            <h3 class="card-title">Unlock bonus of worth ₹30,000</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 m-auto text-white">
                    <div class="card card-cs mt-3">
                        <div class="card-body">
                            <h3 class="card-title">Gate chance to interact 121 with our mentors</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 m-auto text-white">
                    <div class="card card-cs mt-3">
                        <div class="card-body">
                            <h4 class="card-title">Get free pass offer personal communication skill development training
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->

    <!-- Bonus section -->
    <section class="service_section m-layout" style="">
        <div class="container">
            <div class="heading_container heading_center mb-3">
                <h2>
                    Get Access to <span id="b_price" class="hindi">₹30,000/</span>- Bonus
                </h2>
            </div>
            <div class="row">
                {{-- <div class="col-md-4 m-auto coupon">
                    <div class="coupon-content text-white">
                        <div class="mid text-danger">
                            <h4 style="color: rgba(0, 0, 139, 0.877);"><b>Sales E-book 15000</b></h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 m-auto ">
                    <div class="coupon"></div>
                    <div class="coupon-content text-white">
                        <div class="">
                            <h4 style="color: rgba(0, 0, 139, 0.877);"><b>Communication skill development free pass
                                    10,000</b></h4>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 m-auto coupon">
                    <div class="coupon-content text-white">
                        <div class="mid text-danger">
                            <h4 style="color: rgba(0, 0, 139, 0.877);"><b>One to one session with mentors 25000</b></h4>
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-4 p-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4>Get Free Access of Recorded <b>HD videos <i class="fa-solid fa-video text-primary"></b></i>
                                of Full training Beginner to Billionaire worth ₹<b>10,000</b>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 p-2">
                    <div class="card">
                        <div class="card-body text-center">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h4 style="mx-5">3
                                mistake of networker recorded session ₹<b>10,000</b></h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <div class="mt-2"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 p-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4>Get FULL Presentation <i class="fa-solid fa-file-pdf text-danger"></i> <b>PDF</b> of
                                Beginner To Billionaire workshop
                                absolutely free worth ₹<b>10,000</b>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 m-auto">
                    <div class="col-12 text-center mt-5">
                        <button type="button" class="save-my-seat-now-button payment">
                            Book Now Your Free Seat
                        </button>

                        <p class="text-white mt-3" id="rp">
                            Register today to get a bonus of ₹30,000/-
                        </p>

                        {{-- <p class="mt-3 text-white">Offer Ends in <span id="timer2"
                                class="text-warning font-weight-bold"></span> Mins </p> --}}

                        <p class="mt-4 text-white">एक ऐसे जीवन की कल्पना कीजिए जहां आप अपने दिन और समय के मालिक हैं। यह
                            कोर्स आपकी इस कल्पना को हकीकत में बदल देगा।</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->

    <!-- what will learn section -->
    <section class="service_section m-layout">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    What will you Learn?
                </h2>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">ग्राहकों को पहचानना है और उनसे जुड़ने के महत्‍वपूर्ण तरीके सीखे</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">strong relationship and supportive network बनाना सीखे.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">सोशल मीडिया और डिजिटल मार्केटिंग से नेटवर्क कैसे बनाएं सीखें.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">आप नेटवर्क मार्केटिंग की सफलता में trust and communication के महत्व को
                                सीखेंगे.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-auto">
                <div class="col-12 text-center">
                    <button type="button" class="save-my-seat-now-button text-center payment">
                        <span class="mx-5 text-center">Book Now Your Free Seat</span> <br>
                        <small class="mx-5 text-center">Registration is limited</small>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- end service section -->

    <section class="black-bg-section">
    </section>

    <!-- About section -->
    <section class="service_section m-layout">
        <div class="container text-whitw">
            <div class="heading_container heading_center">
                <h2>
                    About K Narayan Skill Academy
                </h2>
            </div>

            <div class="row">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/img/11.png') }}" alt="sirji" class="img-fluid">
                </div>

                <div class="col-lg-8 d-flex flex-column justify-content-center text-white text-center" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="section-title">
                        <h3><span>Welcome to</span> K Narayan Skill Academy!</h3>
                    </div>
                    <p>
                        At K Narayan Skill Academy, we are dedicated to empowering individuals through diverse skill
                        development programs tailored to meet the demands of today's dynamic world. Our mission is to equip
                        you with the knowledge and expertise needed to succeed in various domains.
                    </p>

                    <h5 class="mt-2">Why Choose K Narayan Skill Academy?</h5>

                    <ul class="text-left">
                        <li><b>Expert Guidance:</b> Benefit from the mentorship of experienced professionals and
                            industry leaders passionate about your success.</li>
                        <li><b>Hands-On Learning:</b> Engage in practical, real-world projects and exercises that
                            sharpen your skills and build your portfolio.</li>
                        <li><b>Flexible Learning:</b> Enjoy flexible schedules and a variety of learning formats,
                            including online courses and workshops, enabling you to learn at your own pace.</li>
                    </ul>

                </div>

                <div class="row m-auto">
                    <div class="col-12 text-center">
                        <div class="text-center mt-5 text-white">
                            👇 Secure your spot at no cost👇
                        </div>
                        <button type="button" class="save-my-seat-now-button text-center mt-2 payment">
                            <span class="mx-5 text-center">Claim your seat
                                today!</span> <br>
                        </button>
                        <div class="d-flex justify-content-center mt-3 text-white">
                            <h4>Limited Seats, Filling Fast...</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end service section -->
    <section class="black-bg-section">
    </section>

    <!-- Achivers section -->
    <section class="service_section m-layout text-white text-center">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Achievers
                </h2>
                <h3 class="hindi">People earned after learning from our<span class="text-warning">
                        Techniques</span></h3>
                <p class="hindi">Some of Our Multimillionaires Network Marketing leaders
                    Who transforms their Life & achived Big success in Network Marketing industry...</p>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/jitendra.jpeg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4 class="hindi m-2">Jitendra Dhever</h4>
                            Income - <span class="text-warning font-weight-bold">₹6 crore</span><br>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/WhatsApp Image 2023-09-09 at 11.56.10 AM.jpeg') }}"
                                class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4 class="hindi m-2">Mukesh Sharma</h4>
                            Income - <span class="text-warning font-weight-bold">₹2.5 crore</span><br>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/jst.jpeg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4 class="hindi m-2">Devbrat Mourya</h4>
                            Income - <span class="text-warning font-weight-bold">₹4.5 crore</span><br>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/munib.jpeg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4 class="hindi m-2">Munib Nishad</h4>
                            Income - <span class="text-warning font-weight-bold">₹2.5 crore</span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->

    <!-- Review section -->
    {{-- <section class="client_section layout_padding">
        <div class="container ">
            <div class="heading_container heading_center">
                <h2>
                    What Are People Saying About Training Event?
                </h2>
            </div>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="box">
                            <div class="img-box">
                                <img src="{{ asset('assets/img/team/dharmendra.jpeg') }}" class="img-fluid"
                                    alt="knsa">
                            </div>
                            <div class="detail-box">
                                <h4>
                                    Dharmendra Yadav
                                </h4>
                                <p>
                                    I recently had the opportunity to attend a training session at Skill Academy on network
                                    marketing and I must say, it was a game changer for me. The session was conducted by
                                    experienced and knowledgeable trainers who were able to break down the complex concepts
                                    of network marketing into simple and easy to understand terms.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="box">
                            <div class="img-box">
                                <img src="{{ asset('assets/img/team/WhatsApp Image 2023-09-09 at 11.55.46 AM (1).jpeg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="detail-box">
                                <h4>
                                    Manteshwar
                                </h4>
                                <p>
                                    The first thing that struck me about Skill Academy was their dedication to providing
                                    quality education and training. The trainers were not just there to sell their products
                                    or services, but genuinely wanted to help us improve our skills and succeed in the
                                    network marketing industry. They were patient, approachable, and always willing to
                                    answer any questions we had.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="box">
                            <div class="img-box">
                                <img src="{{ asset('assets/img/team/ramprasad.jpeg') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="detail-box">
                                <h4>
                                    Dayanand Prasad
                                </h4>
                                <p>
                                    The training itself was well-structured and covered all aspects of network marketing,
                                    from understanding the concept and benefits to practical tips on how to succeed. The
                                    trainers used real-life examples and case studies to illustrate their points, making it
                                    easier for us to relate and apply the knowledge in our own business.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="box">
                            <div class="img-box">
                                <img src="{{ asset('assets/img/team/WhatsApp Image 2023-09-09 at 11.54.57 AM.jpeg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="detail-box">
                                <h4>
                                    Panku Sharma
                                </h4>
                                <p>
                                    Apart from the training, Skill Academy also provided us with resources and tools to help
                                    us implement what we learned. They have a comprehensive online platform where we can
                                    access training materials, connect with other network marketers, and stay updated with
                                    the latest trends and strategies.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel_btn-box">
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}

    <section>
        <div class="heading_container heading_center mt-3">
            <h2>
                What Are People Saying About Training Event?
            </h2>
        </div>

        <div class="row text-center m-3">
            <div class="col-md-4 mb-5 mb-md-0">
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('assets/img/team/dharmendra.jpeg') }}" class="rounded-circle shadow-1-strong"
                        width="150" height="150" />
                </div>
                <h5 class="mb-3">Dharmendra Yadav</h5>
                {{-- <h6 class="text-primary mb-3">Web Developer</h6> --}}
                <p class="px-xl-3">
                    <i class="fas fa-quote-left pe-2"></i>I recently had the opportunity to attend a training session at
                    Skill Academy on network
                    marketing and I must say, it was a game changer for me. The session was conducted by
                    experienced and knowledgeable trainers who were able to break down the complex concepts
                    of network marketing into simple and easy to understand terms.
                </p>
                <ul class="list-unstyled d-flex justify-content-center mb-0">
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star-half-alt fa-sm text-warning"></i>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 mb-5 mb-md-0">
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('assets/img/team/WhatsApp Image 2023-09-09 at 11.55.46 AM (1).jpeg') }}"
                        class="rounded-circle shadow-1-strong" width="150" height="150" />
                </div>
                <h5 class="mb-3">Manteshwar</h5>
                {{-- <h6 class="text-primary mb-3">Graphic Designer</h6> --}}
                <p class="px-xl-3">
                    <i class="fas fa-quote-left pe-2"></i>The first thing that struck me about Skill Academy was their
                    dedication to providing
                    quality education and training. The trainers were not just there to sell their products
                    or services, but genuinely wanted to help us improve our skills and succeed in the
                    network marketing industry. They were patient, approachable, and always willing to
                    answer any questions we had.
                </p>
                <ul class="list-unstyled d-flex justify-content-center mb-0">
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 mb-5 mb-md-0">
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('assets/img/team/WhatsApp Image 2023-09-09 at 11.54.57 AM.jpeg') }}"
                        class="rounded-circle shadow-1-strong" width="150" height="150" />
                </div>
                <h5 class="mb-3">Panku Sharma</h5>
                {{-- <h6 class="text-primary mb-3">Graphic Designer</h6> --}}
                <p class="px-xl-3">
                    <i class="fas fa-quote-left pe-2"></i>The training itself was well-structured and covered all aspects
                    of network marketing,
                    from understanding the concept and benefits to practical tips on how to succeed. The
                    trainers used real-life examples and case studies to illustrate their points, making it
                    easier for us to relate and apply the knowledge in our own business.
                </p>
                <ul class="list-unstyled d-flex justify-content-center mb-0">
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                </ul>
            </div>
            {{-- <div class="col-md-4 mb-0">
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('assets/img/team/ramprasad.jpeg') }}"
                        class="rounded-circle shadow-1-strong" width="150" height="150" />
                </div>
                <h5 class="mb-3">Dayanand Prasad</h5>
                <p class="px-xl-3">
                    <i class="fas fa-quote-left pe-2"></i>The training itself was well-structured and covered all aspects of network marketing,
                    from understanding the concept and benefits to practical tips on how to succeed. The
                    trainers used real-life examples and case studies to illustrate their points, making it
                    easier for us to relate and apply the knowledge in our own business.
                </p>
                <ul class="list-unstyled d-flex justify-content-center mb-0">
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="fas fa-star fa-sm text-warning"></i>
                    </li>
                    <li>
                        <i class="far fa-star fa-sm text-warning"></i>
                    </li>
                </ul>
            </div> --}}
        </div>
    </section>
    <!-- end client section -->

    <!-- Who should attend this session section -->
    <section class="service_section m-layout">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Who should attend this session?
                </h2>
            </div>
            <div class="card s_bg p-2 mb-3">
                <div class="card-body text-white text-center">
                    <div class="row">
                        <div class="col-md-3" id="repre">
                            <img src="{{ asset('assets/img/ponting.png') }}" alt="kns" class="img-fluid">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4 mt-3 text-center s_bg">
                                    <img src="{{ asset('assets/img/whos/Sales professionals.jpg') }}" alt="Knsa"
                                        width="200px" height="250px">
                                </div>

                                <div class="col-md-4 mt-3 text-center s_bg">
                                    <img src="{{ asset('assets/img/whos/entrp.jpg') }}" alt="Knsa" width="200px"
                                        height="250px">
                                </div>

                                <div class="col-md-4 mt-3 text-center s_bg">
                                    <img src="{{ asset('assets/img/whos/leader.jpg') }}" alt="Knsa" width="200px"
                                        height="250px">
                                </div>

                                <div class="col-md-4 mt-3 text-center s_bg">
                                    <img src="{{ asset('assets/img/whos/smallb.jpg') }}" alt="Knsa" width="200px"
                                        height="250x">
                                </div>

                                <div class="col-md-4 mt-3 text-center s_bg">
                                    <img src="{{ asset('assets/img/whos/Network marketing professionals.jpg') }}"
                                        alt="Knsa" width="200px" height="250px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-auto">
                <div class="col-12 text-center">
                    <button type="button" class="save-my-seat-now-button text-center payment">
                        <span class="mx-5 text-center">Book Now Your Free Seat</span> <br>
                        <small class="mx-5 text-center">Registration is limited</small>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- end Who should attend this session? section -->

    <!-- Register Modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reg_model_t">
        Launch demo modal
    </button> --}}

    <div class="modal fade" id="reg_model_t" tabindex="-1" aria-labelledby="reg_model" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reg_model"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                                <input type="text" class="form-control" id="name" name="name" placeholder=""
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder=""
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="phone"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" minlength="10"
                                    name="phone" maxlength="10" placeholder="" required>
                            </div>
                            <button class="btn btn-primary float-right" type="button" id="submit">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- end Register Modal -->

    <!-- Register Now button -->
    <div class="register-btn" id="registerButton">
        <div class="row">
            <div class="col-md-6 text-center" id="gh">
                <div class="hindi" id="cs1">
                    <span class="" style="" id="mprice">
                        ₹199
                    </span>
                    {{-- <img src="{{ asset('assets/img/free3.png') }}" alt="knsa" class="img-fluid" id="price-img"> --}}
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
                <button type="button" class="reg_btn payment">
                    Register Now
                </button>
            </div>
        </div>
    </div>
    <!-- end Register -->
@endsection

@section('script')
    <script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>

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
        fbq('init', '365953992779410');
        fbq('track', 'PageView');
    </script>

    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=365953992779410&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    <script>
        // JavaScript to show/hide "Go to Top" button on scroll
        const goTopBtn = document.getElementById("registerButton");

        // window.addEventListener('scroll', function() {
        //     if (window.scrollY > 250) {
        //         // Show button when scrolling down more than 300px
        //         goTopBtn.style.display = "block";
        //     }
        //     else {
        //         // Hide button when at the top or not scrolled enough
        //         goTopBtn.style.display = "none";
        //     }
        // });

        window.addEventListener('scroll', function() {
            var windowHeight = window.innerHeight; // Height of the browser window
            var fullHeight = document.body.clientHeight; // Height of the entire page
            var scrollPosition = window.scrollY || window.pageYOffset || document.documentElement
                .scrollTop; // Current scroll position

            if (scrollPosition > 250 && (fullHeight - (scrollPosition + windowHeight)) > 250) {
                // Show the registration button when scrolled after the top 250px and before the bottom 250px
                goTopBtn.style.display = "block";
            } else {
                // Hide the registration button otherwise
                goTopBtn.style.display = "none";
            }
        });


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

    <script>
        $('.payment').click(function() {
            // window.location.href = "{{ route('audience.store') }}";
            // window.location.href = "https://rzp.io/l/o2gu6qrn";

            // open reg_model_t modal
            $('#reg_model_t').modal('show');

        });
    </script>

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
                        event_name: 'beginner_to_billionaire',
                    },
                    success: function(response) {
                        $('#registration')[0].reset();
                        $('#submit').attr('disabled', false);
                        $('#submit').html('Submit');
                        $('#success').show();
                        $('#success').html(response.message);
                        if (response.message) {
                            // $('#confirm_msg').modal('show');

                            let whatsapp_route = '{{ route('whatsapp') }}'

                            // go to whatsapp page
                            // window.location.href = whatsapp_route + "?name=" + name + "&email=" + email + "&phone=" + phone + "&event_name=beginner_to_billionaire";
                            window.location.href = whatsapp_route;

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
@endsection
