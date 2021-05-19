@extends('home')

@section('home-contents')

    <div>
        <div class="content-header">
            <div>
                <div>
                    <h1 class="text-capitalize">{{ $social_media_platforms->social_media_platform_name}}</h1>
                </div>
                <div >
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Add offer
                    </a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="collapse" id="collapseExample">
                    <div class="card card-primary ">
                        <div class="card-header">
                            <h3 class="card-title"> Create {{ $social_media_platforms->social_media_platform_name}} Service Offer</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('submit-service-category', ['platform' => $social_media_platforms->id]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputBorderWidth2">Service Title</label>
                                    <input name="service_category_name" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Offers Description</label>
                                    <textarea name="service_category_description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <div class="form-group col-12 col-md-3">
                                    <label for="exampleSelectBorderWidth2">Status</label>
                                    <select name="service_category_status" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
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
                        <h3 class="card-title">Platform Service list</h3>
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
                                                    Platform
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Service type
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Status
                                                </th>
                                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Action
                                                </th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($serviceCategory as $key => $value)
                                            <tr role="row" class="{{ ($key % 2) === 0 ? 'even' : 'odd'}}">
                                                <td class="text-capitalize">{{ $value->platformName }}</td>
                                                <td>{{ $value->service_category_name }}</td>
                                                <td>{{ $value->service_category_status }}</td>
                                                {{-- <td>
                                                    <div class="row col-12">
                                                        <div>
                                                            <a class="btn btn-primary" href="#" role="button"><i class="fas fa-eye"></i></a>
                                                        </div>
                                                        <div class="mx-2">
                                                            <a class="btn btn-primary" href="#" role="button"><i class="fas fa-plus"></i></a>
                                                        </div>
                                                        <div>
                                                            <a class="btn btn-danger" href="{{ route('delete-service-category', ['category' => $value->id]) }}" role="button"><i class="fas fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </td> --}}
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">
                                                    Platform
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Service type
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Status
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
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
