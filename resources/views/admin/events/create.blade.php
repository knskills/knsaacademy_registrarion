@extends('admin.layouts.niceapp')

@section('styles')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">New Event</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Event</h5>

                    <div class="mt-5">
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

                    <form action="{{ route('events.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Event Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="event_name" value="Event 1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Event Type</label>
                                    <div class="col-md-8">
                                        <select name="event_type" id="event_type" class="form-select">
                                            <option value="free">Free</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--is_active-->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Is Active</label>
                                    <div class="col-md-8">
                                        <select name="is_active" id="is_active" class="form-select">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Event Date</label>
                                    <div class="col-md-8">
                                        <input type="date" name="event_date" id="event_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Event Start Time</label>
                                    <div class="col-md-8">
                                        <input type="time" name="event_start_time" id="event_start_time"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Event End Time</label>
                                    <div class="col-md-8">
                                        <input type="time" name="event_end_time" id="event_end_time"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!--price-->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Price</label>
                                    <div class="col-md-8">
                                        <input type="number" name="price" id="price" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- original_price -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Original Price</label>
                                    <div class="col-md-8">
                                        <input type="number" name="original_price" id="original_price"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- payment_link -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Payment Link</label>
                                    <div class="col-md-8">
                                        <input type="text" name="payment_link" id="payment_link" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- youtube_link -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Youtube Link</label>
                                    <div class="col-md-8">
                                        <input type="text" name="youtube_link" id="youtube_link" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- whatsapp_link -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Whatsapp Group Link</label>
                                    <div class="col-md-8">
                                        <input type="text" name="whatsapp_link" id="whatsapp_link"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- event_duration -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Event Duration</label>
                                    <div class="col-md-8">
                                        <input type="text" name="event_duration" id="event_duration"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- timer_time in minutes -->
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label">Timer Time(minutes)</label>
                                    <div class="col-md-8">
                                        <input type="number" name="timer_time" id="timer_time" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-end mt-3">
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
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);

            // // change event_time format to 12 hours
            // $('#event_time').on('change', function() {
            //     var time = $(this).val();
            //     var hours = time.split(':')[0];
            //     var minutes = time.split(':')[1];
            //     var ampm = hours >= 12 ? 'PM' : 'AM';
            //     hours = hours % 12;
            //     hours = hours ? hours : 12;
            //     hours = hours < 10 ? '0' + hours : hours;
            //     minutes = minutes < 10 ? '0' + minutes : minutes;
            //     var strTime = hours + ':' + minutes + ' ' + ampm;
            //     $(this).val(strTime);
            // });
        });
    </script>
@endsection
