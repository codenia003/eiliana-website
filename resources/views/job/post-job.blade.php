@extends('layouts/default')

{{-- Page title --}}
@section('title')
Job Post
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('vendors/switchery/css/switchery.css') }}" />
<!--end of page level css-->
<style>
    .eiliana-btn {
        height: 47px;
    }
</style>
@stop

{{-- content --}}
@section('content')
<div class="job-post">
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fa fa-bars"></i></span>
                <span class="h5 text-white ml-2">Job Post</span>
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
                        <form action="{{ url('/post-job-on') }}" method="POST" id="postJobForm" enctype="multipart/form-data">
                            @csrf
                            @isset(Session::get('sales_referral')['referral_id'])
                            <input type="hidden" name="referral_id" value="{{ Session::get('sales_referral')['referral_id'] }}">
                            @endisset
                            @empty(Session::get('sales_referral')['referral_id'])
                            <input type="hidden" name="referral_id" value="0">
                            @endempty
                            <div class="card">
                                <div class="p-4">
                                    <div class="form-group">
                                        <label>About Company</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="about_company" rows="3"></textarea>
                                    </div>
                                    @if (Session::get('contractsattfing')['lookingfor'] === '1')
                                        <div class="form-group basic-info mb-3">
                                            <label>Contract Duration(Months)</label>
                                            <br />
                                            <input type="number" name="model_engagement" class="form-control" value="" required />
                                            {{-- <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="model_engagement" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">Monthly</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="model_engagement" value="2">
                                                <label class="form-check-label" for="inlineCheckbox2">Quarterly</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="model_engagement" value="3">
                                                <label class="form-check-label" for="inlineCheckbox3">Yearly</label>
                                            </div> --}}
                                        </div>
                                    @else
                                        <div class="form-group basic-info mb-3">
                                            <label>Pricing Model</label>
                                            <br />
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="model_engagement" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">Hourly</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="model_engagement" value="2">
                                                <label class="form-check-label" for="inlineCheckbox2">Retainership</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="model_engagement" value="3">
                                                <label class="form-check-label" for="inlineCheckbox3">Project-based</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox4" name="model_engagement" value="4">
                                                <label class="form-check-label" for="inlineCheckbox4">Contract Staffing</label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label>Job Title</label>
                                        <input type="text" name="job_title" class="form-control" value="" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Key Skills</label>
                                        <input type="text" name="key_skills" class="form-control" value="{{ Session::get('contractsattfing')['key_skills'] }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Role Summary</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea2" name="role_summary" rows="3"></textarea>
                                    </div>

                                    <div class="basic-info mb-3">
                                        <label>Type of Project</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="support" class="custom-control-input" name="type_of_project" value="1" checked="">
                                                <label class="custom-control-label" for="support">Support</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="development" class="custom-control-input" name="type_of_project" value="2">
                                                <label class="custom-control-label" for="development">Development</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="both" class="custom-control-input" name="type_of_project" value="3">
                                                <label class="custom-control-label" for="both">Support Cum Development</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Total Experience</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <select class="form-control" name="experience_year">
                                                        @for ($i = 0; $i < 21; $i++)
                                                        <option value="{{ $i }}" {{ (Session::get('contractsattfing')['experience_year']==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <!-- <select class="form-control" name="experience_month">
                                                        @for ($i = 1; $i < 13; $i++)
                                                        <option value="{{ $i }}" {{ (Session::get('contractsattfing')['experience_month']==$i)? "selected" : "" }}>{{ $i }} Months</option>
                                                        @endfor
                                                    </select> -->
                                                    <select class="form-control" name="experience_month">
                                                        @for ($i = 1; $i < 21; $i++)
                                                        <option value="{{ $i }}" {{ (Session::get('contractsattfing')['experience_month']==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Customer Industry</label>
                                            <select name="customer_industry" class="form-control" required>
                                                <option value=""></option>
                                                @foreach ($customerindustries as $industry)
                                                <option value="{{ $industry->customer_industry_id }}">{{ $industry->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>Technology Preference</label>
                                            <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" onchange="change_framework();" multiple>
                                                <option value=""></option>
                                                @foreach ($technologies as $technology)
                                                <option value="{{ $technology->technology_id }}">{{ $technology->technology_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Framework</label>
                                            <select class="form-control select2" name="framework[]" id="framework" multiple>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="form-group col">
                                            <label>Candidate Role</label>
                                            {!! Form::selectRange('candidate_role', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
                                        </div>
                                        <div class="form-group col">
                                            <label>Product Industry Exprience</label>
                                            <select name="product_industry_exprience" class="form-control">
                                                <option value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label>Location</label>
                                            <select name="location" class="form-control">
                                                <option value=""></option>
                                                @foreach ($locations as $location)
                                                <option value="{{ $location->location_id }}" {{ (Session::get('contractsattfing')['current_location']==$location->location_id)? "selected" : "" }}>{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col">
                                            <label>Budget</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <select class="form-control" name="budget_from">
                                                        <option value="">From</option>
                                                        @for ($i = 0; $i < 51; $i++)
                                                        <option value="{{ $i }}">{{ $i }} Lacs</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select class="form-control" name="budget_to">
                                                        <option value="">To</option>
                                                        @for ($i = 1; $i < 51; $i++)
                                                        <option value="{{ $i }}">{{ $i }} Lacs</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group my-4">
                                        <label>Auto Match:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <input type="checkbox" class="js-switch2" name="auto_match" value="1" checked />
                                    </div> -->
                                    <!-- <div class="my-3">
                                        <button class="btn eiliana-btn btn-additional" type="button">Additional Fields <span class="fa fa-plus"></span></button>
                                    </div> -->
                                    {{-- additonal field --}}
                                    <!-- <div class="additional-filter d-none">
                                        
                                        <h4 class="text-left">Education Details</h4>
                                        <div class="ug-qualification-1">
                                            <div class="ug-qualification mb-3">
                                            {{-- <span class="h4 text-left mt-3 mb-4 d-inline-block">UG Qualification</span> --}}
                                            <input type="hidden" name="graduation_type[]" value="3">
                                            <input type="hidden" name="education_id[]" value="0">
                                            <div class="form-row">
                                                <div class="form-group col-4">
                                                    <label>UG Qualification</label>
                                                    <select name="degree[]" class="form-control" required>
                                                        <option value=""></option>
                                                        @foreach ($qualifications as $qualification)
                                                        @if ($qualification->type == 'UG')
                                                        <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-1">
                                                </div>
                                                <div class="form-group col-7">
                                                    <label>University Name</label>
                                                    <select name="universityname[]" class="form-control">
                                                        <option value=""></option>
                                                        @foreach ($universities as $university)
                                                        <option value="{{ $university->university_id }}">{{ $university->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-4">
                                                    <label>Year of Graduation</label>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <select class="form-control" required="" name="month[]">
                                                                <option value="">From</option>
                                                                @for ($i = 2000; $i < 2021; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <select class="form-control" required="" name="year[]">
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
                                                <div class="form-group col-7">
                                                    <label>Education Type</label>
                                                    <select name="education_type[]" class="form-control" required>
                                                        <option value=""></option>
                                                        @foreach ($educationtype as $etype)
                                                        <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <button class="btn eiliana-btn btn-copy-ug" type="button">Add Education <span class="fa fa-plus"></span></button>

                                            <button type="button" class="remove-ug btn eiliana-btn ml-3 rounded-0">Erase Education <span class="fas fa-times"></span></button>
                                        </div>
                                        <div class="pg-qualification-1">
                                            <div class="pg-qualification">
                                                {{-- <span class="h4 text-left mt-3 mb-4 d-inline-block">PG Qualification</span> --}}
                                                <input type="hidden" name="graduation_type[]" value="4">
                                                <input type="hidden" name="education_id[]" value="0">
                                                <div class="form-row">
                                                    <div class="form-group col-4">
                                                        <label>PG Qualification</label>
                                                        <select name="degree[]" class="form-control" required>
                                                            <option value=""></option>
                                                            @foreach ($qualifications as $qualification)
                                                            @if ($qualification->type == 'UG')
                                                            <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-1">
                                                    </div>
                                                    <div class="form-group col-7">
                                                        <label>University Name</label>
                                                        <select name="universityname[]" class="form-control">
                                                            <option value=""></option>
                                                            @foreach ($universities as $university)
                                                            <option value="{{ $university->university_id }}">{{ $university->name }}</option>
                                                            @endforeach
                                                        </select>
                                                         {{-- <input type="text" name="name[]" class="form-control" required/>--}} 
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-4">
                                                        <label>Year of Graduation</label>
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <select class="form-control" required="" name="month[]">
                                                                    <option value="">From</option>
                                                                    @for ($i = 2000; $i < 2021; $i++)
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <select class="form-control" required="" name="year[]">
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
                                                    <div class="form-group col-7">
                                                        <label>Education Type</label>
                                                        <select name="education_type[]" class="form-control" required>
                                                            <option value=""></option>
                                                            @foreach ($educationtype as $etype)
                                                            <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn eiliana-btn btn-copy-pg" type="button">Add Education <span class="fa fa-plus"></span></button>

                                            <button type="button" class="remove-pg btn eiliana-btn ml-3 rounded-0">Erase Education <span class="fas fa-times"></span></button>
                                        </div>
                                        {{-- certification start  --}}
                                        <h4 class="text-left">Certification</h4>
                                        <div class="certification-1">
                                            <div class="certification">
                                                {{-- <span class="h4 text-left mt-3 mb-4 d-inline-block">Certification</span> --}}
                                                <input type="hidden" name="certificate_id[]" value="0">
                                                <div class="form-row">
                                                    <div class="form-group col-5">
                                                        <label>Certification Number</label>
                                                        <input type="text" name="certificate_no" class="form-control"/>
                                                    </div>
                                                     {{--<div class="form-group col-1"></div> --}}
                                                    <div class="form-group col-7">
                                                        <label>Certification Name</label>
                                                        <input type="text" name="certificate_name" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-4">
                                                        <label>Year of Certification</label>
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <select class="form-control" required="" name="from_date[]">
                                                                    <option value="">From</option>
                                                                    @for ($i = 2000; $i < 2021; $i++)
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <select class="form-control" required="" name="till_date[]">
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
                                                    <div class="form-group col-7">
                                                        <label>Institute Name</label>
                                                        <input type="text" name="institutename[]" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn eiliana-btn btn-copy-c" type="button">Add Certification <span class="fa fa-plus"></span></button>
                                            <button type="button" class="remove-c btn eiliana-btn ml-3 rounded-0">Erase Certification <span class="fas fa-times"></span></button>
                                        </div>
                                        <div class="my-3">
                                            <button class="btn eiliana-btn btn-additional-ques" type="button">Additional Filters <span class="fa fa-plus"></span></button>
                                        </div>
                                        <div class="additional-filter-ques d-none">
                                             {{-- question set --}}
                                            <div class="border mt-5">
                                                {{-- question 1 --}}
                                                <div class="p-4 border-bottom">
                                                    <h4 class="text-left">Question 1</h4>
                                                    <div class="question1-1">
                                                        <div class="question1">
                                                            <input type="hidden" name="question_type[]" class="form-control" value="1"/>
                                                            {{-- <input type="hidden" name="radio_count" id="radio_count_id" value="0"/> --}}
                                                            <input type="hidden" name="question_option[]" value="0">
                                                            <div class="form-group">
                                                                {{-- <label>Question</label> --}}
                                                                <input type="text" name="question_name[]" class="form-control"/>
                                                            </div>
                                                            <div class="form-group basic-info my-3">
                                                                <label>Lorem Isume</label>
                                                                <br>
                                                                <div class="form-check form-check-inline">
                                                                    <div class="custom-control custom-radio radioappend1">
                                                                        <input type="radio" id="Yes" class="custom-control-input" name="question_radio0" value="1" checked>
                                                                        <label class="custom-control-label" for="Yes">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <div class="custom-control custom-radio radioappend2">
                                                                        <input type="radio" id="No" class="custom-control-input" name="question_radio0" value="0">
                                                                        <label class="custom-control-label" for="No">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn eiliana-btn btn-copy-q1" type="button">Add Question <span class="fa fa-plus"></span></button>
                                                        <button type="button" class="remove-q1 btn eiliana-btn ml-3 rounded-0">Erase Question <span class="fas fa-times"></span></button>
                                                    </div>
                                                </div>
                                                {{-- question 2 --}}
                                                <div class="p-4 border-bottom">
                                                    <h4 class="text-left">Question 2</h4>
                                                    <div class="question2-1">
                                                        <div class="question2">
                                                            <input type="hidden" name="question_type[]"  value="2"/>
                                                            <input type="hidden" name="question_option[]" value="0">
                                                            <div class="form-group">
                                                                {{-- <label>Question</label> --}}
                                                                <input type="text" name="question_name[]" class="form-control"/>
                                                            </div>
                                                            <div class="form-group basic-info my-3">
                                                                <label>Lorem Isume</label>
                                                                <br>
                                                                <div class="form-check form-check-inline checkboxappend1">
                                                                    <input class="form-check-input" type="checkbox" id="inlineCheckboxQue1" name="question_checkbox0[]" value="1">
                                                                    <label class="form-check-label" for="inlineCheckboQue1">Lorem Isume</label>
                                                                </div>
                                                                <div class="form-check form-check-inline checkboxappend2">
                                                                    <input class="form-check-input" type="checkbox" id="inlineCheckboxQue2" name="question_checkbox0[]" value="2">
                                                                    <label class="form-check-label" for="inlineCheckboxQue2">Lorem Isume</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn eiliana-btn btn-copy-q2" type="button">Add Question <span class="fa fa-plus"></span></button>
                                                        <button type="button" class="remove-q2 btn eiliana-btn ml-3 rounded-0">Erase Question <span class="fas fa-times"></span></button>
                                                    </div>
                                                </div>
                                                {{-- question 3 --}}
                                                <div class="p-4 border-bottom">
                                                    <h4 class="text-left">Question 3</h4>
                                                    <div class="question3-1">
                                                        <div class="question3">
                                                            <input type="hidden" name="question_type[]" class="form-control" value="3"/>
                                                            <div class="form-group">
                                                                {{-- <label>Question</label> --}}
                                                                <input type="text" name="question_name[]" class="form-control"/>
                                                            </div>
                                                            <div class="form-row align-items-center">
                                                                <div class="form-group col-2">
                                                                    <label>Lorem Isume</label>
                                                                </div>
                                                                <div class="form-group input-group col-4">
                                                                    <input type="text" name="question_option[]" class="form-control">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-btn input-group-append">
                                                                            <button class="btn btn-secondary input-group-text image_radius" type="button">
                                                                                <i class="fas fa-percent"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn eiliana-btn btn-copy-q3" type="button">Add Question <span class="fa fa-plus"></span></button>
                                                        <button type="button" class="remove-q3 btn eiliana-btn ml-3 rounded-0">Erase Question <span class="fas fa-times"></span></button>
                                                    </div>
                                                </div>
                                                {{-- question 4 --}}
                                                <div class="p-4 border-bottom">
                                                    <h4 class="text-left">Question 4</h4>
                                                    <div class="question4-1">
                                                        <div class="question4">
                                                            <input type="hidden" name="question_type[]" class="form-control" value="4"/>
                                                            <div class="form-group">
                                                                {{-- <label>Question</label> --}}
                                                                <input type="text" name="question_name[]" class="form-control"/>
                                                            </div>
                                                            <div class="form-row align-items-center">
                                                                <div class="form-group col-2">
                                                                    <label>Lorem Isume</label>
                                                                </div>
                                                                <div class="form-group input-group col-4">
                                                                    <input type="text" name="question_option[]" class="form-control"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn eiliana-btn btn-copy-q4" type="button">Add Question <span class="fa fa-plus"></span></button>
                                                        <button type="button" class="remove-q4 btn eiliana-btn ml-3 rounded-0">Erase Question <span class="fas fa-times"></span></button>
                                                    </div>
                                                </div>
                                                {{-- question 5 --}}
                                                <div class="p-4">
                                                    <h4 class="text-left">Question 5</h4>
                                                    <div class="question5-1">
                                                        <div class="question5">
                                                            <input type="hidden" name="question_type[]"  value="5"/>
                                                            <input type="hidden" name="question_option[]" value="0">
                                                            <div class="form-group">
                                                                {{-- <label>Question</label> --}}
                                                                <input type="text" name="question_name[]" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn eiliana-btn btn-copy-q5" type="button">Add Question <span class="fa fa-plus"></span></button>
                                                        <button type="button" class="remove-q5 btn eiliana-btn ml-3 rounded-0">Erase Question <span class="fas fa-times"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="form-group text-right mt-5">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary" type="submit">
                                               Publish Online
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
<script type="text/javascript" src="{{ asset('vendors/switchery/js/switchery.js') }}"></script>
<script>
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
    var elem = document.querySelector('.js-switch2');
    var init = new Switchery(elem, {
        size: 'small',
        color: '#003466',
    });

    $(function(){
        $(".btn-copy-ug").on('click', function(){
            var element = '<div class="ug-qualification-3">'+$('.ug-qualification').html()+'</div>';
            $('.ug-qualification-1').append(element);

        });
        $(".btn-copy-pg").on('click', function(){
            var element = '<div class="pg-qualification-3">'+$('.pg-qualification').html()+'</div>';
            $('.pg-qualification-1').append(element);
        });
        $(".btn-copy-c").on('click', function(){
            var element = '<div class="certification-3">'+$('.certification').html()+'</div>';
            $('.certification-1').append(element);
        });

        // question start
        var i = 1;
        $(".btn-copy-q1").on('click', function(){
            // var count = $(".question1-3:last input#radio_count_id").val();

            var element = '<div class="question1-3 radioques'+i+'">'+$('.question1').html()+'</div>';
            $('.question1-1').append(element);

            $(".radioques"+i+"  .radioappend1").html('<input type="radio" id="Yes'+i+'" class="custom-control-input" name="question_radio'+i+'" value="1"><label class="custom-control-label" for="Yes'+i+'">Yes</label>');

            $(".radioques"+i+" .radioappend2").html('<input type="radio" id="No'+i+'" class="custom-control-input" name="question_radio'+i+'" value="0"><label class="custom-control-label" for="No'+i+'">No</label>');
            i++;

        });
        $(".btn-copy-q2").on('click', function(){
            var element = '<div class="question2-3">'+$('.question2').html()+'</div>';
            $('.question2-1').append(element);
        });
        $(".btn-copy-q3").on('click', function(){
            var element = '<div class="question3-3">'+$('.question3').html()+'</div>';
            $('.question3-1').append(element);
        });
        $(".btn-copy-q4").on('click', function(){
            var element = '<div class="question4-3">'+$('.question4').html()+'</div>';
            $('.question4-1').append(element);
        });
        $(".btn-copy-q5").on('click', function(){
            var element = '<div class="question5-3">'+$('.question5').html()+'</div>';
            $('.question5-1').append(element);
        });

        $(".btn-additional").on('click', function(){
            $('.additional-filter').removeClass("d-none");
            $('.btn-additional').addClass("d-none");
        });

        $(".btn-additional-ques").on('click', function(){
            $('.additional-filter-ques').removeClass("d-none");
            $('.btn-additional-ques').addClass("d-none");
        });

    });
    $(document).on('click','.remove-ug',function() {
        $(".ug-qualification-3:last").remove();
    });
    $(document).on('click','.remove-pg',function() {
        $(".pg-qualification-3:last").remove();
    });
    $(document).on('click','.remove-c',function() {
        $(".certification-3:last").remove();
    });

    // question start
    $(document).on('click','.remove-q1',function() {
        $(".question1-3:last").remove();
    });
    $(document).on('click','.remove-q2',function() {
        $(".question2-3:last").remove();
    });
    $(document).on('click','.remove-q3',function() {
        $(".question3-3:last").remove();
    });
    $(document).on('click','.remove-q4',function() {
        $(".question4-3:last").remove();
    });
    $(document).on('click','.remove-q5',function() {
        $(".question5-3:last").remove();
    });

});
</script>
<!--global js end-->
@stop
