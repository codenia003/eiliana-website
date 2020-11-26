@extends('layouts/default')

{{-- Page title --}}
@section('title')
Project
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="bg-light profile-setting">
	<div class="bg-red">
	  <div class="px-5 py-2">
	    <div class="align-items-center">
	        <span class="border-title"><i class="fa fa-bars"></i></span>
	        <span class="h5 text-white ml-2">Project</span>
	         <!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
	    </div>
	  </div>
	</div>
	<div class="container space-1 space-top-lg-0 mt-lg-n10">
	    <div class="row">
	        <div class="col-lg-3">
	            @include('_left_menu')
	        </div>
	        <div class="col-lg-9">
	            @yield('project_content')
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