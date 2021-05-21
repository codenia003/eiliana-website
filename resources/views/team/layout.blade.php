@extends('layouts/default')

{{-- Page title --}}
@section('title')
Team
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
<style>
        .listofteam h5.card-title {
            font-size: 20px;
            color: #003466;
            margin-top: -35px;
        }
		.teams-header .mt-6, .my-6 {
			margin-top: 1rem!important;
		}
		.teams-header h2 {
			font-size: 20px;
			margin-top: 65px;
		}
		.profile-setting .my-alldata tr:nth-child(even) {
			background-color: #ffffff;
		}
		
</style>
@stop

{{--@section('top')
<div class="bg-red">
  	<div class="px-5 py-2">
    	<div class="align-items-center">
         	<!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
			 <nav class="navbar navbar-expand-xl navbar-light custom_header">
				<!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse1" style="margin-right: -34px;">
				<span class="border-title"><i class="fa fa-bars"></i></span>
        	    <span class="h5 text-white ml-2">Profile Setting</span>
				</button>
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
@stop--}}
{{-- content --}}
@section('content')
<div class="profile-setting">
	<div class="container space-2">
	    <div class="row">
	        <div class="col-lg-12">
	        	<div id="notific">
		            @include('notifications')
		        </div>
	            @yield('profile_content')
	        </div>
	        {{--<div class="col-lg-4">
	            @include('profile._left_menu')
	        </div>--}}
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
    // $('#registerprofexpForm').bootstrapValidator({});
    $(document).ready(function() {
        flatpickr('.flatpickr');
    });
	$('#technologty_pre').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
    $('#framework').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });

	$('#duplicate_technologty_pre').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
    $('#duplicate_framework').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });

    $('.custom-file-input').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
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

            var str = $(".project-3:last #tech_project_id").val();
            var x = parseInt(str) + parseInt(1);
            console.log(x);
	  		var element = '<div class="project-3">'+$('.project-2').html()+'</div>';
	  		$('.project-1').append(element);

            $('.project-3:last #tech_project_id').val(x);
            $('.project-3:last #technologty_pre_multi').attr("onchange","change_framework_project("+x+");");
            $('.project-3:last #technologty_pre_multi').attr("id","technologty_pre_multi_"+x);
            $('.project-3:last #framework_multi').attr("id","framework_multi_"+x);

	  	});
	  	$(".btn-copy-e").on('click', function(){
	  		var element = '<div class="employer-3">'+$('.employer-2').html()+'</div>';
	  		$('.employer-1').append(element);
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
		var cert_id = $(".project-3:last input#user_project_id").val();
		// console.log(cert_id);
		if (cert_id != '0') {
			ConfirmDelete(cert_id,'3');
		} else {
			$(".project-3:last").remove();
	 	}
	});
	$(document).on('click','.remove-e',function() {
		var cert_id = $(".employer-3:last input#employer_id").val();
		if (cert_id != '0') {
			ConfirmDelete(cert_id,'4');
		} else {
			$(".employer-3:last").remove();
	 	}
	});
	function ConfirmDelete(edu_id,main_id)
	{
	  	var x = confirm("Are you sure you want to delete?");
	  	var edu_id = edu_id;
	  	if (x) {
	  		if (main_id == '1') {
	  			var data= {
		            edu_id:edu_id
		        };
		        var url = '/profile/deleteducation';
		        var message = 'Education Deleted successfully';
	  		} else if (main_id == '2') {
	  			var data= {
		            cert_id:edu_id
		        };
		        var url = '/profile/deletecertification';
		        var message = 'Certificate Deleted successfully';
	  		} else if (main_id == '3') {
	  			var data= {
		            project_id:edu_id
		        };
		        var url = '/profile/deleteprojects';
		        var message = 'Project Deleted successfully';
	  		} else if (main_id == '4') {
	  			var data= {
		            emp_id:edu_id
		        };
		        var url = '/profile/deleteemployer';
		        var message = 'Employer Deleted successfully';
	  		}

	  		$.ajax({
	            type: 'GET',
	            url: url,
	            data: data,
	            contentType: 'application/json',
	            dataType: "json",
	            success: function(data) {
	            	$(".remove-qual-"+edu_id).remove();
	                Swal.fire({
		              type: 'success',
		              title: 'Success...',
		              text: message,
		              showConfirmButton: false,
		              timer: 1500
		            })

	            },
	            error: function(xhr, status, error) {
	                console.log("error: ",error);
	            },
	        });
	    	return true;
	  	} else {
	    	return false;
		}
    }

	function changeInterested(e) {
		$("#exampleModal1").modal();
    }

	function imageUpload(input) {
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.top-mobile').attr('style', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            $('.top-mobile').attr('src', '/assets/no_preview.png');
        }
    }

    function change_framework()
    {
        var technologty_pre = $("#technologty_pre").val();
        // console.log(technologty_pre);
        $.ajax({
            type:"GET",
            url:"/getframework",
            data:"technologty_pre="+technologty_pre,
            success: function(data) {
                console.log("data",data);
                var options = '<option value=""></option>';
                $.each( data, function( key, value ) {
                    options += "<option value='"+value['technology_id']+"'>"+value['technology_name']+"</option>";
                });
                //console.log(options);
                $('#framework').html(options);
            },
            error: function(xhr, status, error) {
                console.log("error: ",error);
            },
        });
    }

    function change_framework_project(id)
    {
        var technologty_pre = $("#technologty_pre_multi_"+id).val();
        // console.log(technologty_pre);
        $.ajax({
            type:"GET",
            url:"/getframework",
            data:"technologty_pre="+technologty_pre,
            success: function(data) {
                console.log("data",data);
                var options = '';
                $.each( data, function( key, value ) {
                    options += "<option value='"+value['technology_id']+"'>"+value['technology_name']+"</option>";
                });
                //console.log(options);
                $('#framework_multi_'+id).html(options);
            },
            error: function(xhr, status, error) {
                console.log("error: ",error);
            },
        });
    }


	function change_duplicate_framework()
    {
        var technologty_pre = $("#duplicate_technologty_pre").val();
        // console.log(technologty_pre);
		alert(technologty_pre);
        $.ajax({
            type:"GET",
            url:"/getframework",
            data:"technologty_pre="+technologty_pre,
            success: function(data) {
                console.log("data",data);
                var options = '<option value=""></option>';
                $.each( data, function( key, value ) {
                    options += "<option value='"+value['technology_id']+"'>"+value['technology_name']+"</option>";
                });
                //console.log(options);
                $('#duplicate_framework').html(options);
            },
            error: function(xhr, status, error) {
                console.log("error: ",error);
            },
        });
    }
    /*$(window).scroll(function(){
	    if ($(window).scrollTop() >= 150) {
	        $('#sidebarNav').addClass('fixed-topscroll');
	    }
	    else {
	        $('#sidebarNav').removeClass('fixed-topscroll');
	    }
	});*/
</script>

<!--global js end-->
@stop
