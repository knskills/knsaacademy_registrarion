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
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">SMS Template</h5>

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
                    <form class="form-horizontal style-form mt-3" action="{{ route('sendMobileSms') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-6 mt-2">
                                <div class="row">
                                    <label class="col-sm-3 col-sm-3 control-label">
                                        Events
                                    </label>
                                    <div class="col-sm-9">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select event</option>
                                            <@foreach ($events as $event)
                                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <div class="row">
                                    <label class="col-sm-2 col-sm-2 control-label">Message</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="message">
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
    <script>
        $(document).ready(function() {
            // close alert automatically after 3 seconds
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);
        });
    </script>
@endsection
