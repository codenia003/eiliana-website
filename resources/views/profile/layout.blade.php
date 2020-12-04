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
<link href="{{ asset('vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
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
	        <div class="col-lg-8">
	        	<div id="notific">
		            @include('notifications')
		        </div>
	            @yield('profile_content')
	        </div>
	        <div class="col-lg-4">
	            @include('profile._left_menu')
	        </div>
	    </div>
	    <!-- End Row -->
	</div>
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<script language="javascript" type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script>
	$('#tag_list').select2({
  		selectOnClose: true
	});
   	function changeAnonymus(e) {
        var anonymous = e.target.value;
        if (anonymous == '0') {
            $('.anonymousShow').addClass("d-none");
        } else {
            $('.anonymousShow').removeClass("d-none");
        }
        var data= {
            anonymous:anonymous
        };
        /*$.ajax({
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
        });*/
    }

	$(function(){
	  	$(".btn-copy-ug").on('click', function(){
	  		var str = $("#graduation_type").val();
	  		var element = '<div class="ug-qualification-3">'+$('.ug-qualification-2').html()+'</div>';
	  		$('.ug-qualification-1').append(element);

	  	});
	  	$(".btn-copy-pg").on('click', function(){
	  		var element = '<div class="pg-qualification-3">'+$('.pg-qualification-2').html()+'</div>';
	  		$('.pg-qualification-1').append(element);
	  	});
	  	$(".btn-copy-c").on('click', function(){
	  		var element = '<div class="certification-3">'+$('.certification-2').html()+'</div>';
	  		$('.certification-1').append(element);
	  	});
	  	$(".btn-copy-p").on('click', function(){
	  		var element = '<div class="project-3">'+$('.project-2').html()+'</div>';
	  		$('.project-1').append(element);
	  	});
	});
	$(document).on('click','.remove-ug',function() {
		var edu_id = $(".ug-qualification-3:last input#education_id").val();
		if (edu_id != '0') {
			ConfirmDelete(edu_id,'1');
		} else {
			$(".ug-qualification-3:last").remove();
	 	}
	 	// $(this).parent('.ug-qualification-3').remove();
	});
	$(document).on('click','.remove-pg',function() {
		var edu_id = $(".pg-qualification-3:last input#education_id").val();
		if (edu_id != '0') {
			ConfirmDelete(edu_id,'1');
		} else {
			$(".pg-qualification-3:last").remove();
	 	}
	});
	$(document).on('click','.remove-c',function() {
		var cert_id = $(".certification-3:last input#certificate_id").val();
		if (cert_id != '0') {
			ConfirmDelete(cert_id,'2');
		} else {
			$(".certification-3:last").remove();
	 	}
	});
	$(document).on('click','.remove-p',function() {
		// var cert_id = $(".certification-3:last input#certificate_id").val();
		// if (cert_id != '0') {
		// 	ConfirmDelete(cert_id,'2');
		// } else {
		$(".project-3:last").remove();
	 	// }
	});
	function ConfirmDelete(edu_id,main_id)
	{
	  	var x = confirm("Are you sure you want to delete?");
	  	var edu_id = edu_id;
	  	if (x) {
	  		if (main_id == '1') {
	  			$.ajax({
		            type: 'GET', 
		            url: '/profile/deleteducation',
		            data: {edu_id:edu_id},
		            contentType: 'application/json',
		            dataType: "json",
		            success: function(data) {
		            	$(".remove-qual-"+edu_id).remove();
		                Swal.fire({
			              type: 'success',
			              title: 'Success...',
			              text: 'Education Deleted successfully',
			              showConfirmButton: false,
			              timer: 1500
			            })

		            },
		            error: function(xhr, status, error) {
		                console.log("error: ",error);
		            },
		        });
	  		} else {
	  			$.ajax({
		            type: 'GET', 
		            url: '/profile/deletecertification',
		            data: {cert_id:edu_id},
		            contentType: 'application/json',
		            dataType: "json",
		            success: function(data) {
		            	$(".remove-qual-"+edu_id).remove();
		                Swal.fire({
			              type: 'success',
			              title: 'Success...',
			              text: 'Certificate Deleted successfully',
			              showConfirmButton: false,
			              timer: 1500
			            })

		            },
		            error: function(xhr, status, error) {
		                console.log("error: ",error);
		            },
		        });
	  		}
	    	return true;
	  	} else {
	    	return false;
		}
	}
	function changeInterested(e) {
		$("#exampleModal1").modal();
    }
</script>
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/profile_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<!--global js end-->
@stop