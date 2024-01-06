@extends('admin.layouts.niceapp')

@section('styles')
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Audiance</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('audiences.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Audiance List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Audiance</h5>
                                </div>

                                <div class="col-6 mt-3 float-end text-end">

                                    <!-- Import buttons -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#importexcel">
                                            Import <i class="bi bi-file-earmark-arrow-up"></i>
                                        </button>
                                    </div>

                                    <!-- Export buttons -->
                                    <div class="btn-group">
                                        <a href="{{ route('audiences.export') }}" class="btn btn-success">
                                            Export <i class="bi bi-file-earmark-arrow-down"></i>
                                        </a>
                                    </div>

                                    {{-- <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Export
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Copy</a></li>
                                            <li><a class="dropdown-item" href="#">CSV</a></li>
                                            <li><a class="dropdown-item" href="#">Excel</a></li>
                                            <li><a class="dropdown-item" href="#">PDF</a></li>
                                            <li><a class="dropdown-item" href="#">Print</a></li>
                                        </ul>
                                    </div> --}}

                                    <!-- Example single warning button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Event</th>
                                            <th class="text-center">Register Date</th>
                                            <th class="text-center">Register Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($audiences as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ ucwords(str_replace('_', ' ', $item->event_name)) }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('h:i A') }}
                                                <td>
                                                    {{-- <a href="{{ route('admin.audiance.show', $item->id) }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.audiance.edit', $item->id) }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i>
                                                </a> --}}
                                                    {{-- <form action="{{ route('audiences.destroy', $item->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs"
                                                        onclick="return confirm('Are you sure delete this item? ')">
                                                        <i class="bi bi-trash "></i>
                                                    </button>
                                                </form> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Place the pagination links outside the table -->
                            <div class="d-flex justify-content-center text-center mt-3">
                                {!! $audiences->links() !!}
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Import file -->
        <div class="modal fade" id="importexcel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Audiance Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('audiences.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="col-form-label">Events</label>
                                <div class="">
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="">select events</option>
                                        @foreach ($events as $event)
                                            <option value="{{ $event->id }}">
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Choose file</label>
                                <input class="form-control" type="file" id="file" name="file" required>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary">Import</button> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Vertically centered Modal-->

    </main><!-- End #main -->
@endsection
