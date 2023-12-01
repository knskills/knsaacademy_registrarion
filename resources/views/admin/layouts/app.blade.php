<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard">

    <title>Admin Panel</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon_io/site.webmanifest') }}" rel="icon">
    <link href="{{ asset('assets/img/favicon_io/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('assets/img/favicon_io/favicon-32x32.png') }}" rel="icon" type="image/png" sizes="32x32">
    <link href="{{ asset('assets/img/favicon_io/favicon-16x16.png') }}" rel="icon" type="image/png" sizes="16x16">
    <link href="{{ asset('assets/img/favicon_io/android-chrome-512x512.png') }}" rel="icon" type="image/png"
        sizes="512x512">
    <link href="{{ asset('assets/img/favicon_io/android-chrome-192x192.png') }}" rel="icon" type="image/png"
        sizes="192x192">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admin/css/bootstrap.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/zabuto_calendar.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/js/gritter/css/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lineicons/style.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style-responsive.css') }}" rel="stylesheet">

    @yield('styles')


    <script src="{{ url('admin/js/chart-master/Chart.js') }}"></script>
</head>

<body>
    @guest
        @yield('content')
    @else
        <section id="container">
            <!--header start-->
            <header class="header black-bg">
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
                </div>
                <!--logo start-->
                <a href="{{ route('audiences') }}" class="logo"><b>YASHIKA TRADING</b></a>
                <div class="top-menu">
                    <ul class="nav pull-right top-menu">
                        <li>
                            <a class="logout"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </header>
            <!--header end-->

            <!-- ***************************************************************************
                                    MAIN SIDEBAR MENU
              ******************************************************************************** -->
            <!--sidebar start-->
            <aside>
                <div id="sidebar" class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">

                        <li class="mt">
                            <a href="{{ route('audiences') }}" class="{{ request()->is('audiences') ? 'active' : '' }}">
                                <i class="fa fa-users"></i>
                                <span>Registered Audience</span>
                            </a>
                        </li>

                        {{-- <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-desktop"></i>
                                <span>Audience</span>
                            </a>
                            <ul class="sub">
                                <li><a href="">General</a></li>
                                <li><a href="buttons.html">Buttons</a></li>
                                <li><a href="panels.html">Panels</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-cogs"></i>
                                <span>Components</span>
                            </a>
                            <ul class="sub">
                                <li><a href="calendar.html">Calendar</a></li>
                                <li><a href="gallery.html">Gallery</a></li>
                                <li><a href="todo_list.html">Todo List</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Extra Pages</span>
                            </a>
                            <ul class="sub">
                                <li><a href="blank.html">Blank Page</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="lock_screen.html">Lock Screen</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>Forms</span>
                            </a>
                            <ul class="sub">
                                <li><a href="form_component.html">Form Components</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-th"></i>
                                <span>Data Tables</span>
                            </a>
                            <ul class="sub">
                                <li><a href="basic_table.html">Basic Table</a></li>
                                <li><a href="responsive_table.html">Responsive Table</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>Charts</span>
                            </a>
                            <ul class="sub">
                                <li><a href="morris.html">Morris</a></li>
                                <li><a href="chartjs.html">Chartjs</a></li>
                            </ul>
                        </li> --}}

                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->

            @yield('content')

        </section>
    @endguest




    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <script src="{{ asset('admin/js/jquery-1.8.3.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.dcjqaccordion.2.7.js') }}" class="include" type="text/javascript"></script>
    <script src="{{ asset('admin/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.sparkline.js') }}"></script>


    <!--common script for all pages-->
    <script src="{{ asset('admin/js/common-scripts.js') }}"></script>
    <script src="{{ asset('admin/js/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('admin/js/gritter-conf.js') }}"></script>

    <!--script for this page-->
    <script src="{{ asset('admin/js/sparkline-chart.js') }}"></script>
    <script src="{{ asset('admin/js/zabuto_calendar.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // var unique_id = $.gritter.add({
            //     // (string | mandatory) the heading of the notification
            //     title: 'Welcome to Dashgum!',
            //     // (string | mandatory) the text inside the notification
            //     text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Free version for <a href="http://blacktie.co" target="_blank" style="color:#ffd777">BlackTie.co</a>.',
            //     // (string | optional) the image to display on the left
            //     image: 'assets/img/ui-sam.jpg',
            //     // (bool | optional) if you want it to fade out on its own or just sit there
            //     sticky: true,
            //     // (int | optional) the time you want it to be alive for before fading out
            //     time: '',
            //     // (string | optional) the class name you want to apply to that specific message
            //     class_name: 'my-sticky-class'
            // });

            return false;
        });
    </script>

    <script type="application/javascript">

        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });


        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>

    @yield('scripts')


</body>

</html>
