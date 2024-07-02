@extends('admin.layouts.niceapp')

@section('styles')
@endsection

@section('content')
    <main id="main" class="main">

        <!-- Start Page Title -->
        <div class="pagetitle">
            <h1>Option</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ route('audiences.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Option List</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Options</h5>
                                </div>
                                <div class="col-6 text-end mt-3">
                                    <a href="{{ route('auto-reply-options.create') }}"
                                        class="btn btn-primary">
                                        New <i class="bi bi-plus"></i>
                                    </a>
                                </div>
                            </div>

                            @include('admin.layouts.messages')

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Keyword</th>
                                            <th>Reply</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($options as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->keyword }}</td>
                                                {{-- <td>{{ ucfirst($item->reply) }} --}}
                                                <td>{{ $item->reply }}</td>
                                                <td nowrap class="text-center">
                                                    {{-- <a href="{{ route('auto-reply-options.show', $item->id) }}"
                                                        class="btn btn-primary btn-xs">
                                                        <i class="bi bi-eye"></i>
                                                    </a> --}}
                                                    <a href="{{ route('auto-reply-options.edit', $item->id) }}"
                                                        class="btn btn-warning btn-xs">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('auto-reply-options.destroy', $item->id) }}"
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
                            <div
                                class="d-flex justify-content-center text-center mt-3">
                                {!! $options->links() !!}
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
