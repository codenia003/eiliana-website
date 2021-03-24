@extends('layouts/default')

{{-- Page title --}}
@section('title')
Contractual Job Information
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
        	<span class="h5 text-white">Contractual Job Information</span>
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
                                <span class="h5 text-white" style="margin-left: -25px;">Contractual Job Information</span> <small>(To be filled by developer)</small>
                            </div>
                        </div>
						<div class="card-body p-4">
                            <form action="{{ route('job-finance.send') }}" method="POST" id="educationForm">
                                @csrf
                                <input type="hidden" name="contractual_job_id" value="{{ $contractual_job->contractual_job_id }}">
                                <input type="hidden" name="job_proposal_id" value="{{ $contractual_job->job_proposal_id }}">
                                <div class="main-moudle">
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Order ID</label>
                                            <input type="text" class="form-control" name="job_id" value="{{ $contractual_job->job_id }}" readonly="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Invoice ID</label>
                                           <input type="text" class="form-control" name="job_leads_id" value="{{ $contractual_job->job_leads_id }}" readonly="">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Price </label>
                                            <input type="text" class="form-control" name="price" value="{{ $contractual_job->price }}" readonly="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Date Acceptance</label>
                                            <input class="form-control" type="text" name="date_acceptance" value="{{ $contractual_job->date_acceptance }}" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Billing Address</label>
                                            <input type="text" class="form-control" name="billing_address" value="{{ $contractual_job->billing_address }}" readonly="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Status</label>
                                            <select name="status[]" class="form-control" disabled>
                                                <option value="1" {{ ($contractual_job->status=='1')? "selected" : "" }}>Pending</option>
                                                <option value="2" {{ ($contractual_job->status=='2')? "selected" : "" }}>Paid</option>
                                                <option value="3" {{ ($contractual_job->status=='3')? "selected" : "" }}>Cancel</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right mt-5" id="status">
                                    <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary" type="submit">Send To Eiliana Finance</button>
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


</script>

<!--global js end-->
@stop

