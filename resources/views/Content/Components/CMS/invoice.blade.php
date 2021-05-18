@extends('home')

@section('home-contents')

    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Note:</h5>
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to print.
                        </div>

                        <div class="p-3 mb-3 invoice">
                            <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> {{ env('APP_NAME') }}
                                            <small class="float-right">Date: {{ $dateNow }}</small>
                                        </h4>
                                    </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>{{ env('APP_NAME') }}</strong><br>
                                        Phone: (804) 123-5432 test<br>
                                        Email: info@almasaeedstudio.com test
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{ $transaction->client_name }}</strong><br>
                                        Phone: {{ $transaction->client_phone_number }}<br>
                                        Email: {{ $transaction->client_email }}
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <b>Transaction #{{ $transaction->transaction_details_number }}</b><br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Service type</th>
                                                <th>Price</th>
                                                <th>Subtotal</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $transaction->client_boost_number_target  }}</td>
                                                <td class="text-uppercase">{{ $transaction->service_category_name  }}</td>
                                                <td>P 0.25</td>
                                                <td>500</td>
                                                <td class="text-uppercase">{{ $transaction->payment_status }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <p class="lead">Payment Method:</p>
                                    <p>{{ $transaction->payment_type  }}</p>

                                    <p class="shadow-none text-muted well well-sm" style="margin-top: 10px;">
                                        For more questions and feedback please contact our customer support by sending us an email at
                                        boostph.support@gmail.com or through Facebook @ Boost PH
                                    </p><br>
                                    <p>Thank you.</p>
                                </div>
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>P 500.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="{{ route('invoice-transactions-print', ['transaction' => $transaction->transactionId]) }}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection







