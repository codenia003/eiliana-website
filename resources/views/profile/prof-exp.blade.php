@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Professional Experience</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registerprofexp') }}" method="POST" id="registerprofexpForm">
            	<div class="form-group">
	                <label>Video Intro URL</label>
	                <input type="text" name="introvideourl" class="form-control" />
	            </div>

	            <div class="form-group">
	                <label>Skills</label>
	                <input type="text" name="skillname" class="form-control" />
	            </div>
	            <div class="form-group">
	            	<label>Looking to develop/Advance Search</label>
	                <select name="looking" class="form-control" required>
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
	            </div>
	            <div class="form-group basic-info">
                    <label>Model Of Engagement</label>
                    <br>
                    <div class="form-check form-check-inline">
					  	<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
					  	<label class="form-check-label" for="inlineCheckbox1">Hourly</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
					  	<label class="form-check-label" for="inlineCheckbox2">Retainership</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
					  	<label class="form-check-label" for="inlineCheckbox3">Project-based</label>
					</div>
                </div>
                <div class="form-group">
	            	<label>Technology Preference</label>
	                <select name="looking" class="form-control" required>
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
	            </div>
	            <div class="form-row">
            		<div class="form-group col-4">
		                <label>Total Experience</label>
		                <div class="form-row">
		                	<div class="col">
				                {!! Form::selectMonth('month[]', null, ['class' => 'form-control','required' =>'']) !!}
	                    	</div>
	                    	<div class="col">
		                        {!! Form::selectRange('year[]', 2000, 2020, null, ['class' => 'form-control','required' =>'']) !!}
		                    </div>
		                </div>
		            </div>
		            <div class="form-group col-4">
		            	<label>No of Support Projects</label>
		                {!! Form::selectRange('year[]', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
		            </div>
		            <div class="form-group col-4">
		            	<label>No of Development Projects</label>
		                {!! Form::selectRange('year[]', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
		            </div>
		        </div>
		        <div class="form-group">
    				<label for="exampleFormControlTextarea1">Project Details</label>
    				<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  				</div>

  				<div class="form-group basic-info">
                    <label>Project Type</label>
                    <div class="form-check form-check-inline ml-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Development" class="custom-control-input" name="title" value="Development">
                            <label class="custom-control-label" for="Development">Development</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Support" class="custom-control-input" name="title" value="Support">
                            <label class="custom-control-label" for="Support">Support</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
	                <label>Duration</label>
	                <input type="text" name="duration" class="form-control" />
	            </div>

	            <div class="form-group">
	            	<label>Framework</label>
	                <select name="looking" class="form-control" required>
                        <option value=""></option>
                        <option value="1">Core PHP</option>
                        <option value="2">Laravel</option>
                    </select>
	            </div>

	            <div class="form-row">
            		<div class="form-group col-5">
		                <label>Version</label>
		                {!! Form::selectRange('version', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
		            </div>
		            <div class="form-group col-2">
		            </div>
		            <div class="form-group col-5">
		            	<label>Industry that Product was designed for</label>
		                <select name="education_type[]" class="form-control">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
		            </div>
		        </div>

		        <div class="form-group basic-info">
                    <label>Project Type</label>
                    <div class="form-check form-check-inline ml-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Development" class="custom-control-input" name="title" value="Development">
                            <label class="custom-control-label" for="Development">Development</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Support" class="custom-control-input" name="title" value="Support">
                            <label class="custom-control-label" for="Support">Support</label>
                        </div>
                    </div>
                </div>
                <div class="form-group basic-file">
	                <label>Project Upload</label>
	                <div class="custom-file">
					  	<input type="file" class="custom-file-input" id="customFile">
					  	<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
					</div>
                <div class="form-group text-right mt-5">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            Save Details
                        </button>
                        <!-- <button class="btn btn-outline-primary" type="reset">Discard</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop