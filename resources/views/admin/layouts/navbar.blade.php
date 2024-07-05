<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <img src="{{asset('assets/img/11.png')}}" alt="knsa">
            <span class="d-none d-lg-block">KNSA</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    {{-- <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar --> --}}

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('nice/assets/img/user_avatar.png') }}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->name }}</h6>
                        {{-- <span>Web Designer</span> --}}
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('dashboard') ? '' : 'collapsed' }}"
                href="{{ route('dashboard') }}" class="{{ Route::currentRouteNamed('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('audiences.*') ? '' : 'collapsed' }}"
                data-bs-target="#audiance-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i>
                <span>Audiance</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="audiance-nav"
                class="nav-content collapse {{ Route::currentRouteNamed('audiences.*') ? 'show' : '' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('audiences.index') }}"
                        class="{{ Route::currentRouteNamed('audiences.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Audiance</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('audiences.create') }}"
                        class="{{ Route::currentRouteNamed('audiences.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>New products</span>
                    </a>
                </li> --}}
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('events.*') ? '' : 'collapsed' }}"
                data-bs-target="#Event-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-calendar-event"></i>
                <span>Event</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Event-nav"
                class="nav-content collapse {{ Route::currentRouteNamed('events.*') ? 'show' : '' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('events.index') }}"
                        class="{{ Route::currentRouteNamed('events.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Events</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('events.create') }}"
                        class="{{ Route::currentRouteNamed('events.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>New</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('templates.*') ? '' : 'collapsed' }}"
                data-bs-target="#Template-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-back"></i>
                <span>Template</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Template-nav"
                class="nav-content collapse {{ Route::currentRouteNamed('templates.*') ? 'show' : '' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('templates.index') }}"
                        class="{{ Route::currentRouteNamed('templates.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Templates</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('templates.create') }}"
                        class="{{ Route::currentRouteNamed('templates.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>New</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('messages.*') ? '' : 'collapsed' }}"
                data-bs-target="#messages-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-envelope"></i>
                <span>Message</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="messages-nav"
                class="nav-content collapse {{ Route::currentRouteNamed('messages.*') ? 'show' : '' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('messages.index') }}"
                        class="{{ Route::currentRouteNamed('messages.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Messages</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('messages.create') }}"
                        class="{{ Route::currentRouteNamed('messages.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>New</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('auto-reply-options.*') ? '' : 'collapsed' }}"
                data-bs-target="#option-reply-nav" data-bs-toggle="collapse" href="#">
                {{-- <i class="bx bx-message-rounded-add"></i> --}}
                <i class="bi bi-chat-left"></i>
                <span>Keywords</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="option-reply-nav"
                class="nav-content collapse {{ Route::currentRouteNamed('auto-reply-options.*') ? 'show' : '' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('auto-reply-options.index') }}"
                        class="{{ Route::currentRouteNamed('auto-reply-options.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Messages</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('auto-reply-options.create') }}"
                        class="{{ Route::currentRouteNamed('auto-reply-options.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>New</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('whatsapp.setting') ? '' : 'collapsed' }}"
                href="{{ route('whatsapp.setting') }}" class="{{ Route::currentRouteNamed('whatsapp.setting') ? 'active' : '' }}">
                <i class="bi bi-whatsapp"></i>
                <span>Whatsapp Setting</span>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('whatsapp.*') ? '' : 'collapsed' }}"
                data-bs-target="#whatsapp-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-whatsapp"></i>
                <span>Whatsapp</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="whatsapp-nav"
                class="nav-content collapse {{ Route::currentRouteNamed('whatsapp.*') ? 'show' : '' }} "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('whatsapp.setting') }}"
                        class="{{ Route::currentRouteNamed('whatsapp.setting') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Profile Setting</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('whatsapp.chat.index') }}"
                        class="{{ Route::currentRouteNamed('whatsapp.chat.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Chat</span>
                    </a>
                </li>
            </ul>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('whatsapp.chat.index') ? '' : 'collapsed' }}"
                href="{{ route('whatsapp.chat.index') }}" class="{{ Route::currentRouteNamed('whatsapp.chat.index') ? 'active' : '' }}">
                <i class="bi bi-whatsapp"></i>
                <span>Whatsapp</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->
