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
                                	<h4 class="card-header text-left">Looking For </h4>
                                	<div class="form-group basic-info my-3">
					                    <!-- <label><span>Looking For</span></label> -->
					                    <!-- <br> -->
					                    <div class="form-check form-check-inline">
					                        <div class="custom-control custom-radio">
					                            <input type="radio" id="Freelance" class="custom-control-input" name="lookingfor" onchange="changeLookingFor()" value="2" checked>
					                            <label class="custom-control-label" for="Freelance">Freelancer</label>
					                        </div>
					                    </div>
					                    <div class="form-check form-check-inline">
					                        <div class="custom-control custom-radio">
					                            <input type="radio" id="Contractual" class="custom-control-input" name="lookingfor" onchange="changeLookingFor()" value="1">
					                            <label class="custom-control-label" for="Contractual">Contractual Employer</label>
					                        </div>
					                    </div>
					                </div>

					                <div class="projects">
					                	<div class="form-group">
                                            <label>Project Category </label>
                                            <select name="project_category" class="form-control" id="project_category" onchange="change_category();">
                                                @foreach ($projectcategorys as $category)
                                                <option value="{{ $category->id }}"  {{ (Session::get('projectcategory')['id']==$category->id)? "selected" : "" }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group" id="project_sub">
                                            <label>Project Sub Category</label>
                                            <select name="project_sub_category" class="form-control" id="project_sub_category">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- for r per rate -->
                                    <div class="form-group d-none" id="rate">
                                        <label>Rate per Hour</label>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="number"  name="rate_hour_min" class="form-control" placeholder="Min">
                                            </div>
                                            <div class="col">
                                                <input type="number"  name="rate_hour_max" class="form-control" placeholder="Max">
                                            </div>
                                        </div> 
                                            
                                    </div>
                                    <!-- for duration field -->
                                    <div class="form-group d-none" id="duration_field">
                                        <label>Project Duration</label>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="number" class="form-control" name="duration_min" placeholder="Min">
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" name="duration_max" placeholder="Max">
                                            </div>
                                        </div>
                                            
                                    </div> 

                                    <!-- for Rate per moth field -->
                                    <div class="form-group d-none" id="rate_month">
                                        <label>Rate Per Month</label>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="number" class="form-control" name="rate_month_min" placeholder="Min">
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" name="rate_month_max" placeholder="Max">
                                            </div>
                                        </div>
                                            
                                    </div> 
                                    <!-- for project based field -->
                                    <div class="form-group d-none" id="project_field">
                                        <label>Project Budget</label>
                                         <div class="form-row">
                                            <div class="col">
                                                <input type="number" class="form-control" name="project_budget_min" placeholder=" Min"> 
                                            </div>
                                             <div class="col">
                                                <input type="number" class="form-control" name="project_budget_max" placeholder=" Max"> 
                                            </div>
                                        </div>
                                           
                                    </div>    

                                    <div class="form-group d-none" id="tech">
                                            <label>Technology</label>
                                            <select name="technology" class="form-control" id="tech_">
                                                <option value="">Select Technology</option>
                                                        @foreach ($technologies as $technology)
                                                        <option value="{{ $technology->technology_id }}">{{ $technology->technology_name }}</option>
                                                        @endforeach
                                            </select>
                                    </div>
					                	<div class="form-group job-posting d-none" id="project_duration">
	                                        <label>Project Duration</label>
	                                        <div class="form-row">
	                                            <div class="col">
	                                                <input type="number" placeholder="Min" class="form-control" name="dur_minimum"/>
	                                                 
	                                            </div>
	                                            <div class="col">
	                                                <input type="number" placeholder="Max" class="form-control" name="dur_maximum"/>
	                                                    
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

                                        <p class="m-0 p-0">Mode of engagement at heading of after search method in hire talent page</p>
                                   
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" checked="false" id="development" class="custom-control-input" name="search_method" onchange="changeSearchMethod()" value="2" >
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
                                    
                                    <!-- for database search method -->
                                    <div class="basic-info1 mb-3 mr-3 d-none">
                                        
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="budget" class="custom-control-input" name="db_search" onchange="changeSearchDBMethod()" value="B" checked="false">
                                                <label class="custom-control-label" for="budget">Budget&nbsp;&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="techanology" class="custom-control-input" name="db_search" onchange="changeSearchDBMethod()" value="T">
                                                <label class="custom-control-label" for="techanology">Technology&nbsp;&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="duration" class="custom-control-input" name="db_search" onchange="changeSearchDBMethod()" value="D">
                                                <label class="custom-control-label" for="duration">Duration</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- for job postiin search method -->
                                    <div class="mb-3 mr-3 d-none" id="job_post">
                                        
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="budget1" class="custom-control-input" name="job_post" onchange="changeSearchDBMethod1()" value="B1" checked="false">
                                                <label class="custom-control-label" for="budget1">Budget&nbsp;&nbsp;</label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="duration1" class="custom-control-input" name="job_post" onchange="changeSearchDBMethod1()" value="D1">
                                                <label class="custom-control-label" for="duration1">Duration</label>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- sub budget -->
                                    <div class="mb-3 mr-3" id="sub_budget">
                                        
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="hourly" class="custom-control-input" name="sub_budgets" onchange="changeSubBudget()" value="H" checked="false">
                                                <label class="custom-control-label" for="hourly">Hourly&nbsp;&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="retainer" class="custom-control-input" name="sub_budgets" onchange="changeSubBudget()" value="R">
                                                <label class="custom-control-label" for="retainer">Retainer&nbsp;&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="project_based" class="custom-control-input" name="sub_budgets" onchange="changeSubBudget()" value="P">
                                                <label class="custom-control-label" for="project_based">Project Based</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- job posting budget -->
                                    <div class="mb-3 mr-3 d-none" id="job_budget">
                                        
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="hourly1" class="custom-control-input" name="job_budget" onchange="changeSubBudget1()" value="H1" checked="false">
                                                <label class="custom-control-label" for="hourly1">Hourly&nbsp;&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="retainer1" class="custom-control-input" name="job_budget" onchange="changeSubBudget1()" value="R1">
                                                <label class="custom-control-label" for="retainer1">Retainer&nbsp;&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="project_based1" class="custom-control-input" name="job_budget" onchange="changeSubBudget1()" value="P1">
                                                <label class="custom-control-label" for="project_based1">Project Based</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group text-right mt-5">
                                        <div class="btn-group" role="group">
                                           <button class="btn btn-primary" type="submit"> 
                                            {{-- <button class="btn btn-primary" type="button" onclick="togglePopup()">--}}
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
                		<img src="/assets/img/profile/freelance.png" class="img-fluid" alt="">
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
        changeSearchDBMethod();
        changeSearchDBMethod1();
        change_category();
        changeSubBudget();
        changeSubBudget1();
    });

    function changeSearchDBMethod1() {
        //  
        var method = $('input[name="job_post"]:checked').attr('value');
        if (method == 'B1') {
            $('#project_duration').addClass("d-none");
            $('#job_budget').removeClass("d-none");
            // $('.basic-info1').removeClass("d-none");
            // $('#rate').removeClass("d-none");
            // $('#tech').addClass("d-none");
            // $('#duration_field').addClass("d-none");
            // $('#sub_budget').removeClass("d-none");
            //  $('#rate_month').addClass("d-none");
        
            // $('#rate').addClass("d-none");
            // $('#sub_budget').addClass("d-none");
            // $('#tech').removeClass("d-none");
            // $('#duration_field').addClass("d-none");
            // $('#project_field').addClass("d-none");
            // $('#rate_month').addClass("d-none");
        }
        else if(method=='D1')
        {
            $('#job_budget').addClass("d-none");
            $('#project_duration').removeClass("d-none");
            // alert();
            // $('#rate').addClass("d-none");
            // $('#sub_budget').addClass("d-none");
            // $('#tech').addClass("d-none");
            //  $('#project_field').addClass("d-none");
            // $('#duration_field').removeClass("d-none");
            //  $('#rate_month').addClass("d-none");
        }
        
        else {
            // $('.job-posting').addClass("d-none");
        }
    }
    function changeSubBudget1() {
        //  
        var method = $('input[name="job_budget"]:checked').attr('value');
        
        if (method == 'H1') {
            
            // $('.job-posting').addClass("d-none");
            // $('.basic-info1').removeClass("d-none");
            // alert();
            $('#rate').removeClass("d-none");
            $('#rate').show();
            $('#rate_month').addClass("d-none");
            $('#tech').addClass("d-none");
            $('#duration_field').addClass("d-none");
            $('#project_field').addClass("d-none");

            // $('#job_budget').addClass("d-none");
            // $('#job_post').removeClass("d-none");
            // $('#job_budget').addClass("d-none");
        }
        else if(method=='R1')
        {
            $('#rate_month').removeClass("d-none");
            $('#rate').addClass("d-none");
            // $('#rate_month').removeClass("d-none");
            // $('#sub_budget').addClass("d-none");
            $('#tech').addClass("d-none");
            $('#duration_field').addClass("d-none");
            $('#job_budget').removeClass("d-none");
        }
        else if(method=='P1')
        {
            $('#project_field').removeClass("d-none");
            $('#rate').addClass("d-none");
            $('#project_field').removeClass("d-none");
            $('#tech').addClass("d-none");
            $('#duration_field').addClass("d-none");
            $('#rate_month').addClass("d-none");
            $('#job_budget').removeClass("d-none");
        }
        
        else {
            // $('.job-posting').addClass("d-none");
        }
    }
    // for sub budget
    function changeSubBudget() {
        //  
        var method = $('input[name="sub_budgets"]:checked').attr('value');
        
        if (method == 'H') {
            
            // $('.job-posting').addClass("d-none");
            // $('.basic-info1').removeClass("d-none");
            $('#rate').removeClass("d-none");
            $('#rate_month').addClass("d-none");
            $('#tech').addClass("d-none");
            $('#duration_field').addClass("d-none");
            $('#project_field').addClass("d-none");
            $('#job_budget').addClass("d-none");
            $('#job_post').addClass("d-none");
            // $('#job_budget').addClass("d-none");
        }
        else if(method=='R')
        {
            $('#rate_month').removeClass("d-none");
            $('#rate').addClass("d-none");
            // $('#rate_month').removeClass("d-none");
            // $('#sub_budget').addClass("d-none");
            $('#tech').addClass("d-none");
            $('#duration_field').addClass("d-none");
            $('#job_budget').addClass("d-none");
            $('#job_post').addClass("d-none");
            // $('#job_budget').addClass("d-none");
        }
        else if(method=='P')
        {
            $('#project_field').removeClass("d-none");
            $('#rate').addClass("d-none");
            $('#project_field').removeClass("d-none");
            $('#tech').addClass("d-none");
            $('#duration_field').addClass("d-none");
            $('#rate_month').addClass("d-none");
            // $('#job_budget').addClass("d-none");
            $('#job_post').addClass("d-none");
            $('#job_budget').addClass("d-none");
        }
        
        else {
            // $('.job-posting').addClass("d-none");
        }
    }
    function changeSearchMethod() {
        var method = $('input[name="search_method"]:checked').attr('value');
        if (method == '1') {
            $('.job-posting').addClass("d-none");
            $('.basic-info1').addClass("d-none");
            $('#rate').addClass("d-none");
        	$('#tech').addClass("d-none");
            $('#duration_field').addClass("d-none");
            $('#sub_budget').addClass("d-none");
            $('#rate').addClass("d-none");
            $('#rate_month').addClass("d-none");
             $('#project_field').addClass("d-none");
             $('#job_post').removeClass("d-none");
             $('#job_budget').removeClass("d-none");
             
             
        } 
        else if(method =='2')
        {
        	$('.job-posting').addClass("d-none");
        	$('.basic-info1').removeClass("d-none");
            // $('#job_budget').addClass("d-none");
            $('#job_post').addClass("d-none");
            $('#job_budget').addClass("d-none");
        }
        else {
        	$('.job-posting').addClass("d-none");
        }
    }
    function changeSearchDBMethod() {
        //  
        var method = $('input[name="db_search"]:checked').attr('value');
        if (method == 'B') {
            $('.job-posting').addClass("d-none");
            $('.basic-info1').removeClass("d-none");
            $('#rate').removeClass("d-none");
        	$('#tech').addClass("d-none");
            $('#duration_field').addClass("d-none");
            $('#sub_budget').removeClass("d-none");
             $('#rate_month').addClass("d-none");
        }
        else if(method=='T')
        {
        	$('#rate').addClass("d-none");
            $('#sub_budget').addClass("d-none");
        	$('#tech').removeClass("d-none");
            $('#duration_field').addClass("d-none");
            $('#project_field').addClass("d-none");
            $('#rate_month').addClass("d-none");
        }
        else if(method=='D')
        {
            $('#rate').addClass("d-none");
            $('#sub_budget').addClass("d-none");
            $('#tech').addClass("d-none");
             $('#project_field').addClass("d-none");
            $('#duration_field').removeClass("d-none");
             $('#rate_month').addClass("d-none");
        }
        
        else {
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
