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
                                    <span>Maintenance</span>
                                    @elseif($projectlead->projectdetail->type_of_project == '2')
                                    <span>New Development</span>
                                    @else
                                    <span>Maintenance Cum New Development</span>
                                    @endif
                            </label>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Customer Objective Of Project (Optional)</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="customer_objective" rows="4" readonly>{{ $projectlead->projectschedulee->customer_objective }}</textarea>
                            </div>
                        </div>
                        {{--<div class="form-row">
                            <div class="form-group col-6">
                                <label>Project Start Date</label>
                                <input class="form-control" type="text" name="project_start_date" value="{{ $projectlead->projectschedulee->project_start_date }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Project End Date</label>
                                <input class="form-control" type="text" name="project_end_date" value="{{ $projectlead->projectschedulee->project_end_date }}" readonly>
                            </div>
                        </div>--}}
                        @if($projectlead->projectdetail->projectAmount->pricing_model == '1')
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Hours Proposed</label>
                                    <input class="form-control" type="text" name="hours_proposed_as" value="as per eiliana software" readonly>
                                    <input class="form-control" type="hidden" name="hours_proposed" value="0">
                                </div>
                                <div class="form-group col-6">
                                    <label>Hours Approved</label>
                                    <input class="form-control" type="text" name="hours_approved_as" value="as per eiliana software" readonly>
                                    <input class="form-control" type="hidden" name="hours_approved" value="0" >
                                </div>
                            </div>
                        @elseif($projectlead->projectdetail->projectAmount->pricing_model == '2')
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Agreed Scope Of Work</label>
                                    <input class="form-control" type="text" name="scope_of_work" value="{{ $projectlead->projectschedulee->scope_of_work }}" readonly>
                                </div>
                            </div>
                        @endif

                        @if($projectlead->projectdetail->referral_id != '0') 
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Total Proposal Value<small>({{ $projectlead->projectdetail->projectCurrency->symbol }})</small></label>
                                    <input class="form-control" type="text" name="total_proposal_value" value="{{ $projectlead->total_proposal_value }}" readonly>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="module-1">
                        @forelse ($projectlead->projectschedulee->schedulemodulee as $key => $modulee)
                            <div class="module-3 remove-qual-1 submodule-1">
                                <input type="hidden" name="module_id[]" id="module_id" value="1">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label><span class="module_num">{{ $key + 1 }}</span>. Module Scope</label>
                                        <input type="text" name="module_scope[]" class="form-control" value="{{ $modulee->module_scope }}" readonly>
                                    </div>
                                </div>
                                @if($projectlead->projectdetail->projectAmount->pricing_model == '3')
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label> Milestone No.</label>
                                            <select class="form-control" name="milestone_no[]" disabled>
                                                <option value=""> </option>
                                                @for ($i = 1; $i < 101; $i++)
                                                <option value="{{ $i }}" {{ ($modulee->milestone_no== $i)? "selected" : "" }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>Payable Amount</label>
                                            <input type="number" name="payable_amount[]" class="form-control" value="{{ $modulee->payable_amount }}" required>
                                        </div>
                                    </div>
                                @endif
                                
                                {{--<div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Module Start Date</label>
                                        <input class="form-control" type="text" name="module_start_date[]" value="{{ $modulee->module_start_date }}" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Module End Date</label>
                                        <input class="form-control" type="text" name="module_end_date[]" value="{{ $modulee->module_end_date }}" readonly>
                                    </div>
                                </div>--}}
                                {{--<div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Hours Proposed</label>
                                        <input class="form-control" type="text" name="hours_proposed[]" value="{{ $modulee->hours_proposed }}" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Hours Approved</label>
                                        <input class="form-control" type="text" name="hours_approved[]" value="{{ $modulee->hours_approved }}" readonly>
                                    </div>
                                </div>--}}
                                {{--<div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Module Status (Mandatory)</label>
                                        <select name="module_status[]" class="form-control" disabled>
                                            <option value="1" {{ ($modulee->module_status=='1')? "selected" : "" }}>To be Started</option>
                                            <option value="2" {{ ($modulee->module_status=='2')? "selected" : "" }}>In Progress</option>
                                            <option value="3" {{ ($modulee->module_status=='3')? "selected" : "" }}>Completed</option>
                                        </select>
                                    </div>
                                </div>--}}

                                <div class="sub-module-1">
                                    @foreach ($modulee->subschedulemodulee as  $key1 => $submodulee)
                                        <div class="sub-module-3 remove-qual-1">
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label><span class="module_num">{{ $key + 1 }}</span>.<span class="sub_module_num">{{ $key1 + 1 }}</span>. Sub-module Scope</label>
                                                    <input type="text" class="form-control" name="sub_module_scope[]" value="{{ $submodulee->module_scope }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label>Sub-module Description</label>
                                                    <textarea class="form-control" name="sub_module_description[]" rows="4" readonly>{{ $submodulee->module_description }}</textarea>
                                                </div>
                                            </div>
                                            {{--<div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Sub-module Status (Optional)</label>
                                                    <select name="sub_module_status[]" class="form-control" disabled>
                                                        <option value="1" {{ ($submodulee->sub_module_status=='1')? "selected" : "" }}>To be Started</option>
                                                        <option value="2" {{ ($submodulee->sub_module_status=='2')? "selected" : "" }}>In Progress</option>
                                                        <option value="3" {{ ($submodulee->sub_module_status=='3')? "selected" : "" }}>Completed</option>
                                                    </select>
                                                </div>
                                            </div>--}}
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

                     <div class="form-group text-right mt-5">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary" type="button" onclick="projectleadSchedule('{{ $projectlead->projectschedulee->project_schedule_id }}','{{ $projectlead->projectdetail->projectAmount->pricing_model }}','{{ $projectlead->project_leads_id }}','2')">Accept</button>
                            <button class="btn btn-primary" type="button" onclick="projectleadSchedule('{{ $projectlead->projectschedulee->project_schedule_id }}','{{ $projectlead->projectdetail->projectAmount->pricing_model }}','{{ $projectlead->project_leads_id }}','3')">Modify</button>
                            <button class="btn btn-primary" type="button" onclick="projectleadSchedule('{{ $projectlead->projectschedulee->project_schedule_id }}','{{ $projectlead->projectdetail->projectAmount->pricing_model }}','{{ $projectlead->project_leads_id }}','4')">Reject</button>
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
function projectleadSchedule(schedule_id,pricing_model,project_leads_id,lead_status){
    $('.spinner-border').removeClass("d-none");
    var url = '/client/project-lead-schedule';
    var data= {
        _token: "{{ csrf_token() }}",
        schedule_id: schedule_id,
        lead_status: lead_status,
        pricing_model: pricing_model,
        project_leads_id: project_leads_id
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
                var msg = userCheck.msg;
                //var redirect = '/client/project-contract-details/'+ project_leads_id;
                var redirect = userCheck.url;
               
                // Swal.fire({
                //     type: 'success',
                //     title: 'Success...',
                //     text: userCheck.msg,
                //     showConfirmButton: false,
                //     timer: 2000
                // });
                // window.location.href = '/freelancer/my-opportunity';
            } else if (userCheck.success == '2') {
                var msg = userCheck.msg;
                var redirect = '/client/project-schedule/'+ project_leads_id;
            } else {
                var msg = userCheck.errors;
                var redirect = '/client/project-schedule/'+ project_leads_id;
                // Swal.fire({
                //     type: 'error',
                //     title: 'Oops...',
                //     text: userCheck.errors,
                //     showConfirmButton: false,
                //     timer: 3000
                // });
                // if (userCheck.success == '2') {
                //     window.location.href = '/freelancer/my-opportunity';
                // }
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
