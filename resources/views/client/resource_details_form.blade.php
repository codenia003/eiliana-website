@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Resource Details </span>
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
                <span class="h5 text-white" style="margin-left: -25px;">Resource Details</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="{{ route('post-resource-details') }}" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="job_schedule_id" value="{{ $leads->job_schedule_id }}">
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Freelancer Name</label>
                               <input type="text" class="form-control" name="freelancer_name" value="{{ $leads->userjobs->fromuser->full_name }}"  readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label>Service Provider Name</label>
                                <input type="text" class="form-control" name="sprovider_name" value="{{ $leads->company_name }}" readonly="">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Date Of Onboarding</label>
                                <input class="flatpickr flatpickr-input form-control" type="text" name="onboard_date" value="{{ $leads->actual_start_date }}" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Onboard Status</label>
                                <select class="form-control" name="onboard_status" id="onboard_status" required>
                                    <option value="">Select Onboard Status</option>
                                    <option value="1">Onboarded</option>
                                    <option value="2">Not Onboarded</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right mt-5" id="onboard_button">
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary" type="submit">
                               Send
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

    $("#onboard_status").change(function(){
    $(this).find("option:selected").each(function(){
        var optionValue = $(this).attr("value");
        //alert(optionValue);
        if(optionValue == '1'){
            $("#onboard_button").show();
        } else{
            $("#onboard_button").hide();
        }
    });
}).change();    
</script>
@stop
