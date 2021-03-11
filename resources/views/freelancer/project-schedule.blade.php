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
                <span class="h5 text-white" style="margin-left: -25px;">Project Schedule</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="{{ route('projectschedule.create') }}" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="project_leads_id" value="{{ $projectlead->project_leads_id }}">
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Project Name</label>
                                <input type="text" class="form-control" name="project_title" value="{{ $projectlead->projectdetail->project_title }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Project Id</label>
                                <input type="text" class="form-control" name="project_id" value="{{ $projectlead->project_id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group basic-info mb-3">
                            <label>Type Of Project:
                                    @if ($projectlead->projectdetail->type_of_project == '1')
                                    <span>Support</span>
                                    @elseif($projectlead->projectdetail->type_of_project == '2')
                                    <span>Development</span>
                                    @else
                                    <span>Support Cum Development</span>
                                    @endif
                            </label>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Customer Objective Of Project (Optional)</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="customer_objective" rows="4" readonly>{{ $projectlead->projectschedulee->customer_objective }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Project Start Date</label>
                                <input class="form-control" type="text" name="project_start_date" value="{{ $projectlead->projectschedulee->project_start_date }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Project End Date</label>
                                <input class="form-control" type="text" name="project_end_date" value="{{ $projectlead->projectschedulee->project_end_date }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="module-1">
                        @forelse ($projectlead->projectschedulee->schedulemodulee as $key => $modulee)
                            <div class="module-3 remove-qual-1 submodule-1">
                                <input type="hidden" name="module_id" id="module_id" value="{{ $modulee->project_schedule_module_id }}">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label><span class="module_num">{{ $key + 1 }}</span>. Module Scope</label>
                                        <input type="text" name="module_scope" class="form-control" value="{{ $modulee->module_scope }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Module Start Date</label>
                                        <input class="form-control" type="text" name="module_start_date" value="{{ $modulee->module_start_date }}" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Module End Date</label>
                                        <input class="form-control" type="text" name="module_end_date" value="{{ $modulee->module_end_date }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Hours Proposed</label>
                                        <input class="form-control" type="text" name="hours_proposed" value="{{ $modulee->hours_proposed }}" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Hours Approved</label>
                                        <input class="form-control" type="text" name="hours_approved" value="{{ $modulee->hours_approved }}" readonly>
                                    </div>
                                </div>
                                @if ($modulee->current == '1')
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Module Status</label>
                                            <select name="module_status" class="form-control" id="module_status">
                                                <option value="1" {{ ($modulee->module_status=='1')? "selected" : "" }}>Started</option>
                                                <option value="2" {{ ($modulee->module_status=='2')? "selected" : "" }}>In Progress</option>
                                                <option value="3" {{ ($modulee->module_status=='3')? "selected" : "" }}>Completed</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Start Date</label>
                                            <input class="flatpickr flatpickr-input form-control" type="text" name="actual_module_start_date" id="actual_module_start_date" value="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Remark</label>
                                            <textarea class="form-control" name="module_remark" id="module_remark" rows="4" required></textarea>
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <button class="btn btn-md btn-info btn-copy-sm" type="button" onclick="sendToClient('{{ $modulee->project_schedule_module_id }}')">
                                                <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                                Send to Client
                                            </button>
                                        </div>

                                    </div>
                                @endif
                                <div class="sub-module-1">
                                    @foreach ($modulee->subschedulemodulee as  $key1 => $submodulee)
                                        <div class="sub-module-3 remove-qual-1">
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label><span class="module_num">{{ $key + 1 }}</span>.<span class="sub_module_num">{{ $key1 + 1 }}</span>. Sub-module Scope</label>
                                                    <input type="text" class="form-control" name="sub_module_scope" value="{{ $submodulee->module_scope }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label>Sub-module Description</label>
                                                    <textarea class="form-control" name="sub_module_description" rows="4" readonly>{{ $submodulee->module_description }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Sub-module Status</label>
                                                    <select name="sub_module_status" class="form-control">
                                                        <option value="1" {{ ($submodulee->sub_module_status=='1')? "selected" : "" }}>Started</option>
                                                        <option value="2" {{ ($submodulee->sub_module_status=='2')? "selected" : "" }}>In Progress</option>
                                                        <option value="3" {{ ($submodulee->sub_module_status=='3')? "selected" : "" }}>Completed</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <p>No data</p>
                        @endforelse

                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label>Remarks</label>
                            <textarea class="form-control" name="remarks" rows="4" readonly>{{ $projectlead->projectschedulee->remarks }}</textarea>
                        </div>
                    </div>

                    {{-- <div class="form-group text-right mt-5">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary" type="button" onclick="projectleadSchedule('{{ $projectlead->projectschedulee->project_schedule_id }}','2')">Accept</button>
                            <button class="btn btn-primary" type="button" onclick="projectleadSchedule('{{ $projectlead->projectschedulee->project_schedule_id }}','3')">Modify</button>
                            <button class="btn btn-primary" type="button" onclick="projectleadSchedule('{{ $projectlead->projectschedulee->project_schedule_id }}','4')">Reject</button>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('profile_script')
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
<script>
function sendToClient(module_id){
    // console.log(module_id);
    $('.spinner-border').removeClass("d-none");
    var url = '/freelancer/project-schedule-update';
    var modulestatus = $('#module_status').find('option:selected').val();
    var actual_module_start_date = $('#actual_module_start_date').val();
    var module_remark = $('#module_remark').val();
    var to_user_id = {{ $projectlead->projectdetail->posted_by_user_id }};
    var lead_id = {{ $projectlead->project_leads_id }};
    var data= {
        _token: "{{ csrf_token() }}",
        module_id: module_id,
        modulestatus: modulestatus,
        actual_module_start_date: actual_module_start_date,
        module_remark: module_remark,
        to_user_id: to_user_id,
        lead_id: lead_id
    };
    console.log(data);
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            var userCheck = data;
            $('.spinner-border').addClass("d-none");
            if (userCheck.success == '1') {
                Swal.fire({
                    type: 'success',
                    title: 'Success...',
                    text: userCheck.msg,
                    showConfirmButton: false,
                    timer: 2000
                });
                // window.location.href = '/freelancer/my-opportunity';
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: userCheck.errors,
                    showConfirmButton: false,
                    timer: 3000
                });
                // if (userCheck.success == '2') {
                //     window.location.href = '/freelancer/my-opportunity';
                // }
            }

        },
        error: function(xhr, status, error) {
            console.log("error: ",error);
        },
    });
}
</script>
@stop
