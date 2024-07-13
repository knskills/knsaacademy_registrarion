@extends('admin.layouts.niceapp')

@section('styles')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('ad-events.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">Event List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Event</h5>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Event</th>
                                            <th>Type</th>
                                            <th>Event Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Price(₹)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    {{ ucwords(str_replace('_', ' ', $item->event_name)) }}
                                                </td>
                                                <td>
                                                    {{ ucwords(str_replace('_', ' ', $item->event_type)) }}
                                                </td>
                                                <td>
                                                    {{ $item->event_date }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->event_start_time)->format('h:i A') }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->event_end_time)->format('h:i A') }}
                                                </td>
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    {{-- <a href="{{ route('admin.audiance.show', $item->id) }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a> --}}
                                                    <a href="{{ route('ad-events.edit', $item->id) }}"
                                                        class="btn btn-warning btn-xs">
                                                        <i
                                                            class="bi bi-pencil"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('ad-events.destroy', $item->id) }}"
                                                        method="POST"
                                                        style="display: inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-xs"
                                                            onclick="return confirm('Are you sure delete this item? ')">
                                                            <i
                                                                class="bi bi-trash "></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Place the pagination links outside the table -->
                            <div class="d-flex justify-content-center mt-3">
                                {!! $events->links() !!}
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
    </script>
@endsection
