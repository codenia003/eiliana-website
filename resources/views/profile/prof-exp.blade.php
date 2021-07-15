@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title profile_text"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2 profile_text">Professional Experience</span>
            <nav class="navbar navbar-expand-xl navbar-light custom_header">
				<!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
				<button type="button" class="navbar-toggler profile_nav" data-toggle="collapse" data-target="#navbarCollapse1" style="margin-right: -34px;">
				<span class="border-title profile_text"><i class="fa fa-bars"></i></span>
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

                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Technology Preference</label>
                            <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" multiple required>
                            {{-- <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" onchange="change_framework();" multiple required> --}}
                                @foreach ($technologies as $technology)
                                <option value="{{ $technology->technology_id }}" {{ (in_array($technology->technology_id, $selected_technologies)) ? 'selected' : '' }} >{{ $technology->technology_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Framework</label>
                            <select class="form-control select2" required="" name="framework[]" id="framework" multiple>
                                <option value=""></option>
                                @foreach ($childtechnologies as $technology)
                                <option value="{{ $technology->technology_id }}" {{ (in_array($technology->technology_id, $selected_framework)) ? 'selected' : '' }} >{{ $technology->technology_name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Profile Headline</label>
                            <input type="text" name="profile_headline" class="form-control" value="{{ $proexp->profile_headline }}" required />
                        </div>
                    </div>
                    @if(Sentinel::getUser()->interested == "2")
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Key Skills (Ex. Core Java, Hibernate, Html, Css)</label>
                            <input type="text" name="key_skills" class="form-control" value="{{ $proexp->key_skills }}" required />
                            <span style="color: red;font-size: 12px;">Note: Key skills mentioned above will be used for contractual staffing</span>
                        </div>
                    </div>
                    <input type="hidden" name="project_category">
                    <input type="hidden" name="project_sub_category">
                    <!-- <input type="hidden" name="designation"> -->
                    <input type="hidden" name="model_engagement">
                    @else
                    <input type="hidden" name="key_skills">
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Freelancing Project Category</label>
                            <select name="project_category" class="form-control" id="project_category" onchange="change_category1();" required>
                                <option value=""></option>
                                @foreach ($projectcategorys as $category)
                                <option value="{{ $category->id }}" {{ ($proexp->project_category==$category->id)? "selected" : "" }} >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--<div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Designation</label>
                            <select name="designation" class="form-control" required>
                                <option value=""></option>
                                @foreach ($designations as $designation)
                                <option value="{{ $designation->designation_id }}" {{ ($proexp->designation==$designation->designation_id)? "selected" : "" }}>{{ $designation->name }}</option>
                                @endforeach
                            </select>
                        </div>--}}

                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Project Sub Category</label>
                            <select name="project_sub_category" id="project_sub_category" class="form-control">
                                <option value="0"></option>
                                @foreach ($subprojectcategorys as $category)
                                @if ($category->parent_id == $proexp->project_category)
                                    <option value="{{ $category->id }}" {{ ($proexp->project_sub_category==$category->id)? "selected" : "" }} >{{ $category->name }}</option>
                                @endif
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
                        <br>
                        @if ($errors->has('model_engagement'))
                            <span class="text-danger">{{ $errors->first('model_engagement') }}</span>
                        @endif
                    </div>
                    <div class="form-row rateperhour {{ in_array(1, $model_engagement_new) ? "" : "d-none" }}">
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Rate Per Hour</label>
                            <input type="number" name="rateperhour" class="form-control" min="100" value="{{  $proexp->rateperhour }}"/>
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label for="currency_id">Currency</label>
                            <select class="form-control" name="currency_id" id="currency_id" required>
                                @foreach ($currency as $currencies)
                                    <option value="{{ $currencies->currency_id }}" {{ ($proexp->currency_id==$currencies->currency_id)? "selected" : "" }}>{{ $currencies->code }} - {{ $currencies->symbol}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Total <br>Experience</label>
                            <div class="form-row">
                                <div class="col-6 col-sm-6 col-md-5 col-lg-5">
                                    <select class="form-control" required="" name="experience_year">
                                        @for ($i = 0; $i < 21; $i++)
                                        <option value="{{ $i }}" {{ ($proexp->experience_year==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6 col-sm-6 col-md-5 col-lg-5">
                                    <select class="form-control" required="" name="experience_month">
                                        @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}" {{ ($proexp->experience_month==$i)? "selected" : "" }}>{{ $i }} Months</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-3 col-lg-3">
                            <label>No of Maintenance <br>Projects(Optional)</label>
                            {!! Form::selectRange('support_project', 1, 20, $proexp->support_project, ['class' => 'form-control','required' =>'']) !!}
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-3 col-lg-3">
                            <label>No of Development Projects(Optional)</label>
                            {!! Form::selectRange('development_project', 1, 20, $proexp->development_project, ['class' => 'form-control','required' =>'']) !!}
                        </div>
                        <!-- <span style="color: red;font-size: 12px;">Note: Candidates needs to mention overall projects executed by them in there professional journey</span> -->
                    </div>
                    @if(Sentinel::getUser()->interested == "1")
                        <div class="form-row">
                            <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                <label>Current Location</label>
                                <select name="current_location" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->location_id }}" {{ ($proexp->current_location == $location->location_id)? "selected" : "" }}>{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="preferred_location" value="0">
                        </div>
                    @else 
                        <div class="form-row">
                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                <label>Current Location</label>
                                <select name="current_location" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->location_id }}" {{ ($proexp->current_location == $location->location_id)? "selected" : "" }}>{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                <label>Preferred Location</label>
                                <select name="preferred_location" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->location_id }}" {{ ($proexp->preferred_location == $location->location_id)? "selected" : "" }}>{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Technology Preference</label>
                            {{-- <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" onchange="change_framework();" multiple required> --}}
                            <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" multiple required>
                                <option value=""></option>
                                @foreach ($technologies as $technology)
                                <option value="{{ $technology->technology_id }}">{{ $technology->technology_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Framework</label>
                            <select class="form-control select2" required="" name="framework[]" id="framework" multiple>
                                <option value=""></option>
                            </select>
                        </div> --}}
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Profile Headline</label>
                            <input type="text" name="profile_headline" class="form-control" required/>
                        </div>
                    </div>
                    @if(Sentinel::getUser()->interested == "2")
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Key Skills (Ex. Core Java, Hibernate, Html, Css)</label>
                            <input type="text" name="key_skills" class="form-control" required/>
                            <span style="color: red;font-size: 12px;">Note: Key skills mentioned above will be used for contractual staffing</span>
                        </div>
                    </div>
                    <input type="hidden" name="project_category">
                    <input type="hidden" name="project_sub_category">
                    @else
                    <input type="hidden" name="key_skills">
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Freelancing Project Category</label>
                            <select name="project_category" class="form-control" id="project_category" onchange="change_category1();" required>
                                <option value=""></option>
                                @foreach ($projectcategorys as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Project Sub Category</label>
                            <select name="project_sub_category" id="project_sub_category" class="form-control">
                                <option value="0"></option>
                            </select>
                        </div>
                        {{--<div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Designation</label>
                            <select name="designation" class="form-control" required>
                                <option value=""></option>
                                @foreach ($designations as $designation)
                                <option value="{{ $designation->designation_id }}">{{ $designation->name }}</option>
                                @endforeach
                            </select>
                        </div>--}}
                    </div>

    	            <div class="form-group basic-info mb-3">
                        <label>Model Of Engagement</label>
                        <br>
                        <div class="form-check form-check-inline">
    					  	<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="model_engagement[]" value="1" checked>
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
                        @if ($errors->has('model_engagement'))
                            <span class="text-danger">{{ $errors->first('model_engagement') }}</span>
                        @endif
                    </div>
                    <div class="form-row rateperhour">
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Rate Per Hour</label>
                            <input type="number" name="rateperhour" class="form-control" min="100" value="" />
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label for="currency_id">Currency</label>
                            <select class="form-control" name="currency_id" id="currency_id" required>
                                @foreach ($currency as $currencies)
                                    <option value="{{ $currencies->currency_id }}">{{ $currencies->code }} - {{ $currencies->symbol}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

    	            <div class="form-row">
                		<div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
    		                <label>Total Experience</label>
    		                <div class="form-row">
    		                	<div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                    <select class="form-control" required="" name="experience_year">
                                        @for ($i = 1; $i < 21; $i++)
                                        <option value="{{ $i }}">{{ $i }} Years</option>
                                        @endfor
                                    </select>
    	                    	</div>
    	                    	<div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                    <select class="form-control" required="" name="experience_month">
                                        @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}">{{ $i }} Months</option>
                                        @endfor
                                    </select>
    		                    </div>
    		                </div>
    		            </div>
    		            <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
    		            	<label>No of Maintenance Projects</label>
    		                {!! Form::selectRange('support_project', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
    		            </div>
    		            <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
    		            	<label>No of Development Projects</label>
    		                {!! Form::selectRange('development_project', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
    		            </div>
    		        </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Current Location</label>
                            <select name="current_location" class="form-control" required>
                                <option value=""></option>
                                @foreach ($locations as $location)
                                <option value="{{ $location->location_id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Preferred Location</label>
                            <select name="preferred_location" class="form-control" required>
                                <option value=""></option>
                                @foreach ($locations as $location)
                                <option value="{{ $location->location_id }}">{{ $location->name }}</option>
                                @endforeach
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
