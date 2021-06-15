<!-- Name Field -->
<div class="form-row">
	<div class="form-group col-6">
	    <label>Order ID</label>
        <input type="text" class="form-control" name="order_id" value="{{ $order_finances_id->order_finance_id }}" readonly="">
	</div>
    <div class="form-group col-6">
        <label>Freelancer Name</label>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $order_finances_id->userprojects->fromuser->full_name }}" readonly="">
	</div>
</div>
<input type="hidden" name="user_id" value="{{ $finance->projectdetail->posted_by_user_id }}">
<!-- Type Field -->
<div class="form-row">
    <div class="form-group col-6">
        <label>Customer Name</label>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $order_finances_id->userprojects->projectdetail->companydetails->full_name }}" readonly="">
	</div>
    <div class="form-group col-6">
        <label>Pan Card</label>
        <input type="text" class="form-control" name="pan_card">
	</div>
</div>

<!-- Type Field -->
<div class="form-row">
    <div class="form-group col-6">
        <label>Resource Name</label>
        <input type="text" class="form-control" name="name_of_lead_generator" readonly>
	</div>
    <div class="form-group col-6">
        <label>No Of Hours Purchase</label>
        @foreach($finance->contractdetails->paymentschedule as $paymentschedule)
           <input type="text" class="form-control" name="total_order_value" value="{{ $paymentschedule->hours_purchase }}" readonly>
        @endforeach
    </div>
</div>

<!-- Type Field -->
<div class="form-row">
    <div class="form-group col-6">
        <label>Per Hour Rate</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>
        <input type="text" class="form-control" name="name_of_lead_generator" value="{{ $finance->contractdetails->order_closed_value }}" readonly="">
	</div>
    <div class="form-group col-6">
        <label>Date of Acceptance</label>
        <input type="text" class="form-control" name="total_order_value" value="{{ date('Y-m-d', strtotime(str_replace('-', '/', $finance->contractdetails->created_at))) }}" readonly>
	</div>
</div>

<!-- Type Field -->
<div class="form-row">
    <div class="form-group col-6">
        <label>Total Advance Payment</label><small>({{ $finance->projectdetail->projectCurrency->symbol }})</small>
		@foreach($finance->contractdetails->paymentschedule as $paymentschedule)
           <input type="text" class="form-control" name="total_order_value" value="{{ $paymentschedule->total_advance_payment }}" readonly>
		@endforeach
	</div>
	<div class="form-group col-6">
        <label>GST Details</label>
        <input type="text" class="form-control" name="gst_no">
	</div>
</div>

<!-- Type Field -->
<div class="form-row">
	<div class="form-group col-6">
        <label>Payment Details</label>
        <input type="text" class="form-control" name="name_of_lead_generator" readonly>
	</div>
    <div class="form-group col-6">
        <label>Ordering Company Name/Individual</label>
        <input type="text" class="form-control" name="ordering_company_name" value="{{ $finance->contractdetails->ordering_com_name }}" readonly>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group text-right mt-5" style="text-align: left !important;">
	<div class="btn-group" role="group">
        <button class="btn btn-primary" type="button" onclick="assignToResource('{{ $order_finances_id->order_finance_id }}','2')">
			Accept 
		</button>&nbsp;&nbsp;
    </div>
    <div class="btn-group" role="group">
        <button class="btn btn-primary" type="button" onclick="assignToResource('{{ $order_finances_id->order_finance_id }}','3')">
			Modify
		</button>
		{{--<button class="btn btn-primary" type="button" onclick="assignToResource('{{ $order_finances_id->order_finance_id }}','2')">
			Assign To Resource(s) 
		</button>--}}
	</div>
</div>
