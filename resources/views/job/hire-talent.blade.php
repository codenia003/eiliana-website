@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ $pagename['page_title'] }}
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick-carousel/slick.css') }}">
<!--end of page level css-->
@stop
{{-- breadcrumb --}}
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">{{ $pagename['page_title'] }}</span>
        </div>
    </div>
</div>
@stop
{{-- content --}}
@section('content')
<div class="hire-talent">
	<div class="shadow1">   
        <div class="container-fluid space-2">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 pr-0">
                    <div id="notific">
                        @include('notifications')
                    </div>
                    <div class="advance-search singup-body login-body">
                        <form action="{{ url('/talent-search') }}" method="post" id="postJobForm" enctype="multipart/form-data">
                            {{-- @csrf --}}
                            <div class="card">
                                <div class="p-4">
                                	<div class="form-group basic-info">
					                    <label><span>Looking For</span></label>
					                    <hr>
					                    <div class="form-check form-check-inline">
					                        <div class="custom-control custom-radio">
					                            <input type="radio" id="Freelance" class="custom-control-input" name="lookingfor" onchange="changeLookingFor(event)" value="2">
					                            <label class="custom-control-label" for="Freelance">Freelance Projects</label>
					                        </div>
					                    </div>
					                    <div class="form-check form-check-inline">
					                        <div class="custom-control custom-radio">
					                            <input type="radio" id="Contractual" class="custom-control-input" name="lookingfor" onchange="changeLookingFor(event)" value="1">
					                            <label class="custom-control-label" for="Contractual">Contractual Staffing</label>
					                        </div>
					                    </div>
					                </div>
                                    <div class="form-group text-right mt-5">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary" type="submit">
                                               Search >>>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                	<div class="border bg-img-hero right-colume" style="background: linear-gradient(to left, rgb(0 0 0 / 0%), rgb(0 0 0 / 0.65)), url(/assets/img/others/hire-talent.png);">
        				<div class="row no-gutters">
        					<div class="col-md-4">
        						<div class="left-side h-100">
        							<div class="logo d-none">
        								<a class="logo-brand" href="/"><img src="/assets/img/logo.png"></a>
        							</div>
        							<div class="content">
        								<h2>UI/UX</h2>
        								<h4>Consultant</h4>
        								<p>4.5 Yrs Experience, India</p>
        							</div>
        				
        						</div>
        					</div>
        					<div class="col-md-8">
        						<div class="right-side">
        							<div class="list-menu">
        								<ul class="list-inline mb-2">
					                        <li>
					                            <a class="nav-link active" href="#">Post a Job</a>
					                        </li>
					                        <li>
					                            <a class="nav-link" href="#">Login</a>
					                        </li>
					                        <li>
					                            <a class="nav-link" href="#">Sing Up</a>
					                        </li>
					                        <li>
					                            <a class="nav-link" href="#">Help</a>
					                        </li>
					                        <li>
					                            <a class="nav-link" href="#"><i class="fas fa-bars"></i></a>
					                        </li>
					                    </ul>
        							</div>
        							<div class="content">
        								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tempor, nulla sagittis tempu liquetnunc.</p>
        								<div class="banner_custom banner_custom_services">
        									<div class="row">
	        									<div class="col-md-5 offset-sm-1">
	        										<div class="crowd_favrt">
									                    <div class="servicesimg">
									                        <img class="img-fluid bg-red" src="/assets/img/profile/hire-2.png">
									                        <div class="media align-items-center mb-0 mt-2">
								                              	<span class="d-block font-size-1 mr-3 text-white">Lorem Ipsum</span>
								                              	<div class="media-body text-right">
								                                	<span class="text-white font-weight-bold">
								                                		<i class="fas fa-star"></i>
								                                		<i class="fas fa-star"></i>
								                                		<i class="fas fa-star"></i>
								                                		<i class="fas fa-star"></i>
								                                		<i class="fas fa-star"></i>
								                                	</span>
								                              	</div>
								                            </div>
								                            <div class="media align-items-center mb-3">
								                              	<span class="d-block mr-3 text-white">Digital</span>
								                            </div>
									                    </div>
									                </div>
	        									</div>
	        									<div class="col-md-5">
	        										<div class="crowd_favrt">
									                    <div class="servicesimg">
									                        <img class="img-fluid bg-pink" src="/assets/img/profile/hire-1.png">
									                        <div class="media align-items-center mb-0 mt-2">
								                              	<span class="d-block font-size-1 mr-3 text-white">Lorem Ipsum</span>
								                              	<div class="media-body text-right">
								                                	<span class="text-white font-weight-bold">
								                                		<i class="fas fa-star"></i>
								                                		<i class="fas fa-star"></i>
								                                		<i class="fas fa-star"></i>
								                                		<i class="fas fa-star"></i>
								                                		<i class="fas fa-star"></i>
								                                	</span>
								                              	</div>
								                            </div>
								                            <div class="media align-items-center mb-3">
								                              	<span class="d-block mr-3 text-white">Software Developer</span>
								                            </div>
									                    </div>
									                </div>
	        									</div>
	        								</div>	
        								</div>
        							</div>
        						</div>
        					</div>
        				</div>
                	</div>
                	<div class="contractual d-none">
                		<div class="slider4">
					        <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-hirec.png);background-size: contain;border: 1px solid #e5e5e5;">
					          	<div class="list-menu">
    								<ul class="list-inline mb-2">
				                        <li>
				                            <a class="nav-link active" href="#">Post a Job</a>
				                        </li>
				                        <li>
				                            <a class="nav-link" href="#">Login</a>
				                        </li>
				                        <li>
				                            <a class="nav-link" href="#">Sing Up</a>
				                        </li>
				                        <li>
				                            <a class="nav-link" href="#">Help</a>
				                        </li>
				                        <li>
				                            <a class="nav-link" href="#"><i class="fas fa-bars"></i></a>
				                        </li>
				                    </ul>
    							</div>
					          	<div class="w-md-65 w-lg-35">
				                  	<div class="mb-4">
				                      	<div class="contractual_content">
				                        	<h2>Transforming lives Through</h2>
				                        	<h3>next Generation</h3>
				                        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tempor, nulla sagittis tempu liquetnunc.</p>
				                        	<div class="group_button">
							                    <a class="big_btn_shadow yellow-linear-gradient text-white" href="#">Download Cv</a>
							                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#">Hire Me</a>
							                </div>
				                      	</div>
				                  	</div>
				              	</div>
				              	<div class="row">
								    <div class="col-md-3 offset-md-1">
								    	<h4>UI/UX Designer</h4>
								        <span>Creative website for you</span>
								    </div>
								    <div class="col-md-3">
								        <h4>Photographer</h4>
								        <span>Awesome photo & video.</span>
								    </div>
								    <div class="col-md-3">
								       <h4>Freelancer</h4>
								       <span>Hire me now</span>
								    </div>
								</div>
					        </div>
					    </div>
                	</div>
                	<div class="projects d-none">
	                	<div class="basic-info mb-3 ">
                            <label>Type of Project</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="support" class="custom-control-input" name="top" value="1" checked="">
                                    <label class="custom-control-label" for="support">Support</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="development" class="custom-control-input" name="top" value="2">
                                    <label class="custom-control-label" for="development">Development</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="both" class="custom-control-input" name="top" value="3">
                                    <label class="custom-control-label" for="both">Support Cum Development</label>
                                </div>
                            </div>
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
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/slick-carousel/slick.min.js') }}"></script>
<script>

	function changeLookingFor(e) {
        var anonymous = e.target.value;
        console.log(anonymous);
        if (anonymous == '1') {
            $('.contractual').removeClass("d-none");
            $('.projects').addClass("d-none");
            $('.right-colume').addClass("d-none");
        } else {
        	$('.contractual').addClass("d-none");
        	$('.right-colume').addClass("d-none");
            $('.projects').removeClass("d-none");
        }
    }
    $(document).ready(function() {
	    $('.multiple-carousel').slick({
	        "slidesToShow": 2,
	        "slidesToScroll": 2,
	        "nextArrow": "<span class=\"fa fa-angle-right slick-arrow slick-arrow-soft-white slick-arrow-right slick-arrow-centered-y rounded-circle mr-sm-2 mr-xl-4\"></span>",
	        "prevArrow": "<span class=\"fa fa-angle-left slick-arrow slick-arrow-soft-white slick-arrow-left slick-arrow-centered-y rounded-circle ml-sm-2 ml-xl-4\"></span>",
	        "dots": false,
	        "infinite": true,
	        "responsive": [{
	            "breakpoint": 768,
	            "settings": {
	                "slidesToShow": 1,
	                "arrows": false
	             }
	        }]
	    });
    });
</script>
<!--global js end-->
@stop