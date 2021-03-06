@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Project Contract Details </span>
        </div>
    </div>
</div>
@stop
<style type="text/css">
     .invoice a:hover { 
       color: #3b5999 !important;
     }
</style>
@section('profile_content')
<div class="profile-information">
    <div id="notific">
        @include('notifications')
    </div>
     <div class="singup-body login-body profile-basic">
        <div class="card">
        <div class="bg-blue">
            <div class="px-5 py-2">
                <span class="h5 text-white" style="margin-left: -25px;">Project Contract Details</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="{{ route('project-retainer-contract-payment') }}" method="POST" id="educationForm">
                    @csrf
                    {{--<input type="hidden" name="contract_id" value="{{ $projectlead->jobcontractdetails->contract_id }}">--}}
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Proposal Id</label>
                                <input type="text" class="form-control" name="project_leads_id" value="{{ $projectlead->project_leads_id }}" readonly>
                            </div>
                            @if($projectlead->projectdetail->referral_id != '0') 
                                <div class="form-group col-6">
                                    <label>Rate Per Month({{ $projectlead->projectdetail->projectCurrency->symbol }})</label>
                                    {{--<input type="text" class="form-control" name="order_closed_value" value="{{ $projectlead->total_proposal_value }}" readonly>--}}
                                    <input type="text" class="form-control" name="order_closed_value" value="{{ number_format($projectlead->contractdetails->order_closed_value, 0, ".", "") }}" readonly>
                                </div>
                            @else
                                <div class="form-group col-6">
                                    <label>Rate Per Month({{ $projectlead->projectdetail->projectCurrency->symbol }})</label>
                                    <input type="text" class="form-control" name="order_closed_value" value="{{ number_format($projectlead->contractdetails->order_closed_value, 0, ".", "") }}" readonly>
                                </div>
                            @endif
                        </div>

                        {{--@if($projectlead->projectdetail->referral_id != '0') 
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Sales Commission Amount(%)</label>
                                    <input type="text" class="form-control" name="sales_comm_amount"  value="{{ $projectlead->sales_comm_amount }}" readonly>
                                </div>
                            </div>
                        @endif--}}

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Date of Acceptance</label>
                                <input class="form-control" type="text" name="date_acceptance" value="{{ $projectlead->contractdetails->date_acceptance }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Contract Duration(Days)</label>
                                <input type="text" class="form-control" name="ordering_com_name" value="{{ $projectlead->delivery_timeline }}" readonly>
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Total Advance Payment({{ $projectlead->projectdetail->projectCurrency->symbol }}) </label>
                                <input type="text" class="form-control" name="advance_payment_details" value="{{ $total_price }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Gst Details(Optional)</label>
                                <input class="form-control" type="text" name="gst" value="">
                            </div>
                            {{--<div class="form-group col-6">
                                <label>Resource name  </label>
                                <input type="text" class="form-control" name="ordering_com_name" value="{{ $projectlead->contractdetails->ordering_com_name }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Ordering Company Name/Individual  </label>
                                <input type="text" class="form-control" name="ordering_com_name" value="{{ $projectlead->contractdetails->ordering_com_name }}" readonly>
                            </div>--}}
                        </div>
                    </div>
                    @forelse ($projectlead->contractdetails->paymentschedule as $item)

                    @if($projectlead->projectdetail->referral_id != '0') 
                       <input type="hidden" name="amount" id="amount" value="{{ $total_price }}">
                    @else
                       <input type="hidden" name="amount" id="amount" value="{{ $total_price }}">
                    @endif
                    <!-- <input type="hidden" name="amount" id="amount" value=""> -->
                    <input type="hidden" name="payment_schedule_id" id="payment_schedule_id" value="{{ $item->payment_schedule_id }}">
                    @empty
                    <input type="hidden" name="amount" id="amount" value="0">
                    @endforelse

                    <input type="hidden" name="currency" id="currency" value="{{ $projectlead->projectdetail->projectCurrency->code }}">
                    <input type="hidden" name="status" id="status" value="1">
                    <input type="hidden" name="payment_id" id="payment_id" value="">
                    {{--@if ($projectlead->contractdetails->status == '1')
                        <div class="form-group text-right mt-5" id="status">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary" type="button" onclick="contractDetails('{{ $projectlead->contractdetails->contract_id }}','2')">Accept</button>
                                <button class="btn btn-primary" type="button" onclick="contractDetails('{{ $projectlead->contractdetails->contract_id }}''4')">Reject</button>
                            </div>
                        </div>
                    @elseif ($projectlead->contractdetails->status == '4')
                    <p>Status: Cancel</p>
                    @else--}}
                        <div class="singup-body" id="payment_button" style="border-top: 1px solid #ffffff;">
                            <div class="btn-group" role="group">
                                <span>Please pay advance payment for further process</span>
                                <button type="button" id="paybtn" class="btn btn-primary deliverinfo">Payment Link</button>
                            </div>
                        </div>
                    {{--@endif--}}
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('profile_script')
{{-- <x-chat-message/> --}}
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

function contractDetails(contract_id,lead_status){
    $('.spinner-border').removeClass("d-none");
    var url = '/client/project-contract-post';
    var data= {
        _token: "{{ csrf_token() }}",
        contract_id: contract_id,
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
                // Swal.fire({
                //     type: 'success',
                //     title: 'Success...',
                //     text: userCheck.msg,
                //     showConfirmButton: false,
                //     timer: 2000
                // });
                var msg = userCheck.msg;
                var redirect = '/client/project-contract-details/'+ contract_id;

                $('#payment_button').show();
                $('#status').hide();

                // window.location.href = '/freelancer/my-opportunity';
            } else {
                var msg = userCheck.errors;
                var redirect = '/client/project-contract-details/'+ contract_id;
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
            location.reload();
        },
        error: function(xhr, status, error) {
            console.log("error: ",error);
        },
    });
}

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


function GeneratePdf(order_invoice_id,job_leads_id){
    var get_url = "{{URL('client/invoice')}}";
    var url = get_url+"/"+order_invoice_id;
    $.ajax({
        type: 'GET',
        url: url,
        success: function(response) {
            var userCheck = response;
            console.log(userCheck);
            if (userCheck.success == '1') {
                var msg = userCheck.msg;
                var redirect = '/client/job-contract-details'+"/"+job_leads_id;
                // Swal.fire({
                //     type: 'success',
                //     title: 'Success...',
                //     text: userCheck.msg,
                //     showConfirmButton: false,
                //     timer: 2000
                // });
                response.download('receipt.pdf');
                //window.location.href = '/client/job-contract-details'+"/"+job_leads_id;
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
