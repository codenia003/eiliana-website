@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Onboarding Resource </span>
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
                <span class="h5 text-white" style="margin-left: -25px;">Please confirm the details below</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="{{ route('contractual-job-payment') }}" method="POST" id="educationForm"> 
                   <input type="hidden" name="job_id" value="{{ $contractual_job->job_id }}"> 
                    @csrf
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Proposal ID</label>
                               <input type="text" class="form-control" name="job_proposal_id" value="{{ $contractual_job->job_proposal_id }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" value="{{ $contractual_job->customer_name }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Price Per Month </label><small> (Excluding GST)</small>
                                <input type="text" class="form-control" name="price" id="price" value="{{ $contractual_job->price }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Notice Period</label><small> (Days)</small>
                                <input type="text" class="form-control" name="notice_period" value="{{ $contractual_job->notice_period }}" readonly="">
                            </div>
                        </div>
                        {{--<div class="form-row">
                            <div class="form-group col-6">
                                <label>Total Price </label><small> (Price + GST)</small>
                                <input type="text" class="form-control" name="total_price" id="total_price" value="{{ $contractual_job->total_price }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>GST Rate</label><small> (%)</small>
                                <input type="text" class="form-control" name="gst_rate" id="gst_rate" value="18" readonly="">
                            </div>
                        </div>--}}
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Contract Duration</label>
                                <input type="text" class="form-control" name="contract_duration" value="{{$contractual_job->contract_duration}}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Resource Name</label>
                                <input type="text" class="form-control" name="company_name" value="{{$contractual_job->company_name}}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Date Of Onboarding</label>
                                <input class="form-control" type="text" name="job_start_date" value="{{$contractual_job->job_start_date}}" readonly="">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Pricing Cycle</label>
                                @if($contractual_job->pricing_cycle == 1)
                                   <input type="text" class="form-control" name="pricing_cycle" value="Monthly Advance" readonly="">
                                @elseif($contractual_job->pricing_cycle == 2)
                                   <input type="text" class="form-control" name="pricing_cycle" value="Quarterly Advance" readonly="">
                                @elseif($contractual_job->pricing_cycle == 3)
                                   <input type="text" class="form-control" name="pricing_cycle" value="Bi-Monthly Advance" readonly="">
                                @else
                                   <input type="text" class="form-control" name="pricing_cycle" value="Yearly Advance" readonly="">
                                @endif
                            </div>
                        </div>
                        {{--@if($contractual_job->pricing_cycle == 2)

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
                        @endif--}}

                        {{--<div class="form-row">
                            <div class="form-group col-12">
                                <label>Location</label>
                                <select class="form-control" name="location">
                                    <option>Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->location_id}}">{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>--}}
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Location</label>
                                    @if($contractual_job->location == 1)
                                        <input type="text" class="form-control" name="location" value="Customer Location" readonly="">
                                    @else
                                        <input type="text" class="form-control" name="location" value="Offsite" readonly="">
                                    @endif
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" rows="4" readonly="">{{$contractual_job->remarks}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right mt-5">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary" type="button" onclick="ContractualJobLeadSchedule('{{ $contractual_job->job_schedule_id }}','2')">Accept</button>
                            <button class="btn btn-primary" type="button" onclick="ContractualJobLeadSchedule('{{ $contractual_job->job_schedule_id }}','3')">Modify</button>
                            <button class="btn btn-primary" type="button" onclick="ContractualJobLeadSchedule('{{ $contractual_job->job_schedule_id }}','4')">Reject</button>
                        </div>
                    </div>
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
                var msg = userCheck.msg;
                var redirect = '/client/job-contract-details/'+job_schedule_id;
                // Swal.fire({
                //     type: 'success',
                //     title: 'Success...',
                //     text: userCheck.msg,
                //     showConfirmButton: false,
                //     timer: 2000
                // });
                // window.location.href = '/freelancer/my-opportunity';
            } else {
                var msg = userCheck.errors;
                var redirect = '/client/job-contract-details/'+job_schedule_id;
                // Swal.fire({
                //     type: 'error',
                //     title: 'Oops...',
                //     text: userCheck.errors,
                //     showConfirmButton: false,
                //     timer: 3000
                // });
                // if (userCheck.success == '2') {
                //     window.location.href = '/freelancer/my-opportunity';
                // }
            }
            toggleRegPopup(msg,redirect);
        },
        error: function(xhr, status, error) {
            console.log("error: ",error);
        },
    });
}
</script>
@stop
