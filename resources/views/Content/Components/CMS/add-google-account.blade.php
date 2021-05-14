@extends('home')

@section('home-contents')

    <div>
        <div class="content-header">
            <div>
                <div>
                    <h1 class="text-capitalize">Add <i class="fab fa-google-plus-g text-danger"></i> Account</h1>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="col-12 row">
                <div class="col-12 col-md-5">
                    <div class="container-fluid">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> Register Google account</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('submit-email-account', ['simcard' => $simcardId]) }}" method="post">
                                    @csrf
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">First Name</label>
                                        <input value="{{ $firstname }}" name="firstname" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Last Name</label>
                                        <input value="{{ $lastname }}" name="lastname" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Middle Name</label>
                                        <input name="middlename" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Email</label>
                                        <input value="{{ $emailaddress }}" name="emailaddress" type="email" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Birthday</label>
                                        <input value="{{ $birthday  }}" name="emailbirthday" type="date" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="emaildescription" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleSelectBorderWidth2">Status</label>
                                        <select name="status" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                            <option value="disable">Disable</option>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Password</label>
                                        <input value="{{ $password }}" name="password" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div>
                                        <input type="submit" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Accounts<i class="mx-2 fab fa-google-plus-g"></i></h3>
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
                                                        Email Address
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                        Password
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($accounts as $key => $value)
                                                <tr role="row" class="{{ ($key % 2) === 0 ? 'even' : 'odd'}}">
                                                    <td><i class="mx-2 fab fa-google-plus-g text-danger"></i>{{ $value->accountEmailAddress }}</td>
                                                    <td>{{ $value->accountPassword }}</td>
                                                </tr>
                                            @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
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
