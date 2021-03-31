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
        	<span class="h5 text-white">Job Contract Details</span>
    	</div>
  	</div>
</div>
@stop
{{-- content --}}
@section('content')
<div class="profile-setting project-contract">
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
                                <span class="h5 text-white" style="margin-left: -25px;">Job Contract Details</span> <small>(To be filled by developer)</small>
                            </div>
                        </div>
						<div class="card-body p-4">
							<form action="{{ route('jobcontract.create') }}" method="POST" id="educationForm">
								@csrf
								<div class="main-moudle">
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label>Proposal Id</label>
                                            <input type="text" class="form-control" name="proposal_id" value="{{ $joblead->job_leads_id }}" readonly>
                                            <input type="hidden" name="project_id" value="{{ $joblead->job_id }}">
                                        </div>
                                        <div class="form-group col-8">
                                            <label>Order Closed Amount</label><small>(including sales Commission & Excluding GST)</small>
                                            <input type="number" class="form-control" name="order_closed_value" required>
                                        </div>
                                    </div>
									<div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Date of Acceptance</label>
                                            <input class="flatpickr flatpickr-input form-control" type="text" name="date_acceptance" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Ordering Company Name/Individual</label>
                                            <input type="text" class="form-control" name="ordering_com_name" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 mt-3">
									    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-4">Generate Invoice</button>
									</div>

									<div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Advance Payment details</label>
                                            <input type="text" class="form-control" name="advance_payment_details">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Remarks</label>
                                            <input type="text" class="form-control" name="remarks">
                                        </div>
                                    </div>

                                    <div class="form-row">
									    <div class="form-group col-5">
                                            <label>Invoice Number </label><small>(Against Advance)</small>
                                            <input type="text" class="form-control" name="invoive_no">
                                        </div>
                                        <div class="form-group col-2">
                                            <label>Invoice Date</label>
                                            <input class="flatpickr flatpickr-input form-control" type="text" name="invoice_date">
                                        </div>
                                        <div class="form-group col-5">
                                            <label>Invoice Amount</label><small>(Excluding GST)</small>
                                            <input type="number" class="form-control" name="invoice_amount" >
                                        </div>
                                    </div>
                                </div>
								<div class="form-group text-right mt-5">
									<div class="btn-group" role="group">
										<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-4">
											Next >>>
										</button>
									</div>
									<div class="btn-group" role="group">
									      <button class="btn btn-primary" type="reset">Discard</button>
									</div>
								</div>
                                <!-- Modal -->
                                <div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-blue text-white">
                                                <h4 class="modal-title" id="modalLabelnews">Customer Payment Schedules</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="main-moudle">
                                                    <h4 class="modal-title" id="modalLabelnews1">Advance Invoice Details</h4>
                                                    <br>
                                                    <div class="schedule">
                                                        <div class="form-row">
                                                            <div class="form-group col-3">
                                                                <label>Invoice No. </label>
                                                                <input type="text" class="form-control" name="invoice_no" value="Eil001" readonly>
                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Invoice Amount </label><small>(Excluding GST)</small>
                                                                <input type="number" class="form-control" name="invoice_amount" required>
                                                            </div>
                                                            <div class="form-group col-2">
                                                                <label>Invoice Due Date</label>
                                                                <input class="flatpickr flatpickr-input form-control" type="text" name="invoice_due_date" required>
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label>Hrs/Milestones </label>
                                                                <input type="text" class="form-control" name="invoice_milestones" value="" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h4 class="modal-title" id="modalLabelnews1">Customer Payment Schedules</h4>
                                                    <br>
                                                    <div class="schedule-1">
                                                        <div class="schedule-3 remove-qual-1">
                                                        <input type="hidden" name="payment_schedule_id[]" id="payment_schedule_id" value="1">
                                                        <input type="hidden" name="advance_payment[]" value="1">
                                                            <div class="form-row">
                                                                <div class="form-group col-5">
                                                                    <label>Advance Payment </label><small>(Excluding GST)</small>
                                                                    <input type="number" class="form-control" name="installment_amount[]" value="" >
                                                                </div>
                                                                <div class="form-group col-2">
                                                                    <label>Payment Due Date</label>
                                                                    <input class="flatpickr flatpickr-input form-control" type="text" name="paymwnt_due_date[]" value="">
                                                                </div>
                                                                <div class="form-group col-5">
                                                                    <label>Hrs/Milestones/Remarks </label>
                                                                    <input type="text" class="form-control" name="milestones_name[]" value="" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 mt-3 profile-basic">
                                                        <button class="btn btn-md btn-info btn-copy-sm1" type="button" onclick="addSchedule('1')">Add More Schedules <span class="fa fa-plus"></span></button>
                                                        <button type="button" class="btn btn-md btn-info ml-3 rounded-0" onclick="removeSchedule('1')">Erase Schedule <span class="fas fa-times"></span></button>
                                                    </div>
                                                    <div class="modal-footer singup-body">
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-primary"><span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                                            Send To Customer  >>></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

<div class="schedule-2 d-none">
    <input type="hidden" name="payment_schedule_id[]" id="payment_schedule_id" value="2">
    <input type="hidden" name="advance_payment[]" value="0">
	<div class="form-row">
		<div class="form-group col-5">
			<!-- <label>First Installment </label><small>(Excluding GST)</small> -->
			<label><span class="sub_module_num">1</span>. Installment </label><small>(Excluding GST)</small>
			<input type="number" class="form-control" name="installment_amount[]" value="" >
		</div>
		<div class="form-group col-2">
			<label>Payment Due Date</label>
			<input class="flatpickr flatpickr-input form-control" type="text" name="paymwnt_due_date[]" value="">
		</div>
		<div class="form-group col-5">
			<label>Hrs/Milestones/Remarks </label>
			<input type="text" class="form-control" name="milestones_name[]" value="" >
		</div>
	</div>
</div>


<div class="sales_commission_schedule-2 d-none">
	<input type="hidden" name="commission_schedule_id[]" id="commission_schedule_id" value="1">
	<input type="hidden" name="last_commission_schedule_id[]" id="last_commission_schedule_id" value="1">
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

    $('.custom-file-input').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });

	function addSchedule(id){
		// console.log(id)
        var str = $('.schedule-3:last #payment_schedule_id').val();
        var x = parseInt(str) + parseInt(1);
		// var y = x - 1;

		var element = '<div class="schedule-3">'+$('.schedule-2').html()+'</div>';
	  	$('.schedule-1').append(element);
        // $('.schedule-3 #schedule_id').val(id);

        $(".schedule-3:last .flatpickr").flatpickr();

        $('.schedule-3:last .sub_module_num').text(x);
        $('.schedule-3:last #payment_schedule_id').val(x);
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
		var mod_id = $('.schedule-3:last #payment_schedule_id').val();
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

