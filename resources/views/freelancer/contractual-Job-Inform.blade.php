@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Contractual Job Information </span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="profile-information">
    <!-- <div id="notific">
        @include('notifications')
    </div> -->
     <div class="singup-body login-body profile-basic">
        <div class="card">
        <div class="bg-blue">
            <div class="px-5 py-2">
                <span class="h5 text-white" style="margin-left: -25px;">Contractual Job Information</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="{{ route('contractual-job-inform.store') }}" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="job_proposal_id" value="{{ $job_proposal_id->job_proposal_id }}">
                    <input type="hidden" name="job_id" value="{{ $joblead->job_id }}">
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Candidate Name</label>
                                <input type="text" class="form-control" name="candidate_name" value="{{ $user->full_name }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Referral ID</label>
                               <input type="text" class="form-control" name="job_leads_id" value="{{ $joblead->job_leads_id }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" value="{{ $user->full_name }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Price </label>
                                <input type="text" class="form-control" name="price">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Billing Address</label>
                                <input type="text" class="form-control" name="billing_address" value="" required="">
                            </div>
                            <div class="form-group col-6">
                                <label>GST Details</label>
                                <input type="text" class="form-control" name="gst_details" value="" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Date Acceptance</label>
                                <input class="flatpickr flatpickr-input form-control" type="text" name="date_acceptance" value="" required>
                            </div>
                            <div class="form-group col-6">
                                <label>End Date</label>
                                <input class="flatpickr flatpickr-input form-control" type="text" name="end_date" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Contract Duration</label>
                                <input type="text" class="form-control" name="contract_duration" value="" required="">
                            </div>
                            <div class="form-group col-6">
                                <label>Pricing Cycle</label>
                                <input type="text" class="form-control" name="pricing_cycle" value="" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Client Period</label>
                                <input type="text" class="form-control" name="client_period" value="" required="">
                            </div>
                            <div class="form-group col-6">
                                <label>Location</label>
                                <input type="text" class="form-control" name="location" value="" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right mt-5">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('profile_script')
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        flatpickr('.flatpickr');
    });
</script>
@stop
