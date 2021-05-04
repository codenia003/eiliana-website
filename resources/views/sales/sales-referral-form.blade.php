@extends('layouts/default')

{{-- Page title --}}
@section('title')
Sales Referral
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
            <span class="h5 text-white ml-2">Sales Referral</span>
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
                    <form action="{{ route('referralform') }}" method="POST" id="salesreferallead">
                        @csrf
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Company Name</label>
                                        <input type="text" name="company_name" class="form-control" value="" required />
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Legal Status</label>
                                        <select name="legal_status" class="form-control" required>
                                            <option value=""></option>
                                            <option value="1">Pending</option>
                                            <option value="2">Processing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Contact Person</label>
                                        <input type="text" name="contact_person" class="form-control" value="" required />
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Designation</label>
                                        <input type="text" name="designation" class="form-control" value="" required />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Email Address</label>
                                        <input type="text" name="email" class="form-control" value="" required />
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Mobile No</label>
                                        <input type="text" name="mobile_no" class="form-control" value="" required />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Website Address</label>
                                        <input type="text" name="website_address" class="form-control" value="" required />
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Requirment Details</label>
                                        <input type="text" name="requirment_details" class="form-control" value="" required />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Customer Industry</label>
                                        <select name="customer_industry" class="form-control" required>
                                            <option value=""></option>
                                            <option value="1">Pending</option>
                                            <option value="2">Processing</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Date/Time Connect</label>
                                        <input class="form-control flatpickr" data-enabletime=true data-time_24hr="true" data-timeFormat="H:i" name="datetimeconnect" id="datetimepicker">
                                    </div>
                                </div>
                                <div class="form-group basic-info mb-3">
                                    <label>Has lead generator spoken to the customer and confirmed the requriment</label>
                                    <br>
                                    <div class="form-check form-check-inline ml-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="Yes" name="confirmed" class="custom-control-input" value="0" checked="">
                                            <label class="custom-control-label" for="Yes">Yes</label>
                                        </div>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="No" name="confirmed" class="custom-control-input" value="1">
                                            <label class="custom-control-label" for="No">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Commission Type</label>
                                        <select name="commission_type" class="form-control" required>
                                            <option value=""></option>
                                            <option value="1">Percentage</option>
                                            <option value="2">Processing</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Expected Commission(%/INR)</label>
                                        <input type="text" name="expected_commission" class="form-control" value="" required />
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <div class="stafflead-basic">
                                        <button class="btn btn-md btn-info bg-light-blue">Identify Consultant</button>
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
