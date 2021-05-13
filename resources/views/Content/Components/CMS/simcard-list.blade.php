@extends('home')

@section('home-contents')

    <div>
        <div class="content-header">
            <div>
                <div>
                    <h1 class="text-capitalize">{{ $network->networkname}} Network</h1>
                </div>
                <div >
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Register Simcard
                    </a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="collapse" id="collapseExample">
                    <div class="card card-primary ">
                        <div class="card-header">
                            <h3 class="card-title"> Register {{ $network->networkname }} Number</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('submit-simcard-list', ['network' => $network->id]) }}" method="post">
                                @csrf
                                <div class="form-group col-12 col-md-3">
                                    <label for="exampleInputBorderWidth2">Simcard Number</label>
                                    <input name="sim_number" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Simcard Description</label>
                                    <textarea name="sim_description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <div class="form-group col-12 col-md-3">
                                    <label for="exampleSelectBorderWidth2">Status</label>
                                    <select name="sim_status" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                                        <option value="active">Active</option>
                                        <option value="pending">Pending</option>
                                        <option value="disable">Disable</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Registered Numbers</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                    Network
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Simcard Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Number
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Status
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Account used count
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($registeredNumber as $key => $value)
                                            <tr role="row" class="{{ ($key % 2) === 0 ? 'even' : 'odd'}}">
                                                <td class="text-capitalize">{{ $value->networkName }}</td>
                                                <td>{{ $value->sim_name }}</td>
                                                <td>{{ $value->sim_number }}</td>
                                                <td>{{ $value->sim_status }}</td>
                                                <td>4</td>
                                                <td>
                                                    <div class="row col-12">
                                                        <div>
                                                            <a class="btn btn-primary" href="#" role="button"><i class="fas fa-eye"></i></a>
                                                        </div>
                                                        <div class="mx-2">
                                                            <a class="btn btn-primary" href="#" role="button"><i class="fas fa-plus"></i></a>
                                                        </div>
                                                        <div>
                                                            <a class="btn btn-danger" href="{{ route('delete-sim', ['sim' => $value->id]) }}" role="button"><i class="fas fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">
                                                    Network
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Simcard Name
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Number
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Status
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Account used count
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Action
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom-scripts')
    <script>
        $(function () {
            $("#example1").DataTable({
            "responsive": true, "info": true, "ordering": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
