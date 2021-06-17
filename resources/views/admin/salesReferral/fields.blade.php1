<!-- Name Field -->
<div class="form-row">
	<div class="form-group col-sm-6">
	    <label>Order ID</label>
        <input type="text" class="form-control" name="order_id" value="{{ $order_finances_id->order_finance_id }}" readonly="">
	</div>
</div>

<!-- Type Field -->
<div class="form-row">
	<div class="form-group col-6">
        <label>Name of Lead Generator</label>
        <input type="text" class="form-control" name="name_of_lead_generator" readonly="">
	</div>
	<div class="form-group col-6">
        <label>Name of Delivery Resource</label>
        <select class="form-control" name="name_of_delivery_resource" readonly>
        	<option>Select Delivery Resource</option>
        </select>
	</div>
</div>

<div class="form-row">
	<div class="form-group col-6">
        <label>Total Advance Payment</label><small>(Including GST)</small>
		@foreach($finance->contractdetails->paymentschedule as $paymentschedule)
           <input type="text" class="form-control" name="total_order_value" value="{{ $paymentschedule->total_advance_payment }}" readonly>
		@endforeach
	</div>
	
	<div class="form-group col-6">
        <label>Sales Commission Amount</label><small>(Excluding GST)</small>
        <input type="text" class="form-control" name="sales_commission_amount" value="{{ $finance->contractdetails->sales_comm_amount }}" readonly>
    </div>
</div>

<div class="form-row">
	<div class="form-group col-6">
        <label>Resource Charge</label><small>(Excluding GST)</small>
        <input type="text" class="form-control" name="resource_charge" readonly="">
    </div>
	<div class="form-group col-6">
        <label>Ordering Company Name/Individual</label>
        <input type="text" class="form-control" name="ordering_company_name" value="{{ $finance->contractdetails->ordering_com_name }}" readonly>
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
{{--<br>
<h4 class="modal-title" id="modalLabelnews1">Payment Details</h4><br>

<!-- <div class="mb-3 mt-3 profile-basic">
    <button class="btn btn-primary" type="button" onclick="addSchedule('1')"> Sales <span class="fa fa-plus"></span></button>
    <button class="btn btn-primary" type="button" onclick="addSchedule1('1')"> Consultant <span class="fa fa-plus"></span></button>
</div> -->

<div class="form-row">
	<div class="form-group col-6">
        <label>Invoice Number</label>
        <input type="text" class="form-control" name="invoice_number" value="{{ $finance->contractdetails->orderinvoice->invoice_no }}" readonly>
    </div>
	<div class="form-group col-6">
        <label>Advance payment Details</label>
        <input type="text" class="form-control" name="advance_payment_details" value="{{ $finance->contractdetails->advance_payment_details }}" readonly="">
    </div>
</div>

<div class="form-row">
	<div class="form-group col-6">
        <label>Invoice Date </label>
        <input class="flatpickr flatpickr-input form-control" type="text" name="invoice_date" value="{{ $finance->contractdetails->orderinvoice->invoice_due_date }}" readonly="">
    </div>
	<div class="form-group col-6">
        <label>Invoice Amount</label><small>(Including GST)</small>
        <input type="text" class="form-control" name="invoice_amount" value="{{ $finance->contractdetails->orderinvoice->invoice_amount }}" readonly="">
    </div>
</div>--}}
<div class="form-row">
	<div class="form-group col-12">
        <label>Remarks </label>
        <textarea class="form-control" name="remarks" readonly>{!! $finance->contractdetails->remarks !!}</textarea>
    </div>
</div>
{{--
<br>
<h4 class="modal-title" id="modalLabelnews1">Customer Payment Schedule</h4><br>

@foreach ($finance->contractdetails->paymentschedule as $item)
    <div class="form-row">
        <div class="form-group col-5">
            @if ($item->advance_payment == '1')
                <label>Advance Payment </label><small>(Excluding GST)</small>
            @else
                <label>{{ $item->installment_no }} Installment</label><small>(Excluding GST)</small>
            @endif
            <input type="text" class="form-control" name="installment_amount" value="{{ $item->installment_amount }}" readonly>
        </div>
        <div class="form-group col-3">
            <label> Due Date</label>
            <input class="form-control" type="text" name="payment_due_date" value="{{ $item->paymwnt_due_date }}" readonly>
        </div>
        <div class="form-group col-4">
            <label>Hrs/Milestones/Remarks </label>
            <input type="text" class="form-control" name="milestones_name" value="{{ $item->milestones_name }}" readonly>
        </div>
    </div>
@endforeach
--}}

{{--<div class="form-row">
	<div class="form-group col-5">
	    <label>First Installment Details </label>
	    <input type="text" class="form-control" name="installment_amount" value="{{ $finance->paymentschedule->advance_payment_details }}" readonly="">
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
</div>--}}

{{--<br>
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
	    <input type="text" class="form-control" name="commission_amount" value="" readonly="">
	</div>
	<div class="form-group col-2">
	    <label>Due Date</label>
	    <input class="flatpickr flatpickr-input form-control" type="text" name="due_date" value="" readonly="">
	</div>
	<div class="form-group col-5">
	    <label>Hrs/Milestones </label>
	    <input type="text" class="form-control" name="milestones_name" value="" readonly="">
	</div>
</div>

<div class="form-row">
	<div class="form-group col-5">
	    <label>Commission Amount </label><small>(INR)</small>
	    <input type="text" class="form-control" name="commission_amount1" value="" readonly="">
	</div>
	<div class="form-group col-2">
	    <label>Due Date</label>
	    <input class="flatpickr flatpickr-input form-control" type="text" name="due_date" value="" readonly="">
	</div>
	<div class="form-group col-5">
	    <label>Remarks </label>
	    <input type="text" class="form-control" name="milestones_name" value="" readonly="">
	</div>
</div>--}}
<!-- <div class="form-row">
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
</div> -->

<!-- Submit Field -->
<div class="form-group text-right mt-5" style="text-align: left !important;">
	<div class="btn-group" role="group">
		<button class="btn btn-primary" type="button" onclick="assignToResource('{{ $order_finances_id->order_finance_id }}','2')">
			Assign To Resource(s) 
		</button>
	</div>
</div>
<!-- <div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div> -->
