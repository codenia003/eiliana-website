@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Education Details</h4>
        <div class="card-body p-4">
        	<div class="ug-qualification">
	        	<h4 class="text-left mt-3 mb-4">UG Qualification</h4>
	            <form action="{{ url('/profile/registerEducation') }}" method="POST" id="educationForm">
	            	@csrf
	            	<div class="form-row">
			            <div class="form-group col-4">
			                <label>Education Type</label>
			                <select name="education_type" class="form-control">
	                            <option value=""></option>
	                            <option value="NA">NAC</option>
	                        </select>
			            </div>
			            <div class="form-group col-8">
			                <label>Institute Name</label>
			                <input type="text" name="name" class="form-control" />
			            </div>
			        </div>
	            	<div class="form-row">
	            		<div class="form-group col-4">
			                <label>Year of Graduation</label>
			                <div class="form-row">
			                	<div class="col">
					                <select name="month" class="form-control">
			                            <option value=""></option>
			                            <option value="NA">NAC</option>
			                        </select>
		                    	</div>
		                    	<div class="col">
			                        <select name="year" class="form-control">
			                            <option value=""></option>
			                            <option value="NA">NAC</option>
			                        </select>
			                    </div>
			                </div>
			            </div>
			            <div class="form-group col-8">
			                <label>UG Qualification</label>
			                <!-- <input type="text" name="degree" class="form-control" /> -->
			                <select name="degree" class="form-control">
	                            <option value=""></option>
	                            <option value="NA">NAC</option>
	                        </select>
			            </div>
			        </div>
		            
	                <div class="form-group text-right mt-5">
	                    <div class="btn-group" role="group">
	                        <button class="btn btn-primary">
	                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
	                            Save Details
	                        </button>
	                        <button class="btn btn-outline-primary" type="reset">Discard</button>
	                    </div>
	                </div>
	            </form>
	            <button class="btn btn-md btn-info">Add More PG Qualification</button>
	            <button class="btn btn-md btn-danger"><span class="fa fa-plus"></span></button>
            </div>
            <div class="pg-qualification">
            	<h4 class="text-left mt-3 mb-4">PG Qualification</h4>
	            <form action="{{ url('/profile/registerEducation') }}" method="POST" id="educationForm">
	            	@csrf
	            	<div class="form-row">
			            <div class="form-group col-4">
			                <label>Education Type</label>
			                <select name="education_type" class="form-control">
	                            <option value=""></option>
	                            <option value="NA">NAC</option>
	                        </select>
			            </div>
			            <div class="form-group col-8">
			                <label>Institute Name</label>
			                <input type="text" name="name" class="form-control" />
			            </div>
			        </div>
	            	<div class="form-row">
	            		<div class="form-group col-4">
			                <label>Year of Graduation</label>
			                <div class="form-row">
			                	<div class="col">
					                <select name="month" class="form-control">
			                            <option value=""></option>
			                            <option value="NA">NAC</option>
			                        </select>
		                    	</div>
		                    	<div class="col">
			                        <select name="year" class="form-control">
			                            <option value=""></option>
			                            <option value="NA">NAC</option>
			                        </select>
			                    </div>
			                </div>
			            </div>
			            <div class="form-group col-8">
			                <label>PG Qualification</label>
			                <!-- <input type="text" name="degree" class="form-control" /> -->
			                <select name="degree" class="form-control">
	                            <option value=""></option>
	                            <option value="NA">NAC</option>
	                        </select>
			            </div>
			        </div>
	                <div class="form-group text-right mt-5">
	                    <div class="btn-group" role="group">
	                        <button class="btn btn-primary">
	                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
	                            Save Details
	                        </button>
	                        <button class="btn btn-outline-primary" type="reset">Discard</button>
	                    </div>
	                </div>
	            </form>
	            <button class="btn btn-md btn-info">Add More PG Qualification</button>
	            <button class="btn btn-md btn-danger"><span class="fa fa-plus"></span></button>
            </div>
        </div>
    </div>
</div>
@stop