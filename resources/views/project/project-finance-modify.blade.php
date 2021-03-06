@extends('layouts/default')

{{-- Page title --}}
@section('title')
Modify Contract Details
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}">
<link href="{{ asset('vendors/flatpickr/css/flatpickr.min.css') }}" rel="stylesheet"
type="text/css"/>
@yield('profile_css')
<!--end of page level css-->
@stop

@section('top')
<div class="bg-red">
  	<div class="px-5 py-2">
    	<div class="align-items-center">
        	<span class="border-title"><i class="fa fa-bars"></i></span>
        	<span class="h5 text-white">Modify Contract Details</span>
    	</div>
  	</div>
</div>
@stop
{{-- content --}}
@section('content')
<div class="profile-setting project-contract">
	<div class="container space-2">
	    <div class="row">
	        <div class="col-lg-8">
	        	<div id="notific">
		            @include('notifications')
		        </div>
	             <div class="singup-body login-body profile-basic">
					<div class="card">
                        <div class="bg-blue">
                            <div class="px-5 py-2">
                                <span class="h5 text-white" style="margin-left: -25px;">Modify Contract Details</span> <small>(To be filled by developer)</small>
                            </div>
                        </div>
						<div class="card-body p-4">
                            <form action="{{ route('project-finance.update') }}" method="POST" id="educationForm">
                                @csrf
                                <input type="hidden" name="project_schedule_id" value="{{ $projectlead->projectschedulee->project_schedule_id }}">
                                <input type="hidden" name="contract_id" value="{{ $projectlead->contractdetails->contract_id }}">
                                <input type="hidden" name="model_engagement" value="{{ $projectlead->contractdetails->model_engagement }}">
                                {{--<input type="hidden" name="invoice_id" value="{{ $projectlead->contractdetails->orderinvoice->order_invoice_id }}">--}}
                                <div class="main-moudle">
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Proposal Id</label>
                                            <input type="text" class="form-control" name="proposal_id" value="{{ $projectlead->project_leads_id }}" readonly>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Date of Acceptance</label>
                                            <input class="form-control" type="text" name="date_acceptance" value="{{ $projectlead->contractdetails->date_acceptance }}" readonly>
                                        </div>
                                    </div>
                                    @if($projectlead->contractdetails->model_engagement == '1')
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label>Per Hour Rate({{ $projectlead->projectdetail->projectCurrency->symbol }})</label>
                                                <input type="number" class="form-control num1 hours_purchase" name="installment_amount" value="{{ number_format($projectlead->contractdetails->order_closed_value, 0, ".", "") }}" readonly>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>No Of Hours Purchase</label>
                                                @foreach($projectlead->contractdetails->paymentschedule as $paymentschedule)
                                                <input type="number" class="form-control num2 hours_purchase" name="hours_purchase" value="{{ $paymentschedule->hours_purchase }}" readonly>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            @if($projectlead->projectdetail->referral_id != '0')
                                                <div class="form-group col-6">
                                                    <label>Sales Commission</label><small>({{ $projectlead->projectdetail->projectCurrency->symbol }})</small>
                                                    <input class="form-control" type="text" name="sales_commision" value="{{ $total_commission }}" readonly>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Total Advance Payment</label><small>(Including GST)({{ $projectlead->projectdetail->projectCurrency->symbol }})</small>
                                                    @foreach($projectlead->contractdetails->paymentschedule as $paymentschedule)
                                                    <input type="text" class="form-control" name="total_advance_payment" id=""  value="{{ $paymentschedule->total_advance_payment }}" readonly>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="form-group col-6">
                                                    <label>Total Advance Payment</label><small>(Including GST)({{ $projectlead->projectdetail->projectCurrency->symbol }})</small>
                                                    @foreach($projectlead->contractdetails->paymentschedule as $paymentschedule)
                                                    <input type="text" class="form-control" name="total_advance_payment" id=""  value="{{ $paymentschedule->total_advance_payment }}" readonly>
                                                    @endforeach
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>No Of Hours Purchase</label>
                                                    @foreach($projectlead->contractdetails->paymentschedule as $paymentschedule)
                                                    <input type="number" class="form-control" name="hours_purchase" value="{{ $paymentschedule->hours_purchase }}" readonly>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label>Ordering Company Name/Individual  </label>
                                                <input type="text" class="form-control" name="ordering_com_name" value="{{ $projectlead->contractdetails->ordering_com_name }}" readonly>
                                            </div>
                                        </div>
                                    @elseif($projectlead->contractdetails->model_engagement == '2')
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label>Rate Per Month({{ $projectlead->projectdetail->projectCurrency->symbol }})</label>
                                                <input type="number" class="form-control" name="installment_amount" value="{{ number_format($projectlead->contractdetails->order_closed_value, 0, ".", "") }}" readonly>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Agreed Scope Of Work</label>
                                                <input type="number" class="form-control" name="scope_of_work" value="{{ $projectlead->projectschedulee->scope_of_work }}" required>
                                            </div>
                                        </div>
                                        @if($projectlead->projectdetail->referral_id != '0')
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label>Sales Commission</label><small>({{ $projectlead->projectdetail->projectCurrency->symbol }})</small>
                                                    <input class="form-control" type="text" name="sales_commision" value="{{ $total_commission }}" readonly>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label>Contract Duration  </label>
                                                <input type="text" class="form-control" name="ordering_com_name" value="{{ $projectlead->delivery_timeline }}" readonly>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Total Advance Payment({{ $projectlead->projectdetail->projectCurrency->symbol }})</label>
                                                <input type="text" class="form-control order_closed_value" name="total_advance_payment" value="{{ $total_price }}" readonly>
                                            </div>
                                            {{--<div class="form-group col-6">
                                                <label>Ordering Company Name/Individual  </label>
                                                <input type="text" class="form-control" name="ordering_com_name" value="{{ $projectlead->contractdetails->ordering_com_name }}" readonly>
                                            </div>--}}
                                        </div>
                                    @else
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label>Per Project Amount({{ $projectlead->projectdetail->projectCurrency->symbol }})</label>
                                                <input type="number" class="form-control" name="installment_amount" value="{{ number_format($projectlead->contractdetails->order_closed_value, 0, ".", "") }}" readonly>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Milestone No.</label>
                                                @foreach($projectlead->projectschedulee->schedulemodulee1 as $schedulemodulee)
                                                  <input type="number" class="form-control" name="milestone_no" value="{{ $schedulemodulee->milestone_no }}" required>
                                                @endforeach
                                            </div>
                                        </div>
                                        @if($projectlead->projectdetail->referral_id != '0')
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label>Sales Commission</label><small>({{ $projectlead->projectdetail->projectCurrency->symbol }})</small>
                                                    <input class="form-control" type="text" name="sales_commision" value="{{ $total_commission }}" readonly>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label>Paybale Amount </label><small>({{ $projectlead->projectdetail->projectCurrency->symbol }})</small>
                                                @foreach($projectlead->projectschedulee->schedulemodulee1 as $schedulemodulee)
                                                   <input type="text" class="form-control" name="ordering_com_name" value="{{ $schedulemodulee->payable_amount }}" readonly>
                                                @endforeach
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Total Advance Payment({{ $projectlead->projectdetail->projectCurrency->symbol }})</label>
                                                <input type="text" class="form-control order_closed_value" name="total_advance_payment" value="{{ $total_price }}" readonly>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>Status</label>
                                            <select name="status[]" class="form-control" disabled>
                                                @foreach($projectlead->contractdetails->paymentschedule as $item)
                                                    <option value="1" {{ ($item->status=='1')? "selected" : "" }}>Pending</option>
                                                    <option value="2" {{ ($item->status=='2')? "selected" : "" }}>Paid</option>
                                                    <option value="3" {{ ($item->status=='3')? "selected" : "" }}>Cancel</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right mt-5" id="status">
                                    <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary" type="submit">Send To Eiliana Finance</button>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
	        </div>
			 @include('layouts.left')
	    </div>
	    <!-- End Row -->
	</div>
</div>

@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $(".order_closed_value").val();
    $(".hours_purchase").val();

    function calc(){
        var num1 = $(".num1").val();
        var num2 = $(".num2").val();
        var gst_rate = 18;
        price = parseInt(num1) * parseInt(num2);
        GST_amount = (price * gst_rate) / 100;
        total_price = price + GST_amount;
        $('.order_closed_value').val(total_price);
        $('#amount').val(total_price);
    }
    $(".hours_purchase").keyup(function(){
        calc();
    });
});

</script>

<!--global js end-->
@stop

