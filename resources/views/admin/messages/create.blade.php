@extends('admin.layouts.app')

@section('content')
    <section id="container">

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <h3>Messages</h3>

                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
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

                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb"> New Message</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-primary pull-right">
                                        <i class="fa fa-angle-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>

                            <form class="form-horizontal style-form mt-3" action="{{ route('sendMobileSms') }}"
                                method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-3 col-sm-3 control-label">
                                                Mobile number
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="mobileNumber">
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
                    </div><!-- col-lg-12-->
                </div><!-- /row -->
            </section>
        </section><!-- /MAIN CONTENT -->

        <!--main content end-->
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // remove alert after 3 seconds
            setTimeout(function() {
                $('.alert').remove();
            }, 3000);

            // get year for footer
            $('#year').text(new Date().getFullYear());
        });

        $(function() {
            $('select.styled').customSelect();
        });
    </script>
@endsection
