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
            <h1>WHatsapp Setting</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Whatsapp setting</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Whatsapp setting</h5>

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
                    <form class="form-horizontal style-form mt-3"
                        action="{{ route('whatsapp.update-profile') }}" method="POST">
                        @csrf
                        <div class="form-group row">

                            <div class="col-12 mt-2">
                                <label class="control-label fw-bold">
                                    About
                                </label>
                                <input type="text" name="about"
                                    id="about"
                                    value="{{ $data->about ?? old('about') }}"
                                    class="form-control" required>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="control-label fw-bold">
                                    Description
                                </label>
                                <input type="text" name="description"
                                    id="description"
                                    value="{{ $data->description ?? old('description') }}"
                                    class="form-control" required>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="control-label fw-bold">
                                    Vertical(Industry type)
                                </label>
                                <input type="text" name="vartical"
                                    id="vartical"
                                    value="{{ $data->vartical ?? old('vartical') }}"
                                    class="form-control" required>

                                    <small>Reference - <a href="https://developers.facebook.com/docs/whatsapp/on-premises/reference/settings/business-profile/" target="_blank">Meta Developers</a></small>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="control-label fw-bold">
                                    Website 1
                                </label>
                                <input type="text" name="website_1"
                                    id="website_1"
                                    value="{{ $data->website_1 ?? old('website_1') }}"
                                    class="form-control">
                            </div>

                            <div class="col-12 mt-2">
                                <label class="control-label fw-bold">
                                    Website 2
                                </label>
                                <input type="text" name="website_2"
                                    id="website_2"
                                    value="{{ $data->website_2 ?? old('website_2') }}"
                                    class="form-control">
                            </div>

                            <div class="col-12 mt-2">
                                <label class="control-label fw-bold">
                                    Email
                                </label>
                                <input type="text" name="email"
                                    id="email"
                                    value="{{ $data->email ?? old('email') }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-12 mt-2">
                                <label class="control-label fw-bold">
                                    Address
                                </label>
                                <input type="text" name="address"
                                    id="address"
                                    value="{{ $data->address ?? old('address') }}"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div>
                            <div class="col-12 mt-3">
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
@endsection
