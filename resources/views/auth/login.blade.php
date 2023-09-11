@extends('admin.layouts.app')

@section('content')
    <div id="login-page">
        <div class="container">

            <form class="form-login" method="POST" action="{{ route('login') }}">
                @csrf
                <h2 class="form-login-heading">sign in now</h2>
                <div class="login-wrap">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="User ID" name="email" value="{{ old('email') }}" required autocomplete="email"
                        autofocus>

                    @error('email')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <br>


                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <br><br>

                    <button class="btn btn-theme btn-block" href="index.html" type="submit">
                        <i class="fa fa-lock"></i> LOG IN
                    </button>

                </div>
                <!-- modal -->

            </form>

        </div>
    </div>
@endsection

@section('scripts')
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="{{ url('admin/js/jquery.backstretch.min.js') }}"></script>
    <script>
        $.backstretch("{{ asset('admin/img/554.jpg') }}", {
            speed: 500
        });
    </script>
@endsection
