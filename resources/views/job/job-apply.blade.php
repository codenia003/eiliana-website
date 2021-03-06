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
                            <form action="{{ route('postJobLead.new') }}" method="POST" id="staffingflead" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                                <input type="hidden" name="to_user_id" value="{{ $job->companydetails->id }}">
                                <div class="modal-header text-black bg-img-hero" style="background-image: url(/assets/img/others/applyproject-removebg.png);background-size: contain;background-position: right;">
                                    <h4 class="modal-title" id="modalLabelnews">Apply JOB</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="form-group col-6">
                                            <label for="job_id" class="col-form-label">Job ID:</label>
                                            <input type="text" class="form-control" name="job_id" id="job_id" value="{{ $job->job_id }}" readonly="">
                                       </div>
                                       <div class="form-group col-6">
                                            <label for="resource_name" class="col-form-label">Resource Name:</label>
                                            <input class="form-control" type="text" name="resource_name" id="resource_name">
                                        </div>
                                    </div>
        
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="price_per_month" class="col-form-label">Price per month:</label>
                                            <input type="number" class="form-control" name="price_per_month" id="price_per_month"  required>
                                        </div>
                                       {{-- <div class="form-group col-6">
                                            <label for="expected_ctc" class="col-form-label">Expected ctc:</label>
                                            <input type="number" class="form-control" name="expected_ctc" id="expected_ctc" required>
                                        </div> --}}
                                        <div class="form-group col-6">
                                            <label for="notice_period" class="col-form-label">Notice Period(In Days):</label>
                                            <input type="number" class="form-control" name="notice_period" id="notice_period">
                                       </div>
                                    </div>
        
                                    <div class="form-row">
                                       <div class="form-group col-12">
                                            <label for="subject" class="col-form-label">Subject:</label>
                                            <input type="text" class="form-control" name="subject" id="subject">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text" name="messagetext" rows="3"></textarea>
                                    </div>

                                    <div class="form-group basic-file">
                                        <label>Attach File/Resume</label>
                                        <div class="custom-file" style="height: calc(1.5em + 0.75rem + 8px);">
                                            <input type="file" class="custom-file-input" id="customFile" name="attach_file">
                                            <label class="custom-file-label" for="customFile">Attach File/Resume</label>
                                        </div>
                                    </div>
                                    
                                    <div class="singup-body float-right mt-3">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary" type="submit"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Apply</button>
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
        notice_period: {
            validators: {
                notEmpty: {
                    message: 'The notice period is required',
                },
            },
        },
    },
});
</script>

<!--global js end-->
@stop

