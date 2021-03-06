<div class="form-row">
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Company Name</label>
        <input type="text" name="company_name" class="form-control" value="{{ $sales_referral->company_name }}" readonly />
    </div>
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Legal Status</label>
        <select name="legal_status" class="form-control" disabled>
            @foreach($company_types as $compny_type)
                <option value="{{ $compny_type->id }}" {{ ($sales_referral->legal_status==$compny_type->id)? "selected" : "" }}>{{ $compny_type->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Sales Executive</label>
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
        <label>DOB</label>
        <input class="form-control" type="text" name="dob" value="{{ $sales_referral->dob }}" readonly>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>City</label>
        <input type="text" name="city" class="form-control" value="{{ $sales_referral->city }}" readonly />
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12">
        <label>Country</label>
        <select name="country" class="form-control" disabled>
            <option value=""></option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ ($sales_referral->country == $country->id)? "selected" : "" }}>{{ $country->name }}</option>
            @endforeach
        </select>
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
            @foreach($customer_industries as $customer_industry)
                <option value="{{ $customer_industry->customer_industry_id }}" {{ ($sales_referral->customer_industry == $customer_industry->customer_industry_id)? "selected" : "" }}>{{ $customer_industry->name }}</option>
            @endforeach
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
        </select>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
        <label>Expected Commission(%/INR)</label>
        <input type="number" name="expected_commission" class="form-control" value="{{ $sales_referral->expected_commission }}" readonly />
    </div>
</div>

<!-- Submit Field -->
<div class="form-group text-right mt-5" style="text-align: left !important;">
	<div class="btn-group" role="group">
        <button class="btn btn-primary" type="button" onclick="salesReferralAssignToClient('{{ $sales_referral->sales_referral_id }}','{{ $sales_referral->company_name }}','{{ $sales_referral->contact_person }}','{{ $sales_referral->email }}','{{ $sales_referral->mobile_no }}','{{ $sales_referral->dob }}','{{ $sales_referral->city }}','{{ $sales_referral->country }}','2')">
			Accept 
		</button>&nbsp;&nbsp;
    </div>
    {{--<div class="btn-group" role="group">
        <button class="btn btn-primary" type="button" onclick="salesReferralAssignToClient('{{ $sales_referral->sales_referral_id }}','{{ $sales_referral->company_name }}','{{ $sales_referral->contact_person }}','{{ $sales_referral->email }}','{{ $sales_referral->mobile_no }}','{{ $sales_referral->dob }}','{{ $sales_referral->city }}','{{ $sales_referral->country }}','5')">
			Modify
		</button>&nbsp;&nbsp;
	</div>--}}
    <div class="btn-group" role="group">
        <button class="btn btn-primary" type="button" onclick="salesReferralAssignToClient('{{ $sales_referral->sales_referral_id }}','{{ $sales_referral->company_name }}','{{ $sales_referral->contact_person }}','{{ $sales_referral->email }}','{{ $sales_referral->mobile_no }}','{{ $sales_referral->dob }}','{{ $sales_referral->city }}','{{ $sales_referral->country }}','4')">
			Reject
		</button>
	</div>
</div>
