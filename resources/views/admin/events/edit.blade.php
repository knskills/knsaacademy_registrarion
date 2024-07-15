@extends('admin.layouts.niceapp')

@section('styles')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Edit Event</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Event</h5>

                    @if ($errors->any() || session('success') || session('error'))
                        <div class="mt-5">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show"
                                    role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @foreach (['success', 'error'] as $msg)
                                @if (session($msg))
                                    <div
                                        class="alert alert-{{ $msg == 'success' ? 'success' : 'danger' }}">
                                        {{ session($msg) }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('ad-events.update', $event->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            {{-- <input type="hidden" name="id"
                                value="{{ $event->id }}"> --}}
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Event
                                        Name</label>
                                    <div class="col-md-8">
                                        <input type="text"
                                            class="form-control"
                                            name="event_name"
                                            placeholder="Enter event name"
                                            value="{{ $event->event_name ?? old('event_name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Event
                                        Type</label>
                                    <div class="col-md-8">
                                        <select name="event_type"
                                            id="event_type"
                                            class="form-select">
                                            <option value="paid"
                                                {{ $event->event_type == 'paid' ? 'selected' : '' }}>
                                                Paid</option>
                                            <option value="free"
                                                {{ $event->event_type == 'free' ? 'selected' : '' }}>
                                                Free</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Is
                                        Active</label>
                                    <div class="col-md-8">
                                        <select name="is_active" id="is_active"
                                            class="form-select">
                                            <option value="1"
                                                {{ $event->is_active == '1' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="0"
                                                {{ $event->is_active == '0' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Event
                                        Date</label>
                                    <div class="col-md-8">
                                        <input type="date" name="event_date"
                                            id="event_date"
                                            value="{{ $event->event_date ?? old('event_date') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Event
                                        Start Time</label>
                                    <div class="col-md-8">
                                        <input type="time"
                                            name="event_start_time"
                                            value="{{ $event->event_start_time ?? old('event_start_time') }}"
                                            id="event_start_time"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Event
                                        End Time</label>
                                    <div class="col-md-8">
                                        <input type="time"
                                            onchange="calculateEventDuration()"
                                            value="{{ $event->event_end_time ?? old('event_end_time') }}"
                                            name="event_end_time"
                                            id="event_end_time"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="col-md-6" id="priceContainer">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Price</label>
                                    <div class="col-md-8">
                                        <input type="number" name="price"
                                            id="price"
                                            placeholder="Enter discounted price"
                                            value="{{ $event->price ?? old('price') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- Original Price -->
                            <div class="col-md-6" id="originalPriceContainer">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Original
                                        Price</label>
                                    <div class="col-md-8">
                                        <input type="number"
                                            name="original_price"
                                            id="original_price"
                                            placeholder="Enter original price"
                                            value="{{ $event->original_price ?? old('original_price') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            {{-- <!-- payment_link -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Payment
                                        Link</label>
                                    <div class="col-md-8">
                                        <input type="text"
                                            name="payment_link"
                                            id="payment_link"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- youtube_link -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Youtube
                                        Link</label>
                                    <div class="col-md-8">
                                        <input type="text"
                                            name="youtube_link"
                                            id="youtube_link"
                                            class="form-control">
                                    </div>
                                </div>
                            </div> --}}

                            <!-- whatsapp_link -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Whatsapp
                                        Group Link</label>
                                    <div class="col-md-8">
                                        <input type="text"
                                            name="whatsapp_link"
                                            id="whatsapp_link"
                                            value="{{ $event->whatsapp_link ?? old('whatsapp_link') }}"
                                            placeholder="Whatsapp group link"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- whatsapp template -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Whatsapp
                                        Template</label>
                                    <div class="col-md-8">
                                        <select name="whstp_temp_name"
                                            id="whstp_temp_name"
                                            class="form-select">
                                            @foreach ($templates as $template)
                                                <option
                                                    value="{{ $template->name }}"
                                                    {{ $template->name == $event->whstp_temp_name ? 'selected' : '' }}>
                                                    {{ ucwords(str_replace('_', ' ', $template->name)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- event_duration -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Event
                                        Duration(Hr)</label>
                                    <div class="col-md-8">
                                        <input type="text" readonly
                                            name="event_duration"
                                            id="event_duration"
                                            value="{{ $event->event_duration ?? old('event_duration') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- timer_time in minutes -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label
                                        class="col-md-4 col-form-label">Timer
                                        Time(minutes)</label>
                                    <div class="col-md-8">
                                        <input type="number"
                                            name="timer_time" id="timer_time"
                                            value="{{ $event->timer_time ?? old('timer_time') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            $eventContent = $event->eventContent;
                        @endphp

                        <div class="row mt-5">
                            <div class="col-10 m-auto">
                                <div class="row">
                                    <h6 class="text-primary">
                                        <b>Event Content</b>
                                    </h6>
                                    <div class="col-12">
                                        <label for="title"
                                            class="form-label">Page
                                            Title</label>
                                        <input type="text"
                                            class="form-control"
                                            name="title"
                                            placeholder="Enter event name"
                                            value="{{ $eventContent->title ?? old('title') }}">
                                    </div>

                                    <h6 class="mt-3"><b>Top Section</b>
                                    </h6>
                                    <div class="col-12 mt-2">
                                        <label for="contanor1_heading"
                                            class="form-label">Heading</label>
                                        <input type="text"
                                            class="form-control"
                                            name="contanor1_heading"
                                            placeholder="Enter heading text"
                                            value="{{ $eventContent->contanor1_heading ?? old('contanor1_heading') }}">
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="contanor1_sub_heading"
                                            class="form-label">Subheading</label>
                                        <input type="text"
                                            class="form-control"
                                            name="contanor1_sub_heading"
                                            placeholder="Enter subheading text"
                                            value="{{ $eventContent->contanor1_sub_heading ?? old('contanor1_sub_heading') }}">
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label
                                            for="contanor1_col1_contant_type"
                                            class="form-label">Top content
                                            type</label>
                                        <select
                                            name="contanor1_col1_contant_type"
                                            id="contanor1_col1_contant_type"
                                            class="form-select">
                                            <option value="image"
                                                {{ $eventContent->contanor1_col1_contant_type == 'image' ? 'selected' : '' }}>
                                                Image</option>
                                            <option value="video"
                                                {{ $eventContent->contanor1_col1_contant_type == 'video' ? 'selected' : '' }}>
                                                Video</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label for="contanor1_col1_contant"
                                            class="form-label">Content</label>
                                        <div id="content-wrapper">
                                            <input
                                                type="{{ $eventContent->contanor1_col1_contant_type == 'image' ? 'file' : 'text' }}"
                                                class="form-control"
                                                name="contanor1_col1_contant"
                                                id="contanor1_col1_contant"
                                                value="{{ $eventContent->contanor1_col1_contant_type == 'video' ? $eventContent->contanor1_col1_contant : '' }}"
                                                placeholder="{{ $eventContent->contanor1_col1_contant_type == 'video' ? 'Enter video URL' : '' }}">
                                            <br>

                                            @if (
                                                $eventContent->contanor1_col1_contant_type == 'image')
                                                <img src="{{ asset($eventContent->contanor1_col1_contant) }}"
                                                    alt="Current Image"
                                                    style="max-width: 150px;"
                                                    class="img-fluid mb-2">

                                                    <input type="hidden" name="contanor1_col1_contant" value="{{$eventContent->contanor1_col1_contant}}">
                                            @else
                                                <small
                                                    class="text-black">Please
                                                    upload video in vimeo and
                                                    paste link here</small>
                                            @endif
                                        </div>
                                    </div>

                                    <h6 class="mt-3"><b>Achievements
                                            Section</b>
                                    </h6>
                                    <div class="col-12 mt-2">
                                        <label for="contanor2_heading"
                                            class="form-label">Heading</label>
                                        <input type="text"
                                            class="form-control"
                                            name="contanor2_heading"
                                            placeholder="Enter heading text"
                                            value="{{ $eventContent->contanor2_heading ?? old('contanor2_heading') }}">
                                    </div>

                                    <div class="col-12 mt-2"
                                        id="achievements">
                                        <label for="contanor2_data"
                                            class="form-label">Achievements</label>


                                        @if (!empty($eventContent->contanor2_data))
                                            @foreach ($eventContent->contanor2_data as $key => $data1)
                                                <div class="row mb-2">
                                                    <div class="col-md-10">
                                                        <input type="text"
                                                            class="form-control"
                                                            name="contanor2_data[]"
                                                            placeholder="Enter achievement text"
                                                            value="{{ $data1 }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-info add-achievement"><i
                                                                class="bi bi-plus-circle"></i></button>
                                                        <button type="button"
                                                            class="btn btn-danger remove-achievement"
                                                            disabled><i
                                                                class="bi bi-dash-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row mb-2">
                                                <div class="col-md-10">
                                                    <input type="text"
                                                        class="form-control"
                                                        name="contanor2_data[]"
                                                        placeholder="Enter achievement text">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-info add-achievement"><i
                                                            class="bi bi-plus-circle"></i></button>
                                                    <button type="button"
                                                        class="btn btn-danger remove-achievement"
                                                        disabled><i
                                                            class="bi bi-dash-circle"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <h6 class="mt-3">
                                        <b>Proud Moments Section</b>
                                    </h6>
                                    <div class="col-12 mt-2">
                                        <label for="contanor3_heading"
                                            class="form-label">Heading</label>
                                        <input type="text"
                                            class="form-control"
                                            name="contanor3_heading"
                                            placeholder="Enter heading text"
                                            value="{{ $eventContent->contanor3_heading ?? old('contanor3_heading') }}">
                                    </div>

                                    <div class="col-12 mt-2" id="prod_mom">
                                        <label for="contanor3_data"
                                            class="form-label">Proud Moment
                                            Images</label>

                                        @if (!empty($eventContent->contanor3_data))
                                            @foreach ($eventContent->contanor3_data as $index => $data2)
                                                <div
                                                    class="row mb-2 moment-row">
                                                    <div class="col-md-10">
                                                        <input type="file"
                                                            class="form-control"
                                                            name="contanor3_data[]"
                                                            id="contanor3_data_{{ $index }}"
                                                            value="{{ $data2 }}">

                                                        <input type="hidden"
                                                            class="form-control"
                                                            name="contanor3_data[]"
                                                            value="{{ $data2 }}">
                                                        <small
                                                            class="text-muted"
                                                            id="file-name-{{ $index }}">
                                                            @if ($data2)
                                                                Current file:
                                                                {{ $data2 }}
                                                            @else
                                                                No file chosen
                                                            @endif
                                                        </small>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-info add-moment-img"><i
                                                                class="bi bi-plus-circle"></i></button>
                                                        <button type="button"
                                                            class="btn btn-danger remove-moment-img"
                                                            disabled><i
                                                                class="bi bi-dash-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row mb-2 moment-row">
                                                <div class="col-md-10">
                                                    <input type="file"
                                                        class="form-control"
                                                        name="contanor3_data[]">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-info add-moment-img"><i
                                                            class="bi bi-plus-circle"></i></button>
                                                    <button type="button"
                                                        class="btn btn-danger remove-moment-img"
                                                        disabled><i
                                                            class="bi bi-dash-circle"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <h6 class="mt-3">
                                        <b>Expand Area Section</b>
                                    </h6>
                                    {{-- <div class="col-12 mt-2">
                                        <label for="contanor4_heading"
                                            class="form-label">Heading</label>
                                        <input type="text"
                                            class="form-control"
                                            name="contanor4_heading"
                                            placeholder="Enter heading text"
                                            value="{{ old('contanor4_heading') }}">
                                    </div> --}}

                                    <div class="col-12 mt-2" id="points">
                                        <label for="contanor4_data"
                                            class="form-label">Points
                                            Text</label>
                                        @if (!empty($eventContent->contanor4_data))
                                            @foreach ($eventContent->contanor4_data as $key => $data3)
                                                <div
                                                    class="row mb-2 point-row">
                                                    <div class="col-md-10">
                                                        <input type="text"
                                                            class="form-control"
                                                            name="contanor4_data[]"
                                                            value="{{ $data3 }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-info add-point-text"><i
                                                                class="bi bi-plus-circle"></i></button>
                                                        <button type="button"
                                                            class="btn btn-danger remove-point-text"
                                                            disabled><i
                                                                class="bi bi-dash-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row mb-2 point-row">
                                                <div class="col-md-10">
                                                    <input type="text"
                                                        class="form-control"
                                                        name="contanor4_data[]">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-info add-point-text"><i
                                                            class="bi bi-plus-circle"></i></button>
                                                    <button type="button"
                                                        class="btn btn-danger remove-point-text"
                                                        disabled><i
                                                            class="bi bi-dash-circle"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <h6 class="mt-3">
                                        <b>Why Need Section</b>
                                    </h6>
                                    <div class="col-12 mt-2">
                                        <label for="contanor5_heading"
                                            class="form-label">Heading</label>
                                        <input type="text"
                                            class="form-control"
                                            name="contanor5_heading"
                                            placeholder="Enter heading text"
                                            value="{{ $eventContent->contanor5_heading ?? old('contanor5_heading') }}">
                                    </div>

                                    <div class="col-12 mt-2" id="need">
                                        <label for="contanor5_data"
                                            class="form-label">Points
                                            Text</label>

                                        @if (!empty($eventContent->contanor4_data))
                                            @foreach ($eventContent->contanor4_data as $key => $data4)
                                                <div
                                                    class="row mb-2 need-row">
                                                    <div class="col-md-10">
                                                        <input type="text"
                                                            class="form-control"
                                                            name="contanor5_data[]"
                                                            value="{{ $data4 }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-info add-need-text"><i
                                                                class="bi bi-plus-circle"></i></button>
                                                        <button type="button"
                                                            class="btn btn-danger remove-need-text"
                                                            disabled><i
                                                                class="bi bi-dash-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row mb-2 need-row">
                                                <div class="col-md-10">
                                                    <input type="text"
                                                        class="form-control"
                                                        name="contanor5_data[]">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-info add-need-text"><i
                                                            class="bi bi-plus-circle"></i></button>
                                                    <button type="button"
                                                        class="btn btn-danger remove-need-text"
                                                        disabled><i
                                                            class="bi bi-dash-circle"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <h6 class="mt-3">
                                        <b>Achivers Section</b>
                                    </h6>
                                    <div class="col-12 mt-2">
                                        <label for="contanor6_heading"
                                            class="form-label">Heading</label>
                                        <input type="text"
                                            class="form-control"
                                            name="contanor6_heading"
                                            placeholder="Enter heading text"
                                            value="{{ $eventContent->contanor6_heading ?? old('contanor6_heading') }}">
                                    </div>

                                    <div class="col-12 mt-2" id="achivers">
                                        <label for="contanor6_data"
                                            class="form-label">Images</label>
                                        @if (!empty($eventContent->contanor6_data))
                                            @foreach ($eventContent->contanor6_data as $index => $data5)
                                                <div
                                                    class="row mb-2 achivers-row">
                                                    <div class="col-md-10">
                                                        <input type="file"
                                                            class="form-control"
                                                            name="contanor6_data[]"
                                                            id="contanor6_data_{{ $index }}"
                                                            value="{{ $data5 }}">

                                                        <input type="hidden"
                                                            class="form-control"
                                                            name="contanor6_data[]"
                                                            value="{{ $data5 }}">

                                                        <small
                                                            class="text-muted"
                                                            id="file-name-{{ $index }}">
                                                            @if ($data5)
                                                                Current file:
                                                                {{ $data5 }}
                                                            @else
                                                                No file chosen
                                                            @endif
                                                        </small>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-info add-achivers-text"><i
                                                                class="bi bi-plus-circle"></i></button>
                                                        <button type="button"
                                                            class="btn btn-danger remove-achivers-text"
                                                            disabled><i
                                                                class="bi bi-dash-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div
                                                class="row mb-2 achivers-row">
                                                <div class="col-md-10">
                                                    <input type="file"
                                                        class="form-control"
                                                        name="contanor6_data[]">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-info add-achivers-text"><i
                                                            class="bi bi-plus-circle"></i></button>
                                                    <button type="button"
                                                        class="btn btn-danger remove-achivers-text"
                                                        disabled><i
                                                            class="bi bi-dash-circle"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <h6 class="mt-3">
                                        <b>About Trainer Section</b>
                                    </h6>
                                    <div class="col-12 mt-2">
                                        <label for="trainer_heading"
                                            class="form-label">Heading</label>
                                        <input type="text"
                                            class="form-control"
                                            name="trainer_heading"
                                            placeholder="Enter heading text"
                                            value="{{ $eventContent->trainer_heading ?? old('trainer_heading') }}">
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="trainer_sub_heading"
                                            class="form-label">Subheading</label>
                                        <input type="text"
                                            class="form-control"
                                            name="trainer_sub_heading"
                                            placeholder="Enter subheading text"
                                            value="{{ $eventContent->trainer_sub_heading ?? old('trainer_sub_heading') }}">
                                    </div>

                                    <div class="col-12 mt-2" id="tariner">
                                        <label for="trainer_data"
                                            class="form-label">Points
                                            Text</label>

                                        <div class="tariner-container">
                                            @if (!empty($eventContent->trainer_data))
                                                @foreach ($eventContent->trainer_data as $key => $data6)
                                                    <div
                                                        class="row mb-2 tariner-row">
                                                        <div
                                                            class="col-md-10">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="trainer_data[]"
                                                                value="{{ $data6 }}">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button
                                                                type="button"
                                                                class="btn btn-info add-tariner-text"><i
                                                                    class="bi bi-plus-circle"></i></button>
                                                            <button
                                                                type="button"
                                                                class="btn btn-danger remove-tariner-text"
                                                                {{ $loop->first ? 'disabled' : '' }}><i
                                                                    class="bi bi-dash-circle"></i></button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div
                                                    class="row mb-2 tariner-row">
                                                    <div class="col-md-10">
                                                        <input type="text"
                                                            class="form-control"
                                                            name="trainer_data[]">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-info add-tariner-text"><i
                                                                class="bi bi-plus-circle"></i></button>
                                                        <button type="button"
                                                            class="btn btn-danger remove-tariner-text"
                                                            disabled><i
                                                                class="bi bi-dash-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>


                                    </div>
                                </div>

                                <h6 class="mt-3">
                                    <b>Bonus Section</b>
                                </h6>
                                <div class="col-12 mt-2">
                                    <label for="bonus_heading"
                                        class="form-label">Heading</label>
                                    <input type="text"
                                        class="form-control"
                                        name="bonus_heading"
                                        placeholder="Enter heading text"
                                        value="{{ $eventContent->bonus_heading ?? old('bonus_heading') }}">
                                </div>

                                <div class="col-12 mt-2">
                                    <label for="bonus_sub_heading"
                                        class="form-label">Subheading</label>
                                    <input type="text"
                                        class="form-control"
                                        name="bonus_sub_heading"
                                        placeholder="Enter subheading text"
                                        value="{{ $eventContent->bonus_sub_heading ?? old('bonus_sub_heading') }}">
                                </div>

                                <div class="col-12 mt-2">
                                    <label for="bonus_price"
                                        class="form-label">Bonus
                                        Price</label>
                                    <input type="text"
                                        class="form-control"
                                        name="bonus_price"
                                        placeholder="Enter subheading text"
                                        value="{{ $eventContent->bonus_price ?? old('bonus_price') }}">
                                </div>

                                <div class="col-12 mt-2" id="bouns">
                                    <label for="bonus_data"
                                        class="form-label">Images</label>
                                    {{-- <div class="bouns-container">
                                        <div class="row mb-2 bouns-row">
                                            <div class="col-md-10">
                                                <input type="file"
                                                    class="form-control"
                                                    name="bonus_data[]">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button"
                                                    class="btn btn-info add-bouns"><i
                                                        class="bi bi-plus-circle"></i></button>
                                                <button type="button"
                                                    class="btn btn-danger remove-bouns"
                                                    disabled><i
                                                        class="bi bi-dash-circle"></i></button>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="bouns-container">
                                        @if (!empty($eventContent->bonus_data))
                                            @foreach ($eventContent->bonus_data as $index => $data6)
                                                <div
                                                    class="row mb-2 bouns-row">
                                                    <div class="col-md-10">
                                                        <input type="file"
                                                            class="form-control"
                                                            name="bonus_data[]"
                                                            id="bonus_data_{{ $index }}"
                                                            value="{{ $data6 }}">
                                                        <input type="hidden"
                                                            class="form-control"
                                                            name="bonus_data[]"
                                                            value="{{ $data6 }}">
                                                        <small
                                                            class="text-muted"
                                                            id="bonus-file-name-{{ $index }}">
                                                            @if ($data5)
                                                                Current file:
                                                                {{ $data6 }}
                                                            @else
                                                                No file chosen
                                                            @endif
                                                        </small>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-info add-bouns"><i
                                                                class="bi bi-plus-circle"></i></button>
                                                        <button type="button"
                                                            class="btn btn-danger remove-bouns"
                                                            disabled><i
                                                                class="bi bi-dash-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row mb-2 bouns-row">
                                                <div class="col-md-10">
                                                    <input type="file"
                                                        class="form-control"
                                                        name="bonus_data[]">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-info add-bouns"><i
                                                            class="bi bi-plus-circle"></i></button>
                                                    <button type="button"
                                                        class="btn btn-danger remove-bouns"
                                                        disabled><i
                                                            class="bi bi-dash-circle"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <h6 class="mt-3">
                                    <b>What learn Section</b>
                                </h6>
                                <div class="col-12 mt-2">
                                    <label for="learn_heading"
                                        class="form-label">Heading</label>
                                    <input type="text"
                                        class="form-control"
                                        name="learn_heading"
                                        placeholder="Enter heading text"
                                        value="{{ $eventContent->learn_heading ?? old('learn_heading') }}">
                                </div>

                                <div class="col-12 mt-2">
                                    <label for="learn_sub_heading"
                                        class="form-label">Subheading</label>
                                    <input type="text"
                                        class="form-control"
                                        name="learn_sub_heading"
                                        placeholder="Enter subheading text"
                                        value="{{ $eventContent->learn_sub_heading ?? old('learn_sub_heading') }}">
                                </div>

                                <div class="col-12 mt-2" id="learn_will">
                                    <label for="learn_data"
                                        class="form-label">Points</label>
                                    <div class="learn_will-container">


                                        @if (!empty($eventContent->learn_data))
                                            @foreach ($eventContent->learn_data as $key => $data7)
                                                <div
                                                    class="row mb-2 learn_will-row">
                                                    <div class="col-md-10">
                                                        <input type="text"
                                                            class="form-control"
                                                            name="learn_data[]"
                                                            value="{{ $data7 }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-info add-learn_will"><i
                                                                class="bi bi-plus-circle"></i></button>
                                                        <button type="button"
                                                            class="btn btn-danger remove-learn_will"
                                                            disabled><i
                                                                class="bi bi-dash-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div
                                                class="row mb-2 learn_will-row">
                                                <div class="col-md-10">
                                                    <input type="text"
                                                        class="form-control"
                                                        name="learn_data[]">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-info add-learn_will"><i
                                                            class="bi bi-plus-circle"></i></button>
                                                    <button type="button"
                                                        class="btn btn-danger remove-learn_will"
                                                        disabled><i
                                                            class="bi bi-dash-circle"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="btn btn-primary float-end mt-3">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            // close alert automatically after 3 seconds
            $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                $(".alert").slideUp(500);
            });

            $('#contanor1_col1_contant_type').change(function() {
                let contentType = $(this).val();
                let contentWrapper = $('#content-wrapper');

                if (contentType === 'video') {
                    contentWrapper.html(`
                    <input type="text" class="form-control" name="contanor1_col1_contant" id="contanor1_col1_contant" placeholder="Enter video URL">
                    <small class="text-black">Please upload video in Vimeo and paste the link here</small>
                `);
                } else {
                    contentWrapper.html(`
                    <input type="file" class="form-control" name="contanor1_col1_contant" id="contanor1_col1_contant">
                    @if (
                        $eventContent->contanor1_col1_contant_type == 'image' &&
                            $eventContent->contanor1_col1_contant)
                        <img src="{{ asset($eventContent->contanor1_col1_contant) }}" alt="Current Image" style="max-width: 150px;" class="img-fluid mb-2">
                    @else
                        <small class="text-black">Please upload video in Vimeo and paste the link here</small>
                    @endif
                `);
                }
            });
        });
        $(document).ready(function() {
            // Initially hide price and original price containers if event type is 'free'
            if ($('#event_type').val() === 'free') {
                $('#priceContainer').hide();
                $('#originalPriceContainer').hide();
            }

            // Handle change event of event type select
            $('#event_type').change(function() {
                if ($(this).val() === 'free') {
                    $('#priceContainer').hide();
                    $('#originalPriceContainer').hide();
                } else {
                    $('#priceContainer').show();
                    $('#originalPriceContainer').show();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($eventContent->contanor3_data as $index => $data2)
                document.getElementById(
                        'contanor3_data_{{ $index }}')
                    .addEventListener('change', function(event) {
                        var fileName = event.target.files.length >
                            0 ? event.target.files[0].name :
                            'No file chosen';
                        document.getElementById(
                                'file-name-{{ $index }}')
                            .textContent = fileName;
                    });
            @endforeach
        });

        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($eventContent->contanor6_data as $index => $data2)
                document.getElementById(
                        'contanor6_data_{{ $index }}')
                    .addEventListener('change', function(event) {
                        var fileName = event.target.files.length >
                            0 ? event.target.files[0].name :
                            'No file chosen';
                        document.getElementById(
                                'file-name-{{ $index }}')
                            .textContent = fileName;
                    });
            @endforeach
        });

        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($eventContent->bonus_data as $index => $data6)
                document.getElementById(
                        'bonus_data_{{ $index }}')
                    .addEventListener('change', function(event) {
                        var fileName = event.target.files.length >
                            0 ? event.target.files[0].name :
                            'No file chosen';
                        document.getElementById(
                                'bonus-file-name-{{ $index }}'
                            )
                            .textContent = fileName;
                    });
            @endforeach
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to set the minimum date to today
            function setMinDate(selector) {
                const today = new Date();
                const yyyy = today.getFullYear();
                const mm = String(today.getMonth() + 1).padStart(2,
                    '0');
                const dd = String(today.getDate()).padStart(2, '0');
                const formattedToday = `${yyyy}-${mm}-${dd}`;
                $(selector).attr('min', formattedToday).val(
                    formattedToday);
            }

            // Function to set the minimum time to now
            function setMinTime(selector) {
                const now = new Date();
                const hh = String(now.getHours()).padStart(2, '0');
                const mm = String(now.getMinutes()).padStart(2, '0');
                const formattedNow = `${hh}:${mm}`;
            }

            // Initial setting of date and time
            setMinDate('#event_date');
            // setMinTime('#event_start_time');
            // setMinTime('#event_end_time');

            function setDefaultTimes() {
                let now = new Date();

                // Format current time for start time
                let hours = String(now.getHours()).padStart(2, '0');
                let minutes = String(now.getMinutes()).padStart(2,
                    '0');
                let startTime = hours + ':' + minutes;

                // Add 30 minutes to the current time for end time
                let endTime = new Date(now.getTime() + 300 *
                    6000); // 30 minutes in milliseconds
                let endHours = String(endTime.getHours()).padStart(2,
                    '0');
                let endMinutes = String(endTime.getMinutes()).padStart(
                    2, '0');
                let formattedEndTime = endHours + ':' + endMinutes;

                // Set the values
                $('#event_start_time').val(startTime);
                $('#event_end_time').val(formattedEndTime);
            }

            $(document).ready(function() {
                // setDefaultTimes();
                // calculateEventDuration();
            });
        });

        function calculateEventDuration() {
            let event_date = $('#event_date').val();
            let start_time = $('#event_start_time').val();
            let end_time = $('#event_end_time').val();

            if (event_date && start_time && end_time) {
                let startDateTime = new Date(event_date + 'T' + start_time);
                let endDateTime = new Date(event_date + 'T' + end_time);

                if (endDateTime <= startDateTime) {
                    alert('End time must be later than start time.');
                    return;
                }

                let durationInMilliseconds = endDateTime - startDateTime;
                let durationInMinutes = durationInMilliseconds / (1000 * 60);
                let durationInHours = durationInMinutes / 60;

                if (durationInHours === 1) {
                    $('#event_duration').val('1 Hour');
                } else if (durationInHours < 1) {
                    $('#event_duration').val(durationInMinutes + ' Minutes');
                } else {
                    $('#event_duration').val(durationInHours + ' Hours');
                }

                // // Optionally, update any display elements with the duration
                // $('#durationResult').text('Event Duration: ' + (durationInHours >= 1 ? durationInHours.toFixed(2) + ' hours' : durationInMinutes.toFixed(2) + ' minutes'));
            } else {
                alert('Please ensure all fields are filled out.');
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            function updateRemoveButtons() {
                let total = $('.achievement-row').length;
                if (total > 0) {
                    $('.remove-achievement').removeAttr('disabled');
                } else {
                    $('.remove-achievement').attr('disabled',
                        'disabled');
                }
            }

            $(document).on('click', '.add-achievement', function() {
                let newAchievement = `
                    <div class="row mb-2 achievement-row">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="contanor2_data[]" placeholder="Enter achievement text">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-info add-achievement"><i class="bi bi-plus-circle"></i></button>
                            <button type="button" class="btn btn-danger remove-achievement"><i class="bi bi-dash-circle"></i></button>
                        </div>
                    </div>`;
                $('#achievements').append(newAchievement);
                updateRemoveButtons();
            });

            $(document).on('click', '.remove-achievement', function() {
                $(this).closest('.achievement-row').remove();
                updateRemoveButtons();
            });

            updateRemoveButtons();
        });

        $(document).ready(function() {
            function updateMomRemoveButtons() {
                let total = $('.moment-row').length;
                if (total > 1) {
                    $('.remove-moment-img').removeAttr('disabled');
                } else {
                    $('.remove-moment-img').attr('disabled',
                        'disabled');
                }
            }

            $(document).on('click', '.add-moment-img', function() {
                let newMoment = `
            <div class="row mb-2 moment-row">
                <div class="col-md-10">
                    <input type="file" class="form-control" name="contanor3_data[]">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-info add-moment-img"><i class="bi bi-plus-circle"></i></button>
                    <button type="button" class="btn btn-danger remove-moment-img"><i class="bi bi-dash-circle"></i></button>
                </div>
            </div>`;
                $('#prod_mom').append(newMoment);
                updateMomRemoveButtons();
            });

            $(document).on('click', '.remove-moment-img', function() {
                $(this).closest('.moment-row').remove();
                updateMomRemoveButtons();
            });

            updateMomRemoveButtons();
        });

        $(document).ready(function() {
            function updatepointRemoveButtons() {
                let total = $('.point-row').length;
                if (total > 1) {
                    $('.remove-point-text').removeAttr('disabled');
                } else {
                    $('.remove-point-text').attr('disabled',
                        'disabled');
                }
            }

            $(document).on('click', '.add-point-text', function() {
                let newPoint = `
            <div class="row mb-2 point-row">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="contanor4_data[]">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-info add-point-text"><i class="bi bi-plus-circle"></i></button>
                    <button type="button" class="btn btn-danger remove-point-text"><i class="bi bi-dash-circle"></i></button>
                </div>
            </div>`;
                $('#points').append(newPoint);
                updatepointRemoveButtons();
            });

            $(document).on('click', '.remove-point-text', function() {
                $(this).closest('.point-row').remove();
                updatepointRemoveButtons();
            });

            updatepointRemoveButtons();
        });

        $(document).ready(function() {
            function updateRemoveButtons() {
                let total = $('.need-row').length;
                if (total > 1) {
                    $('.remove-need-text').removeAttr('disabled');
                } else {
                    $('.remove-need-text').attr('disabled',
                        'disabled');
                }
            }

            $(document).on('click', '.add-need-text', function() {
                let newNeed = `
                    <div class="row mb-2 need-row">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="contanor5_data[]">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-info add-need-text"><i class="bi bi-plus-circle"></i></button>
                            <button type="button" class="btn btn-danger remove-need-text"><i class="bi bi-dash-circle"></i></button>
                        </div>
                    </div>`;
                $('#need').append(newNeed);
                updateRemoveButtons();
            });

            $(document).on('click', '.remove-need-text', function() {
                $(this).closest('.need-row').remove();
                updateRemoveButtons();
            });

            updateRemoveButtons();
        });

        $(document).ready(function() {
            function updateAchiversRemoveButtons() {
                let total = $('.achivers-row').length;
                if (total > 1) {
                    $('.remove-achivers-text').removeAttr('disabled');
                } else {
                    $('.remove-achivers-text').attr('disabled',
                        'disabled');
                }
            }

            $(document).on('click', '.add-achivers-text', function() {
                let newAchivers = `
            <div class="row mb-2 achivers-row">
                <div class="col-md-10">
                    <input type="file" class="form-control" name="contanor6_data[]">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-info add-achivers-text"><i class="bi bi-plus-circle"></i></button>
                    <button type="button" class="btn btn-danger remove-achivers-text"><i class="bi bi-dash-circle"></i></button>
                </div>
            </div>`;
                $('#achivers').append(newAchivers);
                updateAchiversRemoveButtons();
            });

            $(document).on('click', '.remove-achivers-text',
                function() {
                    $(this).closest('.achivers-row').remove();
                    updateAchiversRemoveButtons();
                });

            updateAchiversRemoveButtons();
        });

        $(document).ready(function() {
            // Function to update the state of remove buttons
            function updatetrainerRemoveButtons() {
                var totalItems = $('.tariner-row').length;
                // Disable remove button if there is only one item
                $('.remove-tariner-text').prop('disabled',
                    totalItems === 1);
            }

            // Add new item
            $(document).on('click', '.add-tariner-text', function() {
                var newItem = `
        <div class="row mb-2 tariner-row">
            <div class="col-md-10">
                <input type="text" class="form-control" name="trainer_data[]">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-info add-tariner-text"><i class="bi bi-plus-circle"></i></button>
                <button type="button" class="btn btn-danger remove-tariner-text"><i class="bi bi-dash-circle"></i></button>
            </div>
        </div>`;
                $('.tariner-container').append(newItem);
                updatetrainerRemoveButtons
                    (); // Update remove button status
            });

            // Remove item
            $(document).on('click', '.remove-tariner-text',
                function() {
                    $(this).closest('.tariner-row')
                        .remove(); // Remove the closest row
                    updatetrainerRemoveButtons
                        (); // Update remove button status
                });

            updatetrainerRemoveButtons(); // Initial check on page load
        });


        $(document).ready(function() {
            // Function to update the state of remove buttons
            function updateBonusRemoveButtons() {
                var totalItems = $('.bouns-row').length;
                // Disable remove button if there is only one item
                $('.remove-bouns').prop('disabled', totalItems === 1);
            }

            // Add new item
            $(document).on('click', '.add-bouns', function() {
                var newItem = `
            <div class="row mb-2 bouns-row">
                <div class="col-md-10">
                    <input type="file" class="form-control" name="bonus_data[]">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-info add-bouns"><i class="bi bi-plus-circle"></i></button>
                    <button type="button" class="btn btn-danger remove-bouns"><i class="bi bi-dash-circle"></i></button>
                </div>
            </div>`;
                $('.bouns-container').append(newItem);
                updateBonusRemoveButtons
                    (); // Update remove button status
            });

            // Remove item
            $(document).on('click', '.remove-bouns', function() {
                $(this).closest('.bouns-row')
                    .remove(); // Remove the closest row
                updateBonusRemoveButtons
                    (); // Update remove button status
            });

            updateBonusRemoveButtons(); // Initial check on page load
        });

        $(document).ready(function() {
            // Function to update the state of remove buttons
            function updatewillLearnRemoveButtons() {
                var totalItems = $('.learn_will-row').length;
                // Disable remove button if there is only one item
                $('.remove-learn_will').prop('disabled', totalItems ===
                    1);
            }

            // Add new item
            $(document).on('click', '.add-learn_will', function() {
                var newItem = `
            <div class="row mb-2 learn_will-row">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="learn_data[]">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-info add-learn_will"><i class="bi bi-plus-circle"></i></button>
                    <button type="button" class="btn btn-danger remove-learn_will"><i class="bi bi-dash-circle"></i></button>
                </div>
            </div>`;
                $('.learn_will-container').append(newItem);
                updatewillLearnRemoveButtons
                    (); // Update remove button status
            });

            // Remove item
            $(document).on('click', '.remove-learn_will', function() {
                $(this).closest('.learn_will-row')
                    .remove(); // Remove the closest row
                updatewillLearnRemoveButtons
                    (); // Update remove button status
            });

            updatewillLearnRemoveButtons
                (); // Initial check on page load
        });
    </script>
@endsection
