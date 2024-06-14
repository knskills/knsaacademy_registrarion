@extends('admin.layouts.niceapp')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/chat/style.css') }}">
    <!-- Google Fonts from https://codepen.io/mehedihtml/pen/ZExjpeo-->
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    @vite('resources/js/app.js')

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
                                                <form id="c-serch"
                                                    action="{{ route('whatsapp.chat.index') }}"
                                                    method="GET"
                                                    class="w-100">
                                                    <input type="text"
                                                        name="phone_number"
                                                        class="form-control"
                                                        id="inlineFormInputGroup"
                                                        placeholder="Search"
                                                        aria-label="search">
                                                </form>
                                                <a class="add"
                                                    href="#"
                                                    title="Search">
                                                    <img class="img-fluid"
                                                        src="{{ asset('admin/chat/img/search.png') }}"
                                                        alt="search"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('c-serch').submit();">
                                                </a>
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

                                                    @foreach ($contacts as $key => $contact)
                                                        <div class="tab-pane fade show active"
                                                            id="Open"
                                                            role="tabpanel"
                                                            aria-labelledby="Open-tab">
                                                            <!-- chat-list -->
                                                            <div
                                                                class="chat-list">
                                                                <a href="{{ route('whatsapp.chat.index', ['recipient_id' => $contact->id]) }}"
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
                                                                            {{ $contact->name ?? '' }}
                                                                        </h3>
                                                                        <p>
                                                                            +{{ $contact->number ?? '' }}
                                                                        </p>
                                                                    </div>
                                                                </a>

                                                            </div>
                                                            <!-- chat-list -->
                                                        </div>
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
                                                                {{ $user->name ?? '' }}
                                                            </h3>
                                                            <p>
                                                                +{{ $user->number ?? '' }}
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
                                                                    <form
                                                                        action="{{ route('whatsapp.chat.destroy', $user->id) }}"
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


                                        <div class="modal-body" id="chat-body">
                                            <div class="msg-body">
                                                <ul id="message-list">

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
                                                                        @if ($message->image)
                                                                            <a href="{{ asset($message->image) }}"
                                                                                download>
                                                                                <img src="{{ asset($message->image) }}"
                                                                                    alt="{{ $message->image }}"
                                                                                    style="max-width: 250px;">
                                                                            </a>
                                                                            <br>
                                                                        @endif

                                                                        {!! nl2br(e($message->whatsapp_message)) !!}
                                                                    </p>
                                                                    <span
                                                                        class="time">{{ Carbon\Carbon::parse($message->created_at)->format('h:i a') }}</span>

                                                                    @if ($message->status == 'sent')
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16"
                                                                            height="16"
                                                                            fill="rgb(61, 61, 61)"
                                                                            class="bi bi-check2"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                                                                        </svg>
                                                                    @elseif($message->status == 'delivered')
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16"
                                                                            height="16"
                                                                            fill="rgb(61, 61, 61)"
                                                                            class="bi bi-check2-all"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0" />
                                                                            <path
                                                                                d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
                                                                        </svg>
                                                                    @elseif($message->status == 'read')
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="25"
                                                                            height="25"
                                                                            fill="rgb(52, 243, 94)"
                                                                            class="bi bi-check2-all"
                                                                            viewBox="0 0 25 25">
                                                                            <path
                                                                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0" />
                                                                            <path
                                                                                d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
                                                                        </svg>
                                                                    @elseif($message->status == 'failed')
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16"
                                                                            height="16"
                                                                            fill="rgb(248, 40, 40)"
                                                                            class="bi bi-ban"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                                                                        </svg>
                                                                    @endif
                                                                </li>
                                                            @else
                                                                <li class="repaly"
                                                                    id="{{ $last }}">
                                                                    <p>
                                                                        @if ($message->image)
                                                                            <a href="{{ asset($message->image) }}"
                                                                                download>
                                                                                <img src="{{ asset($message->image) }}"
                                                                                    alt="{{ $message->image }}"
                                                                                    style="max-width: 250px;">
                                                                            </a>
                                                                            <br>
                                                                        @endif

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
                                                enctype="multipart/form-data"
                                                id="whatsapp-send-message-form">
                                                @csrf

                                                <input type="hidden"
                                                    name="recipient_id"
                                                    value="{{ substr($user->number, 2) }}">

                                                <textarea class="form-control" name="message" aria-label="message…" id="send_msg"
                                                    value="{{ old('message') }}" placeholder="Write message…"
                                                    cols="1"></textarea>


                                                <input type="file"
                                                    name="media_image"
                                                    id="upload"
                                                    class="upload-box"
                                                    placeholder="Upload File"
                                                    aria-label="Upload File"
                                                    {{-- accept="image/png, image/jpeg, image/jpg, image/gif" --}}
                                                    style="display: none;">

                                                <button type="submit">
                                                    <i class="fa fa-paper-plane"
                                                        aria-hidden="true"></i>
                                                    Send</button>

                                            </form>
                                            <div class="send-btns">
                                                <div class="attach">
                                                    <div
                                                        class="button-wrapper">
                                                        <span class="label"
                                                            id="add-image-button">
                                                            <img class="img-fluid"
                                                                src="https://mehedihtml.com/chatbox/assets/img/upload.svg"
                                                                alt="image title">
                                                            add image
                                                        </span>
                                                    </div>

                                                    <select
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
                                                    </div>
                                                </div>
                                            </div>

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
                        <h5 class="modal-title" id="newContactModel">
                            New Contact</h5>
                        <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('whatsapp.send-message') }}"
                        method="POST">
                        @csrf
                        <div class="modal-body">
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
            $('#chat-body').scrollTop(lastElement.position().top);

            // change button working
            $('#add-image-button').on('click', function() {
                $('#upload').click();
            });
        });

        $(document).ready(function() {
            $('#whatsapp-send-message-form').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'), // Get form action URL
                    type: 'POST',
                    data: formData,
                    dataType: 'JSON', // Expect JSON response from server
                    processData: false, // Don't process data with `processData: false`
                    contentType: false, // Set content type to `false` for FormData
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel CSRF protection
                    },
                    success: function(response) {
                        // Handle successful response, e.g., display success message
                        console.log('Message sent successfully:', response);

                        // Extract message data from the response
                        var message = response.message;

                        // Determine the date label (Today, Yesterday, or specific date)
                        var messageDate = new Date(message.created_at);
                        var today = new Date();
                        var yesterday = new Date();
                        yesterday.setDate(today.getDate() - 1);
                        var dateLabel = '';

                        if (messageDate.toDateString() === today.toDateString()) {
                            dateLabel = 'Today';
                        } else if (messageDate.toDateString() === yesterday.toDateString()) {
                            dateLabel = 'Yesterday';
                        } else {
                            dateLabel = messageDate.toLocaleDateString('en-US', {
                                month: 'short',
                                day: 'numeric',
                                year: 'numeric'
                            });
                        }

                        // Check if the current date label already exists
                        var lastDivider = $('li .divider').last();
                        if (lastDivider.length === 0 || lastDivider.text().trim() !== dateLabel) {
                            // Append date label if it does not exist
                            $('#message-list').append('<li><div class="divider"><h6>' + dateLabel + '</h6></div></li>');
                        }

                        // Create the message HTML
                        var messageHtml = '<li class="sender">';
                        if (message.image) {
                            messageHtml += '<a href="' + message.image + '" download><img src="' + message.image + '" alt="' + message.image + '" style="max-width: 250px;"></a><br>';
                        }
                        messageHtml += '<p>' + message.whatsapp_message.replace(/\n/g, '<br>') + '</p>';
                        messageHtml += '<span class="time">' + new Date(message.created_at).toLocaleTimeString('en-US', {
                            hour: '2-digit',
                            minute: '2-digit'
                        }) + '</span>';

                        if (message.status === 'sent') {
                            messageHtml += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="rgb(61, 61, 61)" class="bi bi-check2" viewBox="0 0 16 16"><path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"></path></svg>';
                        } else if (message.status === 'delivered') {
                            messageHtml += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="rgb(61, 61, 61)" class="bi bi-check2-all" viewBox="0 0 16 16"><path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"></path><path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"></path></svg>';
                        } else if (message.status === 'read') {
                            messageHtml += '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="rgb(52, 243, 94)" class="bi bi-check2-all" viewBox="0 0 25 25"><path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"></path><path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"></path></svg>';
                        } else if (message.status === 'failed') {
                            messageHtml += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="rgb(248, 40, 40)" class="bi bi-ban" viewBox="0 0 16 16"><path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"></path></svg>';
                        }
                        messageHtml += '</li>';

                        // Append the message HTML to the message list
                        $('#message-list').append(messageHtml);

                        $('#send_msg').val('');

                        // Scroll to the bottom of the message list
                        $('#chat-body').scrollTop($('#message-list')[0].scrollHeight);
                    },
                    error: function(error) {
                        // Handle errors, e.g., display error message to user
                        console.error('Error sending message:', error);
                    }
                });
            });
        });



        $(document).ready(function() {
            console.log('Echo configuration:', window.Echo);
            window.Echo.private('chat')
                .listen('MessageReceived', (e) => {
                    console.log('its working');
                    console.log(e.message);
                });
        });
    </script>
@endsection
