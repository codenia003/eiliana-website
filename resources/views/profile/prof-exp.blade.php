@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Professional Experience</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registerprofexp') }}" method="POST" id="registerprofexpForm">
            	@csrf
                <div class="form-row">
                    <div class="form-group col">
    	                <label>Video Intro URL</label>
    	                <input type="text" name="introvideourl" class="form-control" />
    	            </div>

    	            <div class="form-group col">
    	                <label>Key Skills</label>
    	                <input type="text" name="skillname" class="form-control" />
    	            </div>
                </div>
	            <div class="form-group">
                    <label>Technology Preference</label>
                    <select name="technology" class="form-control" required>
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
                
	            <div class="form-row">
            		<div class="form-group col-4">
		                <label>Total Experience</label>
		                <div class="form-row">
		                	<div class="col">
                                <select class="form-control" required="" name="year[]">
                                    @for ($i = 1; $i < 21; $i++)
                                    <option value="{{ $i }}">{{ $i }} Years</option>
                                    @endfor
                                </select>
	                    	</div>
	                    	<div class="col">
                                <select class="form-control" required="" name="month[]">
                                    @for ($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ $i }} Months</option>
                                    @endfor
                                </select>
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