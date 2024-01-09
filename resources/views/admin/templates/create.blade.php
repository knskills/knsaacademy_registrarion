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
                            <form action="{{ route('templates.store') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Template Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" value="Template 1">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Template Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" id="type" class="form-control">
                                            <option value="sms">SMS</option>
                                            <option value="whatsapp">Whatsapp</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="inputText" class="col-md-3 col-form-label">
                                        Message
                                        {{-- <span class="text-danger">*</span> --}}
                                    </label>
                                    <div class="col-md-9">
                                        <textarea id="message" name="message" class="form-control" rows="10">Hii</textarea>
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
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);
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
