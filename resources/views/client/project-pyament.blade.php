@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Contract Details </span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="profile-information">
    <div id="notific">
        @include('notifications')
    </div>
     <div class="singup-body login-body profile-basic">
        <div class="card">
        <div class="bg-blue">
            <div class="px-5 py-2">
                <span class="h5 text-white" style="margin-left: -25px;">Contract Details</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="{{ route('project-contract-payment') }}" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="contract_id" value="{{ $projectlead->contractdetails->contract_id }}">
                    <input type="hidden" name="model_engagement" value="{{ $projectlead->contractdetails->model_engagement }}">

                    <div class="main-moudle">
                     
                    @if($projectlead->contractdetails->model_engagement == '1')
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Proposal Id</label>
                                <input type="text" class="form-control" name="proposal_id" value="{{ $projectlead->project_leads_id }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Per Hour Rate({{ $projectlead->projectdetail->projectCurrency->symbol }})</label>
                                <input type="number" class="form-control" name="installment_amount" value="{{ number_format($projectlead->contractdetails->order_closed_value, 0, ".", "") }}" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>No Of Hours Purchase</label>
                                @foreach($projectlead->contractdetails->paymentschedule as $paymentschedule)
                                    <input type="text" class="form-control" name="total_order_value" value="{{ $paymentschedule->hours_purchase }}" readonly>
                                @endforeach
                            </div>
                        </div>

                        @foreach($projectlead->projectschedulee->schedulemodulee1 as $key => $modulee)
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Project Start Date</label>
                                    <input class="form-control" type="text" name="actual_module_start_date" value="{{ $modulee->actual_module_start_date }}" readonly>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label> Module Scope</label>
                                    <input type="text" name="module_scope" class="form-control" value="{{ $modulee->module_scope }}" readonly>
                                </div>
                                <div class="form-group col-6">
                                    <label>Module Status </label>
                                    <select name="module_status[]" class="form-control" disabled>
                                        <option value="1" {{ ($modulee->module_status=='1')? "selected" : "" }}>To be Started</option>
                                        <option value="2" {{ ($modulee->module_status=='2')? "selected" : "" }}>In Progress</option>
                                        <option value="3" {{ ($modulee->module_status=='3')? "selected" : "" }}>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name="remarks" rows="4" readonly>{{ $modulee->module_remark }}</textarea>
                                </div>
                            </div>
                        @endforeach

                    @elseif($projectlead->contractdetails->model_engagement == '2')
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Proposal Id</label>
                                <input type="text" class="form-control" name="proposal_id" value="{{ $projectlead->project_leads_id }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Rate Per Month({{ $projectlead->projectdetail->projectCurrency->symbol }})</label>
                                <input type="number" class="form-control" name="installment_amount" value="{{ number_format($projectlead->contractdetails->order_closed_value, 0, ".", "") }}" readonly>
                            </div>
                        </div>

                        @foreach($projectlead->projectschedulee->schedulemodulee1 as $key => $modulee)
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Project Start Date</label>
                                    <input class="form-control" type="text" name="actual_module_start_date" value="{{ $modulee->actual_module_start_date }}" readonly>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label> Module Scope</label>
                                    <input type="text" name="module_scope" class="form-control" value="{{ $modulee->module_scope }}" readonly>
                                </div>
                                <div class="form-group col-6">
                                    <label><span class="module_num">{{ $key + 1 }}</span>. Module Status </label>
                                    <select name="module_status[]" class="form-control" disabled>
                                        <option value="1" {{ ($modulee->module_status=='1')? "selected" : "" }}>To be Started</option>
                                        <option value="2" {{ ($modulee->module_status=='2')? "selected" : "" }}>In Progress</option>
                                        <option value="3" {{ ($modulee->module_status=='3')? "selected" : "" }}>Completed</option>
                                    </select>
                                </div>
                            </div>


                            @foreach ($projectlead->contractdetails->paymentschedule as $item)
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        @if ($item->advance_payment == '1')
                                            <label>Adv. Payment </label><small>(Excluding GST)</small>
                                        @else
                                         {{--<label>{{ $key + 1 }} Installment</label><small>(Excluding GST)</small>--}}
                                        <label>{{ $item->installment_no }} Installment</label><small>(Excluding GST)</small>
                                        @endif
                                        <input type="text" class="form-control" name="installment_amount" value="{{ $item->installment_amount }}" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Status</label>
                                        <select name="status[]" class="form-control" disabled>
                                            <option value="1" {{ ($item->status=='1')? "selected" : "" }}>Pending</option>
                                            <option value="2" {{ ($item->status=='2')? "selected" : "" }}>Paid</option>
                                            <option value="3" {{ ($item->status=='3')? "selected" : "" }}>Cancel</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name="remarks" rows="4" readonly>{{ $modulee->module_remark }}</textarea>
                                </div>
                            </div>
                        @endforeach

                    @elseif($projectlead->contractdetails->model_engagement == '3')
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Proposal Id</label>
                                <input type="text" class="form-control" name="proposal_id" value="{{ $projectlead->project_leads_id }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Per Project Amount({{ $projectlead->projectdetail->projectCurrency->symbol }})</label>
                                <input type="number" class="form-control" name="installment_amount" value="{{ number_format($projectlead->contractdetails->order_closed_value, 0, ".", "") }}" readonly>
                            </div>
                        </div>

                        @foreach($projectlead->projectschedulee->schedulemodulee1 as $key => $modulee)
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Project Start Date</label>
                                    <input class="form-control" type="text" name="actual_module_start_date" value="{{ $modulee->actual_module_start_date }}" readonly>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-6">
                                <label><span class="module_num">{{ $modulee->milestone_no }}</span>. Module Scope</label>
                                    {{--<label><span class="module_num">{{ $key + 1 }}</span>. Module Scope</label>--}}
                                    <input type="text" name="module_scope" class="form-control" value="{{ $modulee->module_scope }}" readonly>
                                </div>
                                <div class="form-group col-6">
                                    <label>Module Status </label>
                                    <select name="module_status[]" class="form-control" disabled>
                                        <option value="1" {{ ($modulee->module_status=='1')? "selected" : "" }}>To be Started</option>
                                        <option value="2" {{ ($modulee->module_status=='2')? "selected" : "" }}>In Progress</option>
                                        <option value="3" {{ ($modulee->module_status=='3')? "selected" : "" }}>Completed</option>
                                    </select>
                                </div>
                            </div>
                            @foreach ($projectlead->contractdetails->paymentschedule as $item)
                                <div class="form-row">
                                    <div class="form-group col-4">
                                        @if ($item->advance_payment == '1')
                                            <label>Adv. Payment </label><small>(Excluding GST)</small>
                                        @else
                                         {{--<label>{{ $key + 1 }} Installment</label><small>(Excluding GST)</small>--}}
                                        <label>{{ $item->installment_no }} Installment</label><small>(Excluding GST)</small>
                                        @endif
                                        <input type="text" class="form-control" name="installment_amount" value="{{ $item->installment_amount }}" readonly>
                                    </div>
                                    {{--<div class="form-group col-3">
                                        <label>Payment Due Date</label>
                                        <input class="form-control" type="text" name="payment_due_date" value="{{ $item->paymwnt_due_date }}" readonly>
                                    </div>--}}
                                    <div class="form-group col-4">
                                        <label>Milestone No. </label>
                                        <input type="number" class="form-control" name="" value="{{ $modulee->milestone_no }}" readonly>
                                        <input type="hidden" name="milestone_no" value="{{ $modulee->milestone_no }}">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Status</label>
                                        <select name="status[]" class="form-control" disabled>
                                            <option value="1" {{ ($item->status=='1')? "selected" : "" }}>Pending</option>
                                            <option value="2" {{ ($item->status=='2')? "selected" : "" }}>Paid</option>
                                            <option value="3" {{ ($item->status=='3')? "selected" : "" }}>Cancel</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name="remarks" rows="4" readonly>{{ $modulee->module_remark }}</textarea>
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- <h4 class="modal-title">Customer Payment Schedules</h4> -->
                        {{--@foreach ($projectlead->contractdetails->paymentschedule as $item)
                            {{-- <div class="form-row">
                                <div class="form-group col-4">
                                    @if ($item->advance_payment == '1')
                                        <label>Adv. Payment </label><small>(Excluding GST)</small>
                                    @else
                                        <label>{{ $item->installment_no }} Installment</label><small>(Excluding GST)</small>
                                    @endif
                                    <input type="text" class="form-control" name="installment_amount" value="{{ $item->installment_amount }}" readonly>
                                </div>--}}
                                {{--<div class="form-group col-3">
                                    <label>Payment Due Date</label>
                                    <input class="form-control" type="text" name="payment_due_date" value="{{ $item->paymwnt_due_date }}" readonly>
                                </div>--}}
                                {{--<div class="form-group col-4">
                                    <label>Milestone No. </label>
                                    @foreach($projectlead->projectschedulee->schedulemodulee as $key => $modulee)
                                       <input type="number" class="form-control" name="milestone_no" value="{{ $modulee->milestone_no }}" readonly>
                                       <input type="hidden" name="milestone_no" value="{{ $modulee->milestone_no }}">
                                    @endforeach
                                </div>
                                <div class="form-group col-4">
                                    <label>Status</label>
                                    <select name="status[]" class="form-control" disabled>
                                        <option value="1" {{ ($item->status=='1')? "selected" : "" }}>Pending</option>
                                        <option value="2" {{ ($item->status=='2')? "selected" : "" }}>Paid</option>
                                        <option value="3" {{ ($item->status=='3')? "selected" : "" }}>Cancel</option>
                                    </select>
                                </div>
                            </div>
                        @endforeach--}}
                      @endif
                    </div>
                    @isset($next_installment->installment_amount)

                        <input type="hidden" name="amount" id="amount" value="{{ $next_installment->installment_amount }}">
                        <input type="hidden" name="payment_schedule_id" id="payment_schedule_id" value="{{ $next_installment->payment_schedule_id }}">
                    @endisset


                    <input type="hidden" name="currency" id="currency" value="INR">
                    <input type="hidden" name="status" id="status" value="1">
                    <input type="hidden" name="payment_id" id="payment_id" value="">
                    @if ($projectlead->contractdetails->status == '1')
                        <div class="form-group text-right mt-5" id="status">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary" type="button" onclick="contractDetails('{{ $projectlead->contractdetails->contract_id }}','2')">Accept</button>
                                <button class="btn btn-primary" type="button" onclick="contractDetails('{{ $projectlead->contractdetails->contract_id }}''4')">Reject</button>
                            </div>
                        </div>
                    @elseif ($projectlead->contractdetails->status == '4')
                    <p>Status: Cancel</p>
                    @else
                        @isset($next_installment->installment_amount)
                        <div class="singup-body" id="payment_button" style="border-top: 1px solid #ffffff;">
                            <div class="btn-group" role="group">
                                <span>Please pay payment for further process</span>
                                <button type="button" id="paybtn" class="btn btn-primary deliverinfo">Payment Link</button>
                            </div>
                        </div>
                        @endisset
                    @endif
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
                var msg = userCheck.msg;
                var redirect = '#';
                // Swal.fire({
                //     type: 'success',
                //     title: 'Success...',
                //     text: userCheck.msg,
                //     showConfirmButton: false,
                //     timer: 2000
                // });

                $('#payment_button').show();
                $('#status').hide();

                // window.location.href = '/freelancer/my-opportunity';
            } else {
                var msg = userCheck.errors;
                var redirect = '#';
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
