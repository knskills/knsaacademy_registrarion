@extends('admin.layouts.niceapp')

@section('styles')
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet" />
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
                    <li class="breadcrumb-item"><a
                            href="{{ route('dashboard') }}">Home</a></li>
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
                                    <li class="text-danger">{{ $error }}
                                    </li>
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

                    <form action="{{ route('messages.store') }}"
                        method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6 mt-2">
                                <label for="type" class="form-label">
                                    Template Type</label>
                                <select name="type" id="type"
                                    class="form-select" required>
                                    <option value="">Select Type
                                    </option>
                                    <option value="sms">SMS</option>
                                    <option value="whatsapp">Whatsapp
                                    </option>
                                    <option value="email">Email
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="template_id" class="form-label">
                                    Template</label>
                                <select name="message_template_id"
                                    id="template_id" class="form-select"
                                    required>
                                    <option value="">Select
                                        Template</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="event_id" class="form-label">
                                    Event</label>
                                <select class="form-select"
                                    aria-label="Default select" id="event"
                                    name="event_id">
                                    <option value="">Select event
                                    </option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">
                                            {{ ucwords(str_replace('_', ' ', $event->event_name)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="file" class="form-label">
                                    Import</label>
                                <input id="fileupload" class="form-control"
                                    type="file" name="files[]">
                            </div>

                            <div class="col-md-12" id="scheduler_div">
                                <div class="row my-2" id="sedule_timing1">
                                    <div class="col-md-5">
                                        <label for="schedule_date1" class="form-label">Schedule Date</label>
                                        <input type="date" name="schedule_date[]" id="schedule_date1" value="{{ old('schedule_date') }}" class="form-control" required>
                                        <input type="text" name="status[]" id="status1" value="Schedule" class="form-control" hidden>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="schedule_time1" class="form-label">Schedule Time</label>
                                        <input type="time" name="schedule_time[]" id="schedule_time1" value="{{ old('schedule_time') }}" class="form-control" required>
                                    </div>

                                    <div class="col-md-2 m-auto">
                                        <a id="add1" class="btn btn-primary mt-4 add-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-plus-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg></a>
                                        <a id="del1" class="btn btn-danger mt-4 del-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-dash-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/></svg></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 my-4" id="sms_cont">
                                <div class="row">
                                    <label class="col-md-2 mt-2">
                                        Recipients
                                    </label>
                                    <div class="col-md-7 mt-2">
                                        <select class="form-control select2"
                                            id="sel2div"
                                            data-placeholder="Choose anything"
                                            multiple name="audience_ids[]">
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <button type="button"
                                            class="btn btn-danger btn-sm mt-2"
                                            id="deselect-all" id="adn">
                                            Deselect all
                                        </button>

                                        <!-- add new number -->
                                        <button
                                            class="btn btn-primary btn-sm mt-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#newnum"
                                            type="button">
                                            Add new
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade"
                                            id="newnum" tabindex="-1"
                                            aria-labelledby="newnumLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="newnumLabel">
                                                            Add numbers or
                                                            emails
                                                        </h5>
                                                        <button type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text"
                                                            name="phone[]"
                                                            class="form-control"
                                                            id="new_phone_no"
                                                            placeholder="Please enter mobile numbers or emails">

                                                        <!-- notice line if multiple numbers -->
                                                        <h6
                                                            class="text-primary mt-1">
                                                            <small>Please enter
                                                                multiple
                                                                numbers or
                                                                emails
                                                                separated by
                                                                comma(,).</small>
                                                        </h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button"
                                                            class="btn btn-primary"
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
                                        <select class="form-control select2"
                                            id="audience_numbers"
                                            data-placeholder="Choose anything"
                                            multiple
                                            name="audience_numbers[]">
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
                                        <textarea name="message" id="message" cols="30" rows="10"
                                            class="form-control" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="col-md-8 m-auto mt-3">
                                <button type="submit"
                                    class="btn btn-primary">Submit</button>
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
    <script
        src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/xlsx@0.18.0/dist/xlsx.full.min.js">
    </script>

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
                    $('#sel2div').attr('name',
                        'audience_ids[]');
                }

                $.ajax({
                    url: "{{ route('get-templates') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "type": type
                    },
                    success: function(response) {
                        // set the template options
                        var templateOptions =
                            '<option value="">Select template</option>';
                        $.each(response.templates,
                            function(index,
                                template) {
                                templateOptions
                                    +=
                                    '<option value="' +
                                    template
                                    .id +
                                    '">' +
                                    template
                                    .name +
                                    '</option>';
                            });

                        // set the template options
                        $('#template_id').html(
                            templateOptions);
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
                        $('#message').val(response
                            .message);

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
                $('#audience_numbers').val(null).trigger(
                    'change');

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

                        if (type == 'email') {
                            $('#sel2div').attr(
                                'name',
                                'emails[]');

                            $.each(response
                                .audiences,
                                function(index,
                                    audience) {
                                    audienceOptions
                                        +=
                                        '<option value="' +
                                        audience
                                        .email +
                                        '">' +
                                        audience
                                        .email +
                                        '</option>';
                                    audience_numbers
                                        +=
                                        '<option value="' +
                                        audience
                                        .phone +
                                        '">' +
                                        audience
                                        .phone +
                                        '</option>';
                                });
                        } else {
                            $('#sel2div').attr(
                                'name',
                                'audience_ids[]'
                            );
                            $.each(response
                                .audiences,
                                function(index,
                                    audience) {
                                    // audienceOptions += '<option value="' + audience.id + '">' +
                                    //     audience.name + '</option>';
                                    audienceOptions
                                        +=
                                        '<option value="' +
                                        audience
                                        .phone +
                                        '">' +
                                        audience
                                        .phone +
                                        '</option>';
                                    audience_numbers
                                        +=
                                        '<option value="' +
                                        audience
                                        .phone +
                                        '">' +
                                        audience
                                        .phone +
                                        '</option>';
                                });
                        }

                        // set the audience options
                        $('#sel2div').html(
                            audienceOptions);
                        $('#audience_numbers')
                            .html(
                                audience_numbers);

                        if (type == 'email') {
                            $('#sel2div').val(
                                    response
                                    .audiences.map(
                                        function(
                                            audience
                                        ) {
                                            return audience
                                                .email;
                                        }))
                                .trigger('change');
                        } else {
                            $('#sel2div').val(
                                    response
                                    .audiences.map(
                                        function(
                                            audience
                                        ) {
                                            return audience
                                                .phone;
                                        }))
                                .trigger('change');
                        }

                        // default select all audience
                        $('#audience_numbers').val(
                            response.audiences
                            .map(function(
                                audience) {
                                return audience
                                    .phone;
                            })).trigger(
                            'change');

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
            $('#add_number').on('click', function() {
                var new_phone_no = $('#new_phone_no').val();
                var new_phone_no_array = new_phone_no.split(
                    ',');

                // Check if sel2div is initialized as a Select2
                if ($('#sel2div').data('select2')) {
                    // If sel2div is not empty, add new numbers to sel2div
                    if ($('#sel2div').val().length > 0) {
                        var sel2div = $('#sel2div').val();
                        var sel2div_array = sel2div.concat(
                            new_phone_no_array);

                        // Remove duplicates
                        var unique_array = Array.from(new Set(
                            sel2div_array));

                        // call the function to change the select2 data
                        changeSelData(unique_array);

                    } else {
                        // call the function to change the select2 data
                        changeSelData(new_phone_no_array);
                    }
                } else {
                    // If not initialized, initialize it
                    $('#sel2div').select2();

                    // Set it to the new numbers
                    $('#sel2div').val(new_phone_no_array)
                        .trigger('change');
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
                audienceOptions += '<option value="' + audience +
                    '">' +
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
    </script>

    <script>
        $(document).ready(function() {
            var ExcelToJSON = function() {
                this.parseExcel = function(file) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var data = e.target.result;
                        // console.log(data);
                        var workbook = XLSX.read(data, {
                            type: 'binary'
                        });
                        workbook.SheetNames.forEach(
                            function(sheetName) {
                                var XL_row_object =
                                    XLSX.utils
                                    .sheet_to_row_object_array(
                                        workbook
                                        .Sheets[
                                            sheetName]
                                    );
                                var productList = JSON
                                    .parse(JSON
                                        .stringify(
                                            XL_row_object
                                        ));

                                var
                                    values = []; // Array to store the values for the textarea
                                var
                                    options = []; // Array to store the options for select2
                                for (var i = 0; i <
                                    productList
                                    .length; i++) {
                                    var columns =
                                        Object.values(
                                            productList[
                                                i]);
                                    values.push(
                                        columns[0]
                                    ); // Assuming the value you want is in the second column

                                    // Create options for select2
                                    options.push(
                                        `<option value="${columns[0]}">${columns[0]}</option>`
                                    );
                                }

                                var type = $('#type')
                                    .val();

                                if (type == 'email') {
                                    $('#sel2div').attr(
                                        'name',
                                        'emails[]');
                                } else {
                                    $('#sel2div').attr(
                                        'name',
                                        'audience_numbers[]'
                                    );
                                }

                                // Update the select2 options
                                $('#sel2div').html(
                                    options.join(
                                        ''));
                                // Set the values in select2
                                $('#sel2div').val(
                                        values)
                                    .trigger('change');


                            })
                    };
                    reader.onerror = function(ex) {
                        console.log(ex);
                    };

                    reader.readAsBinaryString(file);
                };
            };

            function handleFileSelect(evt) {
                var files = evt.target.files; // FileList object
                var xl2json = new ExcelToJSON();
                xl2json.parseExcel(files[0]);
            }

            document.getElementById('fileupload').addEventListener(
                'change', handleFileSelect, false);
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
                // $(selector).attr('min', formattedNow).val(
                // formattedNow);
            }

            // Initial setting of date and time
            setMinDate('#schedule_date1');
            setMinTime('#schedule_time1');

            let counter = 1;

            // Add new schedule
            $(document).on('click', '.add-btn', function() {
                counter++;
                const newRow = `
            <div class="row my-2" id="sedule_timing${counter}">
                <div class="col-md-5">
                    <label for="schedule_date${counter}" class="form-label">Schedule Date</label>
                    <input type="date" name="schedule_date[]" id="schedule_date${counter}" class="form-control" required>
                    <input type="text" name="status[]" id="status${counter}" value="Schedule" class="form-control" hidden>
                </div>
                <div class="col-md-5">
                    <label for="schedule_time${counter}" class="form-label">Schedule Time</label>
                    <input type="time" name="schedule_time[]" id="schedule_time${counter}" class="form-control" required>
                </div>
                <div class="col-md-2 m-auto">
                    <a id="add${counter}" class="btn btn-primary mt-4 add-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-plus-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg></a>
                    <a id="del${counter}" class="btn btn-danger mt-4 del-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-dash-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/></svg></a>
                </div>
            </div>`;
                $('#scheduler_div').append(newRow);
                setMinDate(`#schedule_date${counter}`);
                setMinTime(`#schedule_time${counter}`);
            });

            // Delete a schedule
            $(document).on('click', '.del-btn', function() {
                if ($('#scheduler_div .row').length > 1) {
                    $(this).closest('.row').remove();
                } else {
                    alert(
                    'At least one schedule is required.');
                }
            });

            // // Check onchange schedule_time if it is less than now
            // $(document).on('change', 'input[type="time"]', function() {
            //     const scheduleTime = $(this).val();
            //     const now = new Date();
            //     const hh = String(now.getHours()).padStart(2,
            //         '0');
            //     const mm = String(now.getMinutes()).padStart(2,
            //         '0');
            //     const currentTime = `${hh}:${mm}`;

            //     if (scheduleTime < currentTime) {
            //         alert(
            //             'Please select time greater than now');
            //         $(this).val(currentTime);
            //     }
            // });
        });
    </script>
@endsection
