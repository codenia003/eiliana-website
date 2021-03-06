@extends('layouts/default')

{{-- Page title --}}
@section('title')
Modify Sales Referral
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/flatpickr/css/flatpickr.min.css') }}" rel="stylesheet"
type="text/css"/>
<!--end of page level css-->
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Modify Sales Referral</span>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="shadow1">
    <div class="container space-1 space-top-lg-0 mt-lg-n10">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-lg-0">
                <div id="notific">
                    @include('notifications')
                </div>
                <div class="advance-search singup-body login-body">
                    <form action="{{ route('updateReferralform') }}" method="POST" id="salesreferallead">
                      <input type="hidden" name="sales_referral_id" value="{{ $sales_referral->sales_referral_id}}">
                        @csrf
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Company Name</label>
                                        <input type="text" name="company_name" class="form-control" value="{{ $sales_referral->company_name}}" required />
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Legal Status</label>
                                        <select name="legal_status" class="form-control" required>
                                            <option value=""></option>
                                            @foreach($company_types as $compny_type)
                                                <option value="{{ $compny_type->id }}" {{ ($sales_referral->legal_status==$compny_type->id)? "selected" : "" }}>{{ $compny_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Contact Person</label>
                                        <input type="text" name="contact_person" class="form-control" value="{{ $sales_referral->contact_person}}" required />
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Designation</label>
                                        <input type="text" name="designation" class="form-control" value="{{ $sales_referral->designation}}" required />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Email Address</label>
                                        <input type="text" name="email" class="form-control" value="{{ $sales_referral->email}}" required />
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Mobile No</label>
                                        <input type="text" name="mobile_no" class="form-control" value="{{ $sales_referral->mobile_no}}" required />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>DOB</label>
                                        <input type="date" placeholder="DD/MM/YYYY" name="dob" class="form-control" value="{{ $sales_referral->dob}}" required/>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control" value="{{ $sales_referral->city}}" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select name="country" class="form-control" required>
                                        <option value="">--Select Country--</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ ($sales_referral->country == $country->id)? "selected" : "" }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Website Address</label>
                                        <input type="text" name="website_address" class="form-control" value="{{ $sales_referral->website_address}}" required />
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Requirment Details</label>
                                        <input type="text" name="requirment_details" class="form-control" value="{{ $sales_referral->requirment_details}}" required />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Customer Industry</label>
                                        <select name="customer_industry" class="form-control" required>
                                            <option value=""></option>
                                            @foreach($customer_industries as $customer_industry)
                                                <option value="{{ $customer_industry->customer_industry_id }}" {{ ($sales_referral->customer_industry == $customer_industry->customer_industry_id)? "selected" : "" }}>{{ $customer_industry->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Date/Time Connect</label>
                                        <input class="form-control flatpickr" data-enabletime=true data-time_24hr="true" data-timeFormat="H:i" name="datetimeconnect" id="datetimepicker" value="{{ $sales_referral->datetimeconnect}}">
                                    </div>
                                </div>
                                <div class="form-group basic-info mb-3">
                                    <label>Has lead generator spoken to the customer and confirmed the requriment</label>
                                    <br>
                                    <div class="form-check form-check-inline ml-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="Yes" name="confirmed" class="custom-control-input" value="0" {{ ($sales_referral->confirmed == '0')? "checked" : "" }}>
                                            <label class="custom-control-label" for="Yes">Yes</label>
                                        </div>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="No" name="confirmed" class="custom-control-input" value="1" {{ ($sales_referral->confirmed == '1')? "checked" : "" }}>
                                            <label class="custom-control-label" for="No">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Commission Type</label>
                                        <select name="commission_type" class="form-control" required>
                                            <option value=""></option>
                                            <option value="1" {{ ($sales_referral->commission_type == '1')? "selected" : "" }}>Percentage</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Expected Commission(%/INR)</label>
                                        <input type="text" name="expected_commission" class="form-control" value="{{ $sales_referral->expected_commission}}" required />
                                    </div>
                                </div>
                                <div class="form-group text-right mt-5">
                                    <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('layouts.left')
        </div>
        </div>
    </div>
    <!-- End Row -->
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
<script>
$('#salesreferallead').bootstrapValidator({});
$(document).ready(function() {
    flatpickr('#datetimepicker', {
        enableTime: true,
        dateFormat: 'Y-m-d H:i K',
        minDate: "today",
    });
});
</script>
<!--global js end-->
@stop
