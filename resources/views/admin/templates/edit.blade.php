@extends('admin.layouts.niceapp')

@section('styles')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Templates</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Edit Template</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Template</h5>

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                                        aria-label="Close">
                                    </button>

                                    <strong>Error!</strong> Please fix the following issues:
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('templates.update', $template->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Template Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $template->name }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Template Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" id="type" class="form-control">
                                            <option value="sms" {{ $template->type == 'sms' ? 'selected' : '' }}>SMS
                                            </option>
                                            <option value="whatsapp" {{ $template->type == 'whatsapp' ? 'selected' : '' }}>
                                                Whatsapp</option>
                                            <option value="email" {{ $template->type == 'email' ? 'selected' : '' }}>
                                                Email</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3" style="display:none" id="temp_id">
                                    <label class="col-sm-3 col-form-label">Template Id</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="template_id"
                                            placeholder="Please enter your template id"
                                            value="{{ $template->template_id }}">
                                    </div>
                                </div>

                                @if ($template->type == 'email')
                                    <div class="row mb-3" id="if_mail" style="display:none">
                                        <label class="col-sm-3 col-form-label">CC</label>
                                        <div class="col-sm-9">
                                            @foreach ($template->cc as $cc)
                                                <input type="text" class="form-control" name="cc[]"
                                                    placeholder="test@test.com testuser" value="{{ $cc }}">
                                            @endforeach

                                            <!-- notice line if multiple numbers -->
                                            <h6 class="text-info mt-1">
                                                <small>
                                                    Please enter email addresses first, followed by names with spaces. If
                                                    entering multiple entries, separate them with commas(,).
                                                </small>
                                            </h6>
                                        </div>

                                        <label class="col-sm-3 col-form-label">BCC</label>
                                        <div class="col-sm-9">
                                            @foreach ($template->bcc as $bcc)
                                                <input type="text" class="form-control" name="bcc[]"
                                                    placeholder="test@test.com testuser" value="{{ $bcc }}">
                                            @endforeach

                                            <!-- notice line if multiple numbers -->
                                            <h6 class="text-info mt-1">
                                                <small>
                                                    Please enter email addresses first, followed by names with spaces. If
                                                    entering multiple entries, separate them with commas(,).
                                                </small>
                                            </h6>
                                        </div>

                                        <label class="col-sm-3 col-form-label">Subject</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="subject"
                                                placeholder="Please enter subject" value="{{ $template->subject }}">
                                        </div>
                                    </div>
                                @endif


                                @if ($template->type == 'email' || $template->type == 'whatsapp')
                                    <div class="row mb-3" style="display:none" id="md_file">
                                        <label class="col-sm-3 col-form-label">Media File</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="media_file">

                                            <span class="mt-2">
                                                @if ($template->media_file)
                                                    <a href="{{ asset($template->media_file) }}" target="_blank">View
                                                        File</a>
                                                @else
                                                    No file uploaded
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <label for="inputText" class="col-md-3 col-form-label">
                                        Message
                                        {{-- <span class="text-danger">*</span> --}}
                                    </label>
                                    <div class="col-md-9">
                                        <textarea id="message" name="message" class="form-control" rows="10">{{ $template->message }}</textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary float-end mt-3">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Variables</h5>
                            <p>
                                Variables are used to replace the values of the variables in the template.
                            </p>
                            <div>
                                <ul style="list-style: none" data-name="name" class="text-center">
                                    <li id="name">
                                        <span class="badge bg-primary">Name</span>
                                    </li>
                                    <li id="phone">
                                        <span class="badge bg-primary">Mobile</span>
                                    </li>
                                    <li id="email">
                                        <span class="badge bg-primary">Email</span>
                                    </li>
                                    <li id="event">
                                        <span class="badge bg-primary">Event</span>
                                    </li>
                                    <li id="date">
                                        <span class="badge bg-primary">Date</span>
                                    </li>
                                    <li id="time">
                                        <span class="badge bg-primary">Time</span>
                                    </li>
                                    <li id="link">
                                        <span class="badge bg-primary">Link</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                $(".alert").slideUp(500);
            });

            // if type is whatsapp then show fields
            $('#type').on('change', function() {
                var type = $(this).val();
                changefields(type);
            });

            // check onload page type
            var type = $('#type').val();
            changefields(type);
        });

        // if select or click on variable then add it to the editor at the cursor position
        $('ul[data-name]').on('click', 'li', function() {
            var name = $(this).attr('id');
            var message = $('#message').val();
            var cursorPos = $('#message').prop('selectionStart');
            var v = $('#message').val();
            var textBefore = v.substring(0, cursorPos);
            var textAfter = v.substring(cursorPos, v.length);
            $('#message').val(textBefore + '{' + name + '}' + textAfter);
        });

        function changefields(type) {
            if (type == 'whatsapp') {
                $('#md_file').show();
                $('#temp_id').hide();
                $('#if_mail').hide();
            } else if (type == 'email') {
                $('#if_mail').show();
                $('#md_file').show();
                $('#temp_id').hide();
            } else if (type == 'sms') {
                $('#temp_id').show();
                $('#md_file').hide();
                $('#if_mail').hide();
            }
        }
    </script>
@endsection
