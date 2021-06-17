<div class="form-row">
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Company Name</label>
        <input type="text" name="company_name" class="form-control" value="{{ $sales_referral->company_name }}" readonly />
    </div>
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Legal Status</label>
        <select name="legal_status" class="form-control" disabled>
            <option value=""></option>
            <option value="1" {{ ($sales_referral->legal_status == '1')? "selected" : "" }}>Pending</option>
            <option value="2" {{ ($sales_referral->legal_status == '2')? "selected" : "" }}>Processing</option>
        </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Contact Person</label>
        <input type="text" name="contact_person" class="form-control" value="{{ $sales_referral->contact_person }}" readonly />
    </div>
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Designation</label>
        <input type="text" name="designation" class="form-control" value="{{ $sales_referral->designation }}" readonly />
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Email Address</label>
        <input type="text" name="email" class="form-control" value="{{ $sales_referral->email }}" readonly />
    </div>
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Mobile No</label>
        <input type="text" name="mobile_no" class="form-control" value="{{ $sales_referral->mobile_no }}" readonly />
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Website Address</label>
        <input type="text" name="website_address" class="form-control" value="{{ $sales_referral->website_address }}" readonly />
    </div>
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Requirment Details</label>
        <input type="text" name="requirment_details" class="form-control" value="{{ $sales_referral->requirment_details }}" readonly />
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Customer Industry</label>
        <select name="customer_industry" class="form-control" disabled>
            <option value=""></option>
            <option value="1" {{ ($sales_referral->customer_industry == '1')? "selected" : "" }}>Pending</option>
            <option value="2" {{ ($sales_referral->customer_industry == '2')? "selected" : "" }}>Processing</option>
        </select>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Date/Time Connect</label>
        <input class="form-control" name="datetimeconnect" value="{{ $sales_referral->datetimeconnect }}" readonly>
    </div>
</div>
<div class="form-group basic-info mb-3">
    <label>Has lead generator spoken to the customer and confirmed the requriment</label>
    <br>
    <div class="form-check form-check-inline ml-3">
        <div class="custom-control custom-radio">
            <input type="radio" id="Yes" name="confirmed" class="custom-control-input" value="0" {{ ($sales_referral->confirmed == '0')? "checked" : "" }}>
            <label class="custom-control-label" for="Yes">Yes</label>
        </div>
    </div>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            <input type="radio" id="No" name="confirmed" class="custom-control-input" value="1" {{ ($sales_referral->confirmed == '1')? "checked" : "" }}> 
            <label class="custom-control-label" for="No">No</label>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Commission Type</label>
        <select name="commission_type" class="form-control" disabled>
            <option value=""></option>
            <option value="1" {{ ($sales_referral->commission_type == '1')? "selected" : "" }}>Percentage</option>
            <option value="2" {{ ($sales_referral->commission_type == '2')? "selected" : "" }}>Processing</option>
        </select>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Expected Commission(%/INR)</label>
        <input type="text" name="expected_commission" class="form-control" value="{{ $sales_referral->expected_commission }}" readonly />
    </div>
</div>

<!-- Submit Field -->
<div class="form-group text-right mt-5" style="text-align: left !important;">
	<div class="btn-group" role="group">
        <button class="btn btn-primary" type="button" onclick="salesReferralAssignToClient('{{ $sales_referral->sales_referral_id }}','2')">
			Accept 
		</button>&nbsp;&nbsp;
    </div>
    <div class="btn-group" role="group">
        <button class="btn btn-primary" type="button" onclick="salesReferralAssignToClient('{{ $sales_referral->sales_referral_id }}','5')">
			Modify
		</button>&nbsp;&nbsp;
	</div>
    <div class="btn-group" role="group">
        <button class="btn btn-primary" type="button" onclick="salesReferralAssignToClient('{{ $sales_referral->sales_referral_id }}','4')">
			Reject
		</button>
	</div>
</div>
