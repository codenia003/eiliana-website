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
    <div class="form-group col-12">
        <label>Total Order Value</label><small>(including sales Commission & Excluding GST)</small>
        @if(!empty($finance->jobcontractdetails->order_closed_value))
              <input type="text" class="form-control" name="total_order_value" value="{{ $finance->jobcontractdetails->order_closed_value }}" readonly>
         @else 
            <input type="text" class="form-control" name="total_order_value" value="" readonly>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-6">
        <label>Resource Charge</label><small>(Excluding GST)</small>
        <input type="text" class="form-control" name="resource_charge" readonly="">
    </div>
    <div class="form-group col-6">
        <label>Ordering Company Name/Individual</label>
        @if(!empty($finance->jobcontractdetails->ordering_com_name))
              <input type="text" class="form-control" name="ordering_company_name" value="{{ $finance->jobcontractdetails->ordering_com_name }}" readonly>
         @else 
            <input type="text" class="form-control" name="ordering_company_name" readonly>
        @endif
        
    </div>
</div>

<h4 class="modal-title" id="modalLabelnews1">Payment Details</h4><br>

<!-- <div class="mb-3 mt-3 profile-basic">
    <button class="btn btn-primary" type="button" onclick="addSchedule('1')"> Sales <span class="fa fa-plus"></span></button>
    <button class="btn btn-primary" type="button" onclick="addSchedule1('1')"> Consultant <span class="fa fa-plus"></span></button>
</div> -->

<div class="form-row">
    <div class="form-group col-6">
        <label>Invoice Number</label>
        <input type="text" class="form-control" name="invoice_number" value="{{ $finance->jobcontractdetails->joborderinvoice->invoice_no }}" readonly>
    </div>
    <div class="form-group col-6">
        <label>Advance payment Details</label>
        <input type="text" class="form-control" name="advance_payment_details" value="{{ $finance->jobcontractdetails->advance_payment_details }}" readonly="">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-6">
        <label>Invoice Date </label>
        <input class="flatpickr flatpickr-input form-control" type="text" name="invoice_date" value="{{ $finance->jobcontractdetails->joborderinvoice->invoice_due_date }}" readonly="">
    </div>
    <div class="form-group col-6">
        <label>Invoice Amount</label><small>(Including GST)</small>
        <input type="text" class="form-control" name="invoice_amount" value="{{ $finance->jobcontractdetails->joborderinvoice->invoice_amount }}" readonly="">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-6">
        <label>Remarks </label>
        <textarea class="form-control" name="remarks" readonly>{!! $finance->jobcontractdetails->remarks !!}</textarea>
    </div>
</div>

<br>
<h4 class="modal-title" id="modalLabelnews1">Customer Payment Schedule</h4><br>

@foreach ($finance->jobcontractdetails->jobpaymentschedule as $item)
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


<!-- Submit Field -->
<div class="form-group text-right mt-5" style="text-align: left !important;">
  <div class="btn-group" role="group">
    <button class="btn btn-primary" type="button" onclick="JobAssignToResource('{{ $order_finances_id->job_order_id }}','2')">
      Assign To Resource(s) 
    </button>
  </div>
</div>
<!-- <div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div> -->
