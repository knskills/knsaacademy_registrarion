@extends('admin.layouts.niceapp')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Audiance</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('audience')}}">Home</a></li>
                    <li class="breadcrumb-item">Audiance List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Audiance</h5>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Table with stripped rows -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="numeric">Phone</th>
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
                                            <td>{{ $item->event_name }}</td>
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
                                                {{-- <form action="{{ route('audience.destroy', $item->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs"
                                                        onclick="return confirm('Are you sure delete this item? ')">
                                                        <i class="fa fa-trash-o "></i>
                                                    </button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                            <!-- Place the pagination links outside the table -->
                            <div class="d-flex justify-content-center text-center mt-3">
                                {!! $audiences->links() !!}
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
