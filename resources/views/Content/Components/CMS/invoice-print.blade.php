
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME') }} | Invoice Print</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    </head>
    <body>
        <div class="wrapper">
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
                                    <td>P {{ $transaction->price }}</td>
                                    <td>P {{ $transaction->total_price }}</td>
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
                                        <td>P {{ $transaction->total_price }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.addEventListener("load", window.print());
        </script>
    </body>
</html>

