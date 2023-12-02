@extends('admin.layouts.app')

{{-- @section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css">
@endsection --}}

@section('content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Registerd Audience</h3>
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="col-lg-12">
                    <div class="dropdown" style="margin-top: 5px;">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown">
                            Filter by event
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuButton">
                            <li role="presentation">
                                <a class="dropdown-item" href="{{ route('audiences', ['event' => 'first event']) }}">
                                    First event
                                </a>
                            </li>
                            <li role="presentation">
                                <a class="dropdown-item" href="{{ route('audiences', ['event' => 'art of sale']) }}">
                                    Art of sale
                                </a>
                            </li>
                            <li role="presentation">
                                <a class="dropdown-item" href="{{ route('audiences') }}">
                                    Reset
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="content-panel" style="margin-top: 20px;">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="numeric">Phone</th>
                                        <th>Event</th>
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
                                            <td>
                                                {{-- <a href="{{ route('admin.audiance.show', $item->id) }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.audiance.edit', $item->id) }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i>
                                                </a> --}}
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
                                {!! $audiences->links() !!}
                            </span>
                        </section>
                    </div><!-- /content-panel -->
                </div><!-- /col-lg-4 -->
            </div><!-- /row -->
        </section>
    </section>
@endsection

@section('scripts')
    {{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            // $('.table').DataTable({
            //     // "order": [
            //     //     [0, "desc"]
            //     // ],
            //     // "language": {
            //     //     "lengthMenu": "Display _MENU_ records per page",
            //     //     "zeroRecords": "Nothing found - sorry",
            //     //     "info": "Showing page _PAGE_ of _PAGES_",
            //     //     "infoEmpty": "No records available",
            //     //     "infoFiltered": "(filtered from _MAX_ total records)"
            //     // }
            // });

            // remove alert after 3 seconds
            setTimeout(function() {
                $('.alert').remove();
            }, 3000);
        });
    </script>
@endsection
