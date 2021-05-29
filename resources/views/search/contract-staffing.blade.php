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
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}">
<!-- <link type="text/css" rel="stylesheet" href="{{ asset('vendors/switchery/css/switchery.css') }}" /> -->
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="job-post">
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="mb-4 mt-3 text-right">
                        {{-- <button class="btn btn-md btn-info eiliana-btn" type="button">Save Job <i class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-md btn-info ml-3 eiliana-btn">Modify Job <i class="far fa-edit"></i></button> --}}
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
                    <div id="notific">
                        @include('notifications')
                    </div>
                    <div class="advance-search singup-body login-body">
                        <form action="{{ url('/advance-search/contract-staffing') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="basic-info mb-3 d-none">
                                        <label>Type of Project</label>
                                        <div class="form-check form-check-inline ml-3">
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
                                    <div class="form-group">
                                        <label>Any Keyword(Key Skills)</label>
                                        <input type="text" name="keyword" class="form-control" value="{{ Session::get('contractsattfing')['key_skills'] }}" required />
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Total Experience</label>
                                            <div class="form-row">
                                                <div class="col-5">
                                                    <select class="form-control" name="experience_year">
                                                        @for ($i = 0; $i < 21; $i++)
                                                        <option value="{{ $i }}" {{ (Session::get('contractsattfing')['experience_year']==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-5">
                                                    <select class="form-control" name="experience_month">
                                                        @for ($i = 1; $i < 13; $i++)
                                                        <option value="{{ $i }}" {{ (Session::get('contractsattfing')['experience_month']==$i)? "selected" : "" }}>{{ $i }} Months</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Salary Range</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <select class="form-control" name="range_salary_from">
                                                        <option value="">From</option>
                                                        @for ($i = 0; $i < 51; $i++)
                                                        <option value="{{ $i }}">{{ $i }} Lacs</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select class="form-control" name="range_salary_to">
                                                        <option value="">To</option>
                                                        @for ($i = 0; $i < 51; $i++)
                                                        <option value="{{ $i }}">{{ $i }} Lacs</option>
                                                        @endfor
                                                    </select>
                                                    <!-- <select class="form-control" name="range_salary_thousand">
                                                        <option value=""></option>
                                                        @for ($i = 0; $i < 100; $i+=5)
                                                        <option value="{{ $i }}">{{ $i }} Thousand</option>
                                                        @endfor
                                                    </select> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Technology Preference</label>
                                            <!-- <select name="technologty_pre" class="form-control select2" id="technologty_pre" onchange="change_framework();" multiple> -->
                                            <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" multiple>
                                                <option value=""></option>
                                                @foreach ($technologies as $technology)
                                                <option value="{{ $technology->technology_id }}">{{ $technology->technology_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{--<div class="form-group col-5">
                                            <label>Framework</label>
                                            <select class="form-control select2" name="framework" id="framework" multiple>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-1"></div>--}}
                                        <div class="form-group col-6">
                                            <!-- <label>Industry that Product was designed for</label> -->
                                            <label>Customer Industry</label>
                                            <select name="customer_industry" class="form-control">
                                                <option value=""></option>
                                                @foreach ($customerindustries as $industry)
                                                <option value="{{ $industry->customer_industry_id }}">{{ $industry->name }}</option>
                                                @endforeach
                                            </select>
                                            {{--<select name="industry" class="form-control">
                                                <option value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>--}}
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <!-- <div class="form-group col-5">
                                            <label>Current Location</label>
                                            <select name="current_location" class="form-control">
                                                <option value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div> -->
                                        @if(Session::get('contractsattfing')['location'])
                                        <div class="form-group col">
                                            <label>Job Location</label>
                                            <select name="location" class="form-control">
                                                <option value=""></option>
                                                @foreach ($locations as $location)
                                                <option value="{{ $location->location_id }}" {{ (Session::get('contractsattfing')['location']==$location->location_id)? "selected" : "" }}>{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @else
                                        <div class="form-group col">
                                            <label>Location</label>
                                            <select name="location" class="form-control">
                                                <option value=""></option>
                                                @foreach ($locations as $location)
                                                <option value="{{ $location->location_id }}">{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- eduction start -->
                                    <h4 class="text-left">Education Details</h4>
                                    <div class="ug-qualification mb-3">
                                        {{-- <span class="h4 text-left mt-3 mb-4 d-inline-block">UG Qualification</span> --}}
                                        <input type="hidden" name="graduation_type" value="3">
                                        <div class="form-row">
                                            <div class="form-group col-5">
                                                <label>Under Graduation</label>
                                                <select name="degree" class="form-control" >
                                                    <option value=""></option>
                                                    @foreach ($qualifications as $qualification)
                                                    @if ($qualification->type == 'UG')
                                                    <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-1"></div>
                                            <div class="form-group col-6">
                                                <label>University Name</label>
                                                <select name="name" class="form-control">
                                                    <option value=""></option>
                                                    @foreach ($universities as $university)
                                                    <option value="{{ $university->university_id }}">{{ $university->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-5">
                                                <label>Year of Graduation</label>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <select class="form-control" name="month">
                                                            <option value="">From</option>
                                                            @for ($i = 2000; $i < 2021; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-control" name="year">
                                                            <option value="">Till</option>
                                                            @for ($i = 2000; $i < 2021; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-1"></div>
                                            <div class="form-group col-6">
                                                <label>Education Type</label>
                                                <select name="education_type" class="form-control">
                                                    <option value=""></option>
                                                    @foreach ($educationtype as $etype)
                                                    <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pg-qualification">
                                        {{-- <span class="h4 text-left mt-3 mb-4 d-inline-block">PG Qualification</span> --}}
                                        <input type="hidden" name="graduation_type" value="4">
                                        <div class="form-row">
                                            <div class="form-group col-5">
                                                <label>Post Graduation</label>
                                                <select name="degree" class="form-control">
                                                    <option value=""></option>
                                                    @foreach ($qualifications as $qualification)
                                                    @if ($qualification->type == 'UG')
                                                    <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-1"></div>
                                            <div class="form-group col-6">
                                                <label>University Name</label>
                                                <select name="name" class="form-control">
                                                    <option value=""></option>
                                                    @foreach ($universities as $university)
                                                    <option value="{{ $university->university_id }}">{{ $university->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-5">
                                                <label>Year of Graduation</label>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <select class="form-control" name="month">
                                                            <option value="">From</option>
                                                            @for ($i = 2000; $i < 2021; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-control" name="year">
                                                            <option value="">Till</option>
                                                            @for ($i = 2000; $i < 2021; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-1"></div>
                                            <div class="form-group col-6">
                                                <label>Education Type</label>
                                                <select name="education_type" class="form-control">
                                                    <option value=""></option>
                                                    @foreach ($educationtype as $etype)
                                                    <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- certification start  -->
                                    <h4 class="text-left">Certification</h4>
                                    <div class="certification-3">
                                        {{-- <span class="h4 text-left mt-3 mb-4 d-inline-block">Certification</span> --}}
                                        <div class="form-row">
                                            <div class="form-group col-5">
                                                <label>Certification Number</label>
                                                <input type="text" name="certificate_no" class="form-control"/>
                                            </div>
                                            <div class="form-group col-1"></div>
                                            <div class="form-group col-6">
                                                <label>Certification Name</label>
                                                <input type="text" name="name" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-5">
                                                <label>Year of Certification</label>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <select class="form-control" name="from_date[]">
                                                            <option value="">From</option>
                                                            @for ($i = 2000; $i < 2021; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-control" name="till_date[]">
                                                            <option value="">Till</option>
                                                            @for ($i = 2000; $i < 2021; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-1">
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Institute Name</label>
                                                <input type="text" name="institutename[]" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group basic-info mb-3">
                                        <label>Sort By</label>
                                        <div class="form-check form-check-inline ml-3">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="Relevance" name="sortby" class="custom-control-input" value="0" checked="">
                                                <label class="custom-control-label" for="Relevance">Relevance</label>
                                            </div>
                                        </div>
                                        {{--<div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="Resume" name="sortby" class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="Resume">Resume Fresher</label>
                                            </div>
                                        </div>--}}
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="Last" name="sortby" class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="Last">Last Active Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right mt-5">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary" type="submit">
                                            Search & Find the Relevant Job
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @include('layouts.left')
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
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('vendors/switchery/js/switchery.js') }}"></script> -->
<script>
$('#postJobForm').bootstrapValidator({});

$(document).ready(function() {
    $('#technologty_pre').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
    $('#framework').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
    $(".form-check-input").iCheck({
        checkboxClass: 'icheckbox_minimal-red',
    });
    // var elem = document.querySelector('.js-switch2');
    // var init = new Switchery(elem, {
    //     size: 'small',
    //     color: '#003466',
    // });

});
</script>
<!--global js end-->
@stop

