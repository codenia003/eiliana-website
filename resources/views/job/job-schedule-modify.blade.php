@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Revise Proposal </span>
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
                <span class="h5 text-white" style="margin-left: -25px;">Revise Proposal</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="{{ route('jobschedule.update-modify') }}" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="job_leads_id" value="{{ $contractual_job->job_leads_id }}">
                    <input type="hidden" name="job_schedule_id" value="{{ $contractual_job->job_schedule_id }}">
                    <input type="hidden" name="job_id" value="{{ $contractual_job->job_id }}">
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Proposal ID</label>
                               <input type="text" class="form-control" name="job_proposal_id" value="{{ $contractual_job->job_proposal_id }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" value="{{ $contractual_job->customer_name }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Price Per Month </label><small> (Excluding GST)</small>
                                <input type="number" class="form-control" name="price" id="price" value="{{ $contractual_job->price }}" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Notice Period</label><small> (Days)</small>
                                <input type="number" class="form-control" name="notice_period" value="{{ $contractual_job->notice_period }}" required>
                            </div>
                        </div>
                        {{--<div class="form-row">
                            <div class="form-group col-6">
                                <label>Total Price </label><small> (Price + GST)</small>
                                <input type="text" class="form-control" name="total_price" id="total_price" value="{{ $contractual_job->total_price }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>GST Rate</label><small> (%)</small>
                                <input type="text" class="form-control" name="gst_rate" id="gst_rate" value="{{ $contractual_job->gst_rate }}" readonly="">
                            </div>
                        </div>--}}
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Contract Duration</label>
                                <input type="number" class="form-control" name="contract_duration" value="{{ $contractual_job->contract_duration }}" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Resource Name</label>
                                <input type="text" class="form-control" name="company_name" value="{{ $contractual_job->company_name }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Date Of Onboarding</label>
                                <input class="flatpickr flatpickr-input form-control" type="text" name="job_start_date" value="{{ $contractual_job->job_start_date }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Pricing Cycle</label>
                                <select class="form-control" name="pricing_cycle" id="pricing_cycle" required>
                                    <option>Select Pricing Cycle</option>
                                    <option value="1" {{ ($contractual_job->pricing_cycle=='1')? "selected" : "" }}>Monthly Advance</option>
                                    {{--<option value="2" {{ ($contractual_job->pricing_cycle=='2')? "selected" : "" }}>Monthly Postpaid</option>--}}
                                    <option value="2" {{ ($contractual_job->pricing_cycle=='3')? "selected" : "" }}>Quarterly Advance</option>
                                    {{--<option value="4" {{ ($contractual_job->pricing_cycle=='4')? "selected" : "" }}>Quarterly Postpaid</option>--}}
                                    <option value="3" {{ ($contractual_job->pricing_cycle=='5')? "selected" : "" }}>Bi-Monthly Advance</option>
                                    {{--<option value="6" {{ ($contractual_job->pricing_cycle=='6')? "selected" : "" }}>Bi-Monthly Postpaid</option>--}}
                                    <option value="4" {{ ($contractual_job->pricing_cycle=='7')? "selected" : "" }}>Yearly Advance</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row" id="on_postpaid">
                            <div class="form-group col-6">
                                <label>Postpaid Amount </label>
                                <input type="text" class="form-control" name="on_postpaid_amount" value="{{$contractual_job->on_postpaid_amount}}" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Advance Amount</label>
                                <input type="text" class="form-control" name="advance_amount" value="{{$contractual_job->advance_amount}}" required>
                            </div>
                        </div>

                        
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Location</label>
                                <select class="form-control" name="location" required>
                                    <option></option>
                                    <option value="1" {{ ($contractual_job->location=='1')? "selected" : "" }}>Customer Location</option>
                                    <option value="2" {{ ($contractual_job->location=='2')? "selected" : "" }}>Offsite</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" rows="4" required>{{ $contractual_job->remarks }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group text-right mt-5">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary" type="submit">Send To Customer</button>
                        </div>
                    </div> -->
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
   
//    $("#pricing_cycle").change(function(){
//         $(this).find("option:selected").each(function(){
//             var optionValue = $(this).attr("value");
//             //alert(optionValue);
//             if(optionValue == '2'){
//                 $("#on_postpaid").show();
//             } else{
//                 $("#on_postpaid").hide();
//             }
//         });
//     }).change();

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
