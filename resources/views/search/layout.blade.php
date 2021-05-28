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
		    <span class="border-title profile_text"><i class="fa fa-bars"></i></span>
			<span class="h5 text-white ml-2 profile_text">Advance Search</span>
			<nav class="navbar navbar-expand-xl navbar-light custom_header">
				<!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
				<!-- <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse1" style="margin-right: -34px;">
				<span class="border-title"><i class="fa fa-bars"></i></span>
				<span class="h5 text-white ml-2">Advance Search</span>
				</button> -->
				<!-- Collection of nav links, forms, and other content for toggling -->
				<div id="navbarCollapse1" class="collapse navbar-collapse justify-content-start nav_sub">
					<div class="navbar-nav ml-auto">
						<div class="nav-item dropdown">
							<a href="/profile" class="dropdown-item sub_nav_menu" style="color:white;"><i class="fa fa-user-o"></i> Primary Information</a>
							<a href="/profile/education" class="dropdown-item sub_nav_menu" style="color:white;"><i class="fa fa-sliders"></i> Education</a>
							<a href="/profile/certification" class="dropdown-item sub_nav_menu" style="color:white;"><i class="fa fa-sliders"></i> Certification</a>
							<a href="/profile/professional-experience" class="dropdown-item sub_nav_menu" style="color:white;"><i class="fa fa-sliders"></i> Professional Experience</a>
							<a href="/profile" class="dropdown-item sub_nav_menu" style="color:white;"><i class="fa fa-sliders"></i> User Settings</a>
						</div>
					</div>
				</div>
			</nav>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
     $(window).bind("load", function() {
        change_category();
		changeBrowseProjectType();
		changeBrowseProjectType1();
		changeBrowseProjectType2();
    });

	$('#inlineCheckbox1').change(function() {
		if(this.checked) {
			$('#rate_per_hour').prop('disabled',true);
		} else {
			$('#rate_per_hour').prop('disabled',false);
		}
	});

	document.getElementById('inlineCheckbox1').onchange = function() {
		document.getElementById('rate_per_hour').disabled = !this.checked;
		document.getElementById('rate_per_hour1').disabled = !this.checked;
	};

	
    $('#technologty_pre').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
    // $('#framework').select2({
    //     theme: 'bootstrap',
    //     placeholder: 'Select a value',
    // });


	function changeBrowseProjectType() {
		var checkBox = document.getElementById("inlineCheckbox11");
		// Get the output text
		var hourly = document.getElementById("hourly1");
		if (checkBox.checked == true){
			hourly.style.display = "block";
		} else {
			hourly.style.display = "none";
		}
	}

	function changeBrowseProjectType1() {
		var checkBox = document.getElementById("inlineCheckbox21");
		var retainer = document.getElementById("retainer1");
		if (checkBox.checked == true){
			retainer.style.display = "block";
		} else {
			retainer.style.display = "none";
		}
	}

	function changeBrowseProjectType2() {
		var checkBox = document.getElementById("inlineCheckbox31");
		var project_based = document.getElementById("project-based1");
		if (checkBox.checked == true){
			project_based.style.display = "block";
		} else {
			project_based.style.display = "none";
		}
	}
</script>
@stop
