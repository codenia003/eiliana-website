@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Project Schedule</span>
            <!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
       <div class="bg-blue">
         <div class="px-5 py-2">
           
            <!-- <span class="border-title"><i class="fa fa-bars"></i></span> -->
            <span class="h5 text-white" style="margin-left: -25px;">Project Schedule</span>
            <!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
         
        </div>
      </div> 
        <!-- <h4 class="card-header text-left">Education Details</h4> -->
        <div class="card-body p-4">
	       	<form action="{{ url('/profile/registereducation') }}" method="POST" id="educationForm">
	        	@csrf
	        	<div class="ug-qualification-1">
	        		
                    <div class="ug-qualification-3 remove-qual">
                        <!-- <span class="h4 text-left mt-3 mb-4 d-inline-block">UG Qualification</span> -->
                        <input type="hidden" name="graduation_type[]" value="3">
                        <input type="hidden" name="education_id[]" id="education_id" value="">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Project Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label>Project Id</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Year of Graduation</label>
                                <div class="form-row">
                                    <div class="col">
                                        <select class="form-control" required="" name="month[]">
                                            <option value="">From</option>
                                            
                                            <option value="" ></option>
                                            
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" required="" name="year[]">
                                            <option value="">Till</option>
                                            
                                            <option value="" ></option>
                                            
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
                                    
                                    <option value="" ></option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
					  
	        		<div class="ug-qualification">
			        	<span class="h4 text-left mt-3 mb-4 d-inline-block">UG Qualification</span>
		            	<input type="hidden" name="graduation_type[]" value="3">
		            	<input type="hidden" name="education_id[]" value="0">
		            	<div class="form-row">
				            <div class="form-group col-4">
				                <label>UG Qualification</label>
				                <select name="degree[]" class="form-control" required>
		                            <option value=""></option>
		                           
			                        <option value=""></option>
			                       
		                        </select>
				            </div>
				            <div class="form-group col-1">
				            </div>
				            <div class="form-group col-7">
				                <label>University Name</label>
				                <select name="name[]" class="form-control">
		                            <option value=""></option>
		                           
			                        <option value=""></option>
			                       
		                        </select>
				                <!-- <input type="text" name="name[]" class="form-control" required /> -->
				            </div>
				        </div>
		            	<div class="form-row">
				            <div class="form-group col-4">
				                <label>Year of Graduation</label>
				                <div class="form-row">
				                	<div class="col">
						                <select class="form-control" required="" name="month[]">
	                                        <option value="">From</option>
	                                        
	                                        <option value=""></option>
	                                        
	                                    </select>
			                    	</div>
			                    	<div class="col">
			                    		<select class="form-control" required="" name="year[]">
	                                        <option value="">Till</option>
	                                        
	                                        <option value=""></option>
	                                        
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
		                            
			                        <option value=""></option>
			                        
		                        </select>
				            </div>
				        </div>
		            </div>
		           
	        	</div>
	            <div class="mb-3 mt-3">
		        	<button class="btn btn-md btn-info btn-copy-ug" type="button">Add Education <span class="fa fa-plus"></span></button>
            		<!-- <button class="btn btn-md btn-danger btn-copy-ug" type="button"></button> -->

            		<button type="button" class="remove-ug btn btn-md btn-info ml-3 rounded-0">Erase Education <span class="fas fa-times"></span></button>
		        </div>
		        <div class="pg-qualification-1">
		        	
						    <div class="pg-qualification-3 remove-qual">
						    	<span class="h4 text-left mt-3 mb-4 d-inline-block">PG Qualification</span>
								

				            	<input type="hidden" name="graduation_type[]" value="4">
				            	<input type="hidden" name="education_id[]" id="education_id" value="">
				            	<div class="form-row">
						            <div class="form-group col-4">
						                <label>PG Qualification</label>
						                <select name="degree[]" class="form-control">
				                            <option value=""></option>
				                            
					                        <option value=""  ></option>
					                       
				                        </select>
						            </div>
						            <div class="form-group col-1">
						            </div>
						            <div class="form-group col-7">
						                <label>University Name</label>
						                
						                <select name="name[]" class="form-control">
				                            <option value=""></option>
				                           
					                        <option value=""  ></option>
					                       
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
			                                        
			                                        <option value="" ></option>
			                                        
			                                    </select>
					                    	</div>
					                    	<div class="col">
					                    		<select class="form-control" required="" name="year[]">
			                                        <option value="">Till</option>
			                                        
			                                        <option value="" ></option>
			                                       
			                                    </select>
						                    </div>
						                </div>
						            </div>
						            <div class="form-group col-1">
						            </div>
						            <div class="form-group col-7">
						            	<label>Education Type</label>
						                <select name="education_type[]" class="form-control">
				                            <option value=""></option>
				                           
					                        <option value="" ></option>
					                        
				                        </select>
						            </div>
						        </div>
				            </div>
					   
		            <div class="pg-qualification">
		            	<span class="h4 text-left mt-3 mb-4 d-inline-block">PG Qualification</span>
		            	<input type="hidden" name="graduation_type[]" value="4">
		            	<input type="hidden" name="education_id[]" value="0">
		            	<div class="form-row">
				            <div class="form-group col-4">
				                <label>PG Qualification</label>
				                <select name="degree[]" class="form-control" required>
		                            <option value=""></option>
		                            
			                        <option value=""></option>
			                       
		                        </select>
				            </div>
				            <div class="form-group col-1">
				            </div>
				            <div class="form-group col-7">
				                <label>University Name</label>
				                <select name="name[]" class="form-control">
		                            <option value=""></option>
		                            
			                        <option value=""></option>
			                       
		                        </select>
				                <!-- <input type="text" name="name[]" class="form-control" required/> -->
				            </div>
				        </div>
		            	<div class="form-row">
		            		<div class="form-group col-4">
				                <label>Year of Graduation</label>
				                <div class="form-row">
				                	<div class="col">
						                <select class="form-control" required="" name="month[]">
	                                        <option value="">From</option>
	                                        
	                                        <option value=""></option>
	                                        
	                                    </select>
			                    	</div>
			                    	<div class="col">
			                    		<select class="form-control" required="" name="year[]">
	                                        <option value="">Till</option>
	                                        
	                                        <option value=""></option>
	                                        
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
		                            
			                        <option value=""></option>
			                       
		                        </select>
				            </div>
				        </div>
		            </div>
		            
		       	</div>
	            <div class="mt-3">
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
	<span class="h4 text-left mt-3 mb-4 d-inline-block">UG Qualification</span>
	<!-- <button type="button" class="remove-ug btn btn-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button> -->

	<input type="hidden" name="graduation_type[]" value="3">
	<input type="hidden" name="education_id[]" id="education_id" value="0">
	<div class="form-row">
        <div class="form-group col-4">
            <label>UG Qualification</label>
            <select name="degree[]" class="form-control" required>
                <option value=""></option>
                
                <option value=""></option>
               
            </select>
        </div>
        <div class="form-group col-1">
        </div>
        <div class="form-group col-7">
            <label>University Name</label>
            <select name="name[]" class="form-control">
	            <option value=""></option>
	            
	            <option value=""></option>
	            
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
                       
                        <option value=""></option>
                       
                    </select>
            	</div>
            	<div class="col">
            		<select class="form-control" required="" name="year[]">
                        <option value="">Till</option>
                       
                        <option value=""></option>
                        
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
                
                <option value=""></option>
                
            </select>
        </div>
    </div>
</div>
<div class="pg-qualification-2 d-none">
	<span class="h4 text-left mt-3 mb-4 d-inline-block">PG Qualification</span>
	<!-- <button type="button" class="remove-pg btn btn-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button> -->
	<input type="hidden" name="graduation_type[]" value="4">
	<input type="hidden" name="education_id[]" id="education_id" value="0">
	<div class="form-row">
        <div class="form-group col-4">
            <label>PG Qualification</label>
            <select name="degree[]" class="form-control" required>
                <option value=""></option>
               
                <option value=""></option>
               
            </select>
        </div>
        <div class="form-group col-1">
        </div>
        <div class="form-group col-7">
            <label>University Name</label>
            <select name="name[]" class="form-control">
                <option value=""></option>
                
                <option value=""></option>
                
            </select>
            <!-- <input type="text" name="name[]" class="form-control" required/> -->
        </div>
    </div>
	<div class="form-row">
		<div class="form-group col-4">
            <label>Year of Graduation</label>
            <div class="form-row">
            	<div class="col">
	                <select class="form-control" required="" name="month[]">
                        <option value="">From</option>
                        
                        <option value=""></option>
                        
                    </select>
            	</div>
            	<div class="col">
            		<select class="form-control" required="" name="year[]">
                        <option value="">Till</option>
                        
                        <option value=""></option>
                        
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
                
                <option value=""></option>
                
            </select>
        </div>
    </div>
</div>
@stop
