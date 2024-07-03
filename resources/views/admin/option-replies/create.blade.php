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
                    <li class="breadcrumb-item">New reply</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-9 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Chat reply</h5>

                            @include('admin.layouts.messages')

                            <form action="{{ route('auto-reply-options.store') }}"
                                id="templateForm" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label
                                        class="col-sm-3 col-form-label">Keyword</label>
                                    <div class="col-sm-9">
                                        <textarea id="keyword" name="keyword" class="form-control" rows="5"
                                        placeholder="Please type your keyword" required></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="inputText"
                                        class="col-md-3 col-form-label">Reply</label>
                                    <div class="col-md-9">
                                        <textarea id="reply" name="reply" class="form-control" rows="7"
                                            placeholder="Please type your reply" required></textarea>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn btn-primary float-end mt-3">Save</button>
                            </form>
                        </div>
                    </div>

                </div>

                {{-- <div class="col-lg-3">

                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Conditions</h5>
                            <p>
                                You can use the words given in the keyword and, or, if to form conditions.
                            </p>
                            <div>
                                <ul style="list-style: none" data-name="name"
                                    class="text-center">
                                    <li id="||">
                                        <span
                                            class="badge bg-primary">or</span>
                                    </li>
                                    <li id="&&">
                                        <span
                                            class="badge bg-primary">and</span>
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

        // if select or click on variable then add it to the editor at the cursor position
        $('ul[data-name]').on('click', 'li', function() {
            var name = $(this).attr('id');
            var keyword = $('#keyword').val();
            var cursorPos = $('#keyword').prop('selectionStart');
            var v = $('#keyword').val();
            var textBefore = v.substring(0, cursorPos);
            var textAfter = v.substring(cursorPos, v.length);
            $('#keyword').val(textBefore + name +
                textAfter);
        });
    </script>

@endsection
