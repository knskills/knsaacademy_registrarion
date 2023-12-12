@extends('web.ads.layouts.app')

@section('title')
    <title>From Beginner to Billionaire: Kamal Narayan Sahu's Network Marketing Journey</title>
@endsection

@section('script')
    <style>
        /* hide id head for big screen */
        #head {
            display: none;
        }

        @media (max-width: 768px) {
            #head {
                display: block;
            }

            .hrt{
                margin-top: -7%;
            }

            #timers{
                margin-top: -5%;
            }
        }
    </style>
@endsection

@section('hero')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100" id="main_t">
            <div class="row">
                <div class="col-12 text-center mb-3" id="head">
                    <h2 class="text-black" style="height: 10%">
                        {{-- From Novice to Nine Figures: The Journey to Billionaire Status --}}
                        Mastering the art and science of wealth creation
                    </h2>
                </div>

                <div class="col-md-6 justify-content-center hrt">
                    <h1>Supercharge Yourself By Network <span>Marketing Foundation</span> Skills</h1>
                    <span>
                        {{-- Master the foundational skills of network marketing and unlock advanced strategies proven to
                        generate high-quality leads and propel your product or service sales to 7x levels, paving the way to
                        becoming a billionaire. --}}

                        {{-- Discover network marketing's core skills and proven advanced strategies to skyrocket sales by 7x, paving your path to billionaire status. --}}

                        {{-- BEGINNER TO BILLIONAIRE कोर्स नेटवर्क मार्केटर्स के लिए ब्रह्मास्त्र है। --}}

                        एक ऐसे जीवन की कल्पना कीजिए जहां आप अपने दिन और समय के मालिक हैं। यह कोर्स आपकी इस कल्पना को हकीकत में बदल देगा।
                    </span>

                    <div class="text-center m-auto mt-4">
                        <a href="#skills" class="btn-custom mb-3" {{ $disabled }}>
                            <span>Book Now Your Seat <b>₹199</b> </span>
                        </a>
                    </div><br>


                    <div class="d-flex justify-content-center" id="timers">
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

                <div class="col-md-6 hrt">
                    {{-- <div class="tutorial container text-center my-2 ratio ratio-16x9" tyle="width: 100%;height: 100%;">
                        <iframe src="https://www.youtube.com/embed/6Xr8UZiA7Zg?si=Ebfveh93ApYa6aPz"
                            title="YouTube video player" frameborder="1" style="border: 5px solid #000;"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div> --}}

                    <div class="tutorial container text-center my-2 ratio ratio-16x9" style="width: 80%;height: 100%;">
                        <iframe src="https://www.youtube.com/embed/6Xr8UZiA7Zg?si=Ebfveh93ApYa6aPz" title="Art of sales"
                            frameborder="0"
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
    </section><!-- End Hero -->
@endsection

@section('content')
    {{-- <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>About</h2>
                <h3>Find Out More About <span>Network Marketing</span></h3>
            </div>

            <div class="row">
                <div class="col-lg-6 text-center" data-aos="fade-right" data-aos-delay="100">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/KbedXSOMAt8?si=1-FrgeB5IDnEoLiA" title="Kns academy"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                    <h4 class="text-primary">16+ Years Experience</h4>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up"
                    data-aos-delay="100">
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
    </section><!-- End About Section --> --}}

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>About</h2>
                @if (app()->getLocale() === 'hi')
                    <h3>{{ __('lang.n_m') }} <span>{{ __('lang.about_1') }}</span></h3>
                @else
                    <h3>{{ __('lang.about_1') }} <span>{{ __('lang.n_m') }}</span></h3>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-6 text-center" data-aos="fade-right" data-aos-delay="100">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/KbedXSOMAt8?si=1-FrgeB5IDnEoLiA"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                    <h4 class="text-primary">{{ __('lang.experince') }}</h4>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center"
                    data-aos="fade-up" data-aos-delay="100">
                    <h3>{{ __('lang.about_header') }} </h3>

                    <p class="fst-italic">
                        क्या आप एक सफल नेटवर्क मार्केटिंग व्यवसाय बनाना चाहते हैं? यदि हाँ, तो आपको नेटवर्क मार्केटिंग सफलता सूत्र की आवश्यकता है।
                    </p>

                    <p class="fst-italic">
                        नेटवर्क मार्केटिंग में सफल होने के लिए सबसे ज्यादा काम अपने ऊपर करना होता है, जबकि लोग दूसरों में कमियां निकाल रहे होते हैं, "यह सुनता नहीं है" "वह सुनता नहीं है" अरे वह सुनेगा, उसका खानदान भी सुनेगा, पहले अपने आप को "सुनाने" लायक तो बनाइए।
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    {{-- <section id="" class="section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <!-- <h3>The Beginner to Billionaire<span>: Mastering the Craft of Persuasion and Connection</span></h3> -->

                <h3>𝐒𝐮𝐩𝐞𝐫𝐜𝐡𝐚𝐫𝐠𝐞 𝐘𝐨𝐮𝐫:<span> Selling Skill to rock on your Job, Traditional & NETWORK
                        MARKETING BUSINESS</span></h3>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/Wfm__GY8F_E?si=y_geodwetlH2AggQ" title="Kns academy"
                            frameborder="1" style="border: 5px solid #000;"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up"
                    data-aos-delay="100">
                    <p>हो जाये तैयार 𝐒𝐀𝐋𝐄𝐒 𝐑𝐄𝐂𝐎𝐑𝐃𝐒 तोड़ने के लिए, NETWORK MARKETING BUSINESS में Sales
                        में नयी उंचाईयों तक पहुंचने के लिए क्योंकि सेल्स ही एक ऐसा प्रोफेशन हैं जो सपनो के सारे
                        दरवाजे UNLOCK करती हैं|</b> <br><br>
                        <b class="ml-5">Effective salesmanship involves:</b>
                    <ul style="list-style: none;">
                        <li>👉 Learn Proven Sales Strategies</li>
                        <li>👉 Double Your Sales with Selling Skill, Closing techniques & objection handling Skill
                        </li>
                        <li>👉 Join our Online Sales training course</li>
                        <li>👉 Become Top Sales Performer</li>
                    </ul>

                    <span>
                        Sales Accelerator Program by <br>
                        Trainer SHIV ARORA <br>
                        (16 years of Experience in Sales & Network Marketing)
                    </span>

                    <strong class="mt-2">
                        Sales में अपनी रूकावट को STOP करे & अपने BUSINESS, NETWORK MARKETING BUSINESS या JOB में
                        सफलता पाए, जिसके आप काबिल हे.
                    </strong>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- ======= why2 Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h3><span>Make yourself Network Marketing PRO -</span></h3>
            </div>

            <div class="row">
                <div class="col-lg-6 text-center" data-aos="fade-right" data-aos-delay="100">
                    <img src="{{ asset('assets/img/marketing.jpg') }}" alt="network" class="img-fluid">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up"
                    data-aos-delay="100">
                    <ul>
                        <li>
                            👉 BEGINNER TO BILLIONAIRE कोर्स नेटवर्क मार्केटर्स के लिए ब्रह्मास्त्र है।
                        </li>
                        <li>
                            👉 दुनिया के हर एक नेटवर्क मार्केटर्स को एक बार Beginner to billionaire कोर्स अवश्य करना चाहिए
                        </li>
                        <li>
                            👉 21ST CENTURY की सबसे बड़ी Free Lancing बिजनेस नेटवर्क मार्केटिंग में नई ऊंचाइयों तक पहुंचने के लिए अभी ज्वाइन करे।
                        </li>
                        <li>
                            👉 BEGINNER TO BILLIONAIRE कोर्स श्री कमल नारायण साहू सर के 16 साल के टीम वर्क और लीडरशिप के अनुभव का निचोड़ हैं तभी तो इस कोर्स में आपको मनी बैक गारंटी भी हैं
                        </li>
                    </ul>

                    <p style="margin-top: -7%">
                        <b>BEGINNER TO BILLIONAIRE</b> <br>
                        Network marketing success blueprint
                    </p>

                    <p>
                        by <span class="text-primary">Kamal Narayan Sahu </span><br>
                        Passionate Networker, Founder of K narayan skill Academic
                    </p>
                </div>
            </div>
        </div>

    </section><!-- End About Section -->

    <!-- ======= why Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h3><span>Mastering Sales Skills</span></h3>
            </div>

            <div class="row">
                <div class="col-lg-6 text-center" data-aos="fade-right" data-aos-delay="100">
                    <img src="{{ asset('assets/img/kns2.jpg') }}" alt="sales skills" class="img-fluid">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up"
                    data-aos-delay="100">
                    <b>
                        Unlock the Art and Science of Successful Selling
                    </b>
                    <br>
                    {{-- <p class="fst-italic">
                            "Sales are contingent upon the attitude of the salesman, not the attitude of the prospect."
                            - William Clement Stone
                        </p> --}}
                    <p>
                        Learning sales skills is an ongoing journey of mastering the art of persuasion, effective
                        communication, and building relationships. It involves understanding customer needs, active
                        listening, and presenting solutions that add value.
                    </p>
                    <p>
                        Develop your sales skills by practicing empathy, refining your pitch, and learning from both
                        successes and failures. Utilize technology to enhance your sales process, but never
                        underestimate the power of genuine human connection in sales.
                    </p>
                    <p>
                        Continuous learning and adaptation to new trends and techniques in the sales landscape are
                        essential. Invest time in sales training programs, seek mentorship, and leverage networking
                        opportunities to broaden your skill set and expand your sales prowess.
                    </p>
                    <p>
                        Remember, sales skills are not just about closing deals; they're about building trust and
                        long-lasting relationships with customers. Dedicate yourself to constant improvement, and
                        watch your sales success soar.
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
                <div class="col-lg-7 m-auto">
                    <div class="text-center m-auto">
                        <span class="mb-5">
                            👇 निचे दिए button पर क्लिक करे and Start Your Powerful Sales Journey 👇
                        </span>
                        <a href="https://rzp.io/l/o2gu6qrn" class="btn-custom mb-3 mt-4" {{ $disabled }}>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>Register <b>Now</b> </span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </a><br>
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
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/NfRD3cDW61I?si=RrnocvtUQloqN5dC" title="Kns academy"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                    data-aos-delay="200">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/n_qyxcx6qZA?si=pq_H6F07E2WIlf0-" title="Kns academy"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                    data-aos-delay="300">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/2kaPtYikGZ0?si=Rj_1r2J7LDrMgnn6" title="Kns academy"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/l4AtEtQIkrM?si=LYOLNJYhIacuPBrM" title="Kns academy"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                    data-aos-delay="200">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/BC0ZvtW0hNk?si=-Eovfj127ZHd5Nkx" title="Kns academy"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                    data-aos-delay="300">
                    <div class="tutorial container text-center my-2 ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/M80GBZLkCc4?si=uCx7HnmHUF4F8JBW" title="Kns academy"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Services Section -->

    <!-- ======= Networker ======= -->
    <section id="team" class="services ">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Trainers</h2>
                <h3>People earned after learning from our sales<span> Techniques</span></h3>
                <p>Some of Our Multimillionaires Network Marketing leaders
                    Who transforms their Life & achived Big success in Network Marketing industry...</p>
            </div>

            <div class="row text-center">
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/jitendra.jpeg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Jitendra Dhever</h4>
                            <span class="text-dark">Income - ₹ 6 crore</span><br>
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
                            <h4>Mukesh Sharma</h4>
                            <span class="text-dark">Income - ₹ 2.5 crore</span><br>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="400">
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

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/munib.jpeg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Munib Nishad</h4>
                            <span class="text-dark">Income - ₹ 2.5 crore</span><br>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/dharmendra.jpeg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Dharmendra Yadav</h4>
                            <span class="text-dark">Income - ₹ 1.5 crore</span><br>
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
                            <h4>Manteshwar</h4>
                            <span class="text-dark">Income - ₹ 81 lac</span><br>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/team/ramprasad.jpeg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>DAYANAND PRASAD </h4>
                            <span class="text-dark">Income - ₹ 49 lac</span><br>
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
                            <h4>Panku Sharma </h4>
                            <span class="text-dark">Income - ₹ 37 lac</span><br>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Team Section -->

    <!-- ======= about kamalnarayan sahu Section ======= -->
    <section id="portfolio" class="team section-bg">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/img/11.png') }}" alt="sirji" class="img-fluid">
                </div>

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="section-title">
                        {{-- <h3><span>Who Is</span> Kamal Narayan Sahu</h3> --}}
                        <h3> Welcome to K Narayan Skill Academy! </h3>
                    </div>
                    <p>
                        At K Narayan Skill Academy, we are dedicated to empowering individuals through diverse skill
                        development programs tailored to meet the demands of today's dynamic world. Our mission is
                        to equip you with the knowledge and expertise needed to succeed in various domains.
                    </p>

                    <h4>Why Choose K Narayan Skill Academy?</h4>

                    <ul>
                        <li><b>Expert Guidance:</b> Benefit from the mentorship of experienced professionals and
                            industry leaders passionate about your success.</li>
                        <li><b>Hands-On Learning:</b> Engage in practical, real-world projects and exercises that
                            sharpen your skills and build your portfolio.</li>
                        <li><b>Flexible Learning:</b> Enjoy flexible schedules and a variety of learning formats,
                            including online courses and workshops, enabling you to learn at your own pace.</li>
                    </ul>

                    <div class="text-center mt-2">
                        🛑 Secure Your Spot Now! Enroll Today 👇
                    </div>

                    <div class="d-flex justify-content-center text-center mt-3">
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

    <!-- ======= about kamalnarayan sahu Section ======= -->
    <section id="portfolio" class="team">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/img/sirji2.png') }}" alt="sirji" class="img-fluid">
                </div>

                <div class="col-lg-8 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
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
                    {{-- <div class="d-flex justify-content-center mt-5">
                            <a href="#skills" class="btn-custom">
                                <span>Book Now Your Free Seat</span>
                            </a>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <h4>Limited Seats, Filling Fast...</h4>
                        </div> --}}
                </div>
            </div>

        </div>
    </section><!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Contact</h2>
                <h3><span>Contact Us</span></h3>
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

        </div>
    </section><!-- End Contact Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing section-bg">
        <div class="container" data-aos="fade-up">

            <div class="container-fluid">
                <div class="row text-center">
                    <a href="https://www.facebook.com/profile.php?id=61551921226266&mibextid=rS40aB7S9Ucbxw6v">
                        <img src="{{ asset('assets/img/kns.png') }}" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section><!-- End Pricing Section -->
@endsection
