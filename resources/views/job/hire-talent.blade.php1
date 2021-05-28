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
                                            <label>Project Category</label>
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

                                        <div class="basic-info mb-3 ">
                                            <label>Search Method</label>                                   
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

                                        <div class="basic-info mb-3 freelancer_datasase_browse_project d-none">
                                            <label>Browse Project By</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="budget" class="custom-control-input" name="browse_project" onchange="changeBrowseProject()" value="1">
                                                    <label class="custom-control-label" for="budget">Budget</label>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="technology" class="custom-control-input" name="browse_project" onchange="changeBrowseProject()" value="2">
                                                    <label class="custom-control-label" for="technology">Technology</label>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="duration" class="custom-control-input" name="browse_project" onchange="changeBrowseProject()" value="3">
                                                    <label class="custom-control-label" for="duration">Duration</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="basic-info mb-3 freelancer_jobposting_browse_project d-none">
                                            <label>Browse Project By</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="job_budget" class="custom-control-input" name="job_browse_project" onchange="jobPostChangeBrowseProject()" value="1" checked="">
                                                    <label class="custom-control-label" for="job_budget">Budget</label>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="job_duration" class="custom-control-input" name="job_browse_project" onchange="jobPostChangeBrowseProject()" value="2">
                                                    <label class="custom-control-label" for="job_duration">Duration</label>
                                                </div>
                                            </div>
                                        </div>
                                        
					                	<div class="form-group project-budget d-none">
                                            <div class="basic-info mb-3">
                                               <label>Mode Of Engagement</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="hourly" class="custom-control-input" name="model_engagement" onchange="changeBrowseProjectType();" value="1">
                                                        <label class="custom-control-label" for="hourly">Hourly</label>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="retainer" class="custom-control-input" name="model_engagement" onchange="changeBrowseProjectType();" value="2">
                                                        <label class="custom-control-label" for="retainer">Retainership</label>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="project_based" class="custom-control-input" name="model_engagement" onchange="changeBrowseProjectType();" value="3">
                                                        <label class="custom-control-label" for="project_based">Project-based</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group hourly11 d-none">
                                                <label>Rate Per Hour</label>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="number" placeholder="Min" class="form-control" name="hourly_minimum">
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" placeholder="Max" class="form-control" name="hourly_maximum">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group retainer11 d-none">
                                                <label>Rate Per Month</label>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="number" placeholder="Min" class="form-control" name="retainer_minimum">
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" placeholder="Max" class="form-control" name="retainer_maximum">
                                                    </div>
                                                </div>
                                            </div>
	                                        
	                                        <div class="form-group project-based11 d-none">
                                                <label>Project Budget</label>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="number" placeholder="Min" class="form-control" name="project_based_minimum">
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" placeholder="Max" class="form-control" name="project_based_maximum">
                                                    </div>
	                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group project-technology d-none">
	                                        <label>Technology Preference</label>
	                                        <div class="form-row">
                                                <div class="form-group col">
                                                    {{-- <label>Technology Preference</label> --}}
                                                    <select name="technologty_pre" class="form-control" id="technologty_pre" onchange="change_framework();">
                                                        <option value="">Select Technology</option>
                                                        @foreach ($technologies as $technology)
                                                        <option value="{{ $technology->technology_id }}">{{ $technology->technology_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{--  <div class="form-group col">
                                                    <label>Framework</label> 
                                                    <select class="form-control" name="framework" id="framework">
                                                        <option value="">Select Framework</option>
                                                    </select>
                                                </div>--}}
	                                        </div>
                                        </div>
                                        <div class="form-group project-duration d-none">
	                                        <label>Project Duration</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="number" placeholder="Min" class="form-control" name="project_duration_min"/>
                                                </div>
                                                <div class="col">
                                                    <input type="number" placeholder="Max" class="form-control" name="project_duration_max"/>
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
				                                    <select class="form-control" name="experience_year" id="experience_year" onchange="toExperience();">
				                                        @for ($i = 0; $i < 21; $i++)
				                                        <option value="{{ $i }}">{{ $i }} Years</option>
				                                        @endfor
				                                    </select>
				                                </div>
				                                <div class="col">
				                                    <select class="form-control" name="experience_month" id="experience_to_year">
				                                        @for ($i = 1; $i < 21; $i++)
				                                        <option value="{{ $i }}">{{ $i }} Years</option>
				                                        @endfor
				                                    </select>
				                                </div>
				                            </div>
	                                    </div>
                                        <div class="form-group">
	                                        <label>Job Location</label>
	                                        <select name="location" class="form-control">
	                                            <option value=""></option>
	                                            @foreach ($locations as $location)
                                                <option value="{{ $location->location_id }}" >{{ $location->name }}</option>
                                                @endforeach
	                                        </select>
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

                                        <div class="basic-info mb-3 ">
                                            <label>Search Method</label>                                   
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" checked="false" id="contractual_development" class="custom-control-input" name="contractual_search_method" onchange="contractualChangeSearchMethod()" value="2" >
                                                    <label class="custom-control-label" for="contractual_development">Database Search</label>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="contractual_support" class="custom-control-input" name="contractual_search_method" onchange="contractualChangeSearchMethod()" value="1">
                                                    <label class="custom-control-label" for="contractual_support">Job Posting</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="basic-info mb-3 contractual_datasase_browse_project d-none">
                                            <label>Browse Project By</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="contractual_budget" class="custom-control-input" name="browse_project" onchange="contractualChangeBrowseProject()" value="1">
                                                    <label class="custom-control-label" for="contractual_budget">Budget</label>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="contractual_technology" class="custom-control-input" name="browse_project" onchange="contractualChangeBrowseProject()" value="2">
                                                    <label class="custom-control-label" for="contractual_technology">Technology</label>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="contractual_duration" class="custom-control-input" name="browse_project" onchange="contractualChangeBrowseProject()" value="3">
                                                    <label class="custom-control-label" for="contractual_duration">Duration</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group contractual-project-budget d-none">
                                            <div class="basic-info mb-3">
                                               <label>Mode Of Engagement</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="contractual_hourly" class="custom-control-input" name="contractual_model_engagement" onchange="contractualChangeBrowseProjectType();" value="1">
                                                        <label class="custom-control-label" for="contractual_hourly">Hourly</label>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="contractual_retainer" class="custom-control-input" name="contractual_model_engagement" onchange="contractualChangeBrowseProjectType();" value="2">
                                                        <label class="custom-control-label" for="contractual_retainer">Retainership</label>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="contractual_project_based" class="custom-control-input" name="contractual_model_engagement" onchange="contractualChangeBrowseProjectType();" value="3">
                                                        <label class="custom-control-label" for="contractual_project_based">Project-based</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group hourly11 d-none">
                                                <label>Rate Per Hour</label>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="number" placeholder="Min" class="form-control" name="contractual_hourly_minimum"/>
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" placeholder="Max" class="form-control" name="contractual_hourly_maximum"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group retainer11 d-none">
                                                <label>Rate Per Month</label>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="number" placeholder="Min" class="form-control" name="contractual_retainer_minimum"/>
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" placeholder="Max" class="form-control" name="contractual_retainer_maximum"/>
                                                    </div>
                                                </div>
                                            </div>
	                                        
	                                        <div class="form-group project-based11 d-none">
                                                <label>Project Budget</label>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="number" placeholder="Min" class="form-control" name="contractual_project_based_minimum"/>
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" placeholder="Max" class="form-control" name="contractual_project_based_maximum"/>
                                                    </div>
	                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group contractual-project-technology d-none">
	                                        <label>Technology Preference</label>
	                                        <div class="form-row">
                                                <div class="form-group col">
                                                    {{-- <label>Technology Preference</label> --}}
                                                    <select name="technologty_pre" class="form-control" id="technologty_pre" onchange="change_framework();">
                                                        <option value="">Select Technology</option>
                                                        @foreach ($technologies as $technology)
                                                        <option value="{{ $technology->technology_id }}">{{ $technology->technology_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{--  <div class="form-group col">
                                                    <label>Framework</label> 
                                                    <select class="form-control" name="framework" id="framework">
                                                        <option value="">Select Framework</option>
                                                    </select>
                                                </div>--}}
	                                        </div>
                                        </div>
                                        <div class="form-group contractual-project-duration d-none">
	                                        <label>Project Duration</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="number" placeholder="Min" class="form-control" name="project_duration_min"/>
                                                </div>
                                                <div class="col">
                                                    <input type="number" placeholder="Max" class="form-control" name="project_duration_max"/>
                                                </div>
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
                		<!-- <img src="/assets/img/profile/hire-right-2.png" class="img-fluid" alt=""> -->
                        <img src="/assets/img/profile/staffing.png" class="img-fluid" alt="">
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
        changeBrowseProjectType();
        contractualChangeSearchMethod();
        contractualChangeBrowseProject();
        changeBrowseProject();
        jobPostChangeBrowseProject();
        change_category();
        changeSearchMethod();
        contractualChangeBrowseProjectType();
    });

    function changeSearchMethod() {
        var method = $('input[name="search_method"]:checked').attr('value');
        if (method == '1') {
            $('.freelancer_jobposting_browse_project').removeClass("d-none");
            $('.freelancer_datasase_browse_project').addClass("d-none"); 
            document.getElementById("hourly").checked = false;
            document.getElementById("retainer").checked = false;
            document.getElementById("project_based").checked = false;
            document.getElementById("job_budget").checked = false;
            document.getElementById("job_duration").checked = false;
            $('.project-budget').hide();
            $('.project-technology').hide();
            $('.project-duration').hide();
            $('.hourly11').hide();
            $('.retainer11').hide();
            $('.project-based11').hide();
        } 
        else if(method =='2')
        {
        	$('.freelancer_datasase_browse_project').removeClass("d-none");
            $('.freelancer_jobposting_browse_project').addClass("d-none");
            document.getElementById("hourly").checked = false;
            document.getElementById("retainer").checked = false;
            document.getElementById("project_based").checked = false;
            document.getElementById("budget").checked = false;
            document.getElementById("technology").checked = false;
            document.getElementById("duration").checked = false;
            $('.project-budget').hide();
            $('.project-technology').hide();
            $('.project-duration').hide();
            $('.hourly11').hide();
            $('.retainer11').hide();
            $('.project-based11').hide();
        }
    }

    function changeBrowseProject() {
        var method = $('input[name="browse_project"]:checked').attr('value');
        if (method == '1') {
            $('.project-budget').removeClass("d-none");
            $('.project-technology').addClass("d-none");
            $('.project-duration').addClass("d-none");
            $('.project-budget').show();
            $('.project-based11').hide();
        } else if(method == '2') {
            $('.project-technology').removeClass("d-none");
            $('.project-budget').addClass("d-none");
            $('.project-duration').addClass("d-none");
            $('.project-technology').show();
            document.getElementById("hourly").checked = false;
            document.getElementById("retainer").checked = false;
            document.getElementById("project_based").checked = false;
            $('.hourly11').hide();
            $('.retainer11').hide();
            $('.project-based11').hide();
        } else {
            $('.project-duration').removeClass("d-none");
            $('.project-budget').addClass("d-none");
            $('.project-technology').addClass("d-none");
            $('.project-duration').show();
            document.getElementById("hourly").checked = false;
            document.getElementById("retainer").checked = false;
            document.getElementById("project_based").checked = false;
            $('.hourly11').hide();
            $('.retainer11').hide();
            $('.project-based11').hide();
        }
    }

    function jobPostChangeBrowseProject() {
        var method = $('input[name="job_browse_project"]:checked').attr('value');
        if (method == '1') {
            $('.project-budget').removeClass("d-none");
            $('.project-duration').addClass("d-none");
            $('.project-budget').show();
        } else {
            $('.project-duration').removeClass("d-none");
            $('.project-budget').addClass("d-none");
            $('.project-duration').show();
            document.getElementById("hourly").checked = false;
            document.getElementById("retainer").checked = false;
            document.getElementById("project_based").checked = false;
            $('.hourly11').hide();
            $('.retainer11').hide();
            $('.project-based11').hide();
        }
    }

    function changeBrowseProjectType() {
        // var anonymous = e.target.value;
        var method = $('input[name="model_engagement"]:checked').attr('value');
        // console.log(anonymous);
        if (method == '1') {
            $('.hourly11').removeClass("d-none");
            $('.retainer11').addClass("d-none");
            $('.project-based11').addClass("d-none");
            $('.hourly11').show();
        }else if (method == '2') {
            $('.hourly11').addClass("d-none");
            $('.retainer11').removeClass("d-none");
            $('.project-based11').addClass("d-none");
            $('.retainer11').show();
        }
        else {
        	$('.hourly11').addClass("d-none");
            $('.retainer11').addClass("d-none");
            $('.project-based11').removeClass("d-none");
            $('.project-based11').show();
        }
    }

	function changeLookingFor() {
        // var anonymous = e.target.value;
        var anonymous = $('input[name="lookingfor"]:checked').attr('value');
        // console.log(anonymous);
        if (anonymous == '1') {
            $('.contractual').removeClass("d-none");
            $('.projects').addClass("d-none");
            $('.contractual-project-duration').hide();
        } else {
        	$('.contractual').addClass("d-none");
            $('.projects').removeClass("d-none");
        }
    }


    function contractualChangeSearchMethod() {
        var method = $('input[name="contractual_search_method"]:checked').attr('value');
        if (method == '1') {
            //$('.contractual_jobposting_browse_project').removeClass("d-none");
            $('.contractual_datasase_browse_project').addClass("d-none"); 
            document.getElementById("contractual_hourly").checked = false;
            document.getElementById("contractual_retainer").checked = false;
            document.getElementById("contractual_project_based").checked = false;
            //document.getElementById("job_budget").checked = false;
            //document.getElementById("job_duration").checked = false;
            $('.contractual-project-budget').hide();
            $('.contractual-project-technology').hide();
            $('.contractual-project-duration').hide();
            $('.hourly11').hide();
            $('.retainer11').hide();
            $('.project-based11').hide();
        } 
        else if(method =='2')
        {
        	$('.contractual_datasase_browse_project').removeClass("d-none");
            $('.contractual_jobposting_browse_project').addClass("d-none");
            document.getElementById("contractual_hourly").checked = false;
            document.getElementById("contractual_retainer").checked = false;
            document.getElementById("contractual_project_based").checked = false;
            document.getElementById("contractual_budget").checked = false;
            document.getElementById("contractual_technology").checked = false;
            document.getElementById("contractual_duration").checked = false;
            $('.contractual-project-budget').hide();
            $('.contractual-project-technology').hide();
            $('.contractual-project-duration').hide();
            $('.hourly11').hide();
            $('.retainer11').hide();
            $('.project-based11').hide();
        }
    }

    function contractualChangeBrowseProject() {
        var method = $('input[name="browse_project"]:checked').attr('value');
        if (method == '1') {
            $('.contractual-project-budget').removeClass("d-none");
            $('.contractual-project-technology').addClass("d-none");
            $('.contractual-project-duration').addClass("d-none");
            $('.contractual-project-budget').show();
            
        } else if(method == '2') {
            $('.contractual-project-technology').removeClass("d-none");
            $('.contractual-project-budget').addClass("d-none");
            $('.contractual-project-duration').addClass("d-none");
            $('.contractual-project-technology').show();
            document.getElementById("contractual_hourly").checked = false;
            document.getElementById("contractual_retainer").checked = false;
            document.getElementById("contractual_project_based").checked = false;
            $('.hourly11').hide();
            $('.retainer11').hide();
            $('.project-based11').hide();
        } else {
            $('.contractual-project-duration').removeClass("d-none");
            $('.contractual-project-budget').addClass("d-none");
            $('.contractual-project-technology').addClass("d-none");
            $('.contractual-project-duration').show();
            document.getElementById("contractual_hourly").checked = false;
            document.getElementById("contractual_retainer").checked = false;
            document.getElementById("contractual_project_based").checked = false;
            $('.hourly11').hide();
            $('.retainer11').hide();
            $('.project-based11').hide();
        }
    }

    function contractualChangeBrowseProjectType() {
        // var anonymous = e.target.value;
        var method = $('input[name="contractual_model_engagement"]:checked').attr('value');
        // console.log(anonymous);
        if (method == '1') {
            $('.hourly11').removeClass("d-none");
            $('.retainer11').addClass("d-none");
            $('.project-based11').addClass("d-none");
            $('.hourly11').show();
        }else if (method == '2') {
            $('.hourly11').addClass("d-none");
            $('.retainer11').removeClass("d-none");
            $('.project-based11').addClass("d-none");
            $('.retainer11').show();
        }
        else {
        	$('.hourly11').addClass("d-none");
            $('.retainer11').addClass("d-none");
            $('.project-based11').removeClass("d-none");
            $('.project-based11').show();
        }
    }
</script>
<!--global js end-->
@stop
