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
        </div>

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
                                        <select name="type" id="type" class="form-select" required>
                                            <option value="">Select type</option>
                                            <option value="sms">SMS</option>
                                            <option value="whatsapp">Whatsapp</option>
                                            <option value="email">Email</option>
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
                                        <select name="message_template_id" id="template_id" class="form-select" required>
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
                                            value="{{ old('schedule_date') }}" class="form-control" required>

                                        <input type="text" name="status" id="status" value="Schedule"
                                            class="form-control" hidden>
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
                                            value="{{ old('schedule_time') }}" class="form-control" required>
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
                                            <option value="">Select event</option>
                                            @foreach ($events as $event)
                                                <option value="{{ $event->id }}">
                                                    {{ ucwords(str_replace('_', ' ', $event->event_name)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2" id="sms_cont">
                                <div class="row">
                                    <label class="col-md-2 control-label">
                                        Recipients
                                    </label>
                                    <div class="col-md-7">
                                        <select class="form-control select2" id="sel2div"
                                            data-placeholder="Choose anything" multiple name="audience_ids[]">
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-danger btn-sm" id="deselect-all"
                                            id="adn">
                                            Deselect all
                                        </button>

                                        <!-- add new number -->
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#newnum" type="button">
                                            Add new
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="newnum" tabindex="-1" aria-labelledby="newnumLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="newnumLabel">
                                                            Add numbers or emails
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" name="phone[]" class="form-control"
                                                            id="new_phone_no" placeholder="Please enter mobile numbers or emails">

                                                        <!-- notice line if multiple numbers -->
                                                        <h6 class="text-primary mt-1">
                                                            <small>Please enter multiple numbers or emails separated by comma(,).</small>
                                                        </h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-primary"
                                                            id="add_number">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                            <div class="col-md-8 m-auto mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
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

                // if type is email change sel2div name to emails[]
                if (type == 'email') {
                    $('#sel2div').attr('name', 'emails[]');
                } else {
                    $('#sel2div').attr('name', 'audience_ids[]');
                }

                // // if type is email, show the email recipients
                // if (type == 'email') {
                //     $('#email_cont').show();
                //     $('#sms_cont').hide();
                // } else {
                //     $('#email_cont').hide();
                //     $('#sms_cont').show();
                // }

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

            $("#deselect-all").click(function() {
                $('#sel2div').val(null).trigger('change');
                $('#audience_numbers').val(null).trigger('change');

                // reset event
                $('#event').val(null).trigger('change');
            });

            // get the audience based on event selected
            $('#event').on('change', function() {
                var event_id = $(this).val();
                var type = $('#type').val();
                $.ajax({
                    url: "{{ route('get-audience') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "event_id": event_id,
                        "type": type
                    },
                    success: function(response) {
                        // set the audience options
                        var audienceOptions = '';
                        var audience_numbers = '';
                        var audience_emails = '';

                        // $.each(response.audiences, function(index, audience) {
                        //     // audienceOptions += '<option value="' + audience.id + '">' +
                        //     //     audience.name + '</option>';
                        //     audienceOptions += '<option value="' + audience.phone +
                        //         '">' +
                        //         audience.phone + '</option>';
                        //     audience_numbers += '<option value="' + audience.phone +
                        //         '">' +
                        //         audience.phone + '</option>';
                        // });

                        if (type == 'email') {
                            $('#sel2div').attr('name', 'emails[]');

                            $.each(response.audiences, function(index, audience) {
                                audienceOptions += '<option value="' + audience.email +
                                    '">' +
                                    audience.email + '</option>';
                                audience_numbers += '<option value="' + audience.phone +
                                    '">' +
                                    audience.phone + '</option>';
                            });
                        } else {
                            $('#sel2div').attr('name', 'audience_ids[]');
                            $.each(response.audiences, function(index, audience) {
                                // audienceOptions += '<option value="' + audience.id + '">' +
                                //     audience.name + '</option>';
                                audienceOptions += '<option value="' + audience.phone +
                                    '">' +
                                    audience.phone + '</option>';
                                audience_numbers += '<option value="' + audience.phone +
                                    '">' +
                                    audience.phone + '</option>';
                            });
                        }

                        // set the audience options
                        $('#sel2div').html(audienceOptions);
                        $('#audience_numbers').html(audience_numbers);

                        // default select all audience
                        // $('#sel2div').val(response.audiences.map(function(audience) {
                        //     return audience.phone;
                        // })).trigger('change');

                        if (type == 'email') {
                            $('#sel2div').val(response.audiences.map(function(audience) {
                                return audience.email;
                            })).trigger('change');
                        } else {
                            $('#sel2div').val(response.audiences.map(function(audience) {
                                return audience.phone;
                            })).trigger('change');
                        }

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

    <script>
        $(document).ready(function() {
            today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd
            }

            if (mm < 10) {
                mm = '0' + mm
            }

            var today = yyyy + '-' + mm + '-' + dd;

            $('#schedule_date').attr('min', today);

            // set default date to today
            $('#schedule_date').val(today);

            //===================================================================//

            // set default time to now
            var current = new Date();
            var hh = current.getHours();
            var mm = current.getMinutes();

            if (hh < 10) {
                hh = '0' + hh;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            var now = hh + ':' + mm;

            $('#schedule_time').attr('min', now);

            // // set default time to now
            // $('#schedule_time').val(now);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#add_number').on('click', function() {
                var new_phone_no = $('#new_phone_no').val();
                var new_phone_no_array = new_phone_no.split(',');

                // Check if sel2div is initialized as a Select2
                if ($('#sel2div').data('select2')) {
                    // If sel2div is not empty, add new numbers to sel2div
                    if ($('#sel2div').val().length > 0) {
                        var sel2div = $('#sel2div').val();
                        var sel2div_array = sel2div.concat(new_phone_no_array);

                        // Remove duplicates
                        var unique_array = Array.from(new Set(sel2div_array));

                        // call the function to change the select2 data
                        changeSelData(unique_array);

                        // // Set the new array to sel2div
                        // $('#sel2div').val(unique_array).trigger('change');
                    } else {
                        // call the function to change the select2 data
                        changeSelData(new_phone_no_array);

                        // // If sel2div is empty, set it to the new numbers
                        // $('#sel2div').val(new_phone_no_array).trigger('change');
                    }
                } else {
                    // If not initialized, initialize it
                    $('#sel2div').select2();

                    // Set it to the new numbers
                    $('#sel2div').val(new_phone_no_array).trigger('change');
                }

                // Close the modal
                $('#newnum').modal('hide');
            });

        });

        function changeSelData(data) {
            // set the audience options
            var audienceOptions = '';
            var audience_numbers = '';

            $.each(data, function(index, audience) {
                audienceOptions += '<option value="' + audience + '">' +
                    audience + '</option>';
                audience_numbers += '<option value="' + audience +
                    '">' +
                    audience + '</option>';
            });

            // set the audience options
            $('#sel2div').html(audienceOptions);
            $('#audience_numbers').html(audience_numbers);

            // default select all audience
            $('#sel2div').val(data.map(function(audience) {
                return audience;
            })).trigger('change');

            // default select all audience
            $('#audience_numbers').val(data.map(function(audience) {
                return audience;
            })).trigger('change');
        }

        $(document).ready(function() {
            // check onchange schedule_time if it is less than now
            $('#schedule_time').on('change', function() {
                var schedule_time = $(this).val();
                var now = new Date();
                var hh = now.getHours();
                var mm = now.getMinutes();

                if (hh < 10) {
                    hh = '0' + hh;
                }

                if (mm < 10) {
                    mm = '0' + mm;
                }

                var now = hh + ':' + mm;

                if (schedule_time < now) {
                    alert('Please select time greater than now');
                    $('#schedule_time').val(now);
                }
            });

            // // if change event and not empty, enable the adn button
            // $('#event').on('change', function() {
            //     var event_id = $(this).val();
            //     if (event_id != '') {
            //         $('#adn').prop('disabled', false);
            //     } else {
            //         $('#adn').prop('disabled', true);
            //     }
            // });
        });
    </script>
@endsection
