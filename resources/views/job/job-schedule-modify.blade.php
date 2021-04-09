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
                <form action="{{ route('jobschedule.update-modify') }}" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="job_leads_id" value="{{ $contractual_job->job_leads_id }}">
                    <input type="hidden" name="job_schedule_id" value="{{ $contractual_job->job_schedule_id }}">
                    <input type="hidden" name="job_id" value="{{ $contractual_job->job_id }}">
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Referral ID</label>
                               <input type="text" class="form-control" name="job_leads_id" value="{{ $contractual_job->job_leads_id }}" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" value="{{ $contractual_job->customer_name }}" readonly="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Price </label><small> (Excluding GST)</small>
                                <input type="text" class="form-control" name="price" value="{{ $contractual_job->price }}">
                            </div>
                            <div class="form-group col-6">
                                <label>Contract Duration</label>
                                <input type="text" class="form-control" name="contract_duration" value="{{$contractual_job->contract_duration}}">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Pricing Cycle</label>
                                <select class="form-control" name="pricing_cycle" id="pricing_cycle">
                                    <option>Select Pricing Cycle</option>
                                    <option value="1" {{ ($contractual_job->pricing_cycle=='1')? "selected" : "" }}>Monthly Advance</option>
                                    <option value="2" {{ ($contractual_job->pricing_cycle=='2')? "selected" : "" }}>Monthly Postpaid</option>
                                    <option value="3" {{ ($contractual_job->pricing_cycle=='3')? "selected" : "" }}>By Monthly</option>
                                    <option value="4" {{ ($contractual_job->pricing_cycle=='4')? "selected" : "" }}>Quertly</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row" id="on_postpaid">
                            <div class="form-group col-6">
                                <label>Postpaid Amount </label>
                                <input type="text" class="form-control" name="on_postpaid_amount" value="{{$contractual_job->on_postpaid_amount}}">
                            </div>
                            <div class="form-group col-6">
                                <label>Advance Amount</label>
                                <input type="text" class="form-control" name="advance_amount" value="{{$contractual_job->advance_amount}}">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Location</label>
                                <select class="form-control" name="location">
                                    <option>Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->location_id}}" {{ ($contractual_job->location==$location->location_id)? "selected" : "" }}>{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       <!--  <div class="form-row">
                            <div class="form-group col-12">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" rows="4"></textarea>
                            </div>
                        </div> -->
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

    $("#pricing_cycle").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            //alert(optionValue);
            if(optionValue == '2'){
                $("#on_postpaid").show();
            } else{
                $("#on_postpaid").hide();
            }
        });
    }).change();
</script>
@stop
