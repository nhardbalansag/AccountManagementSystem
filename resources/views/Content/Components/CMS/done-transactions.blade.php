@extends('home')

@section('home-contents')

    <div>
        <div class="content-header">
            <div>
                <div>
                    <h1 class="text-capitalize">Accounts</h1>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Available Google Accounts</h3>
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
                                                    Transaction Number
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Client Account Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Email
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Total order
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Available Account
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Used Account
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Remaining Account
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($doneTransactions as $key => $value)
                                            <tr role="row" class="{{ ($key % 2) === 0 ? 'even' : 'odd'}}">
                                                <td>{{ $value['transaction_details_number'] }}</td>
                                                <td>{{ $value['client_social_media_account_name'] }}</td>
                                                <td>{{ $value['client_email'] }}</td>
                                                <td>{{ $value['client_boost_number_target'] }}</td>
                                                <td>{{ $value['totalAccount'] }}</td>
                                                <td>{{ $value['usedCount'] }}</td>
                                                <td>{{ $value['remainingCount'] }}</td>
                                                <td>
                                                    <div class="row col-12">
                                                        <div class="col-12 col-md-6">
                                                            <a class="btn btn-primary" href="{{ route('account-available', ['transaction' => $value['transactionId']]) }}" role="button"><i class="fas fa-eye"></i></a>
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
                                                    Transaction Number
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Client Account Name
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Email
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Total order
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Available Account
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Used Account
                                                </th>
                                                <th rowspan="1" colspan="1">
                                                    Remaining Account
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
            "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
