@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Onboarding Resource </span>
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
                <span class="h5 text-white" style="margin-left: -25px;">Please verify the details below</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="{{ route('contractual-job-inform.store') }}" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="job_leads_id" value="{{ $joblead->job_leads_id }}">
                    <input type="hidden" name="job_id" value="{{ $joblead->job_id }}">
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Proposal ID</label>
                               <input type="text" class="form-control" name="job_proposal_id" value="{{ $joblead->jobProposal->job_proposal_id }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" value="{{ $joblead->jobdetail->by_user_job->full_name }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Price Per Month </label><small> (Excluding GST)</small>
                                <input type="number" class="form-control" name="price" id="price" value="{{ $joblead->price_per_month }}" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Notice Period</label><small> (Days)</small>
                                <input type="number" class="form-control" name="notice_period" value="{{ $joblead->notice_period }}" required>
                            </div>
                        </div>
                        {{--<div class="form-row">
                            <div class="form-group col-6">
                                <label>Total Price </label><small> (Price + GST)</small>
                                <input type="text" class="form-control" name="total_price" id="total_price" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>GST Rate</label><small> (%)</small>
                                <input type="text" class="form-control" name="gst_rate" id="gst_rate" value="18" readonly="">
                            </div>
                        </div>--}}
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Contract Duration</label>
                                <input type="number" class="form-control" name="contract_duration" value="{{$joblead->jobdetail->contract_duration}}">
                            </div>
                            <div class="form-group col-6">
                                <label>Resource Name</label>
                                <input type="text" class="form-control" name="company_name" value="" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Date Of Onboarding</label>
                                <input class="flatpickr flatpickr-input form-control" type="text" name="job_start_date" value="" required>
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="form-group col-12">
                                <label>Acceptance Date</label>
                                <input class="flatpickr flatpickr-input form-control" type="text" name="job_start_date" value="" required>
                            </div>
                        </div>     -->
                        <!-- <div class="form-row">
                            <div class="form-group col-6">
                                <label>Billing Address</label>
                                <input type="text" class="form-control" name="billing_address" value="" required="">
                            </div>
                            <div class="form-group col-6">
                                <label>GST Details</label>
                                <input type="text" class="form-control" name="gst_details" value="" required="">
                            </div>
                        </div> -->
                        <!-- <div class="form-row">
                            <div class="form-group col-6">
                                <label>Date Acceptance</label>
                                <input class="flatpickr flatpickr-input form-control" type="text" name="date_acceptance" value="" required>
                            </div>
                            <div class="form-group col-6">
                                <label>End Date</label>
                                <input class="flatpickr flatpickr-input form-control" type="text" name="end_date" value="" required>
                            </div>
                        </div> -->
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Pricing Cycle</label>
                                <select class="form-control" name="pricing_cycle" id="pricing_cycle" required>
                                    <option></option>
                                    <option value="1">Monthly Advance</option>
                                    <!-- <option value="2">Monthly Postpaid</option> -->
                                    <option value="2">Quarterly Advance</option>
                                    <option value="3">Bi-Monthly Advance</option>
                                    <!-- <option value="6">Bi-Monthly Postpaid</option> -->
                                    <option value="4">Yearly Advance</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row" id="on_postpaid">
                            <div class="form-group col-6">
                                <label>Postpaid Amount </label>
                                <input type="text" class="form-control" name="on_postpaid_amount" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Advance Amount</label>
                                <input type="text" class="form-control" name="advance_amount" required>
                            </div>
                        </div>

                        {{--<div class="form-row">
                            <div class="form-group col-12">
                                <label>Location</label>
                                <select class="form-control" name="location">
                                    <option>Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->location_id}}">{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>--}}
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Location</label>
                                <select class="form-control" name="location" required>
                                    <option></option>
                                    <option value="1">Customer Location</option>
                                    <option value="2">Offsite</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="form-group">
                                <input type="checkbox" id="candidate_support" class="form-check-input" required />
                                <label for="candidate_support" > Support checkbox</label>
                            </div>
                        </div> -->
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right mt-5">
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary" type="submit">
                               Send To Customer
                            </button>
                            <button class="btn btn-primary" type="reset">Discard</button>
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
$('#educationForm').bootstrapValidator({});
    $(document).ready(function() {
        flatpickr('.flatpickr');
    });
   
    $('#on_postpaid').hide();

//    $("#pricing_cycle").change(function() {
//         var pricing_cycle = this.value;
//         console.log(pricing_cycle);
//         if(pricing_cycle == 2)
//         {
//             $('#on_postpaid').show();
//         }
//         else
//         {
//             $('#on_postpaid').hide();
//         }
//     });

    function resetForm() {
        document.getElementById("educationForm").reset();
    }

    $("#price").keyup(function() {
        var price = this.value;
        var gst_rate = 18;
        //alert(price);
        if(price)
        {
            GST_amount = (price * gst_rate) / 100;
            total_price = parseInt(price) + parseInt(GST_amount);
            $('#total_price').val(total_price);
        }
        
    });
</script>
@stop
