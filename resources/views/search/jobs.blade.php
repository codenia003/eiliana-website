@extends('search/layout')

@section('search_content')
<div class="advance-search singup-body login-body">
    <form action="{{ url('/advance-search/jobs') }}" method="GET">
        {{-- @csrf --}}
        <div class="card">
            <div class="card-header d-none">
                <div class="basic-info">
                    <label>Type of Project</label>
                    <div class="form-check form-check-inline ml-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="support" class="custom-control-input" name="top" value="1">
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
                            <label class="custom-control-label" for="both">Both</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                {{-- <div class="form-group">
                    <label>Looking to develop</label>
                    <select name="job_category" class="form-control" required>
                        <option value=""></option>
                        @foreach ($projectcategorys as $category)
                        <option value="{{ $category->id }}" {{ (Session::get('contractsattfing')['project_category']==$category->id)? "selected" : "" }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <input type="hidden" name="job_category" value="{{ Session::get('contractsattfing')['project_category'] }}">
                <div class="form-group">
                    <label>Any Keyword(Key Skills)</label>
                    <input type="text" name="keyword" class="form-control" value="{{ Session::get('contractsattfing')['key_skills'] }}" />
                </div>
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
                <div class="form-group basic-info mb-3">
                    <label>Model Of Engagement</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox"
                         @if(isset($prev_tech['rate_hour']))
                            checked="" 
                         @endif
                          id="inlineCheckbox1" name="model_engagement" value="1" checked="" >
                        <label class="form-check-label" for="inlineCheckbox1">Hourly</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox"
                        @if(isset($prev_tech['rate_month']))
                            checked="" 
                         @endif
                         id="inlineCheckbox2" name="model_engagement" value="2">
                        <label class="form-check-label" for="inlineCheckbox2">Retainership</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox"
                         @if(isset($prev_tech['project_budget']))
                            checked="" 
                         @endif
                         id="inlineCheckbox3" name="model_engagement" value="3">
                        <label class="form-check-label" for="inlineCheckbox3">Project-based</label>
                    </div>
                </div>
                <div class="form-group">

                    <label>Technology Preference </label>
                    <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" onchange="change_framework();" multiple>
                        @if(isset($prev_tech) && isset($prev_tech['id']))
                            <option selected="" value=" {{$prev_tech['id']}}"> {{$prev_tech['name']}}</option>
                        @endif
                        
                        @foreach ($technologies as $technology)
                        <option value="{{ $technology->technology_id }}">{{ $technology->technology_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <!-- <label>Framework</label>
                        <select class="form-control select2" name="framework[]" id="framework" multiple>
                            <option value=""></option>
                        </select> -->
                        
                                    
                        
                        <label>Project Duration</label>
                            <div class="form-row">
                                <div class="col">
                                <input type="number" value="@if(isset($prev_tech['dur_min'])){{$prev_tech['dur_min']}}@endif" class="form-control" name="duration_min" placeholder="Min">
                            </div>
                            <div class="col">
                            <input type="number" value="@if(isset($prev_tech['dur_max'])){{$prev_tech['dur_max']}}@endif" class="form-control" 
                                name="duration_max" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col">
                        <!-- <label>Industry that Product was designed for</label> -->
                        <label>Customer Industry</label>
                        <select name="customer_industry" class="form-control">
                            <option value=""></option>
                            @foreach ($customerindustries as $industry)
                            <option value="{{ $industry->customer_industry_id }}">{{ $industry->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label>Total Experience</label>
                        <div class="form-row">
                            <div class="col-5">
                                <select class="form-control" name="experience_year">
                                    @for ($i = 0; $i < 21; $i++)
                                    <option value="{{ $i }}">{{ $i }} Years</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="experience_month">
                                    @for ($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ $i }} Months</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label>Rate Per Hour</label>
                        <div class="form-row">
                            <div class="col">
                                <select class="form-control" name="range_salary_from" id="rate_per_hour">
                                    <option value="">From</option>
                                    @for ($i = 0; $i < 51; $i++)
                                    <option value="{{ $i }}">{{ $i }} Lacs</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-control" name="range_salary_to" id="rate_per_hour1">
                                    <option value="">To</option>
                                    @for ($i = 1; $i < 51; $i++)
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
                        <button class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            Search and find the relevant projects
                        </button>
                        <!-- <button class="btn btn-outline-primary" type="reset">Discard</button> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@stop

