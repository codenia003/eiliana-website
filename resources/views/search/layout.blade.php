@extends('layouts/default')

{{-- Page title --}}
@section('title')
Advance Search
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
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="advanced-search">
	<div class="bg-red">
	  <div class="px-5 py-2">
	    <div class="align-items-center">
	        <span class="border-title"><i class="fa fa-bars"></i></span>
	        <span class="h5 text-white ml-2">Advance Search</span>
	         <!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
	    </div>
	  </div>
	</div>
	<div class="shadow1">
		<div class="container space-1 space-top-lg-0 mt-lg-n10">
	    	@yield('search_tab_content')
	    	<div class="row">
		        <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
		        	<div id="notific">
			            @include('notifications')
			        </div>
		            @yield('search_content')
		        </div>
		        @include('layouts.left')
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
<script type="text/javascript" src="{{ asset('vendors/moment/js/moment.min.js') }}"></script>
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/profile_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
    $('#technologty_pre').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
    $('#framework').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
</script>
<!--global js end-->
@stop
