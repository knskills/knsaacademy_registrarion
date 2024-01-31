@extends('admin.layouts.niceapp')

@section('styles')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Messages</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('audiences.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Send/Schedule Message List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Send/Schedule Messages</h5>
                            </div>

                            <div class="col-6 mt-3 float-end text-end">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Filter by event
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('audiences.index', ['event' => 'first event']) }}">
                                                First event
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('audiences.index', ['event' => 'beginner_to_billionaire']) }}">
                                                Beginner to Billionaire
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('audiences.index') }}">
                                                Reset
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

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
                                        <th>Template</th>
                                        <th>Type</th>
                                        <th class="text-center">Sending Date</th>
                                        <th class="text-center">Sending Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{-- {{ ucwords(str_replace('_', ' ', $item->event->event_name))}} --}}

                                                {{ $item->event_id ? ucwords(str_replace('_', ' ', $item->event->event_name)) : 'No Event' }}
                                            </td>
                                            <td>{{ $item->messageTemplate->name ?? "" }}</td>
                                            <td>{{ ucfirst($item->type) }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($item->schedule_date)->format('d-m-Y') }}
                                            </td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($item->schedule_time)->format('h:i A') }}
                                            </td>
                                            <td>
                                                <form action="{{ route('messages.destroy', $item->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs"
                                                        onclick="return confirm('Are you sure delete this item? ')">
                                                        <i class="bi bi-trash "></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Place the pagination links outside the table -->
                        <div class="d-flex justify-content-center text-center mt-3">
                            {!! $messages->links() !!}
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
