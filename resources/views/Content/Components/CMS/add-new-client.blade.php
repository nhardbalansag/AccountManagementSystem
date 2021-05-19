@extends('home')

@section('home-contents')

    <div>
        <div class="content-header">
            <div>
                <div>
                    <h1 class="text-capitalize"><i class="mx-2 far fa-user"></i>New Client</h1>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="col-12 row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="container-fluid">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Client Information</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('add-new-cient-submit') }}" method="post">
                                    @csrf
                                    <div class="form-group ">
                                        <label for="exampleSelectBorderWidth2">Service Availing</label>
                                        <select name="service_category_id" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                                            <option value="{{ null }}">Select Service Category</option>
                                            @forelse ($serviceCategory as $data => $value)
                                                <option value="{{ $value->id }}">{{ $value->service_category_name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleSelectBorderWidth2">Price</label>
                                        <select name="price_information_id" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                                            <option value="{{ null }}">Select Price</option>
                                            @forelse ($priceInfo as $data => $value)
                                                <option value="{{ $value->id }}">{{ $value->price }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Target Count</label>
                                        <input name="client_boost_number_target" type="number" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Email</label>
                                        <input  name="client_email" type="email" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Phone Number</label>
                                        <input  name="client_phone_number" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Client Name</label>
                                        <input name="client_name" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Account Name</label>
                                        <input name="client_social_media_account_name" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputBorderWidth2">Account Link</label>
                                        <input name="client_social_media_link" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleSelectBorderWidth2">Payment Status</label>
                                        <select name="payment_status" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                            <option value="disable">Disable</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleSelectBorderWidth2">Payment Type</label>
                                        <select name="payment_type" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                                            <option value="gcash">GCASH</option>
                                            <option value="cash">Cash</option>
                                            <option value="card">Card</option>
                                        </select>
                                    </div>
                                    <div>
                                        <input type="submit" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

