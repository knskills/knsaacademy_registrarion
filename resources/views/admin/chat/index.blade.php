@extends('admin.layouts.niceapp')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/chat/style.css') }}">
    <!-- Google Fonts from https://codepen.io/mehedihtml/pen/ZExjpeo-->
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <style>
        .custom-button-wrapper {
            display: inline-block;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
        }

        .custom-label {
            display: inline-block;
            vertical-align: middle;
            cursor: pointer;
            color: #333;
            font-size: 16px;
        }

        .custom-img-fluid {
            max-width: 24px;
            margin-right: 8px;
            vertical-align: middle;
        }

        .custom-upload-box {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <main id="main" class="main">

        {{-- <div class="pagetitle">
            <h1>Messages</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ route('audiences.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Send/Schedule Message List</li>
                </ol>
            </nav>
        </div> --}}

        <div>
            @if ($errors->any())
                <ul class="alert">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

        </div>

        <!-- char-area -->
        <section class="message-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="chat-area">
                            <!-- chatlist -->
                            <div class="chatlist">
                                <div class="modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="chat-header">
                                            <div class="msg-search">
                                                {{-- <input type="text"
                                                    class="form-control"
                                                    id="inlineFormInputGroup"
                                                    placeholder="Search"
                                                    aria-label="search"> --}}

                                                <form id="c-serch"
                                                    action="{{ route('whatsapp.chat.index') }}"
                                                    method="GET"
                                                    class="w-100">
                                                    @csrf
                                                    <input type="text"
                                                        name="recipient_id"
                                                        class="form-control"
                                                        id="inlineFormInputGroup"
                                                        placeholder="Search"
                                                        aria-label="search">
                                                </form>
                                                <a class="add"
                                                    href="#"
                                                    title="Search">
                                                    <img class="img-fluid"
                                                        src="https://mehedihtml.com/chatbox/assets/img/add.svg"
                                                        alt="search"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('c-serch').submit();">
                                                </a>

                                                {{-- <a class="dropdown-item"
                                                    href="{{ route('whatsapp.chat.index') }}"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a> --}}


                                            </div>
                                        </div>

                                        <hr>

                                        <div class="modal-body">
                                            <!-- chat-list -->
                                            <div class="chat-lists">
                                                <div class="tab-content"
                                                    id="myTabContent">

                                                    <button
                                                        class="btn btn-secondary w-100 mb-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#newContact">New</button>

                                                    @foreach ($chatList as $key => $customer)
                                                        <div class="tab-pane fade show active"
                                                            id="Open"
                                                            role="tabpanel"
                                                            aria-labelledby="Open-tab">
                                                            <!-- chat-list -->
                                                            <div
                                                                class="chat-list">
                                                                <a href="{{ route('whatsapp.chat.index', ['recipient_id' => $customer->recipient_id]) }}"
                                                                    class="d-flex align-items-center"
                                                                    readonly>
                                                                    <div
                                                                        class="flex-shrink-0">
                                                                        <img class="img-fluid"
                                                                            style="max-width:30px;"
                                                                            src="{{ asset('nice/assets/img/chatUser.png') }}"
                                                                            alt="user img">
                                                                        {{-- <span class="active"></span> --}}
                                                                    </div>
                                                                    <div
                                                                        class="flex-grow-1 ms-3">
                                                                        <h3>
                                                                            {{ $customer->profile_name ?? '' }}
                                                                        </h3>
                                                                        <p>
                                                                            +{{ $customer->recipient_id ?? '' }}
                                                                        </p>
                                                                    </div>
                                                                </a>

                                                            </div>
                                                            <!-- chat-list -->
                                                        </div>

                                                        {{-- <div class="tab-pane fade"
                                                            id="Closed"
                                                            role="tabpanel"
                                                            aria-labelledby="Closed-tab">

                                                            <!-- chat-list -->
                                                            <div
                                                                class="chat-list">
                                                                <a href="{{ route('whatsapp.chat.index', ['recipient_id' => $customer->recipient_id]) }}"
                                                                    class="d-flex align-items-center">
                                                                    <div
                                                                        class="flex-shrink-0">
                                                                        <img class="img-fluid"
                                                                            src="{{asset('nice/assets/img/chatUser.png')}}"
                                                                            alt="user img">
                                                                        <span
                                                                            class="active"></span>
                                                                    </div>
                                                                    <div
                                                                        class="flex-grow-1 ms-3">
                                                                        <h3>{{ $customer->profile_name ?? '' }}
                                                                        </h3>
                                                                        <p>+{{ $customer->recipient_id ?? '' }}
                                                                        </p>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- chat-list -->
                                                        </div> --}}
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- chat-list -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- chatlist -->

                            <!-- chatbox -->
                            <div class="chatbox">
                                <div class="modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="msg-head">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div
                                                        class="d-flex align-items-center">
                                                        <span
                                                            class="chat-icon"><img
                                                                class="img-fluid"
                                                                src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg"
                                                                alt="image title"></span>
                                                        <div
                                                            class="flex-shrink-0">
                                                            <img class="img-fluid"
                                                                style="max-width:30px;"
                                                                src="{{ asset('nice/assets/img/chatUser.png') }}"
                                                                alt="user img">
                                                        </div>
                                                        <div
                                                            class="flex-grow-1 ms-3">
                                                            <h3>
                                                                {{ $user->profile_name ?? '' }}
                                                            </h3>
                                                            <p>
                                                                +{{ $user->recipient_id ?? '' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <ul class="moreoption">
                                                        <li
                                                            class="navbar nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle"
                                                                href="#"
                                                                role="button"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fa fa-ellipsis-v"
                                                                    aria-hidden="true"></i></a>
                                                            <ul
                                                                class="dropdown-menu">
                                                                <li>
                                                                    {{-- <a class="dropdown-item"
                                                                        href="{{ route('whatsapp.chat.destroy', ['chat' => $user->recipient_id]) }}"
                                                                        onclick="return confirm('Are you sure you want to delete this chat?');">
                                                                        Delete
                                                                    </a> --}}

                                                                    <form
                                                                        action="{{ route('whatsapp.chat.destroy', $user->recipient_id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button
                                                                            type="submit"
                                                                            class="dropdown-item"
                                                                            onclick="return confirm('Are you sure you want to delete this chat?');">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <li><a class="dropdown-item"
                                                                        href="#">Another
                                                                        action</a>
                                                                </li>
                                                                <li>
                                                                    <hr
                                                                        class="dropdown-divider">
                                                                </li>
                                                                <li><a class="dropdown-item"
                                                                        href="#">Something
                                                                        else
                                                                        here</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="modal-body">
                                            <div class="msg-body">
                                                <ul>

                                                    @if ($messages->isEmpty())
                                                        <p>No chat messages
                                                            found.</p>
                                                    @else
                                                        @php
                                                            $currentDate = null;
                                                        @endphp

                                                        @foreach ($messages as $key => $message)
                                                            @php
                                                                $messageDate = Carbon\Carbon::parse(
                                                                    $message->created_at,
                                                                )->format(
                                                                    'Y-m-d',
                                                                );
                                                                $today = Carbon\Carbon::now()->format(
                                                                    'Y-m-d',
                                                                );
                                                                $yesterday = Carbon\Carbon::now()
                                                                    ->subDay()
                                                                    ->format(
                                                                        'Y-m-d',
                                                                    );

                                                                $last = '';

                                                                // if $key eqal to the count of messages the $last is returned last
                                                                if (
                                                                    $key +
                                                                        1 ==
                                                                    count(
                                                                        $messages,
                                                                    )
                                                                ) {
                                                                    $last =
                                                                        'last';
                                                                }

                                                            @endphp

                                                            @if ($currentDate !== $messageDate)
                                                                @php $currentDate = $messageDate; @endphp
                                                                <li>
                                                                    <div
                                                                        class="divider">
                                                                        @if ($currentDate === $today)
                                                                            <h6>Today
                                                                            </h6>
                                                                        @elseif($currentDate === $yesterday)
                                                                            <h6>Yesterday
                                                                            </h6>
                                                                        @else
                                                                            <h6>{{ Carbon\Carbon::parse($currentDate)->format('M d, Y') }}
                                                                            </h6>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endif

                                                            @if ($message->type == 'send')
                                                                <li class="sender"
                                                                    id="{{ $last }}">
                                                                    <p>
                                                                        {{-- @if (!empty($message->template))
                                                                        {!!$message->template->whtsp_msg[0]['text']!!}

                                                                        <textarea name="" id="" cols="30" rows="10">{{$message->template->whtsp_msg[0]['text']}}</textarea>
                                                                        @else
                                                                        {{ $message->whatsapp_message }}
                                                                        @endif --}}

                                                                        {{-- <textarea name="" id="" cols="30" rows="10">{{ $message->whatsapp_message }}</textarea> --}}

                                                                        {{-- {{ $message->whatsapp_message }} --}}

                                                                        <img src="{{ asset($message->image) }}"
                                                                            alt="{{ $message->image }}"
                                                                            style="max-width: 250px;">
                                                                        <br>
                                                                        {!! nl2br(e($message->whatsapp_message)) !!}
                                                                    </p>
                                                                    <span
                                                                        class="time">{{ Carbon\Carbon::parse($message->created_at)->format('h:i a') }}</span>
                                                                </li>
                                                            @else
                                                                <li class="repaly"
                                                                    id="{{ $last }}">
                                                                    <p>
                                                                        <img src="{{ asset($message->image) }}"
                                                                            alt="{{ $message->image }}"
                                                                            style="max-width: 250px;">

                                                                        <br>
                                                                        {{ $message->whatsapp_message }}
                                                                    </p>
                                                                    <span
                                                                        class="time">{{ Carbon\Carbon::parse($message->created_at)->format('h:i a') }}</span>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>


                                        <div class="send-box">
                                            <form
                                                action="{{ route('whatsapp.send-message') }}"
                                                method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden"
                                                    name="recipient_id"
                                                    value="{{ substr($user->recipient_id, 2) }}">

                                                <textarea class="form-control" name="message" aria-label="message…"
                                                    value="{{ old('message') }}" placeholder="Write message…"
                                                    cols="1"></textarea>

                                                <button type="submit">
                                                    <i class="fa fa-paper-plane"
                                                        aria-hidden="true"></i>
                                                    Send</button>


                                                <div class="send-btns">
                                                    <div class="attach">
                                                        <div
                                                            class="button-wrapper">
                                                            <span
                                                                class="label">
                                                                <img class="img-fluid"
                                                                    src="https://mehedihtml.com/chatbox/assets/img/upload.svg"
                                                                    alt="image title">
                                                                add image
                                                            </span>
                                                            <input
                                                                type="file"
                                                                name="media_image"
                                                                id="upload"
                                                                class="upload-box"
                                                                placeholder="Upload File"
                                                                aria-label="Upload File">
                                                        </div>

                                                        {{-- <select
                                                            class="form-control"
                                                            id="exampleFormControlSelect1">
                                                            <option>Select
                                                                template
                                                            </option>
                                                            <option>Template
                                                                1</option>
                                                            <option>Template
                                                                2</option>
                                                        </select>

                                                        <div class="add-apoint">
                                                            <a href="#"
                                                                data-toggle="modal"
                                                                data-target="#exampleModal4"><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="16"
                                                                    height="16"
                                                                    viewbox="0 0 16 16"
                                                                    fill="none">
                                                                    <path
                                                                        d="M8 16C3.58862 16 0 12.4114 0 8C0 3.58862 3.58862 0 8 0C12.4114 0 16 3.58862 16 8C16 12.4114 12.4114 16 8 16ZM8 1C4.14001 1 1 4.14001 1 8C1 11.86 4.14001 15 8 15C11.86 15 15 11.86 15 8C15 4.14001 11.86 1 8 1Z"
                                                                        fill="#7D7D7D" />
                                                                    <path
                                                                        d="M11.5 8.5H4.5C4.224 8.5 4 8.276 4 8C4 7.724 4.224 7.5 4.5 7.5H11.5C11.776 7.5 12 7.724 12 8C12 8.276 11.776 8.5 11.5 8.5Z"
                                                                        fill="#7D7D7D" />
                                                                    <path
                                                                        d="M8 12C7.724 12 7.5 11.776 7.5 11.5V4.5C7.5 4.224 7.724 4 8 4C8.276 4 8.5 4.224 8.5 4.5V11.5C8.5 11.776 8.276 12 8 12Z"
                                                                        fill="#7D7D7D" />
                                                                </svg>
                                                                Appoinment</a>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- chatbox -->
                    </div>
                </div>
            </div>
        </section>
        <!-- char-area -->

        <!-- New Chat -->
        <div class="modal fade" id="newContact" tabindex="-1"
            aria-labelledby="newContactLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            New Contact</h5>
                        <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('whatsapp.text-message') }}"
                        method="POST">
                        @csrf
                        <div class="modal-body">

                            <!--<div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Recipient Name:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                    </div>-->

                            <div class="mb-3">
                                <label for="recipient-name"
                                    class="col-form-label">Recipient
                                    Number:</label>
                                <input type="text" class="form-control"
                                    id="recipient-number"
                                    value="{{ old('recipient_id') }}"
                                    required minlength="10" maxlength="10"
                                    name="recipient_id"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                            <div class="mb-3">
                                <label for="message-text"
                                    class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text" name="message"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit"
                                class="btn btn-primary">Send</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!--End New Chat -->

    </main><!-- End #main -->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('admin/chat/chat.js') }}"></script>
    <script>
        $(document).ready(function() {
            // close alert automatically after 3 seconds
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);

            // Select the last li element by its ID
            var lastElement = $('#last');
            // Scroll the container to the top position of the last element
            $('.modal-body').scrollTop(lastElement.position().top);
        });
    </script>
@endsection
