@extends('layouts/default')

{{-- Page title --}}
@section('title')
Home
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="profile-setting">
	<div class="bg-red">
	  <div class="px-5 py-2">
	    <div class="align-items-center">
	        <span class="border-title"><i class="fa fa-bars"></i></span>
	        <span class="h5 text-white ml-2">Dashboard</span>
	    </div>
	  </div>
	</div>
	<div class="container space-2">
	    <div class="row">
	        <div class="col-lg-3">
			    <div id="notific">
		            @include('notifications')
		        </div>
	        	@include('_left_menu')
	        </div>
	        <div class="col-lg-9">
	            <div class="card mb-3 mb-lg-5">
				    <div class="card-header">
				        <h5 class="card-title">Recent Projects</h5>
				    </div>
				    <!-- Body -->
				    <div class="card-body">
				        <div class="card-body card-body-centered" style="min-height: 15rem;">
						    <p>Start bidding now on projects that meet your skills.</p>
                            @if (Session::get('users')['login_as'] == '1')
                            <a class="btn btn-primary bg-orange" href="{{ url('search-project') }}">Browse Projects And Jobs</a>
                            @else
                            <a class="btn btn-primary bg-orange" href="{{ url('hire-talent') }}">Browse Freelancer And Talent</a>
                            @endif
                            <!-- <a class="btn btn-primary bg-orange" routerLink="/project/1">Browse Projects</a> -->
						 </div>
				    </div>
				    <!-- End Body -->
				</div>
	        </div>
	    </div>
	    <!-- End Row -->
	</div>
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!-- page level js starts-->
<!--page level js ends-->
@stop
