@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Project Schedule Module: {{ $projectlead->projectdetail->project_title }}</span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="profile-information">
    <div id="notific">
        @include('notifications')
    </div>
     <div class="singup-body login-body profile-basic">
        <div class="card">
        <div class="bg-blue">
            <div class="px-5 py-2">
                <span class="h5 text-white" style="margin-left: -25px;">Project Schedule Module Status</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="{{ route('projectschedule.create') }}" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="project_leads_id" value="{{ $projectlead->project_leads_id }}">
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Project Name</label>
                                <input type="text" class="form-control" name="project_title" value="{{ $projectlead->projectdetail->project_title }}" readonly>
                            </div>
                        </div>
                        @forelse ($projectlead->projectschedulee->schedulemodulee as $key => $modulee)
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Project Start Date</label>
                                <input class="form-control" type="text" name="actual_module_start_date" value="{{ $modulee->actual_module_start_date }}" readonly>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label> Module Scope</label>
                                <input type="text" name="module_scope" class="form-control" value="{{ $modulee->module_scope }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Module Status </label>
                                <select name="module_status[]" class="form-control" disabled>
                                    <option value="1" {{ ($modulee->module_status=='1')? "selected" : "" }}>To be Started</option>
                                    <option value="2" {{ ($modulee->module_status=='2')? "selected" : "" }}>In Progress</option>
                                    <option value="3" {{ ($modulee->module_status=='3')? "selected" : "" }}>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" rows="4" readonly>{{ $modulee->module_remark }}</textarea>
                            </div>
                        </div>
                        @empty
                            <p>No data</p>
                        @endforelse
                    </div>

                     <div class="form-group text-right mt-5">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        <div class="btn-group" role="group">
                        @foreach($projectlead->projectschedulee->schedulemodulee as $key => $modulee)
                            <button class="btn btn-primary" type="button" onclick="projectScheduleModule('{{ $modulee->project_schedule_module_id }}','2')">Accept</button>
                            {{--<button class="btn btn-primary" type="button" onclick="projectScheduleModule('{{ $projectlead->projectschedulee->project_schedule_id }}','3')">Modify</button>--}}
                            <button class="btn btn-primary" type="button" onclick="projectScheduleModule('{{ $modulee->project_schedule_module_id }}','3')">Deny</button>
                        @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('profile_script')
{{-- <x-chat-message/> --}}
<script>



function projectScheduleModule(module_id,lead_status){
    $('.spinner-border').removeClass("d-none");
    var url = '/client/project-schedule-module-status';
    var to_user_id = {{ $projectlead->from_user_id }};
    var data= {
        _token: "{{ csrf_token() }}",
        module_id: module_id,
        to_user_id: to_user_id,
        lead_status: lead_status
    };
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            var userCheck = data;
            $('.spinner-border').addClass("d-none");
            if (userCheck.success == '1') {
                var msg = userCheck.msg;
                var redirect = '#';
            } else {
                var msg = userCheck.errors;
                var redirect = '#';
            }
            toggleRegPopup(msg,redirect);
        },
        error: function(xhr, status, error) {
            console.log("error: ",error);
        },
    });
}
</script>
@stop
