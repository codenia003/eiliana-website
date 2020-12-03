@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Projects</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registerprojects') }}" method="POST" id="registerprojectsForm">
                @csrf
                <div class="project-1">
                    @forelse ($projects as $project)
                        <div class="project-3">
                            <span class="h4 text-left mt-3 mb-4 d-inline-block">Project</span>
                            <input type="hidden" name="project_id[]" value="0">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" name="name" class="form-control" />
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
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Duration</label>
                                    <input type="text" name="duration" class="form-control" />
                                </div>

                                <div class="form-group col">
                                    <label>Framework</label>
                                    <select name="framework" class="form-control" required>
                                        <option value=""></option>
                                        <option value="1">Core PHP</option>
                                        <option value="2">Laravel</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Version</label>
                                    {!! Form::selectRange('version', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
                                </div>
                                <div class="form-group col">
                                    <label>Industry that Product was designed for</label>
                                    <select name="education_type[]" class="form-control">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Project Details</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="form-group basic-file">
                                <label>Project Upload</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="project-3">
                            <span class="h4 text-left mt-3 mb-4 d-inline-block">Project</span>
                            <input type="hidden" name="project_id[]" value="0">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" name="name" class="form-control" />
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
			  				<div class="form-row">
    			                <div class="form-group col">
    				                <label>Duration</label>
    				                <input type="text" name="duration" class="form-control" />
    				            </div>

    				            <div class="form-group col">
    				            	<label>Framework</label>
    				                <select name="framework" class="form-control" required>
    			                        <option value=""></option>
    			                        <option value="1">Core PHP</option>
    			                        <option value="2">Laravel</option>
    			                    </select>
    				            </div>
                            </div>

				            <div class="form-row">
			            		<div class="form-group col">
					                <label>Version</label>
					                {!! Form::selectRange('version', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
					            </div>
					            <div class="form-group col">
					            	<label>Industry that Product was designed for</label>
					                <select name="education_type[]" class="form-control">
			                            <option value=""></option>
			                            <option value="1">1</option>
			                            <option value="2">2</option>
			                            <option value="3">3</option>
			                        </select>
					            </div>
					        </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Project Details</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
			                <div class="form-group basic-file">
				                <label>Project Upload</label>
				                <div class="custom-file">
								  	<input type="file" class="custom-file-input" id="customFile">
								  	<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
							</div>
                        </div>
                    @endforelse
                </div>
                <div class="mt-3">
                    <button class="btn btn-md btn-info btn-copy-p" type="button">Add More project</button>
                    <button class="btn btn-md btn-danger btn-copy-p" type="button"><span class="fa fa-plus"></span></button>
                    <button type="button" class="remove-p btn btn-danger ml-3 rounded-0"><i class="fas fa-times"></i></button>
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
<div class="project-2 d-none">
    <span class="h4 text-left mt-3 mb-4 d-inline-block">Project</span>
    <input type="hidden" name="project_id[]" value="0">
    <div class="form-group">
        <label>Project Name</label>
        <input type="text" name="name" class="form-control" />
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
    <div class="form-row">
        <div class="form-group col">
            <label>Duration</label>
            <input type="text" name="duration" class="form-control" />
        </div>

        <div class="form-group col">
            <label>Framework</label>
            <select name="framework" class="form-control" required>
                <option value=""></option>
                <option value="1">Core PHP</option>
                <option value="2">Laravel</option>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col">
            <label>Version</label>
            {!! Form::selectRange('version', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
        </div>
        <div class="form-group col">
            <label>Industry that Product was designed for</label>
            <select name="education_type[]" class="form-control">
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Project Details</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group basic-file">
        <label>Project Upload</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>
</div>
@stop