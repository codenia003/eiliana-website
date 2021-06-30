@extends('profile/layout')
@section('profile_css')
<style>
    .profile-basic button.btn-info span {
        float: right;
        font-size: 20px;
        position: relative;
        left: 5px;
    }
</style>
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
                <form action="{{ route('projectschedule.update') }}" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="project_leads_id" value="{{ $projectlead->project_leads_id }}">
                    <input type="hidden" name="project_schedule_id" value="{{  $projectlead->projectschedulee->project_schedule_id }}">
                    <input type="hidden" name="pricing_model" value="{{ $projectlead->projectdetail->projectAmount->pricing_model }}">
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
                                <div class="form-group col-6">
                                    <label><span class="module_num">{{ $key + 1 }}</span>. Module Scope</label>
                                    <input type="text" name="module_scope[]" class="form-control" value="{{ $modulee->module_scope }}" readonly>
                                </div>
                                <div class="form-group col-6">
                                    <label>Module Status</label>
                                    <select name="module_status" class="form-control" id="module_status" disabled>
                                        <option value="1" {{ ($modulee->module_status=='1')? "selected" : "" }}>Started</option>
                                        <option value="2" {{ ($modulee->module_status=='2')? "selected" : "" }}>In Progress</option>
                                        <option value="3" {{ ($modulee->module_status=='3')? "selected" : "" }}>Completed</option>
                                    </select>
                                </div>
                            </div>
                            @if($projectlead->projectdetail->projectAmount->pricing_model == '3')
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label> Milestone No.</label>
                                        <input type="number" class="form-control" name="milestone_no" value="{{ $modulee->milestone_no }}" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label>Payable Amount</label>
                                        <input type="number" class="form-control" name="payable_amount" value="{{ $modulee->payable_amount }}" readonly>
                                    </div>
                                </div>
                            @endif
                            {{--<div class="form-row">
                                <div class="form-group col-6">
                                    <label>Module Start Date</label>
                                    <input class="flatpickr flatpickr-input form-control" type="text" name="module_start_date[]" value="{{ $modulee->module_start_date }}" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>Module End Date</label>
                                    <input class="flatpickr flatpickr-input form-control" type="text" name="module_end_date[]" value="{{ $modulee->module_end_date }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Hours Proposed</label>
                                    <input class="form-control" type="text" name="hours_proposed[]" value="{{ $modulee->hours_proposed }}" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>Hours Approved</label>
                                    <input class="form-control" type="text" name="hours_approved[]" value="{{ $modulee->hours_approved }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Modify Hours</label>
                                    <input class="form-control" type="text" name="modify_hours[]">
                                </div>
                            </div> --}}
                            <div class="form-row d-none">
                                <div class="form-group col-6">
                                    <label>Module Status (Mandatory)</label>
                                    <select name="module_status[]" class="form-control" readonly>
                                        <option value="1">To be Started</option>
                                        <option value="2">In Progress</option>
                                        <option value="3">Completed</option>
                                    </select>
                                </div>
                            </div>

                            @if($modulee->project_schedule_module_id == $update_status)
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Module Status</label>
                                        <select name="module_status" class="form-control" id="module_status">
                                            <option value="1" {{ ($modulee->module_status=='1')? "selected" : "" }}>Started</option>
                                            <option value="2" {{ ($modulee->module_status=='2')? "selected" : "" }}>In Progress</option>
                                            <option value="3" {{ ($modulee->module_status=='3')? "selected" : "" }}>Completed</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6" id="start_picker">
                                        <label>Start Date</label>
                                        <input class="flatpickr flatpickr-input form-control" type="text" name="actual_module_start_date" id="actual_module_start_date" value="{{ $modulee->actual_module_start_date }}">
                                        <small class="help-block d-none">Start Date is required</small>
                                    </div>
                                    <div class="form-group col-12" id="remark_id">
                                        <label>Remark</label>
                                        <textarea class="form-control" name="module_remark" id="module_remark" rows="4" required></textarea>
                                        <small class="help-block d-none">The Remark is required</small>
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
                                        <input type="hidden" name="sub_module_id[]" id="sub_module_id" value="1">
                                        <input type="hidden" name="last_module_id[]" id="last_module_id" value="1">
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label><span class="module_num">{{ $key + 1 }}</span>.<span class="sub_module_num">{{ $key1 + 1 }}</span>. Sub-module Scope</label>
                                                <input type="text" class="form-control" name="sub_module_scope[]" value="{{ $submodulee->module_scope }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label>Sub-module Description</label>
                                                <textarea class="form-control" name="sub_module_description[]" rows="4" required>{{ $submodulee->module_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row d-none">
                                            <div class="form-group col-6">
                                                <label>Sub-module Status (Optional)</label>
                                                <select name="sub_module_status[]" class="form-control" readonly>
                                                    <option value="1">To be Started</option>
                                                    <option value="2">In Progress</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{--<div class="form-row d-none">
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
                            @if(empty($update_status))
                                @if($projectlead->projectdetail->projectAmount->pricing_model == '3')
                                    <div class="mb-3 mt-3">
                                        <button class="btn btn-md btn-info btn-copy-sm" type="button" onclick="addSubModule('1')">Add Sub-Module <span class="fa fa-plus"></span></button>
                                        <button type="button" class="remove-sm btn btn-md btn-info ml-3 rounded-0" onclick="removeSubModule('1')">Erase Sub-Module <span class="fas fa-times"></span></button>
                                    </div>
                                @endif
                            @endempty
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

                    @if(empty($update_status))
                        @if($projectlead->projectdetail->projectAmount->pricing_model == '3')
                            <div class="mb-3 mt-3">
                                <button class="btn btn-md btn-info btn-copy-ps" type="button">Add Module <span class="fa fa-plus"></span></button>
                                <button type="button" class="remove-ps btn btn-md btn-info ml-3 rounded-0">Erase Module <span class="fas fa-times"></span></button>
                            </div>
                        @endif
                        <div class="form-group text-right mt-5">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary" type="submit">Final Submission</button>
                            </div>
                        </div>
                    @endempty
                </form>
            </div>
            <div class="module-2 d-none">
                <input type="hidden" name="module_id[]" id="module_id" value="0">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label><span class="module_num">1</span>. Module Scope</label>
                        <input type="text" name="module_scope[]" class="form-control">
                    </div>
                </div>
                @if($projectlead->projectdetail->projectAmount->pricing_model == '3')
                    {{-- <h4 class="title">Customer Payment Schedules</h4> --}}
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label> Milestone No.</label>
                            <select class="form-control milestone_no" name="milestone_no[]" required>
                                <option value=""> </option>
                                @for ($i = 1; $i < 101; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label>Payable Amount</label>
                            @foreach($projectlead->projectschedulee->schedulemodulee as $key => $modulee)
                              <input type="number" class="form-control" name="payable_amount[]" value="{{ $modulee->payable_amount }}" readonly>
                            @endforeach
                        </div>
                    </div>
                @endif
                {{--<div class="form-row">
                    <div class="form-group col-6">
                        <label>Module Start Date</label>
                        <input class="flatpickr flatpickr-input form-control" type="text" name="module_start_date[]" value="">
                    </div>
                    <div class="form-group col-6">
                        <label>Module End Date</label>
                        <input class="flatpickr flatpickr-input form-control" type="text" name="module_end_date[]" value="">
                    </div>
                </div>--}}
                {{-- <div class="form-row">
                    <div class="form-group col-6">
                        <label>Hours Proposed</label>
                        <input class="form-control" type="text" name="hours_proposed[]">
                    </div>
                    <div class="form-group col-6">
                        <label>Hours Approved</label>
                        <input class="form-control" type="text" name="hours_approved[]">
                    </div>
                </div> --}}
                {{-- <div class="form-row">
                    <div class="form-group col-6">
                        <label>Modify Hours</label>
                        <input class="form-control" type="text" name="modify_hours[]">
                    </div>
                </div> --}}
                <div class="form-row d-none">
                    <div class="form-group col-6">
                        <label>Module Status (Mandatory)</label>
                        <select name="module_status[]" class="form-control">
                            <option value="1">To be Started</option>
                            <option value="2">In Progress</option>
                            <option value="3">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="sub-module-1">
                    <div class="sub-module-3 remove-qual-1">
                        <input type="hidden" name="sub_module_id[]" id="sub_module_id" value="1">
                        <input type="hidden" name="last_module_id[]" id="last_module_id" value="1">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label><span class="module_num">1</span>.<span class="sub_module_num">1</span>. Sub-module Scope</label>
                                <input type="text" class="form-control" name="sub_module_scope[]">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Sub-module Description</label>
                                <textarea class="form-control" name="sub_module_description[]" rows="4"></textarea>

                            </div>
                        </div>
                        <div class="form-row d-none">
                            <div class="form-group col-6">
                                <label>Sub-module Status (Optional)</label>
                                <select name="sub_module_status[]" class="form-control">
                                    <option value="1">To be Started</option>
                                    <option value="2">In Progress</option>
                                    <option value="3">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            @if(empty($update_status))
               @if($projectlead->projectdetail->projectAmount->pricing_model == '3')
                <div class="mb-3 mt-3" id="submodulebutton">
                    <button class="btn btn-md btn-info btn-copy-sm" type="button" onclick="addSubModule('1')">Add Sub-Module <span class="fa fa-plus"></span></button>
                    <button type="button" class="remove-sm btn btn-md btn-info ml-3 rounded-0" onclick="removeSubModule('1')">Erase Sub-Module <span class="fas fa-times"></span></button>
                </div>
                @endif
            @endempty
            </div>

            <div class="sub-module-2 d-none">
                <input type="hidden" name="sub_module_id[]" id="sub_module_id" value="1">
                <input type="hidden" name="last_module_id[]" id="last_module_id" value="1">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label><span class="module_num">1</span>.<span class="sub_module_num">1</span>. Sub-module Scope</label>
                        <input type="text" class="form-control" name="sub_module_scope[]">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label>Sub-module Description</label>
                        <textarea class="form-control" name="sub_module_description[]" rows="4"></textarea>

                    </div>
                </div>
                <div class="form-row d-none">
                    <div class="form-group col-6">
                        <label>Sub-module Status (Optional)</label>
                        <select name="sub_module_status[]" class="form-control">
                            <option value="1">To be Started</option>
                            <option value="2">In Progress</option>
                            <option value="3">Completed</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('profile_script')
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/profile_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
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
    var project_schedule_id = {{ $projectlead->projectschedulee->project_schedule_id }};

    if(actual_module_start_date.trim() == ''){
        $("#start_picker").addClass("has-error");
        $("#start_picker .help-block").removeClass("d-none");
        $('.spinner-border').addClass("d-none");
        return false;
    }

    if(module_remark.trim() == ''){
        $("#remark_id").addClass("has-error");
        $("#remark_id .help-block").removeClass("d-none");
        $('.spinner-border').addClass("d-none");
        return false;
    }

    var data= {
        _token: "{{ csrf_token() }}",
        module_id: module_id,
        modulestatus: modulestatus,
        actual_module_start_date: actual_module_start_date,
        module_remark: module_remark,
        to_user_id: to_user_id,
        lead_id: lead_id,
        project_schedule_id: project_schedule_id
    };
    // console.log(data);
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            var userCheck = data;
            $('.spinner-border').addClass("d-none");
            if (userCheck.success == '1') {
                // Swal.fire({
                //     type: 'success',
                //     title: 'Success...',
                //     text: userCheck.msg,
                //     showConfirmButton: false,
                //     timer: 2000
                // });
                var msg = userCheck.msg;
                var redirect = '';
                //var redirect = '/freelancer/my-project';
                
                //window.location.href = '/freelancer/my-project';
            } else {
                var msg = userCheck.errors;
                var redirect = '#';
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

<script>
    $('#educationForm').bootstrapValidator({});
    $(document).ready(function() {
        flatpickr('.flatpickr');
    });
	$('#technologty_pre').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
    $('#framework').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });

	$(function(){
        $(document).on("click",".btn-copy-ps",function() {
	  		var str = $(".module-3:last #module_id").val();
            // console.log(str);
            var x = parseInt(str) + parseInt(1);

            var element = '<div class="module-3 submodule-'+x+'">'+$('.module-2').html()+'</div>';
	  		$('.module-1').append(element);

            $('.module-3:last .module_num').text(x);
            $('.module-3:last #module_id').val(x);
            $('.module-3:last #sub_module_id').val(x);

            $(".module-3:last .flatpickr").flatpickr();

			var subbutton = '<button class="btn btn-md btn-info btn-copy-sm" type="button" onclick="addSubModule('+x+')">Add Sub-Module <span class="fa fa-plus"></span></button><button type="button" class="remove-sm btn btn-md btn-info ml-3 rounded-0" onclick="removeSubModule('+x+')">Erase Sub-Module <span class="fas fa-times"></span></button>';
			$('.submodule-'+x+' #submodulebutton').html(subbutton);
	  	});
	});

	function addSubModule(id){
		// console.log(id)
        var str = $('.submodule-'+id+' .sub-module-3:last #last_module_id').val();
        var x = parseInt(str) + parseInt(1);

		var element = '<div class="sub-module-3">'+$('.sub-module-2').html()+'</div>';
	  	$('.submodule-'+id+' .sub-module-1').append(element);

        $('.submodule-'+id+' .sub-module-3 .module_num').text(id);
        $('.submodule-'+id+' .sub-module-3 #sub_module_id').val(id);

        $('.submodule-'+id+' .sub-module-3:last .sub_module_num').text(x);
        $('.submodule-'+id+' .sub-module-3:last #last_module_id').val(x);
	}

    function removeSubModule(id){
        var mod_id = $('.submodule-'+id+' .sub-module-3:last #last_module_id').val();
        if(mod_id != '1'){
            $('.submodule-'+id+' .sub-module-1 .sub-module-3:last').remove();
        }

    }

	$(document).on('click','.remove-ps',function() {
		var mod_id = $(".module-3:last input#module_id").val();
		if (mod_id != '0') {
            if(mod_id != '1'){
                $(".module-3:last").remove();
            }
			// ConfirmDelete(mod_id,'1');
		} else {
			$(".module-3:last").remove();
	 	}
	 	// $(this).parent('.ug-qualification-3').remove();
	});

	function ConfirmDelete(mod_id,main_id)
	{
	  	var x = confirm("Are you sure you want to delete?");
	  	var mod_id = mod_id;
	  	if (x) {
            var data= {
		        mod_id:mod_id
            };
            var url = '#';
            var message = 'Education Deleted successfully';

	  		$.ajax({
	            type: 'GET',
	            url: url,
	            data: data,
	            contentType: 'application/json',
	            dataType: "json",
	            success: function(data) {
	            	$(".remove-qual-"+mod_id).remove();
	                Swal.fire({
		              type: 'success',
		              title: 'Success...',
		              text: message,
		              showConfirmButton: false,
		              timer: 1500
		            })

	            },
	            error: function(xhr, status, error) {
	                console.log("error: ",error);
	            },
	        });
	    	return true;
	  	} else {
	    	return false;
		}
    }
</script>
@stop
