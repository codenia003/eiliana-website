@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Education Details</h4>
        <div class="card-body p-4">
	       	<form action="{{ url('/profile/registereducation') }}" method="POST" id="educationForm">
	        	@csrf
	        	<div class="ug-qualification-1">
	        		@forelse ($educations as $education)
	        			@if ($education->graduation_type == 3)
						    <div class="ug-qualification remove-qual-{{ $education->education_id }}">
					        	<span class="h4 text-left mt-3 mb-4 d-inline-block">UG Qualification</span>
								<button type="button" onclick="ConfirmDelete('{{ $education->education_id }}','1')" class="btn btn-outline-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button>
				            	<input type="hidden" name="graduation_type[]" value="3">
				            	<input type="hidden" name="education_id[]" value="{{ $education->education_id }}">
				            	<div class="form-row">
						            <div class="form-group col-4">
						                <label>Education Type</label>
						                <select name="education_type[]" class="form-control" required>
				                            <option value=""></option>
				                            @foreach ($educationtype as $etype)
					                        <option value="{{ $etype->education_type_id }}" {{ ($education->education_type==$etype->education_type_id)? "selected" : "" }} >{{ $etype->name }}</option>
					                        @endforeach
				                        </select>
						            </div>
						            <div class="form-group col-1">
						            </div>
						            <div class="form-group col-7">
						                <label>Institute Name</label>
						                <input type="text" name="name[]" class="form-control" value="{{ $education->name }}" required />
						            </div>
						        </div>
				            	<div class="form-row">
				            		<div class="form-group col-4">
						                <label>Year of Graduation</label>
						                <div class="form-row">
						                	<div class="col">
								                <select name="month[]" class="form-control" required>
						                            <option value=""></option>
						                            <option value="01" selected>01</option>
						                            <option value="02">02</option>
						                            <option value="03">03</option>
						                            <option value="04">04</option>
						                            <option value="05">05</option>
						                            <option value="06">06</option>
						                            <option value="07">07</option>
						                            <option value="08">08</option>
						                            <option value="09">09</option>
						                            <option value="10">10</option>
						                            <option value="11">11</option>
						                            <option value="12">12</option>
						                        </select>
					                    	</div>
					                    	<div class="col">
						                        <select name="year[]" class="form-control" required>
						                            <option value=""></option>
						                            <option value="2016" selected>2016</option>
						                            <option value="2016">2016</option>
						                            <option value="2016">2016</option>
						                            <option value="2016">2016</option>
						                            <option value="2016">2016</option>
						                        </select>
						                    </div>
						                </div>
						            </div>
						            <div class="form-group col-1">
						            </div>
						            <div class="form-group col-7">
						                <label>UG Qualification</label>
						                <!-- <input type="text" name="degree" class="form-control" /> -->
						                <select name="degree[]" class="form-control">
				                            <option value=""></option>
				                            @foreach ($qualifications as $qualification)
					                        @if ($qualification->type == 'UG')
					                        <option value="{{ $qualification->qualification_id }}" {{ ($education->degree==$qualification->qualification_id)? "selected" : "" }} >{{ $qualification->name }}</option>
					                        @endif
					                        @endforeach
				                        </select>
						            </div>
						        </div>
				            </div>
					    @endif
					@empty
	        		<div class="ug-qualification">
			        	<span class="h4 text-left mt-3 mb-4 d-inline-block">UG Qualification</span>
		            	<input type="hidden" name="graduation_type[]" value="3">
		            	<input type="hidden" name="education_id[]" value="0">
		            	<div class="form-row">
				            <div class="form-group col-4">
				                <label>Education Type</label>
				                <select name="education_type[]" class="form-control" required>
		                            <option value=""></option>
		                            @foreach ($educationtype as $etype)
			                        <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
			                        @endforeach
		                        </select>
				            </div>
				            <div class="form-group col-1">
				            </div>
				            <div class="form-group col-7">
				                <label>Institute Name</label>
				                <input type="text" name="name[]" class="form-control" required />
				            </div>
				        </div>
		            	<div class="form-row">
		            		<div class="form-group col-4">
				                <label>Year of Graduation</label>
				                <div class="form-row">
				                	<div class="col">
						                <select name="month[]" class="form-control" required>
				                            <option value=""></option>
				                            <option value="01">01</option>
				                            <option value="02">02</option>
				                            <option value="03">03</option>
				                            <option value="04">04</option>
				                            <option value="05">05</option>
				                        </select>
			                    	</div>
			                    	<div class="col">
				                        <select name="year[]" class="form-control" required>
				                            <option value=""></option>
				                            <option value="2016">2016</option>
				                            <option value="2016">2016</option>
				                            <option value="2016">2016</option>
				                            <option value="2016">2016</option>
				                            <option value="2016">2016</option>
				                        </select>
				                    </div>
				                </div>
				            </div>
				            <div class="form-group col-1">
				            </div>
				            <div class="form-group col-7">
				                <label>UG Qualification</label>
				                <!-- <input type="text" name="degree" class="form-control" /> -->
				                <select name="degree[]" class="form-control" required>
		                            <option value=""></option>
		                            @foreach ($qualifications as $qualification)
			                        @if ($qualification->type == 'UG')
			                        <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
			                        @endif
			                        @endforeach
		                        </select>
				            </div>
				        </div>
		            </div>
		            @endforelse
	        	</div>
	            <div class="mb-5 mt-3">
		        	<button class="btn btn-md btn-info btn-copy-ug" type="button">Add More Ug Qualification</button>
            		<button class="btn btn-md btn-danger btn-copy-ug" type="button"><span class="fa fa-plus"></span></button>
		        </div>
		        <div class="pg-qualification-1">
		        	@forelse ($educations as $education)
	        			@if ($education->graduation_type == 4)
						    <div class="pg-qualification remove-qual-{{ $education->education_id }}">
						    	<span class="h4 text-left mt-3 mb-4 d-inline-block">PG Qualification</span>
								<button type="button" onclick="ConfirmDelete('{{ $education->education_id }}','1')" class="btn btn-outline-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button>

				            	<input type="hidden" name="graduation_type[]" value="4">
				            	<input type="hidden" name="education_id[]" value="{{ $education->education_id }}">
				            	<div class="form-row">
						            <div class="form-group col-4">
						                <label>Education Type</label>
						                <select name="education_type[]" class="form-control">
				                            <option value=""></option>
				                            @foreach ($educationtype as $etype)
					                        <option value="{{ $etype->education_type_id }}" {{ ($education->education_type==$etype->education_type_id)? "selected" : "" }} >{{ $etype->name }}</option>
					                        @endforeach
				                        </select>
						            </div>
						            <div class="form-group col-1">
						            </div>
						            <div class="form-group col-7">
						                <label>Institute Name</label>
						                <input type="text" name="name[]" class="form-control" value="{{ $education->name }}" />
						            </div>
						        </div>
				            	<div class="form-row">
				            		<div class="form-group col-4">
						                <label>Year of Graduation</label>
						                <div class="form-row">
						                	<div class="col">
								                <select name="month[]" class="form-control" required>
						                            <option value=""></option>
						                            <option value="01" selected>01</option>
						                            <option value="02">02</option>
						                            <option value="03">03</option>
						                            <option value="04">04</option>
						                            <option value="05">05</option>
						                        </select>
					                    	</div>
					                    	<div class="col">
						                        <select name="year[]" class="form-control" required>
						                            <option value=""></option>
						                            <option value="2016" selected>2016</option>
						                            <option value="2016">2016</option>
						                            <option value="2016">2016</option>
						                            <option value="2016">2016</option>
						                            <option value="2016">2016</option>
						                        </select>
						                    </div>
						                </div>
						            </div>
						            <div class="form-group col-1">
						            </div>
						            <div class="form-group col-7">
						                <label>PG Qualification</label>
						                <!-- <input type="text" name="degree" class="form-control" /> -->
						                <select name="degree[]" class="form-control">
				                            <option value=""></option>
				                            @foreach ($qualifications as $qualification)
					                        @if ($qualification->type == 'PG')
					                        <option value="{{ $qualification->qualification_id }}" {{ ($education->degree==$qualification->qualification_id)? "selected" : "" }} >{{ $qualification->name }}</option>
					                        @endif
					                        @endforeach
				                        </select>
						            </div>
						        </div>
				            </div>
					    @endif
					@empty
		            <div class="pg-qualification">
		            	<span class="h4 text-left mt-3 mb-4 d-inline-block">PG Qualification</span>
		            	<input type="hidden" name="graduation_type[]" value="4">
		            	<input type="hidden" name="education_id[]" value="0">
		            	<div class="form-row">
				            <div class="form-group col-4">
				                <label>Education Type</label>
				                <select name="education_type[]" class="form-control" required>
		                            <option value=""></option>
		                            @foreach ($educationtype as $etype)
			                        <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
			                        @endforeach
		                        </select>
				            </div>
				            <div class="form-group col-1">
				            </div>
				            <div class="form-group col-7">
				                <label>Institute Name</label>
				                <input type="text" name="name[]" class="form-control" required/>
				            </div>
				        </div>
		            	<div class="form-row">
		            		<div class="form-group col-4">
				                <label>Year of Graduation</label>
				                <div class="form-row">
				                	<div class="col">
						                <select name="month[]" class="form-control" required>
				                            <option value=""></option>
				                            <option value="01">01</option>
				                            <option value="02">02</option>
				                            <option value="03">03</option>
				                            <option value="04">04</option>
				                            <option value="05">05</option>
				                        </select>
			                    	</div>
			                    	<div class="col">
				                        <select name="year[]" class="form-control" required>
				                            <option value=""></option>
				                            <option value="2016">2016</option>
				                            <option value="2016">2016</option>
				                            <option value="2016">2016</option>
				                            <option value="2016">2016</option>
				                            <option value="2016">2016</option>
				                        </select>
				                    </div>
				                </div>
				            </div>
				            <div class="form-group col-1">
				            </div>
				            <div class="form-group col-7">
				                <label>PG Qualification</label>
				                <!-- <input type="text" name="degree" class="form-control" /> -->
				                <select name="degree[]" class="form-control" required>
		                            <option value=""></option>
		                            @foreach ($qualifications as $qualification)
			                        @if ($qualification->type == 'UG')
			                        <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
			                        @endif
			                        @endforeach
		                        </select>
				            </div>
				        </div>
		            </div>
		            @endforelse
		       	</div>
	            <div class="mt-3">
	            	<button class="btn btn-md btn-info btn-copy-pg" type="button">Add More PG Qualification</button>
	            	<button class="btn btn-md btn-danger btn-copy-pg" type="button"><span class="fa fa-plus"></span></button>
                </div>
	            <div class="form-group text-right mt-5">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" type="submit">
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
<div class="ug-qualification-2 d-none">
	<span class="h4 text-left mt-3 mb-4 d-inline-block">UG Qualification</span>
	<button type="button" class="remove-ug btn btn-outline-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button>
	
	<input type="hidden" name="graduation_type[]" value="3">
	<input type="hidden" name="education_id[]" value="0">
	<div class="form-row">
        <div class="form-group col-4">
            <label>Education Type</label>
            <select name="education_type[]" class="form-control" required>
                <option value=""></option>
                @foreach ($educationtype as $etype)
                <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-1">
        </div>
        <div class="form-group col-7">
            <label>Institute Name</label>
            <input type="text" name="name[]" class="form-control" required />
        </div>
    </div>
	<div class="form-row">
		<div class="form-group col-4">
            <label>Year of Graduation</label>
            <div class="form-row">
            	<div class="col">
	                <select name="month[]" class="form-control" required>
                        <option value=""></option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                    </select>
            	</div>
            	<div class="col">
                    <select name="year[]" class="form-control" required>
                        <option value=""></option>
                        <option value="2016">2016</option>
                        <option value="2016">2016</option>
                        <option value="2016">2016</option>
                        <option value="2016">2016</option>
                        <option value="2016">2016</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-1">
        </div>
        <div class="form-group col-7">
            <label>UG Qualification</label>
            <!-- <input type="text" name="degree" class="form-control" /> -->
            <select name="degree[]" class="form-control" required>
                <option value=""></option>
                @foreach ($qualifications as $qualification)
                @if ($qualification->type == 'UG')
                <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="pg-qualification-2 d-none">
	<span class="h4 text-left mt-3 mb-4 d-inline-block">PG Qualification</span>
	<button type="button" class="remove-pg btn btn-outline-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button>
	<input type="hidden" name="graduation_type[]" value="4">
	<input type="hidden" name="education_id[]" value="0">
	<div class="form-row">
        <div class="form-group col-4">
            <label>Education Type</label>
            <select name="education_type[]" class="form-control" required>
                <option value=""></option>
                @foreach ($educationtype as $etype)
                <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-1">
        </div>
        <div class="form-group col-7">
            <label>Institute Name</label>
            <input type="text" name="name[]" class="form-control" required/>
        </div>
    </div>
	<div class="form-row">
		<div class="form-group col-4">
            <label>Year of Graduation</label>
            <div class="form-row">
            	<div class="col">
	                <select name="month[]" class="form-control" required>
                        <option value=""></option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                    </select>
            	</div>
            	<div class="col">
                    <select name="year[]" class="form-control" required>
                        <option value=""></option>
                        <option value="2016">2016</option>
                        <option value="2016">2016</option>
                        <option value="2016">2016</option>
                        <option value="2016">2016</option>
                        <option value="2016">2016</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-1">
        </div>
        <div class="form-group col-7">
            <label>PG Qualification</label>
            <!-- <input type="text" name="degree" class="form-control" /> -->
            <select name="degree[]" class="form-control" required>
                <option value=""></option>
                @foreach ($qualifications as $qualification)
                @if ($qualification->type == 'PG')
                <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
@stop