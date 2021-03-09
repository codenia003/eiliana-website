<!-- Name Field -->
<div class="form-row">
	<div class="form-group col-sm-6">
	    <label>Order ID</label>
        <input type="text" class="form-control" name="order_id" required>
	</div>
</div>

<!-- Type Field -->
<div class="form-row">
	<div class="form-group col-6">
        <label>Name of Lead Generator</label>
        <input type="text" class="form-control" name="name_of_lead_generator" required>
	</div>
	<div class="form-group col-6">
        <label>Name of Delivery Resource</label>
        <select class="form-control" name="name_of_delivery_resource">
        	<option>Select Delivery Resource</option>
        </select>
	</div>
</div>

<div class="form-row">
	<div class="form-group col-6">
        <label>Total Order Value</label><small>(including sales Commission & Excluding GST)</small>
        <input type="text" class="form-control" name="total_order_value" required>
    </div>
	<div class="form-group col-6">
        <label>Sales Commission Amount</label><small>(Excluding GST)</small>
        <input type="text" class="form-control" name="sales_commission_amount" required>
    </div>
</div>

<div class="form-row">
	<div class="form-group col-6">
        <label>Resource Charge</label><small>(Excluding GST)</small>
        <input type="text" class="form-control" name="resource_charge" required>
    </div>
	<div class="form-group col-6">
        <label>Ordering Company Name/Individual</label>
        <input type="text" class="form-control" name="ordering_company_name" required>
    </div>
</div>

<div class="form-group basic-info mb-3">
    <label>Model Of Engagement</label>
    <br>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            <input type="radio" id="hourly" class="custom-control-input" name="title1" checked>
            <label class="custom-control-label" for="hourly">Hourly</label>
        </div>
    </div>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            <input type="radio" id="pt_rentainer" class="custom-control-input" name="title1">
            <label class="custom-control-label" for="pt_rentainer">P.T.Rentainer</label>
        </div>
    </div>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            <input type="radio" id="project_based" class="custom-control-input" name="title1">
            <label class="custom-control-label" for="project_based"> Project-based</label>
        </div>
    </div>
</div>
<br>
<h4 class="modal-title" id="modalLabelnews1">Payment Details</h4><br>

<!-- <div class="mb-3 mt-3 profile-basic">
    <button class="btn btn-primary" type="button" onclick="addSchedule('1')"> Sales <span class="fa fa-plus"></span></button>
    <button class="btn btn-primary" type="button" onclick="addSchedule1('1')"> Consultant <span class="fa fa-plus"></span></button>
</div> -->

<div class="form-row">
	<div class="form-group col-6">
        <label>Invoice Number</label>
        <input type="text" class="form-control" name="invoice_number" required>
    </div>
	<div class="form-group col-6">
        <label>Advance payment Details</label>
        <input type="text" class="form-control" name="advance_payment_details" required>
    </div>
</div>

<div class="form-row">
	<div class="form-group col-6">
        <label>Invoice Date </label>
        <input class="flatpickr flatpickr-input form-control" type="text" name="invoice_date" value="" required>
    </div>
	<div class="form-group col-6">
        <label>Invoice Amount</label><small>(Including GST)</small>
        <input type="text" class="form-control" name="invoice_amount" required>
    </div>
</div>
<div class="form-row">
	<div class="form-group col-6">
        <label>Remarks </label>
        <textarea class="form-control" name="remarks"></textarea>
    </div>
</div>

<br>
<h4 class="modal-title" id="modalLabelnews1">Customer Payment Schedule</h4><br>

<div class="form-row">
	<div class="form-group col-5">
	    <label>First Installment Details </label>
	    <input type="text" class="form-control" name="installment_amount" value="" >
	</div>
	<div class="form-group col-2">
	    <label>Due Date</label>
	    <input class="flatpickr flatpickr-input form-control" type="text" name="due_date" value="">
	</div>
	<div class="form-group col-5">
	    <label>Hrs/Milestones/Remarks </label>
	    <input type="text" class="form-control" name="milestones_name" value="" >
	</div>
</div>

<div class="form-row">
	<div class="form-group col-5">
	    <label>Payment Details </label>
	    <input type="text" class="form-control" name="payment_details" value="" >
	</div>
	<div class="form-group col-2">
	    <label>Due Date</label>
	    <input class="flatpickr flatpickr-input form-control" type="text" name="due_date" value="">
	</div>
	<div class="form-group col-5">
	    <label>Remarks </label>
	    <input type="text" class="form-control" name="milestones_name" value="" >
	</div>
</div>
<div class="form-row">
	<div class="form-group col-5">
	    <label>Payment Details </label>
	    <input type="text" class="form-control" name="payment_details" value="" >
	</div>
	<div class="form-group col-2">
	    <label>Due Date</label>
	    <input class="flatpickr flatpickr-input form-control" type="text" name="due_date" value="">
	</div>
	<div class="form-group col-5">
	    <label>Remarks </label>
	    <input type="text" class="form-control" name="milestones_name" value="" >
	</div>
</div>

<br>
<h4 class="modal-title" id="modalLabelnews1">Commission Payment Schedule</h4><br>

<div class="form-group basic-info mb-3">
    <br>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            <input type="radio" id="one_time" class="custom-control-input" name="title" checked>
            <label class="custom-control-label" for="one_time">One Time</label>
        </div>
    </div>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            <input type="radio" id="recurring" class="custom-control-input" name="title">
            <label class="custom-control-label" for="recurring">Recurring</label>
        </div>
    </div>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            <input type="radio" id="no_comission" class="custom-control-input" name="title">
            <label class="custom-control-label" for="no_comission"> No Comission</label>
        </div>
    </div>
</div>
<div class="form-row">
	<div class="form-group col-5">
	    <label>Commission Amount </label><small>(INR)(Excluding GST)</small>
	    <input type="text" class="form-control" name="commission_amount" value="" >
	</div>
	<div class="form-group col-2">
	    <label>Due Date</label>
	    <input class="flatpickr flatpickr-input form-control" type="text" name="due_date" value="">
	</div>
	<div class="form-group col-5">
	    <label>Hrs/Milestones </label>
	    <input type="text" class="form-control" name="milestones_name" value="" >
	</div>
</div>

<div class="form-row">
	<div class="form-group col-5">
	    <label>Commission Amount </label><small>(INR)</small>
	    <input type="text" class="form-control" name="commission_amount1" value="" >
	</div>
	<div class="form-group col-2">
	    <label>Due Date</label>
	    <input class="flatpickr flatpickr-input form-control" type="text" name="due_date" value="">
	</div>
	<div class="form-group col-5">
	    <label>Remarks </label>
	    <input type="text" class="form-control" name="milestones_name" value="" >
	</div>
</div>
<div class="form-row">
	<div class="form-group col-5">
	    <label>Commission Amount </label><small>(INR)</small>
	    <input type="text" class="form-control" name="commission_amount2" value="" >
	</div>
	<div class="form-group col-2">
	    <label>Due Date</label>
	    <input class="flatpickr flatpickr-input form-control" type="text" name="due_date" value="">
	</div>
	<div class="form-group col-5">
	    <label>Remarks </label>
	    <input type="text" class="form-control" name="milestones_name" value="" >
	</div>
</div>

<!-- Submit Field -->
<div class="form-group text-right mt-5" style="text-align: left !important;">
	<div class="btn-group" role="group">
		<button class="btn btn-primary" type="button">
			Assign To Resource(s) 
		</button>
	</div>
</div>
<!-- <div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div> -->
