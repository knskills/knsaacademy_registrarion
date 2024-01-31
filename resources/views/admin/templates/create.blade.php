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
                    <li class="breadcrumb-item">New Template</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Template</h5>

                            <div class="my-3">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show mt-5 error-message"
                                        role="alert">
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

                                @if (session('success'))
                                    <div class="alert alert-success sent-message">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>

                            <form action="{{ route('templates.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Template Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" value="" required placeholder="Please type your template name">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Template Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="">Select Template Type</option>
                                            <option value="sms">SMS</option>
                                            <option value="whatsapp">Whatsapp</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3" style="display:none" id="temp_id">
                                    <label class="col-sm-3 col-form-label">Template Id</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="template_id" placeholder="Please enter your template id">
                                    </div>
                                </div>

                                <div class="row mb-3" style="display:none" id="md_file">
                                    <label class="col-sm-3 col-form-label">Media File</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="media_file">
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="inputText" class="col-md-3 col-form-label">
                                        Message
                                        {{-- <span class="text-danger">*</span> --}}
                                    </label>
                                    <div class="col-md-9">
                                        <textarea id="message" name="message" class="form-control" rows="10" placeholder="Please type or paste your message" required></textarea>
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
            // close alert automatically after 3 seconds
            // setTimeout(function() {
            //     $(".alert").alert('close');
            // }, 3000);

            $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                $(".alert").slideUp(500);
            });

            // if type is whatsapp then show media file and type is sms then show template id
            $('#type').on('change', function() {
                var type = $(this).val();
                // temp_id md_file
                if (type == 'whatsapp') {
                    // $('div[style="display:none"]').show();
                    // $('div[style="display:none"]').next().show();
                    // $('div[style="display:none"]').next().next().hide();
                    // $('div[style="display:none"]').next().next().next().hide();
                    $('#md_file').show();
                    $('#temp_id').hide();
                } else {
                    // $('div[style="display:none"]').hide();
                    // $('div[style="display:none"]').next().hide();
                    // $('div[style="display:none"]').next().next().show();
                    // $('div[style="display:none"]').next().next().next().show();

                    $('#temp_id').show();
                    $('#md_file').hide();
                }
            });
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
    </script>
@endsection
