<!-- Name Field -->
<div class="form-row">
	<div class="form-group col-6">
	    <label>Order ID</label>
        <input type="text" class="form-control" name="order_id" value="{{ $order_finances_id->order_finance_id }}" readonly="">
	</div>
    <div class="form-group col-6">
        <label>Freelancer Name</label>
        <input type="text" class="form-control" name="freelancer_name" value="{{ $order_finances_id->userprojects->fromuser->full_name }}" readonly="">
	</div>
</div>
<input type="hidden" name="user_id" value="{{ $finance->projectdetail->posted_by_user_id }}">
<!-- Type Field -->
<div class="form-row">
    <div class="form-group col-6">
        <label>Customer GST Number(Optional)</label>
        <input type="text" class="form-control gst_no user_details" name="gst_no" id="gst_no">
	</div>
    <div class="form-group col-6">
        <label>Customer Pan Card(Optional)</label>
        <input type="text" class="form-control pan_card user_details" name="pan_card" id="pan_card">
	</div>
</div>

<!-- Name Field -->
<div class="form-row">
	<div class="form-group col-6">
	    <label>Customer Address</label>
        <input type="text" class="form-control" name="customer_address" value="{{ $order_finances_id->userprojects->projectdetail->companydetails->address }}" readonly="">
	</div>
    <div class="form-group col-6">
        <label>City</label>
        <input type="text" class="form-control" name="city" value="{{ $order_finances_id->userprojects->projectdetail->companydetails->city }}" readonly="">
	</div>
</div>

<div class="form-row">
	<div class="form-group col-6">
	    <label>State</label>
        <input type="text" class="form-control" name="state" value="{{ $order_finances_id->userprojects->projectdetail->companydetails->user_state }}" readonly="">
	</div>
    <div class="form-group col-6">
        <label>Country</label>
        @if(!empty($country_name))
           <input type="text" class="form-control" name="country" value="{{ $country_name->name }}" readonly="">
        @endif
	</div>
</div>
<!-- Type Field -->
<div class="form-row">
    <div class="form-group col-6">
        <label>Date of Acceptance</label>
        <input type="text" class="form-control" name="total_order_value" value="{{ $finance->contractdetails->date_acceptance }}" readonly>
	</div>
    <div class="form-group col-6">
        <label>Ordering Company Name/Individual</label>
        <input type="text" class="form-control" name="ordering_company_name" value="{{ $finance->contractdetails->ordering_com_name }}" readonly>
    </div>
</div>

@if($finance->contractdetails->model_engagement == '1')
<h4 class="modal-title" style="font-size: 21px;" id="modalLabelnews1"> Payment Details</h4><br>
<!-- Type Field -->
<div class="form-row">
    <div class="form-group col-6">
        <label>Per Hour Rate</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->contractdetails->order_closed_value }}" readonly="">
	</div>
    <div class="form-group col-6">
        <label>No Of Hours Purchase</label>
        @foreach($finance->contractdetails->paymentschedule as $paymentschedule)
           <input type="text" class="form-control" name="total_order_value" value="{{ $paymentschedule->hours_purchase }}" readonly>
        @endforeach
    </div>
</div>

@if($finance->projectdetail->referral_id != '0') 
<h4 class="modal-title" style="font-size: 21px;" id="modalLabelnews1">Commission Payment Schedule</h4><br>
<?php
        $installment = $finance->contractdetails->order_closed_value;
        $commission = $finance->sales_comm_amount;
        $total_commission = $installment * $commission/100;
?>
<div class="form-row">
    <div class="form-group col-12">
        <label>Total Commission</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>
        <input class="form-control" type="text" name="sales_commision" value="{{ $total_commission }}" readonly>
	</div>
</div>
@endif

<h4 class="modal-title" style="font-size: 21px;" id="modalLabelnews1">Total Advance Details </h4><br>
@foreach($finance->contractdetails->paymentschedule as $paymentschedule)
<div class="form-row">
    <div class="form-group col-6">
        <label>Payment ID</label>
        <input type="text" class="form-control" name="total_order_value" value="{{ $paymentschedule->payment_id }}" readonly>
	</div>
    <div class="form-group col-6">
        <label>Total Advance Payment</label><small>(Including GST + Commission)({{ $finance->projectdetail->projectCurrency->symbol }})</small>
        <input type="text" class="form-control" name="total_order_value" value="{{ $paymentschedule->total_advance_payment }}" readonly>
	</div>
</div>
@endforeach

@elseif($finance->contractdetails->model_engagement == '2')
<h4 class="modal-title" style="font-size: 21px;" id="modalLabelnews1"> Installment Details</h4><br>
<div class="form-row">
    <div class="form-group col-6">
        <label>First Installment</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->contractdetails->order_closed_value }}" readonly="">
	</div>
    <div class="form-group col-3">
        <label>Billing Period From</label><small>(Month)</small>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->projectdetail->project_duration_min }}" readonly="">
	</div>
    <div class="form-group col-3">
        <label>Billing Period To</label><small>(Month)</small>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->projectdetail->project_duration_max }}" readonly="">
	</div>
</div>

@if($finance->projectdetail->referral_id != '0') 
<h4 class="modal-title" style="font-size: 21px;" id="modalLabelnews1">Commission Payment Schedule</h4><br>
<div class="form-row">
    <div class="form-group col-4">
        <label>First Installment</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->contractdetails->order_closed_value }}" readonly="">
	</div>
    <div class="form-group col-2">
        <label>Billing Period From</label><small>(Month)</small>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->projectdetail->project_duration_min }}" readonly="">
	</div>
    <div class="form-group col-2">
        <label>Billing Period To</label><small>(Month)</small>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->projectdetail->project_duration_max }}" readonly="">
	</div>
    <?php
          $installment = $finance->contractdetails->order_closed_value;
          $commission = $finance->sales_comm_amount;
          $total_commission = $installment * $commission/100;
    ?>
    <div class="form-group col-4">
        <label>Total Commission</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>
        <input class="form-control" type="text" name="sales_commision" value="{{ $total_commission }}" readonly>
	</div>
</div>
{{--<div class="form-row">
    <div class="form-group col-6">
        <label>Sales Commission(%):</label>
        <input class="form-control" type="text" name="sales_commision" value="{{ $finance->sales_comm_amount }}" readonly>
	</div>
    <div class="form-group col-6">
        <label>Total Proposal Value</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>
		<input class="form-control" type="text" name="total_proposal_value" value="{{ $finance->total_proposal_value }}" readonly>
	</div>
</div>--}}
@endif

<h4 class="modal-title" style="font-size: 21px;" id="modalLabelnews1">Total Advance Details </h4><br>
<div class="form-row">
    <div class="form-group col-6">
        <label>Payment ID</label>
        @foreach($finance->contractdetails->paymentschedule as $paymentschedule)
           <input type="text" class="form-control" name="total_order_value" value="{{ $paymentschedule->payment_id }}" readonly>
        @endforeach
    </div>
    <div class="form-group col-6">
        <label>Total Advance Payment</label><small>(Including GST + Commission)({{ $finance->projectdetail->projectCurrency->symbol }})</small>
        <input type="text" class="form-control" name="total_order_value" value="{{ $total_price }}" readonly>
	</div>
</div>

{{--<div class="form-row">
    <div class="form-group col-6">
        <label>Rate Per Month</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>

        @if($finance->projectdetail->referral_id != '0') 
           <input class="form-control" type="text" name="total_proposal_value" value="{{ $finance->total_proposal_value }}" readonly>
        @else
           <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->contractdetails->order_closed_value }}" readonly="">
        @endif
	</div>
    <div class="form-group col-6">
        <label>Agreed Scope Of Work</label>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->projectschedulee->scope_of_work }}" readonly="">
	</div>
</div>

<div class="form-row">
    <div class="form-group col-6">
        <label>Due Date</label>
        @foreach($finance->contractdetails->paymentschedule as $paymentschedule)
           <input type="text" class="form-control" name="total_order_value" value="{{ $paymentschedule->paymwnt_due_date }}" readonly>
        @endforeach
    </div>
    <div class="form-group col-6">
        <label>Total Advance Payment</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>
        <input type="text" class="form-control" name="total_order_value" value="{{ $total_price }}" readonly>
	</div>
</div>--}}

@else
<div class="form-row">
    <div class="form-group col-4">
        <label>Total Project Cost</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>

        @if($finance->projectdetail->referral_id != '0') 
           <input class="form-control" type="text" name="total_proposal_value" value="{{ $finance->total_proposal_value }}" readonly>
        @else
           <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->contractdetails->order_closed_value }}" readonly="">
        @endif
	</div>
    @foreach ($finance->projectschedulee->schedulemodulee as $item)
    <div class="form-group col-4">
        <label>Payble Amount</label>
        <input type="text" class="form-control" name="payable_amount" value="{{ $item->payable_amount }}" readonly="">
	</div>
    <div class="form-group col-4">
        <label>Milestones No.</label>
        <input type="text" class="form-control" name="milestone_no" value="{{ $item->milestone_no }}" readonly="">
	</div>
    @endforeach
</div>

@foreach ($finance->contractdetails->paymentschedule as $item)
<div class="form-row">
    <div class="form-group col-6">
        <label>Due Date</label>
        <input type="text" class="form-control" name="total_order_value" value="{{ $item->paymwnt_due_date }}" readonly>
	</div>
    <div class="form-group col-6">
        <label>Total Advance Payment</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>
        <input type="text" class="form-control" name="total_order_value" value="{{ $item->total_advance_payment }}" readonly>
	</div>
</div>
@endforeach

@endif

<!-- Submit Field -->
<div class="form-group text-right mt-5" style="text-align: left !important;">
	<div class="btn-group" role="group">
        <button class="btn btn-primary" style="font-size: 17px !important;" type="button" onclick="assignToResource('{{ $order_finances_id->order_finance_id }}','{{ $finance->projectdetail->posted_by_user_id }}','2')">
			Accept 
		</button>&nbsp;&nbsp;
    </div>
    <div class="btn-group" role="group">
        <button class="btn btn-primary" style="font-size: 17px !important;" type="button" onclick="assignToResource('{{ $order_finances_id->order_finance_id }}','{{ $finance->projectdetail->posted_by_user_id }}','3')">
			Modify
		</button>&nbsp;&nbsp;
	</div>
    <div class="btn-group" role="group">
		<button class="btn btn-primary" style="font-size: 17px !important;" type="button" onclick="GenerateBill('{{ $finance->project_leads_id }}','{{ $paymentschedule->total_advance_payment }}','2')">
			Generate Bill 
		</button>
	</div>
</div>
