@extends('layouts/default')

{{-- Page title --}}
@section('title')
Project Schedule
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}">
<link href="{{ asset('vendors/flatpickr/css/flatpickr.min.css') }}" rel="stylesheet"
type="text/css"/>
@yield('profile_css')
<!--end of page level css-->
@stop

@section('top')
<div class="bg-red">
  	<div class="px-5 py-2">
    	<div class="align-items-center">
        	<span class="border-title"><i class="fa fa-bars"></i></span>
        	<span class="h5 text-white">Project Schedule</span>
         	<!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
    	</div>
  	</div>
</div>
@stop
{{-- content --}}
@section('content')
<div class="profile-setting">
	<div class="container space-2">
	    <div class="row">
	        <div class="col-lg-8">
	        	<div id="notific">
		            @include('notifications')
		        </div>
	             <div class="singup-body login-body profile-basic project-schedule">
					<div class="card">
					<div class="bg-blue">
						<div class="px-5 py-2">
							<span class="h5 text-white" style="margin-left: -25px;">Project Schedule</span>
						</div>
					</div>
						<div class="card-body p-4">
							<form action="{{ route('projectschedule.create') }}" method="POST" id="educationForm">
								@csrf
                                <input type="hidden" name="project_leads_id" value="{{ $projectleads->project_leads_id }}">
                                <input type="hidden" name="pricing_model" value="{{ $projectleads->projectdetail->projectAmount->pricing_model }}">
								<div class="main-moudle">
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Project Name</label>
                                            <input type="text" class="form-control" name="project_title" value="{{ $projectleads->projectdetail->project_title }}" readonly>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Project Id</label>
                                            <input type="text" class="form-control" name="project_id" value="{{ $projectleads->project_id }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group basic-info mb-3">
                                        <label>Type Of Project:
                                                @if ($projectleads->projectdetail->type_of_project == '1')
                                                <span>Maintenance</span>
                                                @elseif($projectleads->projectdetail->type_of_project == '2')
                                                <span>New Development</span>
                                                @else
                                                <span>Maintenance Cum New Development</span>
                                                @endif
                                        </label>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>Customer Objective Of Project (Optional)</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="customer_objective" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group basic-info mb-3">
                                        <label>Model Of Engagement</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="hourly" class="custom-control-input" name="title1" checked>
                                                <label class="custom-control-label" for="hourly">Hourly</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="pt_rentainer" class="custom-control-input" name="title1">
                                                <label class="custom-control-label" for="pt_rentainer">Retainership</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="project_based" class="custom-control-input" name="title1">
                                                <label class="custom-control-label" for="project_based"> Project-based</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{--<div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Project Start Date</label>
                                            <input class="flatpickr flatpickr-input form-control" type="text" name="project_start_date" value="" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Project End Date</label>
                                            <input class="flatpickr flatpickr-input form-control" type="text" name="project_end_date" value="" required>
                                        </div>
                                    </div>--}}
                                    @if($projectleads->projectdetail->projectAmount->pricing_model == '1')
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
                                    @elseif($projectleads->projectdetail->projectAmount->pricing_model == '2')
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label>Agree Scope Of Work</label>
                                                <input class="form-control" type="text" name="scope_of_work">
                                            </div>
                                        </div>
                                    @endif
                                </div>

								<div class="module-1">
									<div class="module-3 remove-qual-1 submodule-1">
										<input type="hidden" name="module_id[]" id="module_id" value="1">
										<div class="form-row">
											<div class="form-group col-12">
												<label><span class="module_num">1</span>. Module Scope</label>
												<input type="text" name="module_scope[]" class="form-control" required>
											</div>
										</div>
                                        @if($projectleads->projectdetail->projectAmount->pricing_model == '3')
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label> Milestone No.</label>
                                                    <select class="form-control" name="milestone_no[]" required>
                                                        <option value=""> </option>
                                                        @for ($i = 1; $i < 101; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
										{{--<div class="form-row">
											<div class="form-group col-6">
												<label>Module Start Date</label>
												<input class="flatpickr flatpickr-input form-control" type="text" name="module_start_date[]" value="" required>
											</div>
											<div class="form-group col-6">
												<label>Module End Date</label>
												<input class="flatpickr flatpickr-input form-control" type="text" name="module_end_date[]" value="" required>
											</div>
										</div>--}}
										{{-- <div class="form-row">
											<div class="form-group col-6">
												<label>Hours Proposed</label>
												<input class="form-control" type="text" name="hours_proposed[]" required>
											</div>
											<div class="form-group col-6">
												<label>Hours Approved</label>
												<input class="form-control" type="text" name="hours_approved[]" required>
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
												<select name="module_status[]" class="form-control" readonly>
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
														<input type="text" class="form-control" name="sub_module_scope[]" required>
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-12">
														<label>Sub-module Description</label>
                                                        <textarea class="form-control" name="sub_module_description[]" rows="4" required></textarea>
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
											</div>
										</div>
										<div class="mb-3 mt-3">
											<button class="btn btn-md btn-info btn-copy-sm" type="button" onclick="addSubModule('1')">Add Sub-Module <span class="fa fa-plus"></span></button>
											<button type="button" class="remove-sm btn btn-md btn-info ml-3 rounded-0" onclick="removeSubModule('1')">Erase Sub-Module <span class="fas fa-times"></span></button>
										</div>
									</div>
								</div>

								<div class="form-row">
                                    <div class="form-group col-12">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="remarks" rows="4" required></textarea>
                                    </div>
                                </div>
								<div class="mb-3 mt-3">
									<button class="btn btn-md btn-info btn-copy-ps" type="button">Add Module <span class="fa fa-plus"></span></button>
									<button type="button" class="remove-ps btn btn-md btn-info ml-3 rounded-0">Erase Module <span class="fas fa-times"></span></button>
								</div>

								 <div class="form-group text-right mt-5">
									<div class="btn-group" role="group">
										<button class="btn btn-primary" type="submit">
											Next >>>
										</button>
										 <button class="btn btn-primary" type="reset">Discard</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="module-2 d-none">
					<input type="hidden" name="module_id[]" id="module_id" value="0">
					<div class="form-row">
                        <div class="form-group col-12">
                            <label><span class="module_num">1</span>. Module Scope</label>
                            <input type="text" name="module_scope[]" class="form-control">
                        </div>
                    </div>
                    @if($projectleads->projectdetail->projectAmount->pricing_model == '3')
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label> Milestone No.</label>
                                <select class="form-control" name="milestone_no[]" required>
                                    <option value=""> </option>
                                    @for ($i = 1; $i < 101; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
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
					<div class="mb-3 mt-3" id="submodulebutton">
						<button class="btn btn-md btn-info btn-copy-sm" type="button" onclick="addSubModule('1')">Add Sub-Module <span class="fa fa-plus"></span></button>
						<button type="button" class="remove-sm btn btn-md btn-info ml-3 rounded-0" onclick="removeSubModule('1')">Erase Sub-Module <span class="fas fa-times"></span></button>
					</div>
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
			 @include('layouts.left')
	    </div>
	    <!-- End Row -->
	</div>
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/profile_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
@yield('profile_script')
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

<!--global js end-->
@stop

