@extends('admin.layouts.niceapp')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection__choice {
            background-color: var(--bs-gray-200);
            border: none !important;
            font-size: 12px;
            font-size: 0.85rem !important;
        }
    </style>
@endsection

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Message</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Send Message</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Send Message</h5>

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
                    <form class="form-horizontal style-form mt-3" action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6 mt-2">
                                <div class="row">
                                    <label class="col-md-4 control-label">
                                        Template Type
                                    </label>
                                    <div class="col-md-8">
                                        <select name="type" id="type" class="form-select">
                                            <option value="">Select type</option>
                                            <option value="sms">SMS</option>
                                            <option value="whatsapp">Whatsapp</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <div class="row">
                                    <label class="col-md-4 control-label">
                                        Template
                                    </label>
                                    <div class="col-md-8">
                                        <select name="message_template_id" id="template_id" class="form-select">
                                            <option value="">Select template</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <div class="row">
                                    <label class="col-md-4 control-label">
                                        Schedule Date
                                    </label>
                                    <div class="col-md-8">
                                        <input type="date" name="schedule_date" id="schedule_date"
                                            value="{{ old('schedule_date') }}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <div class="row">
                                    <label class="col-md-4 control-label">
                                        Schedule Time
                                    </label>
                                    <div class="col-md-8">
                                        <input type="time" name="schedule_time" id="schedule_time"
                                            value="{{ old('schedule_time') }}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <div class="row">
                                    <label class="col-md-4 control-label">
                                        Event
                                    </label>
                                    <div class="col-md-8">
                                        <select class="form-select" aria-label="Default select" id="event"
                                            name="event_id">
                                            <option selected>Select event</option>
                                            @foreach ($events as $event)
                                                <option value="{{ $event->id }}">
                                                    {{ ucwords(str_replace('_', ' ', $event->event_name)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <div class="row">
                                    <label class="col-md-2 control-label">
                                        Recipients
                                    </label>
                                    <div class="col-md-10">
                                        <select class="form-control select2" id="sel2div"
                                            data-placeholder="Choose anything" multiple name="audience_ids[]">
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2" hidden>
                                <div class="row">
                                    <label class="col-md-2 control-label">
                                        Audience numbers
                                    </label>
                                    <div class="col-md-10">
                                        <select class="form-control select2" id="audience_numbers"
                                            data-placeholder="Choose anything" multiple name="audience_numbers[]">
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <div class="row">
                                    <label class="col-md-2 control-label">
                                        Message
                                    </label>
                                    <div class="col-md-10">
                                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // close alert automatically after 3 seconds
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);

            // get templates based on type selected (sms or whatsapp) ajax call
            $('#type').on('change', function() {
                var type = $(this).val();
                $.ajax({
                    url: "{{ route('get-templates') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "type": type
                    },
                    success: function(response) {
                        // set the template options
                        var templateOptions = '<option value="">Select template</option>';
                        $.each(response.templates, function(index, template) {
                            templateOptions += '<option value="' + template.id + '">' +
                                template.name + '</option>';
                        });

                        // set the template options
                        $('#template_id').html(templateOptions);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // get message based on template selected ajax call
            $('#template_id').on('change', function() {
                var template_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-message') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": template_id
                    },
                    success: function(response) {
                        // set the message
                        $('#message').val(response.message);

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('.select2').select2({
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
            });

            // get the audience based on event selected
            $('#event').on('change', function() {
                var event_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-audience') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "event_id": event_id
                    },
                    success: function(response) {
                        // set the audience options
                        var audienceOptions = '';
                        var audience_numbers = '';
                        $.each(response.audiences, function(index, audience) {
                            audienceOptions += '<option value="' + audience.id + '">' +
                                audience.name + '</option>';
                            audience_numbers += '<option value="' + audience.phone +
                                '">' +
                                audience.phone + '</option>';
                        });

                        // set the audience options
                        $('#sel2div').html(audienceOptions);
                        $('#audience_numbers').html(audience_numbers);

                        // default select all audience
                        $('#sel2div').val(response.audiences.map(function(audience) {
                            return audience.id;
                        })).trigger('change');

                        // default select all audience
                        $('#audience_numbers').val(response.audiences.map(function(audience) {
                            return audience.phone;
                        })).trigger('change');

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
