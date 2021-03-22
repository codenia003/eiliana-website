<!-- Name Field -->
<div class="form-row">
	<div class="form-group col-sm-6">
	    <label>Order ID</label>
        <input type="text" class="form-control" name="order_id" value="{{ $order_finances_id->job_order_id }}" readonly="">
	</div>
    <div class="form-group col-6">
        <label>Price </label>
        <input type="text" class="form-control" name="resource_charge" value="{{ $order_finances_id->jobAmount->price }}" readonly="">
    </div>
</div>

<div class="form-row">
	<div class="form-group col-6">
        <label>Invoice Number</label>
        <input type="text" class="form-control" name="invoice_number" value="{{ $order_finances_id->invoice_id }}" readonly>
    </div>
    <div class="form-group col-6">
        <label>Invoice Date </label>
        <input class="form-control" type="text" name="invoice_date" readonly="">
    </div>
</div>
<div class="form-row">
	<div class="form-group col-6">
        <label>Remarks </label>
        <textarea class="form-control" name="remarks" readonly></textarea>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group text-right mt-5" style="text-align: left !important;">
	<div class="btn-group" role="group">
		<!-- <button class="btn btn-primary" type="button" onclick="assignToResource('{{ $order_finances_id->job_finance_id }}','2')">
			Assign To Resource(s) 
		</button> -->
        <button class="btn btn-primary" type="button">
            Assign To Resource(s) 
        </button>
	</div>
</div>
<!-- <div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div> -->
