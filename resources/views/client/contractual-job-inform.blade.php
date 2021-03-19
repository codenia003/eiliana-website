@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Contractual Job Information </span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="profile-information">
    <!-- <div id="notific">
        @include('notifications')
    </div> -->
     <div class="singup-body login-body profile-basic">
        <div class="card">
        <div class="bg-blue">
            <div class="px-5 py-2">
                <span class="h5 text-white" style="margin-left: -25px;">Contractual Job Information</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="{{ route('contractual-job-payment') }}" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $contractual_job->job_id }}">
                    <input type="hidden" name="job_leads_id" value="{{ $joblead_id->job_leads_id }}">
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Candidate Name</label>
                                <input type="text" class="form-control" name="candidate_name" value="{{ $contractual_job->candidate_name }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Referral ID</label>
                               <input type="text" class="form-control" name="referral_id" value="{{ $joblead_id->job_leads_id }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" value="{{ $contractual_job->customer_name }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Price </label>
                                <input type="text" class="form-control" name="price" value="{{ $contractual_job->price }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Billing Address</label>
                                <input type="text" class="form-control" name="billing_address" value="{{ $contractual_job->billing_address }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>GST Details</label>
                                <input type="text" class="form-control" name="gst_details" value="{{ $contractual_job->gst_details }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Start Date</label>
                                <input class="form-control" type="text" name="start_date" value="{{ $contractual_job->start_date }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>End Date</label>
                                <input class="form-control" type="text" name="end_date" value="{{ $contractual_job->end_date }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Contract Duration</label>
                                <input type="text" class="form-control" name="contract_duration" value="{{ $contractual_job->contract_duration }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Pricing Cycle</label>
                                <input type="text" class="form-control" name="pricing_cycle" value="{{ $contractual_job->pricing_cycle }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Client Period</label>
                                <input type="text" class="form-control" name="client_period" value="{{ $contractual_job->client_period }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Location</label>
                                <input type="text" class="form-control" name="location" value="{{ $contractual_job->location }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" rows="4" readonly="">{{ $contractual_job->remark }}</textarea>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="amount" id="amount" value="{{ $contractual_job->price }}">
                    <input type="hidden" name="contractual_job_id" id="contractual_job_id" value="{{ $contractual_job->contractual_job_id }}">

                    <input type="hidden" name="currency" id="currency" value="INR">
                    <input type="hidden" name="status" id="status" value="1">
                    <input type="hidden" name="payment_id" id="payment_id" value="">
                    
                    <div class="singup-body" id="payment_button" style="border-top: 1px solid #ffffff;">
                        <div class="btn-group" role="group">
                            <span>Please pay advance payment for further process</span>
                            <button type="button" id="paybtn" class="btn btn-primary deliverinfo">Payment Link</button>
                        </div>
                    </div>
                    
                    <!-- <div class="form-group text-right mt-5">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('profile_script')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function padStart(str) {
    return ('0' + str).slice(-2)
}

function demoSuccessHandler(transaction) {

    if (transaction.razorpay_payment_id) {
        $('#payment_id').val(transaction.razorpay_payment_id);
        $('#status').val('2');
        $("#educationForm").submit();
    }
}

$('body').on('click', '#paybtn', function(e){

    var totalAmount = document.getElementById("amount").value;
    var currency = document.getElementById("currency").value;
    var name = 'Eilaian India';
    var store_logo = "{{ asset('/assets/img/logo.png') }}";
    var options = {
        "key": "{{ env('RAZOR_KEY') }}",
        "amount": (totalAmount*100), // 2000 paise = INR 20
        "currency": currency,
        "name": name,
        "image": store_logo,
        "handler": demoSuccessHandler,
        "theme": {
           "color": "#ff2424"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
});
</script>
@stop
