@extends('admin.layouts.app')

@section('content')
    <section id="container">

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i>Event</h3>

                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">

                    <div class="col-lg-12">
                        <div>
                            <a href="{{ route('events.index') }}" class="btn btn-danger ml-2">Back</a>
                        </div>

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

                            <h4 class="mb"><i class="fa fa-angle-right"></i> New Element</h4>
                            <form class="form-horizontal style-form" action="{{ route('events.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-2 col-sm-2 control-label">
                                                Event name
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="event_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-2 col-sm-2 control-label">Event date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="event_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-2 col-sm-2 control-label">
                                                Event time
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="time" class="form-control" name="event_time">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-2 col-sm-2 control-label">
                                                Event link
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="event_link">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-2 col-sm-2 control-label">
                                                Youtube link
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="youtube_link">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-2 col-sm-2 control-label">
                                                Button text
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="button_text">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-2 col-sm-2 control-label">
                                                Price
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="price">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-2 col-sm-2 control-label">
                                                Payment link
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="payment_link">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-2 col-sm-2 control-label">
                                                Whatsapp link
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="whatsapp_link">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-2 col-sm-2 control-label">
                                                Status
                                            </label>
                                            <div class="col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="radio" class="form-control" name="is_active" checked>
                                                        Active
                                                    </label>

                                                    <label>
                                                        <input type="radio" class="form-control" name="is_active">
                                                        Inactive
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- col-lg-12-->
                </div><!-- /row -->
            </section>
        </section><!-- /MAIN CONTENT -->

        <!--main content end-->

        {{-- <!--footer start-->
        <footer class="site-footer">
            <div class="text-center">
                <span id="year"></span> - Alvarez.is
                <a href="form_component.html#" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
        <!--footer end--> --}}
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
