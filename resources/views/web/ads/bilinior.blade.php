@extends('web.ads.layouts.app2')

@section('title')
    <title>From Beginner to Billionaire: Kamal Narayan Sahu's Network Marketing Journey</title>
@endsection

@section('style')
    {{-- <link rel="stylesheet" href="{{ asset('assets/gaurd/css/custom.css') }}"> --}}
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

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
            background-image: url('{{ asset('assets/gaurd/images/coupon.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            /* height: 300px; */
            min-height: 200px;
            width: 100%;
            position: relative;
            /* Add a positioning context for the text */
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
    </style>

    <style>
        li {
            list-style: none;
        }
    </style>
@endsection

@section('content')
    <!-- service section -->
    <section class="service_section">
        <div class="container" id="top1" style="padding: 20px 0px 70px;">
            <div class="text-center">
                <h2 class="text-white" style="font-family: 'Noto Sans Devanagari', sans-serif;">
                    How to earn <span class="text-warning font-weight-bold">1 crore</span> in 1 year
                </h2>

            </div>
            <div class="heading_container heading_center">
                <h2 class="mt-3" id="m1">
                    Income sales technique that will make you money making machine
                </h2>

                <h3 id="m11" class="hindi">
                    हमारी <span class="text-warning">sales techniques </span> के माध्यम से किसी भी product और service की
                    sale करें
                </h3>

                {{-- <h3 id="m11" class="hindi">
                    21 दिवसीय चुनौती <span class="text-warning">कमल नारायण साहू </span>द्वारा
                </h3> --}}
            </div>
            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="video-container">
                        <iframe id="yframe"
                            src="https://www.youtube.com/embed/X13jh94WpQw?si=hZPyRgUYN9jDs8sq?rel=0?version=3&autoplay=1&controls=0&&showinfo=0&loop=1&modestbranding=0"
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
                                        <span class="big-bold-text">7 Hours</span>
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
                                        <span class="big-bold-text">17 Dec 2023</span>
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

            {{-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="box">
                            <div class="img-box">
                                <img src="images/client.png" alt="">
                            </div>
                            <div class="detail-box">
                                <h4>
                                    Minim Veniam
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                    do eiusmod tempor incididunt ut labore et dolore magna
                                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="box">
                            <div class="img-box">
                                <img src="images/client.png" alt="">
                            </div>
                            <div class="detail-box">
                                <h4>
                                    Minim Veniam
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                    do eiusmod tempor incididunt ut labore et dolore magna
                                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="box">
                            <div class="img-box">
                                <img src="images/client.png" alt="">
                            </div>
                            <div class="detail-box">
                                <h4>
                                    Minim Veniam
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                    do eiusmod tempor incididunt ut labore et dolore magna
                                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip
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
            </div> --}}

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

                        <div class="row">
                            <div class="col-md-2">
                                <ul class="">
                                    <li class="font-weight-bold"> Mumbai </li>
                                    <li class="font-weight-bold"> Delhi </li>
                                    <li class="font-weight-bold"> Bangalore </li>
                                    <li class="font-weight-bold"> Hyderabad </li>
                                    <li class="font-weight-bold"> Ahmedabad </li>
                                    <li class="font-weight-bold"> Chennai </li>
                                    <li class="font-weight-bold"> Kolkata </li>
                                    <li class="font-weight-bold"> Surat</li>
                                    <li class="font-weight-bold"> Pune</li>
                                    <li class="font-weight-bold"> Jaipur</li>
                                </ul>
                            </div>

                            <div class="col-md-2">
                                <ul>
                                    <li class="font-weight-bold">Raipur</li>
                                    <li class="font-weight-bold">Lucknow</li>
                                    <li class="font-weight-bold">Kanpur</li>
                                    <li class="font-weight-bold">Nagpur</li>
                                    <li class="font-weight-bold">Indore</li>
                                    <li class="font-weight-bold">Visakhapatnam</li>
                                    <li class="font-weight-bold">Patna</li>
                                    <li class="font-weight-bold">Vadodara</li>
                                    <li class="font-weight-bold">Ghaziabad</li>
                                    <li class="font-weight-bold">Agra</li>
                                </ul>
                            </div>

                            <div class="col-md-8">
                                <div class="d-flex justify-content-center" style="margin-top:-40px;">
                                    <img src="{{ asset('assets/img/india2.png') }}" alt="ytm" class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <p class="hindi">
                            अपनी संपूर्ण यात्रा के दौरान, हमें भारत के विभिन्न क्षेत्रों में व्यापक प्रशिक्षण सत्र देने का
                            सौभाग्य मिला है। ये सत्र विशेष रूप से व्यक्तियों को उनकी प्रतिभा और क्षमताओं को भुनाने के लिए
                            आवश्यक कौशल और ज्ञान के साथ सशक्त बनाने के लिए तैयार किए गए हैं, जो अंततः उन्हें स्वतंत्र रूप से
                            आजीविका कमाने में सक्षम बनाते हैं। विभिन्न शहरों और कस्बों में कार्यशालाओं और सेमिनारों का आयोजन
                            करते हुए, हमनें प्रत्यक्ष रूप से देखा है कि कौशल विकास का व्यक्तियों के जीवन पर परिवर्तनकारी
                            प्रभाव पड़ सकता है। हमारा प्रशिक्षण मॉड्यूल आज के प्रतिस्पर्धी परिदृश्य में सफलता के लिए आवश्यक
                            व्यावहारिक, लागू कौशल पर ध्यान केंद्रित करते हैं। तकनीकी विशेषज्ञता में महारत हासिल करने से लेकर
                            उद्यमशीलता कौशल को निखारने तक, हमारा उद्देश्य देश भर के उम्मीदवारों को सशक्त बनाना है, उनकी
                            अर्जित प्रतिभा के माध्यम से स्थायी आय उत्पन्न करने की उनकी क्षमता को उजागर करना है।
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
                    मुख्य ६ कारण जिससे आपको यह training में शामिल होना चाहिए
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">Improve your sales technique.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">No prayer knowledge of sales.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">Sales is Art science and skill , learn sales art sale science and sales skill.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">Generate high quality sales and grow your business all over the world.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">Earn 1 crore in one year through our sales.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">Learn the technique of sales in very less price.</span>
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
                                        <span class="big-bold-text">7 Hours</span>
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
                                        <span class="big-bold-text">17 Dec 2023</span>
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
    <section class="service_section m-layout">
        <div class="container">
            <div class="heading_container heading_center mb-3">
                {{-- <h2>
                    What People Say About Training Event?
                </h2> --}}

                <h2>
                    Training Event के बारे में लोग क्या कहते हैं?
                </h2>
            </div>
            <div class="row">
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
    <!-- end contact section -->

    <section class="black-bg-section">
    </section>

    <!-- contact section -->
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
                            <h3 class="card-title">Unlock bonus of worth rs 50000</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 m-auto text-white">
                    <div class="card card-cs mt-3">
                        <div class="card-body">
                            <h3 class="card-title">Get ebook of sales techniques</h3>
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
                            <h4 class="card-title">Get free pass offer personal communication skill development training</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 m-auto text-white">
                    <div class="card card-cs mt-3">
                        <div class="card-body">
                            <h3 class="card-title">Unlock bonus of worth rs 50000</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->

    <!-- contact section -->
    <section class="service_section m-layout" style="">
        <div class="container">
            <div class="heading_container heading_center mb-3">
                <h2>
                    Get Access to ₹50,000/- Bonus
                </h2>
            </div>
            <div class="row">
                <div class="col-md-4 m-auto coupon">
                    <div class="coupon-content text-white">
                        {{-- <div class="top" style="width: 90%;">
                            <h3>Top</h3>
                        </div> --}}
                        <div class="mid text-danger">
                            <h4 style="color: rgba(0, 0, 139, 0.877);"><b>Sales e book 15000</b></h4>
                        </div>
                        {{-- <div class="foot">
                            <h2>200</h2>
                        </div> --}}
                    </div>
                </div>

                <div class="col-md-4 m-auto coupon">
                    <div class="coupon-content text-white">
                        <div class="">
                            <h4 style="color: rgba(0, 0, 139, 0.877);"><b>Communication skill development free pass 10000</b></h4>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 m-auto coupon">
                    <div class="coupon-content text-white">
                        <div class="mid text-danger">
                            <h4 style="color: rgba(0, 0, 139, 0.877);"><b>One to one session with mentors 25000</b></h4>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 m-auto">
                    <div class="col-12 text-center mt-5">
                        <button type="button" class="save-my-seat-now-button">
                            SAVE MY SEAT NOW FOR ₹199
                        </button>

                        <p class="text-white mt-3" id="rp">
                            Register today to get a bonus of ₹14,995/-
                        </p>

                        {{-- <p class="mt-3 text-white">Offer Ends in <span id="timer2"
                                class="text-warning font-weight-bold"></span> Mins </p> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->

    <!-- service section -->
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
                            <span class="f18">Technique technique to grow your business 10x.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">Learn advanced skill of Sales.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">Guarantee to become crorepati if you follow our techniques.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card s_bg">
                        <div class="card-body text-white">
                            <i aria-hidden="true" class="fas fa-check-circle text-success larger-icon"></i>
                            <span class="f18">Learn how to sell any product and services.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-auto">
                <div class="col-12 text-center">
                    <button type="button" class="save-my-seat-now-button text-center">
                        <span class="mx-5 text-center"> SAVE MY SEAT NOW FOR ₹199</span> <br>
                        <small class="mx-5 text-center">Registration is limited</small>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- end service section -->

    <section class="black-bg-section">
    </section>

    <!-- service section -->
    <section class="service_section m-layout">
        <div class="container text-whitw">
            <div class="heading_container heading_center">
                <h2>
                    About KNSA Founder
                </h2>
            </div>

            <div class="row">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/img/sirji2.png') }}" alt="sirji" class="img-fluid shadowed-image"
                        id="sirimg">
                </div>

                <div class="col-lg-8 d-flex flex-column justify-content-center text-white text-center" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="section-title">
                        <h3><span>Founder of</span> K Narayan Skill Academy</h3>
                    </div>
                    <p>
                        Kamal Narayan Sahu, an Entrepreneur, Motivational speaker, Leadership &
                        Direct Selling Coach. He is only matriculate and a school dropper student, and at the early
                        age of 16, Came to the world’s biggest industry “Sales” Now he has 16 years of sales and
                        leadership experience. He works to inspire the youth of India and helping people to realize
                        their true potential. Kamal Narayan Sahu is C.E.O And Managing Director on one of the
                        Leading Network Marketing/Direct selling Company- (YTM) YASHIKA TRADING & MARKETING PVT.
                        LTD.
                    </p>

                </div>

                <div class="row m-auto">
                    <div class="col-12 text-center">
                        <div class="text-center mt-5 text-white">
                            👇 Secure Your Spot Now! Enroll Today 👇
                        </div>
                        <button type="button" class="save-my-seat-now-button text-center mt-2">
                            <span class="mx-5 text-center"> BOOK MY SEAT NOW FOR ₹199</span> <br>
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

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/dharmendra.jpeg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4 class="hindi m-2">Dharmendra Yadav</h4>
                            Income - <span class="text-warning font-weight-bold">₹1.5 crore</span><br>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/WhatsApp Image 2023-09-09 at 11.55.46 AM (1).jpeg') }}"
                                class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4 class="hindi m-2">Manteshwar</h4>
                            Income - <span class="text-warning font-weight-bold">₹81 lac</span><br>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/ramprasad.jpeg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4 class="hindi m-2">Dayanand Prasad</h4>
                            Income - <span class="text-warning font-weight-bold">₹49 lac</span><br>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/WhatsApp Image 2023-09-09 at 11.54.57 AM.jpeg') }}"
                                class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4 class="hindi m-2">Panku Sharma </h4>
                            Income - <span class="text-warning font-weight-bold">₹37 lac</span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->


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
@endsection
