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
	             <div class="singup-body login-body profile-basic">
					<div class="card">
					<div class="bg-blue">
						<div class="px-5 py-2">

							<!-- <span class="border-title"><i class="fa fa-bars"></i></span> -->
							<span class="h5 text-white" style="margin-left: -25px;">Project Schedule</span>
							<!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->

						</div>
					</div>
						<!-- <h4 class="card-header text-left">Education Details</h4> -->
						<div class="card-body p-4">
							<form action="" method="POST" id="educationForm">
								@csrf
								<div class="main-moudle">
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Project Name</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Project Id</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group basic-info mb-3">
                                        <label>Type Of Project</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="support_project" class="custom-control-input" name="title" checked>
                                                <label class="custom-control-label" for="support_project">Support Project</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="development_project" class="custom-control-input" name="title">
                                                <label class="custom-control-label" for="development_project">Development Project</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="development_cum_support_project" class="custom-control-input" name="title">
                                                <label class="custom-control-label" for="development_cum_support_project">Development cum Support Project</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>Customer Objective Of Project (Optional)</label>
                                            <input type="text" class="form-control" style="height: 100px;">
                                        </div>
                                    </div>
                                    <div class="form-group basic-info mb-3">
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
                                                <label class="custom-control-label" for="pt_rentainer">P.T.Rentainer</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="project_based" class="custom-control-input" name="title1">
                                                <label class="custom-control-label" for="project_based"> Project-based</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Project Start Date</label>
                                            <input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Project End Date</label>
                                            <input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
                                        </div>
                                    </div>
                                </div>

								<div class="module-1">
									<div class="module-3 remove-qual-1">
										<input type="hidden" name="module_id" id="module_id" value="1">
										<div class="form-row">
											<div class="form-group col-12">
												<label><span class="module_num">1</span>. Module Scope</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-6">
												<label>Module Start Date</label>
												<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
											</div>
											<div class="form-group col-6">
												<label>Module End Date</label>
												<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-6">
												<label>Hours Proposed</label>
												<input class="form-control" type="text" value="">
											</div>
											<div class="form-group col-6">
												<label>Hours Approved</label>
												<input class="form-control" type="text" value="">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-6">
												<label>Modify Hours</label>
												<input class="form-control" type="text" value="">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-6">
												<label>Module Status (Mandatory)</label>
												<select name="" class="form-control">
												    <option value=""></option>
												</select>
											</div>
										</div>

										<div class="sub-module-1">
										    <div class="sub-module-3 remove-qual-1">
												<input type="hidden" name="sub_module_id" id="sub_module_id" value="1">
												<div class="form-row">
													<div class="form-group col-12">
														<label><span class="module_num">1</span>.<span class="sub_module_num">1</span>. Sub-module Scope</label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-12">
														<label>Sub-module Description</label>
														<input type="text" class="form-control" style="height: 100px;">
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-6">
														<label>Sub-module Status (Optional)</label>
														<select name="" class="form-control">
															<option value=""></option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="mb-3 mt-3">
											<button class="btn btn-md btn-info btn-copy-sm" type="button">Add Sub-Module <span class="fa fa-plus"></span></button>
											<button type="button" class="remove-sm btn btn-md btn-info ml-3 rounded-0">Erase Sub-Module <span class="fas fa-times"></span></button>
										</div>
									</div>
								</div>

								<div class="form-row">
                                    <div class="form-group col-12">
                                        <label>Remarks</label>
                                        <input type="text" class="form-control" style="height: 100px;">
                                    </div>
                                </div>
								<div class="mb-3 mt-3">
									<button class="btn btn-md btn-info btn-copy-ps" type="button">Add Module <span class="fa fa-plus"></span></button>
									<button type="button" class="remove-ps btn btn-md btn-info ml-3 rounded-0">Erase Module <span class="fas fa-times"></span></button>
								</div>

								 <div class="form-group text-right mt-5">
									<div class="btn-group" role="group">
										<button class="btn btn-primary" type="submit">
											<span class="spinner-border spinner-border-sm mr-1 d-none"></span>
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
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label>Module Start Date</label>
							<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
						</div>
						<div class="form-group col-6">
							<label>Module End Date</label>
							<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label>Hours Proposed</label>
							<input class="form-control" type="text" value="">
						</div>
						<div class="form-group col-6">
							<label>Hours Approved</label>
							<input class="form-control" type="text" value="">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label>Modify Hours</label>
							<input class="form-control" type="text" value="">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label>Module Status (Mandatory)</label>
							<select name="" class="form-control">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-12">
							<label><span class="module_num">1</span>.<span class="sub_module_num">1</span>. Sub-module Scope</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-12">
							<label>Sub-module Description</label>
							<input type="text" class="form-control" style="height: 100px;">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label>Sub-module Status (Optional)</label>
							<select name="" class="form-control">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="mb-3 mt-3">
						<button class="btn btn-md btn-info btn-copy-sm" type="button">Add Sub-Module <span class="fa fa-plus"></span></button>
						<button type="button" class="remove-sm btn btn-md btn-info ml-3 rounded-0">Erase Sub-Module <span class="fas fa-times"></span></button>
					</div>
				</div>
                <div class="sub-module-2 d-none">
                    <input type="hidden" name="sub_module_id[]" id="sub_module_id" value="0">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label>1.1. Sub-module Scope</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label>Sub-module Description</label>
                            <input type="text" class="form-control" style="height: 100px;">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Sub-module Status (Optional)</label>
                            <select name="" class="form-control">
                                <option value=""></option>
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
            console.log(str);
	  		var element = '<div class="module-3">'+$('.module-2').html()+'</div>';
	  		$('.module-1').append(element);

            var x = parseInt(str) + parseInt(1);
            $('.module-3:last .module_num').text(x);
            $('.module-3:last #module_id').val(x);
            flatpickr('.flatpickr');
	  	});
	});

	$(function(){
        $(document).on("click",".btn-copy-sm",function() {
            console.log('clikc ho raha haiu');
            var str = $(".module-3:last #module_id").val();
	  		var sub_str = $(".module-3:last .sub-module-3:last #sub_module_type").val();

	  		var element = '<div class="sub-module-3">'+$('.sub-module-2').html()+'</div>';
	  		$('.sub-module-1').append(element);

            var x = parseInt(sub_str) + parseInt(1);
            $('.module-3:last .sub-module-3:last .sub_module_num').text(x);

	  	});
	});

	// $(function(){
	// 	$(".btn-copy-sm1").on('click', function(){

    //         var str = $("#module_type").val();
	//   		var element = '<div class="module-2">'+$('.sub-module-2').html()+'</div>';
	//   		$('.module-2').append(element);

	//   	});
	// });

	$(document).on('click','.remove-ps',function() {
		var mod_id = $(".module-3:last input#module_id").val();
		if (mod_id != '0') {
			ConfirmDelete(mod_id,'1');
		} else {
			$(".module-3:last").remove();
	 	}
	 	// $(this).parent('.ug-qualification-3').remove();
	});

	$(document).on('click','.remove-sm',function() {
		var sub_mod_id = $(".sub-module-3:last input#sub_module_id").val();
		if (sub_mod_id != '0') {
			ConfirmDelete(sub_mod_id,'1');
		} else {
			$(".sub-module-3:last").remove();
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

