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
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 pr-lg-0 space-2">
                    <div id="notific">
                        @include('notifications')
                    </div>
                    <div class="advance-search singup-body login-body">
                        <form action="{{ url('/search-project') }}" method="get" id="hireTalentForm" enctype="multipart/form-data">
                            {{-- @csrf --}}
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
					                            <label class="custom-control-label" for="Contractual">Contractual Job</label>
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
                                            <label>Browse Project By</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="budget" class="custom-control-input" name="browse_project" onchange="changeBrowseProject()" value="1" checked="">
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
					                	<div class="form-group project-budget d-none">
	                                        <label>Project Budget</label>
	                                        <div class="form-row">
	                                            <div class="col">
	                                                <select class="form-control" name="dur_minimum">
	                                                    <option value="">Minimum</option>
	                                                    @for ($i = 0; $i < 21; $i++)
	                                                    <option value="{{ $i }}">{{ $i }} Lakh</option>
	                                                    @endfor
	                                                </select>
	                                            </div>
	                                            <div class="col">
	                                                <select class="form-control" name="dur_maximum">
	                                                    <option value="">Maximum</option>
	                                                    @for ($i = 1; $i < 21; $i++)
	                                                    <option value="{{ $i }}">{{ $i }} Lakh</option>
	                                                    @endfor
	                                                </select>
	                                            </div>
	                                        </div>
                                        </div>
                                        <div class="form-group project-technology d-none">
	                                        <label>Project Framework</label>
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
                                                <div class="form-group col">
                                                    {{-- <label>Framework</label> --}}
                                                    <select class="form-control" name="framework" id="framework">
                                                        <option value="">Select Framework</option>
                                                    </select>
                                                </div>
	                                        </div>
                                        </div>
                                        <div class="form-group project-duration d-none">
	                                        <label>Project Duration</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <select class="form-control" name="budget_from">
                                                        <option value="">From</option>
                                                        @for ($i = 0; $i < 21; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select class="form-control" name="budget_to">
                                                        <option value="">To</option>
                                                        @for ($i = 1; $i < 13; $i++)
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
                                    <div class="form-group text-right mt-5">
                                        <div class="btn-group" role="group">
                                            {{-- <button class="btn btn-primary" type="submit"> --}}
                                            <button class="btn btn-primary" type="button" onclick="togglePopup()">
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
                    <div class="search-project projects space-2">
                		{{-- <img src="/assets/img/profile/hire-right.png" class="img-fluid" alt=""> --}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="content">
                                    <h3>Digital Transformation</h3>
                                    <p>Digital transformation is the process of using digital technologies to create new or modify existing business processes, culture, and customer experiences.</p>
                                    <p>Join hand with Eiliana.com and reach to the next level of transformation.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="search-image">
                                    <img src="/assets/img/profile/search-projectgirl.png" class="img-fluid" alt="">
                                    <div class="names">
                                        <h4>Jyotsana Punj</h4>
                                        <p>3.5 Years, Content Writer</p>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="content">
                                    <h3>Artificial intelligence</h3>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <p>Artificial intelligence (AI) refers to the simulation of human intelligence in machines that are programmed to think like humans and mimic their actions.</p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <p>From Google Assistant, Siri, Alexa to Uber and Ola, several AI-enabled services are available today that make our lives easier.</p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                	</div>
                    <div class="contractual d-none">
                		<img src="/assets/img/profile/search-contractstaffing.png" class="img-fluid" alt="">
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
        changeBrowseProject();
        change_category();
    });
    function changeBrowseProject() {
        var method = $('input[name="browse_project"]:checked').attr('value');
        if (method == '1') {
            $('.project-budget').removeClass("d-none");
            $('.project-technology').addClass("d-none");
            $('.project-duration').addClass("d-none");
        } else if(method == '2') {
            $('.project-technology').removeClass("d-none");
            $('.project-budget').addClass("d-none");
            $('.project-duration').addClass("d-none");
        } else {
            $('.project-duration').removeClass("d-none");
            $('.project-budget').addClass("d-none");
            $('.project-technology').addClass("d-none");
        }
    }
	function changeLookingFor() {
        // var anonymous = e.target.value;
        var anonymous = $('input[name="lookingfor"]:checked').attr('value');
        // console.log(anonymous);
        if (anonymous == '1') {
            $('.contractual').removeClass("d-none");
            $('.projects').addClass("d-none");
        } else {
        	$('.contractual').addClass("d-none");
            $('.projects').removeClass("d-none");
        }
    }
</script>
<!--global js end-->
@stop
