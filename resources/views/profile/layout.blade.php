@extends('layouts/default')

{{-- Page title --}}
@section('title')
Profile Setting
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="profile-setting">
	<div class="bg-red">
	  <div class="px-5 py-2">
	    <div class="align-items-center">
	        <span class="border-title"><i class="fa fa-bars"></i></span>
	        <span class="h5 text-white ml-2">Profile Setting</span>
	         <!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
	    </div>
	  </div>
	</div>
	<div class="container space-1 space-top-lg-0 mt-lg-n10">
	    <div class="row">
	        <div class="col-lg-3">
	            @include('profile._left_menu')
	        </div>
	        <div class="col-lg-9">
	            @yield('profile_content')
	        </div>
	    </div>
	    <!-- End Row -->
	</div>
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<script>
    function changeAnonymus(e) {
        var anonymous = e.target.value;
        var data= {
            anonymous:anonymous
        };
        $.ajax({
            type: 'GET', 
            url: '/profile/publicAnonymusUpdate',
            data: data,
            contentType: 'application/json',
            dataType: "json",
            success: function(data) {
                Swal.fire({
	              type: 'success',
	              title: 'Success...',
	              text: 'Updated successfully',
	              showConfirmButton: false,
	              timer: 1500
	            })
            },
            error: function(xhr, status, error) {
                console.log("error: ",error);
            },
        });
    }
</script>
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/profile_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<!--global js end-->
@stop