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
        <div class="container space-2">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 pr-0">
                    <div id="notific">
                        @include('notifications')
                    </div>
                    <div class="advance-search singup-body login-body">
                        <form action="{{ url('/talent-search') }}" method="post" id="hireTalentForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="px-3 py-2">
                                	<h4 class="card-header text-left">Looking For</h4>
                                	<div class="form-group basic-info my-3">
					                    <!-- <label><span>Looking For</span></label> -->
					                    <!-- <br> -->
					                    <div class="form-check form-check-inline">
					                        <div class="custom-control custom-radio">
					                            <input type="radio" id="Freelance" class="custom-control-input" name="lookingfor" onchange="changeLookingFor()" value="2" checked>
					                            <label class="custom-control-label" for="Freelance">Freelance Projects</label>
					                        </div>
					                    </div>
					                    <div class="form-check form-check-inline">
					                        <div class="custom-control custom-radio">
					                            <input type="radio" id="Contractual" class="custom-control-input" name="lookingfor" onchange="changeLookingFor()" value="1">
					                            <label class="custom-control-label" for="Contractual">Contractual Staffing</label>
					                        </div>
					                    </div>
					                </div>

					                <div class="projects">
					                	<div class="form-group">
                                            <label>Category</label>
                                            <select name="project_category" class="form-control">
                                                @foreach ($projectcategorys as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
					                	<div class="form-group job-posting d-none">
	                                        <label>Project Duration</label>
	                                        <div class="form-row">
	                                            <div class="col">
	                                                <select class="form-control" name="dur_minimum">
	                                                    <option value="">Minimum</option>
	                                                    @for ($i = 0; $i < 21; $i++)
	                                                    <option value="{{ $i }}">{{ $i }}</option>
	                                                    @endfor
	                                                </select>
	                                            </div>
	                                            <div class="col">
	                                                <select class="form-control" name="dur_maximum">
	                                                    <option value="">Maximum</option>
	                                                    @for ($i = 1; $i < 21; $i++)
	                                                    <option value="{{ $i }}">{{ $i }}</option>
	                                                    @endfor
	                                                </select>
	                                            </div>
	                                        </div>
	                                    </div>
					                </div>
					                <div class="contractual d-none">
						                <div class="form-group">
				                            <label>Key Skills</label>
				                            <input type="text" name="key_skills" class="form-control" />
				                        </div>
						                <div class="form-group">
	                                        <label>Experience</label>
	                                        <div class="form-row">
				                                <div class="col">
				                                    <select class="form-control" required="" name="experience_year">
				                                        @for ($i = 0; $i < 21; $i++)
				                                        <option value="{{ $i }}">{{ $i }} Years</option>
				                                        @endfor
				                                    </select>
				                                </div>
				                                <div class="col">
				                                    <select class="form-control" required="" name="experience_month">
				                                        @for ($i = 1; $i < 13; $i++)
				                                        <option value="{{ $i }}">{{ $i }} Months</option>
				                                        @endfor
				                                    </select>
				                                </div>
				                            </div>
	                                    </div>
	                                    <div class="form-group job-posting d-none">
	                                        <label>Job Location</label>
	                                        <select name="current_location" class="form-control">
	                                            <option value=""></option>
	                                            @foreach ($locations as $location)
                                                <option value="{{ $location->location_id }}" >{{ $location->name }}</option>
                                                @endforeach
	                                        </select>
	                                    </div>
					                </div>
                                    <div class="basic-info mb-3 ">
                                        <label>Search Method</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="development" class="custom-control-input" name="search_method" onchange="changeSearchMethod()" value="2" checked="">
                                                <label class="custom-control-label" for="development">Database Search</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="support" class="custom-control-input" name="search_method" onchange="changeSearchMethod()" value="1">
                                                <label class="custom-control-label" for="support">Job Posting</label>
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
                <div class="col-lg-7 col-md-7 col-sm-7 col-12">
                	<div class="projects">
                		<img src="/assets/img/profile/hire-right.png" class="img-fluid" alt="">
                	</div>
                	<div class="border bg-img-hero right-colume d-none" style="background: linear-gradient(to left, rgb(0 0 0 / 0%), rgb(0 0 0 / 0.65)), url(/assets/img/others/hire-talent.png);">
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
									                        <img class="img-fluid" src="/assets/img/photo/client1.png">
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
								                              	<span class="d-block mr-3 text-white">2 Digital</span>
								                            </div>
									                    </div>
									                </div>
	        									</div>
	        									<div class="col-md-5">
	        										<div class="crowd_favrt">
									                    <div class="servicesimg">
									                        <img class="img-fluid" src="/assets/img/photo/client2.jpg">
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
								                              	<span class="d-block mr-3 text-white">2 Software Developer</span>
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
                	<div class="contractual padding-c d-none">
                		<img src="/assets/img/profile/hire-right-2.png" class="img-fluid" alt="">
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
<script>
    $(window).bind("load", function() {
        changeLookingFor();
        changeSearchMethod();
    });
    function changeSearchMethod() {
        var method = $('input[name="search_method"]:checked').attr('value');
        if (method == '1') {
            $('.job-posting').removeClass("d-none");
        } else {
        	$('.job-posting').addClass("d-none");
        }
    }
	function changeLookingFor() {
        // var anonymous = e.target.value;
        var anonymous = $('input[name="lookingfor"]:checked').attr('value');
        // console.log(anonymous);
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
</script>
<!--global js end-->
@stop
