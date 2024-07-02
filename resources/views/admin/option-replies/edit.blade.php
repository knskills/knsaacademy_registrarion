@extends('admin.layouts.niceapp')

@section('styles')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Options</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Edit reply</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-9 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reply</h5>

                            @include('admin.layouts.messages')

                            <form
                                action="{{ route('auto-reply-options.update', $autoReplyOption->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label
                                        class="col-sm-3 col-form-label">Keyword<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <textarea id="keyword" name="keyword" class="form-control" rows="5"
                                            placeholder="Please type your keyword" required>{{ $autoReplyOption->keyword }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="inputText"
                                        class="col-md-3 col-form-label">Reply<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <textarea id="reply" name="reply" class="form-control" rows="7"
                                            placeholder="Please type your reply" required>{{ $autoReplyOption->reply }}</textarea>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn btn-primary float-end mt-3">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-lg-3">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Variables</h5>
                            <p>
                                Variables are used to replace the values of the
                                variables in the template.
                            </p>
                            <div>
                                <ul style="list-style: none" data-name="name"
                                    class="text-center">
                                    <li id="name">
                                        <span
                                            class="badge bg-primary">Name</span>
                                    </li>
                                    <li id="phone">
                                        <span
                                            class="badge bg-primary">Mobile</span>
                                    </li>
                                    <li id="email">
                                        <span
                                            class="badge bg-primary">Email</span>
                                    </li>
                                    <li id="event">
                                        <span
                                            class="badge bg-primary">Event</span>
                                    </li>
                                    <li id="date">
                                        <span
                                            class="badge bg-primary">Date</span>
                                    </li>
                                    <li id="time">
                                        <span
                                            class="badge bg-primary">Time</span>
                                    </li>
                                    <li id="link">
                                        <span
                                            class="badge bg-primary">Link</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
        });

        // // if select or click on variable then add it to the editor at the cursor position
        // $('ul[data-name]').on('click', 'li', function() {
        //     var name = $(this).attr('id');
        //     var message = $('#message').val();
        //     var cursorPos = $('#message').prop('selectionStart');
        //     var v = $('#message').val();
        //     var textBefore = v.substring(0, cursorPos);
        //     var textAfter = v.substring(cursorPos, v.length);
        //     $('#message').val(textBefore + '{' + name + '}' +
        //         textAfter);
        // });
    </script>
@endsection
