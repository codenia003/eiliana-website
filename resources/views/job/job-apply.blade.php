@extends('layouts/default')

{{-- Page title --}}
@section('title')
Apply Job
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
        	<span class="h5 text-white">Apply Job</span>
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
						<div class="card-body p-4">
                            <form action="{{ route('postJobLead.new') }}" method="POST" id="staffingflead">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                                <input type="hidden" name="to_user_id" value="{{ $job->companydetails->id }}">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalLabelnews">Apply JOB</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="form-group col-6">
                                            <label for="job_id" class="col-form-label">Job ID:</label>
                                            <input type="text" class="form-control" name="job_id" id="job_id" value="{{ $job->job_id }}" readonly="">
                                       </div>
                                       <div class="form-group col-6">
                                            <label for="application_date" class="col-form-label">Application date:</label>
                                            <input class="flatpickr flatpickr-input form-control" type="text" name="application_date" id="application_date">
                                        </div>
                                    </div>
        
                                    <div class="form-row">
                                       <div class="form-group col-6">
                                            <label for="current_ctc" class="col-form-label">Current ctc:</label>
                                            <input type="text" class="form-control" name="current_ctc" id="current_ctc" value="{{ $job->companydetails->id }}" readonly="">
                                       </div>
                                       <div class="form-group col-6">
                                            <label for="expected_ctc" class="col-form-label">Expected ctc:</label>
                                            <input type="number" class="form-control" name="expected_ctc" id="expected_ctc" required>
                                        </div>
                                    </div>
        
                                    <div class="form-row">
                                       <div class="form-group col-6">
                                            <label for="notice_period" class="col-form-label">Notice Period:</label>
                                            <input type="text" class="form-control" name="notice_period" id="notice_period">
                                       </div>
                                       <div class="form-group col-6">
                                            <label for="subject" class="col-form-label">Subject:</label>
                                            <input type="text" class="form-control" name="subject" id="subject">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text" name="messagetext" rows="3"></textarea>
                                    </div>
                                    
                                    <div class="singup-body float-right mt-3">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Apply</button>
                                            {{-- <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
	        </div>
            {{-- <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="search-project projects space-2">
                    <img src="/assets/img/others/applyproject-removebg.png" class="img-fluid" alt="">
                    <img src="/assets/img/others/applyproject-removebg.png" class="img-fluid" alt="">
                </div>
            </div> --}}
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
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        flatpickr('.flatpickr');
    });
</script>    
<script>
$('#staffingflead').bootstrapValidator({
    fields: {
        subject: {
            validators: {
                notEmpty: {
                    message: 'The subject is required',
                },
            },
        },
        messagetext: {
            validators: {
                notEmpty: {
                    message: 'The message is required',
                },
            },
        },
        application_date: {
            validators: {
                notEmpty: {
                    message: 'The application date is required',
                },
            },
        },
        notice_period: {
            validators: {
                notEmpty: {
                    message: 'The notice period is required',
                },
            },
        },
    },
}).on('success.form.bv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    var bv = $form.data('bootstrapValidator');
    $('.spinner-border').removeClass("d-none");
    $.post($form.attr('action'), $form.serialize(), function(result) {
        var userCheck = result;
        if (userCheck.success == '1') {
            $('#modal-4').modal('toggle');
            $('#subject').val('');
            $('#message-text').val('');
            $('#notice_period').val('');
            $('.spinner-border').addClass("d-none");
            Swal.fire({
              type: 'success',
              title: 'Success...',
              text: userCheck.msg,
              showConfirmButton: false,
              timer: 2000
            });
        } else {
            $('#modal-4').modal('toggle');
            $('#subject').val('');
            $('#message-text').val('');
            $('#notice_period').val('');
            $('.spinner-border').addClass("d-none");
            Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: userCheck.errors,
              showConfirmButton: false,
              timer: 2000
            });
        }
    }, 'json');
});</script>

<!--global js end-->
@stop

