<div class="main-moudle">
		<div class="form-row">
			<div class="form-group col-6">
				<label>Proposal ID</label>
				<input type="text" class="form-control" name="job_proposal_id" value="{{ $resources->jobcontractschedule->job_proposal_id }}" readonly="">
			</div>
			<div class="form-group col-6">
				<label>Customer Name</label>
				<input type="text" class="form-control" name="customer_name" value="{{ $resources->jobcontractschedule->customer_name }}" readonly="">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-6">
				<label>Price Per Month </label><small> (Excluding GST)</small>
				<input type="text" class="form-control" name="price" id="price" value="{{ $resources->jobcontractschedule->price }}" readonly="">
			</div>
			<div class="form-group col-6">
				<label>Date Of Onboard</label>
				<input class="form-control" type="text" name="job_start_date" value="{{ $resources->onboard_date }}" readonly="">
			</div>
		</div>
		
		<div class="form-row">
			<div class="form-group col-6">
				<label>Contract Duration</label>
				<input type="text" class="form-control" name="contract_duration" value="{{ $resources->jobcontractschedule->contract_duration }}" readonly="">
			</div>
			<div class="form-group col-6">
				<label>Resource Name</label>
				<input type="text" class="form-control" name="company_name" value="{{ $resources->jobcontractschedule->company_name }}" readonly="">
			</div>
		</div>
	
		<div class="form-row">
		    <div class="form-group col-6">
				<label>Pricing Cycle</label>
				@if($resources->jobcontractschedule->pricing_cycle == 1)
					<input type="text" class="form-control" name="pricing_cycle" value="Monthly Advance" readonly="">
				@elseif($resources->jobcontractschedule->pricing_cycle == 2)
					<input type="text" class="form-control" name="pricing_cycle" value="Quarterly Advance" readonly="">
				@elseif($resources->jobcontractschedule->pricing_cycle == 3)
					<input type="text" class="form-control" name="pricing_cycle" value="Bi-Monthly Advance" readonly="">
				@else
					<input type="text" class="form-control" name="pricing_cycle" value="Yearly Advance" readonly="">
				@endif
			</div>
			<div class="form-group col-6">
				<label>Location</label>
					@if($resources->jobcontractschedule->location == 1)
						<input type="text" class="form-control" name="location" value="Customer Location" readonly="">
					@else
						<input type="text" class="form-control" name="location" value="Offsite" readonly="">
					@endif
			</div>
		</div>
		<div class="form-row">
		    <div class="form-group col-12">
				<label>Billing Address</label>
				<input type="text" class="form-control" name="billing_address">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-12">
				<label>Remarks</label>
				<textarea class="form-control" name="remarks" rows="4" readonly="">{{ $resources->jobcontractschedule->remarks }}</textarea>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-12">
				<label>Reject Remarks</label>
				<textarea class="form-control" name="reject_remarks" rows="4"></textarea>
			</div>
		</div>
	</div>
	<div class="form-group text-right mt-5">
		<span class="spinner-border spinner-border-sm mr-1 d-none"></span>
		<div class="btn-group" role="group">
			<button class="btn btn-primary" style="margin-right: 10px;border-radius: 2px;" type="button" onclick="ResourceDetailsStatus('{{ $resources->job_schedule_id }}','1')">Send To Billing</button>
			<button class="btn btn-primary" type="button" style="border-radius: 2px;" onclick="ResourceDetailsStatus('{{ $resources->job_schedule_id }}','2')">Reject</button>
		</div>
	</div>