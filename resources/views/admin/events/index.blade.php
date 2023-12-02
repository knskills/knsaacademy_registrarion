@extends('admin.layouts.app')

@section('content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <h3>
                <i class="fa fa-angle-right"></i> Registerd Audience
            </h3>

            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="col-lg-12">
                    <div>
                        <a href="{{ route('events.create') }}" class="btn btn-lg btn-success">New</a>
                    </div>

                    <div class="content-panel" style="margin-top: 20px;">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Name </th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Event</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->event_name }}</td>
                                            <td>{{ $item->event_name }}</td>
                                            <td>{{ $item->event_name }}</td>
                                            <td>{{ $item->event_name }}</td>
                                            <td>
                                                <form action="{{ route('audience.destroy', $item->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs"
                                                        onclick="return confirm('Are you sure delete this item? ')">
                                                        <i class="fa fa-trash-o "></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <span class="d-flex justify-content-center text-center">
                                {!! $events->links() !!}
                            </span>
                        </section>
                    </div><!-- /content-panel -->
                </div><!-- /col-lg-4 -->
            </div><!-- /row -->
        </section>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // remove alert after 3 seconds
            setTimeout(function() {
                $('.alert').remove();
            }, 3000);
        });
    </script>
@endsection
