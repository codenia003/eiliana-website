@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title profile_text"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2 profile_text">Education Details</span>
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
        <h4 class="card-header text-left">Education Details</h4>
        <div class="card-body p-4">
	       	<form action="{{ url('/profile/registereducation') }}" method="POST" id="educationForm">
	        	@csrf
	        	<div class="ug-qualification-1">
	        		@forelse ($ug_educations as $education)
                        <div class="ug-qualification-3 remove-qual-{{ $education->education_id }}">
                            <span class="h4 text-left mt-3 mb-4 d-inline-block">Under Graducation</span>
                            <!-- <button type="button" onclick="ConfirmDelete('{{ $education->education_id }}','1')" class="btn btn-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button> -->
                            <input type="hidden" name="graduation_type[]" value="3">
                            <input type="hidden" name="education_id[]" id="education_id" value="{{ $education->education_id }}">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>Under Graducation</label>
                                    <select name="degree[]" class="form-control">
                                        <option value=""></option>
                                        @foreach ($qualifications as $qualification)
                                        @if ($qualification->type == 'UG')
                                        <option value="{{ $qualification->qualification_id }}" {{ ($education->degree==$qualification->qualification_id)? "selected" : "" }} >{{ $qualification->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
                                    <label>University Name</label>
                                    <select name="name[]" class="form-control">
                                        <option value=""></option>
                                        @foreach ($universities as $university)
                                        <option value="{{ $university->university_id }}" {{ ($education->name==$university->university_id)? "selected" : "" }} >{{ $university->name }}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" name="name[]" class="form-control" value="{{ $education->name }}" required /> -->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>Year of Graduation</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <select class="form-control" required="" name="month[]">
                                                <option value="">From</option>
                                                @for ($i = 2000; $i < 2021; $i++)
                                                <option value="{{ $i }}" {{ ($education->month==$i)? "selected" : "" }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" required="" name="year[]">
                                                <option value="">Till</option>
                                                @for ($i = 2000; $i < 2021; $i++)
                                                <option value="{{ $i }}" {{ ($education->year==$i)? "selected" : "" }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
                                    <label>Education Type</label>
                                    <select name="education_type[]" class="form-control" required>
                                        <option value=""></option>
                                        @foreach ($educationtype as $etype)
                                        <option value="{{ $etype->education_type_id }}" {{ ($education->education_type==$etype->education_type_id)? "selected" : "" }} >{{ $etype->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
					@empty
	        		<div class="ug-qualification">
			        	<span class="h4 text-left mt-3 mb-4 d-inline-block">Under Graducation</span>
		            	<input type="hidden" name="graduation_type[]" value="3">
		            	<input type="hidden" name="education_id[]" value="0">
		            	<div class="form-row">
				            <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
				                <label>Under Graducation</label>
				                <select name="degree[]" required="" class="form-control" >
		                            <option value=""></option>
		                            @foreach ($qualifications as $qualification)
			                        @if ($qualification->type == 'UG')
			                        <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
			                        @endif
			                        @endforeach
		                        </select>
				            </div>
				            <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
				            </div>
				            <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
				                <label>University Name</label>
				                <select name="name[]" class="form-control">
		                            <option value=""></option>
		                            @foreach ($universities as $university)
			                        <option value="{{ $university->university_id }}">{{ $university->name }}</option>
			                        @endforeach
		                        </select>
				                <!-- <input type="text" name="name[]" class="form-control" required /> -->
				            </div>
				        </div>
		            	<div class="form-row">
				            <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
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
				            <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
				            </div>
				            <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
				            	<label>Education Type</label>
				                <select name="education_type[]" required="" class="form-control">
		                            <option value=""></option>
		                            @foreach ($educationtype as $etype)
			                        <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
			                        @endforeach
		                        </select>
				            </div>
				        </div>
		            </div>
		            @endforelse
	        	</div>
	            <div class="btn-group mb-3 mt-3" role="group">
		        	<button class="btn btn-md btn-info btn-copy-ug" type="button">Add Education <span class="fa fa-plus"></span></button>
            		<!-- <button class="btn btn-md btn-danger btn-copy-ug" type="button"></button> -->

            		<button type="button" class="remove-ug btn btn-md btn-info ml-3 rounded-0">Erase Education <span class="fas fa-times"></span></button>
		        </div>
		        <div class="pg-qualification-1">
		        	@forelse ($pg_educations as $education)
                        <div class="pg-qualification-3 remove-qual-{{ $education->education_id }}">
                            <span class="h4 text-left mt-3 mb-4 d-inline-block">Post Graducation</span>
                            <!-- <button type="button" onclick="ConfirmDelete('{{ $education->education_id }}','1')" class="btn btn-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button> -->

                            <input type="hidden" name="graduation_type[]" value="4">
                            <input type="hidden" name="education_id[]" id="education_id" value="{{ $education->education_id }}">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>Post Graducation</label>
                                    <select name="degree[]" class="form-control">
                                        <option value=""></option>
                                        @foreach ($qualifications as $qualification)
                                        @if ($qualification->type == 'PG')
                                        <option value="{{ $qualification->qualification_id }}" {{ ($education->degree==$qualification->qualification_id)? "selected" : "" }} >{{ $qualification->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
                                    <label>University Name</label>
                                    <!-- <input type="text" name="name[]" class="form-control" value="{{ $education->name }}" /> -->
                                    <select name="name[]" class="form-control">
                                        <option value=""></option>
                                        @foreach ($universities as $university)
                                        <option value="{{ $university->university_id }}" {{ ($education->name==$university->university_id)? "selected" : "" }} >{{ $university->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>Year of Graduation</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <select class="form-control" required="" name="month[]">
                                                <option value="">From</option>
                                                @for ($i = 2000; $i < 2021; $i++)
                                                <option value="{{ $i }}" {{ ($education->month==$i)? "selected" : "" }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" required="" name="year[]">
                                                <option value="">Till</option>
                                                @for ($i = 2000; $i < 2021; $i++)
                                                <option value="{{ $i }}" {{ ($education->year==$i)? "selected" : "" }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
                                    <label>Education Type</label>
                                    <select name="education_type[]" class="form-control">
                                        <option value=""></option>
                                        @foreach ($educationtype as $etype)
                                        <option value="{{ $etype->education_type_id }}" {{ ($education->education_type==$etype->education_type_id)? "selected" : "" }} >{{ $etype->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
					@empty
                        <div class="pg-qualification">
                            <span class="h4 text-left mt-3 mb-4 d-inline-block">Post Graducation</span>
                            <input type="hidden" name="graduation_type[]" value="4">
                            <input type="hidden" name="education_id[]" value="0">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>Post Graducation</label>
                                    <select name="degree[]" class="form-control">
                                        <option value=""></option>
                                        @foreach ($qualifications as $qualification)
                                        @if ($qualification->type == 'UG')
                                        <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
                                    <label>University Name</label>
                                    <select name="name[]" class="form-control">
                                        <option value=""></option>
                                        @foreach ($universities as $university)
                                        <option value="{{ $university->university_id }}">{{ $university->name }}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" name="name[]" class="form-control" required/> -->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>Year of Graduation</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <select class="form-control" name="month[]">
                                                <option value="">From</option>
                                                @for ($i = 2000; $i < 2021; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" name="year[]">
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
                                <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
                                    <label>Education Type</label>
                                    <select name="education_type[]" class="form-control">
                                        <option value=""></option>
                                        @foreach ($educationtype as $etype)
                                        <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
		            @endforelse
		       	</div>
	            <div class="btn-group mt-3" role="group">
	            	<button class="btn btn-md btn-info btn-copy-pg" type="button">Add Education <span class="fa fa-plus"></span></button>
	            	<!-- <button class="btn btn-md btn-danger btn-copy-pg" type="button"></button> -->
	            	<button type="button" class="remove-pg btn btn-md btn-info ml-3 rounded-0">Erase Education <span class="fas fa-times"></span></button>
                </div>
	            <div class="form-group text-right mt-5">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" type="submit">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            Next >>>
                        </button>
                        <!-- <button class="btn btn-primary" type="reset">Discard</button> -->
                    </div>
                </div>
	        </form>
        </div>
    </div>
</div>
<div class="ug-qualification-2 d-none">
	<span class="h4 text-left mt-3 mb-4 d-inline-block">Under Graducation</span>
	<!-- <button type="button" class="remove-ug btn btn-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button> -->

	<input type="hidden" name="graduation_type[]" value="3">
	<input type="hidden" name="education_id[]" id="education_id" value="0">
	<div class="form-row">
        <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
            <label>Under Graducation</label>
            <select name="degree[]" required="" class="form-control">
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
        <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
            <label>University Name</label>
            <select name="name[]" class="form-control">
	            <option value=""></option>
	            @foreach ($universities as $university)
	            <option value="{{ $university->university_id }}">{{ $university->name }}</option>
	            @endforeach
	        </select>
        </div>
    </div>
	<div class="form-row">
		<div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
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
        <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
        	<label>Education Type</label>
            <select name="education_type[]" class="form-control" required="">
                <option value=""></option>
                @foreach ($educationtype as $etype)
                <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="pg-qualification-2 d-none">
	<span class="h4 text-left mt-3 mb-4 d-inline-block">Post Graducation</span>
	<!-- <button type="button" class="remove-pg btn btn-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button> -->
	<input type="hidden" name="graduation_type[]" value="4">
	<input type="hidden" name="education_id[]" id="education_id" value="0">
	<div class="form-row">
        <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
            <label>Post Graducation</label>
            <select name="degree[]" class="form-control" required>
                <option value=""></option>
                @foreach ($qualifications as $qualification)
                @if ($qualification->type == 'PG')
                <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-1">
        </div>
        <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
            <label>University Name</label>
            <select name="name[]" class="form-control">
                <option value=""></option>
                @foreach ($universities as $university)
                <option value="{{ $university->university_id }}">{{ $university->name }}</option>
                @endforeach
            </select>
            <!-- <input type="text" name="name[]" class="form-control" required/> -->
        </div>
    </div>
	<div class="form-row">
		<div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
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
        <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
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
@stop
