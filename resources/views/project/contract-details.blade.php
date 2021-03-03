@extends('layouts/default')

{{-- Page title --}}
@section('title')
Contract Details
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
        	<span class="h5 text-white">Contract Details</span>
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
							<span class="h5 text-white" style="margin-left: -25px;">Contract Details</span> <small>(To be filled by developer)</small>
							<!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->

						</div>
					</div>
						<!-- <h4 class="card-header text-left">Education Details</h4> -->
						<div class="card-body p-4">
							<form action="" method="POST" id="educationForm">
								@csrf
								<div class="main-moudle">
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label>Proposal Id</label>
                                            <input type="text" class="form-control" name="proposal_id" value="{{$projectlead->project_leads_id}}" readonly>
                                        </div>
                                        <div class="form-group col-8">
                                            <label>Order Closed Value</label><small>(including sales Commission & Excluding GST)</small>
                                            <input type="text" class="form-control" name="ord_closed_value" value="" >
                                        </div>
                                    </div>
									<div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Date of Acceptance</label>
                                            <input class="flatpickr flatpickr-input form-control" type="text" name="acceptance_date[]" value="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Ordering Company Name/Individual  </label>
                                            <input type="text" class="form-control" name="ord_company_name" value="" >
                                        </div>
                                    </div>

									<div class="form-row">
										<div class="form-group col-6">
											<div class="form-group basic-file">
												<label>Upload Documents</label>
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="customFile" name="upload_file[]">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
										</div>
										<div class="form-group col-6">
                                            <label>Sales Commission Amount </label><small>(Excluding GST)</small>
                                            <input type="text" class="form-control" name="sales_comm_amount" value="" >
                                        </div>
                                    </div>

                                    <!-- <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>Customer Objective Of Project (Optional)</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="customer_objective" rows="4"></textarea>
                                        </div>
                                    </div> -->
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

                                    <div class="mb-3 mt-3">
									<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-4">Generate Invoice</button>
										<!-- <button class="btn btn-md btn-info btn-copy-sm111" type="button">Advance Payment Details <span class="fa fa-plus"></span></button> -->
									</div>

									<div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Advance Payment details</label>
                                            <input type="text" class="form-control" name="advance_payment_details" value="" >
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Remarks </label>
                                            <input type="text" class="form-control" name="remarks" value="" >
                                        </div>
                                    </div>

                                    <div class="form-row">
									    <div class="form-group col-5">
                                            <label>Invoice Number </label><small>(Against Advance)</small>
                                            <input type="text" class="form-control" name="invoive_no" value="" >
                                        </div>
                                        <div class="form-group col-2">
                                            <label>Invoice Date</label>
                                            <input class="flatpickr flatpickr-input form-control" type="text" name="invoice_date[]" value="">
                                        </div>
                                        <div class="form-group col-5">
                                            <label>Invoice Amount</label><small>(Including GST)</small>
                                            <input type="text" class="form-control" name="invoice_amount" value="" >
                                        </div>
                                    </div>
                                </div>

								 <div class="form-group text-right mt-5">
									<div class="btn-group" role="group">
										<button class="btn btn-primary" type="submit">
											<span class="spinner-border spinner-border-sm mr-1 d-none"></span>
											Next >>>
										</button>
										 <!-- <button class="btn btn-primary" type="reset">Discard</button> -->
									</div>
									<div class="btn-group" role="group">
									      <button class="btn btn-primary" type="reset">Discard</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
	        </div>
			 @include('layouts.left')
	    </div>
	    <!-- End Row -->
	</div>
</div>

<!-- Modal -->
<div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
	<div class="modal-dialog" role="document" style="max-width: 950px !important;">
		<div class="modal-content">
				<div class="modal-header bg-blue text-white">
					<h4 class="modal-title" id="modalLabelnews">Customer Payment Schedules</h4>
				</div>
				<div class="modal-body">
				    <div class="main-moudle">
						<h4 style="text-align:center;" class="modal-title" id="modalLabelnews1">Advance Invoice Details</h4>
				        <br>
						<form action="" method="POST" id="staffingflead">
						    @csrf
							<div class="schedule">
								<div class="schedule">
								<!-- <input type="hidden" name="schedule_id[]" id="schedule_id" value="1">
								<input type="hidden" name="last_schedule_id[]" id="last_schedule_id" value="1"> -->
									<div class="form-row">
										<div class="form-group col-3">
											<label>Invoice No. </label>
											<input type="text" class="form-control" value="Eil001" readonly>
										</div>
										<div class="form-group col-4">
											<label>Invoice Amount </label><small>(Including GST)</small>
											<input type="text" class="form-control" name="invoice_amount" value="" >
										</div>
										<div class="form-group col-2">
											<label>Invoice Due Date</label>
											<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
										</div>
										<div class="form-group col-3">
											<label>Hrs/Milestones </label>
											<input type="text" class="form-control" name="milestones_name" value="" >
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer singup-body" style="border-top: 1px solid #ffffff;">
								<div class="btn-group" role="group">
									<button class="btn btn-primary">
									<span class="spinner-border spinner-border-sm mr-1 d-none"></span>
									Send To Customer >>></button>
								</div>
							</div>
						</form>

						<h4 style="text-align:center;" class="modal-title" id="modalLabelnews1">Customer Payment Schedules</h4>
				        <br>
						<form action="" method="POST" id="staffingflead">
							@csrf
							<div class="schedule-1">
								<div class="schedule-3 remove-qual-1">
								<input type="hidden" name="schedule_id[]" id="schedule_id" value="1">
								<input type="hidden" name="last_schedule_id[]" id="last_schedule_id" value="1">
									<div class="form-row">
										<div class="form-group col-5">
											<label>Advance Payment </label><small>(Excluding GST)</small>
											<input type="text" class="form-control" name="advance_payment" value="" >
										</div>
										<div class="form-group col-2">
											<label>Payment Due Date</label>
											<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
										</div>
										<div class="form-group col-5">
											<label>Hrs/Milestones/Remarks </label>
											<input type="text" class="form-control" name="milestones_name" value="" >
										</div>
									</div>

									<!-- <div class="form-row">
										<div class="form-group col-5">
											<label>Payable Amount </label><small>(Excluding GST)</small>
											<input type="text" class="form-control" value="" >
										</div>
										<div class="form-group col-2">
											<label>Payment Due Date</label>
											<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
										</div>
										<div class="form-group col-5">
											<label>Hrs/Milestones </label>
											<input type="text" class="form-control" value="" >
										</div>
									</div> -->
								</div>
							</div>
							<div class="mb-3 mt-3">
								<button class="btn btn-md btn-info btn-copy-sm1" type="button" onclick="addSchedule('1')">Add More Schedules <span class="fa fa-plus"></span></button>
								<button type="button" class="btn-btn-md1 btn-info ml-3 rounded-0" onclick="removeSchedule('1')">Erase Schedule <span class="fas fa-times"></span></button>
							</div>
							<div class="modal-footer singup-body">
								<div class="btn-group" role="group">
									<button class="btn btn-primary"><span class="spinner-border spinner-border-sm mr-1 d-none"></span>
									Send To Eiliana Finance >>></button>
									<!-- <button class="btn btn-outline-primary" data-dismiss="modal">Discard</button> -->
								</div>
						    </div>
					    </form>
				    </div>

					<!-- <h4 style="text-align:center;" class="modal-title" id="modalLabelnews">Customer Payment Schedules</h4><hr><br> -->

					<!-- <div class="second-moudle">
					    <div class="sales_commission_schedule-1">
						    <div class="sales_commission_schedule-3 remove-qual-1">
							    <input type="hidden" name="commission_schedule_id[]" id="commission_schedule_id" value="1">
							    <input type="hidden" name="last_commission_schedule_id[]" id="last_commission_schedule_id" value="1">
								<div class="form-group basic-info mb-3">
									<div class="form-check form-check-inline">
										<div class="custom-control custom-radio">
											<input type="radio" id="on_time" class="custom-control-input" name="title12" checked>
											<label class="custom-control-label" for="on_time">On Time</label>
										</div>
									</div>
									<div class="form-check form-check-inline">
										<div class="custom-control custom-radio">
											<input type="radio" id="recurring" class="custom-control-input" name="title12">
											<label class="custom-control-label" for="recurring">Recurring</label>
										</div>
									</div>
									<div class="form-check form-check-inline">
										<div class="custom-control custom-radio">
											<input type="radio" id="no_commission" class="custom-control-input" name="title12">
											<label class="custom-control-label" for="no_commission"> No Commission</label>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-5">
										<label>Commission Amount </label><small>(INR)(Excluding GST)</small>
										<input type="text" class="form-control" value="" >
									</div>
									<div class="form-group col-2">
										<label>Payment Due Date</label>
										<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
									</div>
									<div class="form-group col-5">
										<label>Remarks/Milestones </label>
										<input type="text" class="form-control" value="" >
									</div>
								</div>
							</div>
						</div>
						<div class="mb-3 mt-3">
							 <button style="color: #fff;width: 220px;height: 52px;text-transform: capitalize;line-height: 22px;font-weight: 600;font-size: 16px !important;border-color: #ffffff;background: linear-gradient(281deg, rgba(168,129,222,1) 0%, rgba(86,177,221,1) 70%);" class="btn btn-md btn-info btn-copy-sm111" type="button">
							Add Further Commission Payout Schedules <span class="fa fa-plus"></span></button> -->
							<!--<button style="color: #fff;width: 220px;height: 52px;text-transform: capitalize;line-height: 22px;font-weight: 600;font-size: 16px !important;border-color: #ffffff;background: linear-gradient(281deg, rgba(168,129,222,1) 0%, rgba(86,177,221,1) 70%);" class="btn btn-md btn-info btn-copy-sm" type="button" onclick="addCommissionPayoutSchedule('1')">
							Add Further Commission Payout Schedules <span class="fa fa-plus"></span></button>
							<button style="color: #fff;width: 220px;height: 52px;text-transform: capitalize;line-height: 22px;font-weight: 600;font-size: 16px !important;border-color: #ffffff;background: linear-gradient(281deg, rgba(168,129,222,1) 0%, rgba(86,177,221,1) 70%);" type="button" class="btn btn-md btn-info ml-3 rounded-0" onclick="removeCommissionPayoutSchedule('1')">
							Erase Commission Payout Schedules <span class="fas fa-times"></span></button>
						</div>
				    </div> -->
				</div>
		</div>
	</div>
</div>

<div class="schedule-2 d-none">
    <input type="hidden" name="schedule_id[]" id="schedule_id" value="1">
	<input type="hidden" name="last_schedule_id[]" id="last_schedule_id" value="1">
	<div class="form-row">
		<div class="form-group col-5">
			<!-- <label>First Installment </label><small>(Excluding GST)</small> -->
			<label><span class="sub_module_num">1</span>. Installment </label><small>(Excluding GST)</small>
			<input type="text" class="form-control" value="" >
		</div>
		<div class="form-group col-2">
			<label>Payment Due Date</label>
			<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
		</div>
		<div class="form-group col-5">
			<label>Hrs/Milestones/Remarks </label>
			<input type="text" class="form-control" value="" >
		</div>
	</div>

	<!-- <div class="form-row">
		<div class="form-group col-5">
			<label>Payable Amount </label><small>(Excluding GST)</small>
			<input type="text" class="form-control" value="" >
		</div>
		<div class="form-group col-2">
			<label>Payment Due Date</label>
			<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
		</div>
		<div class="form-group col-5">
			<label>Hrs/Milestones </label>
			<input type="text" class="form-control" value="" >
		</div>
	</div> -->
</div>


<div class="sales_commission_schedule-2 d-none">
	<input type="hidden" name="commission_schedule_id[]" id="commission_schedule_id" value="1">
	<input type="hidden" name="last_commission_schedule_id[]" id="last_commission_schedule_id" value="1">
	<!-- <div class="form-group basic-info mb-3">
		<div class="form-check form-check-inline">
			<div class="custom-control custom-radio">
				<input type="radio" id="on_time" class="custom-control-input" name="title12" checked>
				<label class="custom-control-label" for="on_time">On Time</label>
			</div>
		</div>
		<div class="form-check form-check-inline">
			<div class="custom-control custom-radio">
				<input type="radio" id="recurring" class="custom-control-input" name="title12">
				<label class="custom-control-label" for="recurring">Recurring</label>
			</div>
		</div>
		<div class="form-check form-check-inline">
			<div class="custom-control custom-radio">
				<input type="radio" id="no_commission" class="custom-control-input" name="title12">
				<label class="custom-control-label" for="no_commission"> No Commission</label>
			</div>
		</div>
	</div> -->
	<div class="form-row">
		<div class="form-group col-5">
			<label>Commission Amount </label><small>(INR)(Excluding GST)</small>
			<input type="text" class="form-control" value="" >
		</div>
		<div class="form-group col-2">
			<label>Payment Due Date</label>
			<input class="flatpickr flatpickr-input form-control" type="text" name="dob" value="">
		</div>
		<div class="form-group col-5">
			<label>Remarks/Milestones </label>
			<input type="text" class="form-control" value="" >
		</div>
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

	function addSchedule(id){
		// console.log(id)
        var str = $('.schedule-3:last #last_schedule_id').val();
        var x = parseInt(str) + parseInt(1);
		var y = x - 1;

		var element = '<div class="schedule-3">'+$('.schedule-2').html()+'</div>';
	  	$('.schedule-1').append(element);
        $('.schedule-3 #schedule_id').val(id);

        $('.schedule-3:last .sub_module_num').text(y);
        $('.schedule-3:last #last_schedule_id').val(x);
	}


	function addCommissionPayoutSchedule(id){
		// console.log(id)
        var str = $('.sales_commission_schedule-3:last #last_commission_schedule_id').val();
        var x = parseInt(str) + parseInt(1);

		var element = '<div class="sales_commission_schedule-3">'+$('.sales_commission_schedule-2').html()+'</div>';
	  	$('.sales_commission_schedule-1').append(element);
        $('.sales_commission_schedule-3:last #last_commission_schedule_id').val(x);
	}

    function removeSchedule(id){
		var mod_id = $('.schedule-3:last #last_schedule_id').val();
        if(mod_id != '1'){
			$('.schedule-1 .schedule-3:last').remove();
        }
    }


	function removeCommissionPayoutSchedule(id){
		var mod_id = $('.sales_commission_schedule-3:last #last_commission_schedule_id').val();
        if(mod_id != '1'){
			$('.sales_commission_schedule-1 .sales_commission_schedule-3:last').remove();
        }
    }

	// $(document).on('click','.remove-ps',function() {
	// 	var mod_id = $(".module-3:last input#module_id").val();
	// 	if (mod_id != '0') {
	// 		ConfirmDelete(mod_id,'1');
	// 	} else {
	// 		$(".module-3:last").remove();
	//  	}
	//  	// $(this).parent('.ug-qualification-3').remove();
	// });

	// $(document).on('click','.remove-sm',function() {
	// 	var sub_mod_id = $(".sub-module-3:last input#sub_module_id").val();
	// 	if (sub_mod_id != '0') {
	// 		ConfirmDelete(sub_mod_id,'1');
	// 	} else {
	// 		$(".sub-module-3:last").remove();
	//  	}
	//  	// $(this).parent('.ug-qualification-3').remove();
	// });

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

