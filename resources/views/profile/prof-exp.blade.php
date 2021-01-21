@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Professional Experience</span>
            <!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Professional Experience</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registerprofexp') }}" method="POST" id="registerprofexpForm">
            	@csrf
                @forelse ($proexps as $proexp)
                    <input type="hidden" name="professional_experience_id" value="{{ $proexp->professional_experience_id }}">
                    <div class="form-row">
                        <!-- <div class="form-group col">
                            <label>Video Intro URL</label>
                            <div class="input-group mb-3">
                                <input type="text" name="video_url" class="form-control" value="{{ $proexp->video_url }}">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-upload"></i></span>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group col">
                            <label>Technology Preference</label>
                            <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" onchange="change_framework();" multiple required>
                                <option value=""></option>
                                @foreach ($technologies as $technology)
                                <option value="{{ $technology->technology_id }}" {{ (in_array($technology->technology_id, $selected_technologies)) ? 'selected' : '' }} >{{ $technology->technology_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>Framework</label>
                            <select class="form-control select2" required="" name="framework[]" id="framework" multiple>
                                <option value=""></option>
                                @foreach ($childtechnologies as $technology)
                                <option value="{{ $technology->technology_id }}" {{ (in_array($technology->technology_id, $selected_framework)) ? 'selected' : '' }} >{{ $technology->technology_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Profile Headline</label>
                            <input type="text" name="profile_headline" class="form-control" value="{{ $proexp->profile_headline }}" />
                        </div>
                    </div>
                    @if(Sentinel::getUser()->interested == "2")
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Key Skills (Ex. Core Java, Hibernate, Html, Css)</label>
                            <input type="text" name="key_skills" class="form-control" value="{{ $proexp->key_skills }}" />
                            <span style="color: red;font-size: 12px;">Note: Key skills mentioned above will be used for contractual staffing</span>
                        </div>
                    </div>
                    <input type="hidden" name="project_category">
                    <input type="hidden" name="designation">
                    <input type="hidden" name="model_engagement">
                    @else
                    <input type="hidden" name="key_skills">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Freelancing Project Category</label>
                            <select name="project_category" class="form-control">
                                <option value=""></option>
                                @foreach ($projectcategorys as $category)
                                <option value="{{ $category->id }}" {{ ($proexp->project_category==$category->id)? "selected" : "" }} >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>Designation</label>
                            <select name="designation" class="form-control" required>
                                <option value=""></option>
                                @foreach ($designations as $designation)
                                <option value="{{ $designation->designation_id }}" {{ ($proexp->designation==$designation->designation_id)? "selected" : "" }}>{{ $designation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group basic-info mb-3">
                        <label>Model Of Freelancing Engagement</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="model_engagement[]" value="1" {{ in_array(1, $model_engagement_new) ? "checked" : "" }}>
                            <label class="form-check-label" for="inlineCheckbox1">Hourly</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="model_engagement[]" value="2" {{ in_array(2, $model_engagement_new) ? "checked" : "" }}>
                            <label class="form-check-label" for="inlineCheckbox2">Retainership</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="model_engagement[]" value="3" {{ in_array(3, $model_engagement_new) ? "checked" : "" }}>
                            <label class="form-check-label" for="inlineCheckbox3">Project-based</label>
                        </div>
                    </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Total <br>Experience</label>
                            <div class="form-row">
                                <div class="col-5">
                                    <select class="form-control" required="" name="experience_year">
                                        @for ($i = 0; $i < 21; $i++)
                                        <option value="{{ $i }}" {{ ($proexp->experience_year==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-5">
                                    <select class="form-control" required="" name="experience_month">
                                        @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}" {{ ($proexp->experience_month==$i)? "selected" : "" }}>{{ $i }} Months</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label>No of Support <br>Projects(Optional)</label>
                            {!! Form::selectRange('support_project', 1, 20, $proexp->support_project, ['class' => 'form-control','required' =>'']) !!}
                        </div>
                        <div class="form-group col-3">
                            <label>No of Development Projects(Optional)</label>
                            {!! Form::selectRange('development_project', 1, 20, $proexp->development_project, ['class' => 'form-control','required' =>'']) !!}
                        </div>
                        <!-- <span style="color: red;font-size: 12px;">Note: Candidates needs to mention overall projects executed by them in there professional journey</span> -->
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Current Location</label>
                            <select name="current_location" class="form-control" required>
                                <option value=""></option>
                                @foreach ($locations as $location)
                                <option value="{{ $location->location_id }}" {{ ($proexp->current_location == $location->location_id)? "selected" : "" }}>{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>Preferred Location</label>
                            <select name="preferred_location" class="form-control" required>
                                <option value=""></option>
                                @foreach ($locations as $location)
                                <option value="{{ $location->location_id }}" {{ ($proexp->preferred_location == $location->location_id)? "selected" : "" }}>{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @empty
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Technology Preference</label>
                            <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" onchange="change_framework();" multiple required>
                                <option value=""></option>
                                @foreach ($technologies as $technology)
                                <option value="{{ $technology->technology_id }}">{{ $technology->technology_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>Framework</label>
                            <select class="form-control select2" required="" name="framework[]" id="framework" multiple>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Profile Headline</label>
                            <input type="text" name="profile_headline" class="form-control" />
                        </div>
                    </div>
                    @if(Sentinel::getUser()->interested == "2")
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Key Skills (Ex. Core Java, Hibernate, Html, Css)</label>
                            <input type="text" name="key_skills" class="form-control" />
                            <span style="color: red;font-size: 12px;">Note: Key skills mentioned above will be used for contractual staffing</span>
                        </div>
                    </div>
                    <input type="hidden" name="project_category">
                    @else
                    <input type="hidden" name="key_skills">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Freelancing Project Category</label>
                            <select name="project_category" class="form-control">
                                <option value=""></option>
                                @foreach ($projectcategorys as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>Designation</label>
                            <select name="designation" class="form-control" required>
                                <option value=""></option>
                                @foreach ($designations as $designation)
                                <option value="{{ $designation->designation_id }}">{{ $designation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

    	            <div class="form-group basic-info mb-3">
                        <label>Model Of Engagement</label>
                        <br>
                        <div class="form-check form-check-inline">
    					  	<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="model_engagement[]" value="1">
    					  	<label class="form-check-label" for="inlineCheckbox1">Hourly</label>
    					</div>
    					<div class="form-check form-check-inline">
    					  	<input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="model_engagement[]" value="2">
    					  	<label class="form-check-label" for="inlineCheckbox2">Retainership</label>
    					</div>
    					<div class="form-check form-check-inline">
    					  	<input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="model_engagement[]" value="3">
    					  	<label class="form-check-label" for="inlineCheckbox3">Project-based</label>
    					</div>
                    </div>
                    @endif

    	            <div class="form-row">
                		<div class="form-group col-4">
    		                <label>Total Experience</label>
    		                <div class="form-row">
    		                	<div class="col">
                                    <select class="form-control" required="" name="experience_year">
                                        @for ($i = 1; $i < 21; $i++)
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
    		            <div class="form-group col-4">
    		            	<label>No of Support Projects</label>
    		                {!! Form::selectRange('support_project', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
    		            </div>
    		            <div class="form-group col-4">
    		            	<label>No of Development Projects</label>
    		                {!! Form::selectRange('development_project', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
    		            </div>
    		        </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Current Location</label>
                            <select name="current_location" class="form-control" required>
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>Preferred Location</label>
                            <select name="preferred_location" class="form-control" required>
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                @endforelse
                <div class="form-group text-right mt-5">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            Next >>>
                        </button>
                        <!-- <button class="btn btn-outline-primary" type="reset">Discard</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
