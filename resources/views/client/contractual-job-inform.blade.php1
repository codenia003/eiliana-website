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
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Referral ID</label>
                               <input type="text" class="form-control" name="job_leads_id" value="{{ $contractual_job->job_leads_id }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" value="{{ $contractual_job->customer_name }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Price </label><small> (Excluding GST)</small>
                                <input type="text" class="form-control" name="price" value="{{ $contractual_job->price }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Contract Duration</label>
                                <input type="text" class="form-control" name="contract_duration" value="{{$contractual_job->contract_duration}}" readonly="">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Pricing Cycle</label>
                                <input type="text" class="form-control" name="pricing_cycle" value="{{$contractual_job->pricing_cycle}}" readonly="">
                            </div>
                        </div>
                        @if($contractual_job->pricing_cycle == 2)

                        <div class="form-row" id="on_postpaid">
                            <div class="form-group col-6">
                                <label>Postpaid Amount </label>
                                <input type="text" class="form-control" name="on_postpaid_amount" value="{{$contractual_job->on_postpaid_amount}}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Advance Amount</label>
                                <input type="text" class="form-control" name="advance_amount" value="{{$contractual_job->advance_amount}}" readonly="">
                            </div>
                        </div>
                        @endif

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Location</label>
                                <input type="text" class="form-control" name="location" value="{{$contractual_job->locations->name}}" readonly="">
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="form-group">
                                <input type="checkbox" id="candidate_support" class="form-check-input" required />
                                <label for="candidate_support" > Support checkbox</label>
                            </div>
                        </div> -->
                        
                        <!-- <div class="form-row">
                            <div class="form-group col-12">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" rows="4" readonly="">{{ $contractual_job->remark }}</textarea>
                            </div>
                        </div> -->
                    </div>

                    <div class="form-group text-right mt-5">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary" type="button" onclick="ContractualJobLeadSchedule('{{ $contractual_job->job_schedule_id }}','2')">Accept</button>
                            <button class="btn btn-primary" type="button" onclick="ContractualJobLeadSchedule('{{ $contractual_job->job_schedule_id }}','3')">Modify</button>
                            <button class="btn btn-primary" type="button" onclick="ContractualJobLeadSchedule('{{ $contractual_job->job_schedule_id }}','4')">Reject</button>
                        </div>
                    </div>

                    <!-- <input type="hidden" name="amount" id="amount" value="{{ $contractual_job->price }}">
                    <input type="hidden" name="contractual_job_id" id="contractual_job_id" value="{{ $contractual_job->contractual_job_id }}">

                    <input type="hidden" name="currency" id="currency" value="INR">
                    <input type="hidden" name="status" id="status" value="1">
                    <input type="hidden" name="payment_id" id="payment_id" value="">
                    
                    <div class="singup-body" id="payment_button" style="border-top: 1px solid #ffffff;">
                        <div class="btn-group" role="group">
                            <span>Please pay payment for further process</span>
                            <button type="button" id="paybtn" class="btn btn-primary deliverinfo">Payment Link</button>
                        </div>
                    </div> -->
                    
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
<script>
function ContractualJobLeadSchedule(job_schedule_id,lead_status){
    $('.spinner-border').removeClass("d-none");
    var url = '/client/contractual-job-lead-schedule';
    var data= {
        _token: "{{ csrf_token() }}",
        job_schedule_id: job_schedule_id,
        lead_status: lead_status
    };
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            var userCheck = data;
            $('.spinner-border').addClass("d-none");
            if (userCheck.success == '1') {
                Swal.fire({
                    type: 'success',
                    title: 'Success...',
                    text: userCheck.msg,
                    showConfirmButton: false,
                    timer: 2000
                });
                // window.location.href = '/freelancer/my-opportunity';
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: userCheck.errors,
                    showConfirmButton: false,
                    timer: 3000
                });
                // if (userCheck.success == '2') {
                //     window.location.href = '/freelancer/my-opportunity';
                // }
            }

        },
        error: function(xhr, status, error) {
            console.log("error: ",error);
        },
    });
}
</script>
@stop
