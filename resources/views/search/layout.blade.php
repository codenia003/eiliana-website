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
	<div class="shadow">	
		<div class="container space-1 space-top-lg-0 mt-lg-n10">
	    	<div class="row">
		        <div class="col-lg-8">
		        	<div id="notific">
			            @include('notifications')
			        </div>
		            @yield('search_content')
		        </div>
		        <div class="col-lg-4">
		            <div id="sidebarNav" class="navbar-collapse navbar-vertical " style="">
					    <div class="position-relative max-w-50rem mx-auto mobile-profile">
					        <!-- Device Mockup -->
					        <div class="device device-iphone-x w-100 mx-auto">
					            <img class="device-iphone-x-frame" src="/assets/img/profile/mobile-bg.png" alt="Image Description">
					            <div class="device-iphone-x-screen">
					                <div class="top-mobile bg-blue bg-img-hero" style="background-image: url(/assets/img/profile/mobile-profile.png);">
					                    <div class="row">
					                        <div class="col-4"></div>
					                        <div class="col-8">
					                            <div class="img-upload">
					                                <img class="image-preview avatar-img" src="/assets/img/profile/m-photo-icon.png" class="avatar" alt="Avatar">
					                                <span>Upload Photo</span>
					                            </div>
					                            <button class="btn">{{ Sentinel::getUser()->full_name }}</button>
					                            <p class="card-text font-size-1">
					                                @isset(Sentinel::getUser()->city)
					                                {{ Sentinel::getUser()->city }}, 
					                                @endisset
					                                {{ Session::get('users')['country_name'] }}
					                                <br>
					                                {{ \Carbon\Carbon::parse(Sentinel::getUser()->created_at)->format('M d, Y')}}
					                            </p>
					                        
					                        </div>
					                    </div>
					                </div> 
					                <div class="bottom-menu">
					                    <div class="list-group">
					                        <a class="list-group-item list-group-item-action bg-white-b {!! (Request::is('profile') ? 'active' : '' ) !!}" href="/profile">
					                            <!-- <i class="fas fa-info-circle"></i> -->
					                            <img class="img-fluid" src="/assets/img/profile/icon-1.png" alt="Avatar">
					                            <span>Primary Information</span>
					                        </a>
					                        <a class="list-group-item list-group-item-action bg-blue {!! (Request::is('profile/education') ? 'active' : '' ) !!}" href="/profile/education">
					                            <img class="img-fluid" src="/assets/img/profile/icon-2.png" alt="Avatar">
					                            <span> Education</span>
					                        </a>
					                        <a class="list-group-item list-group-item-action bg-white-b {!! (Request::is('profile/certification') ? 'active' : '' ) !!}" href="/profile/certification">
					                            <img class="img-fluid" src="/assets/img/profile/icon-3.png" alt="Avatar">
					                            <span> Certification</span>
					                        </a>
					                        <a class="list-group-item list-group-item-action bg-blue {!! (Request::is('profile/professional-experience') ? 'active' : '' ) !!}" href="/profile/professional-experience">
					                            <img class="img-fluid" src="/assets/img/profile/icon-4.png" alt="Avatar">
					                            <span> Professional Experience</span>
					                        </a>
					                        <a class="list-group-item list-group-item-action bg-white-b" href="/profile">
					                            <img class="img-fluid" src="/assets/img/profile/icon-5.png" alt="Avatar">
					                            <span> Company Settings</span>
					                        </a>
					                    </div>
					                </div>
				            </div>
				        </div>
				        <!-- End Device Mockup -->
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
<script type="text/javascript" src="{{ asset('vendors/moment/js/moment.min.js') }}"></script>
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/profile_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
	
</script>
<!--global js end-->
@stop