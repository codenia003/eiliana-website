@extends('layouts/default')

{{-- Page title --}}
@section('title')
Job Lead Response
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<!--end of page level css-->
@stop

@section('top')
<div class="bg-red">
  	<div class="px-5 py-2">
    	<div class="align-items-center">
        	<span class="border-title"><i class="fa fa-bars"></i></span>
        	<span class="h5 text-white">Job Lead Response</span>
    	</div>
  	</div>
</div>
@stop
{{-- content --}}
@section('content')
<div class="job-lead-response">
	<div class="container space-2">
	    <div class="row">
	        <div class="col-md-8 offset-md-2 mt-4 shadow p-0 lead-res-body">
	        	<div id="notific">
		            @include('notifications')
		        </div>
	             <div class="notification-type">
					<div class="card shadow border">
						<div class="card-body p-4">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Image" width="150">
                            </div>
                            <div class="message-part">
                                <h3>Hi, {{ Sentinel::getUser()->full_name }}</h3>
                                <p>
                                    Your proposal has been submitted successfully. Will keep you posted on update.
                                </p>
                            </div>
                            {{-- <div class="singup-body float-right mt-3">
                                <a class="btn btn-primary" href="#">Check</a>
                                <a class="btn btn-outline-primary" href="#">My Lead</a>
                            </div> --}}
						</div>
					</div>
				</div>
	        </div>
	    </div>
	    <!-- End Row -->
	</div>
</div>

@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<!--global js end-->
@stop

