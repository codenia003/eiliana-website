@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Projects</span>
            <!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Projects</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registerprojects') }}" method="POST" id="registerprojectsForm" enctype="multipart/form-data">
                @csrf
                <div class="project-1">
                    @forelse ($projects as $key => $project)
                        <div class="project-3">
                            <!-- <span class="h4 text-left mt-3 mb-4 d-inline-block">Project</span> -->
                            <input type="hidden" name="user_project_id[]" id="user_project_id" value="{{ $project->user_project_id }}">
                            <input type="hidden" name="tech_project_id" id="tech_project_id" value="{{ $key + 1 }}">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" name="project_name[]" class="form-control" value="{{ $project->project_name }}" />
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-8 col-lg-8">
                                    <label>Project Type</label>
                                    <select name="project_type[]" class="form-control" required>
                                        @foreach ($projecttypes as $type)
                                        <option value="{{ $type->project_type_id }}" {{ ($project->project_type==$type->project_type_id)? "selected" : "" }} >{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- <div class="form-group basic-info">
                                <label>Project Type</label>
                                <div class="form-check form-check-inline ml-3">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="Development" class="custom-control-input" name="project_type[]" value="1" {{ ($project->project_type=="1")? "checked" : "" }} >
                                        <label class="custom-control-label" for="Development">Development</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="Support" class="custom-control-input" name="project_type[]" value="2" {{ ($project->project_type=="2")? "checked" : "" }} >
                                        <label class="custom-control-label" for="Support">Support</label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                    <label>Duration (Months)</label>
                                    <input type="text" name="duration[]" class="form-control" value="{{ $project->duration }}" />
                                </div>

                                <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                    <label>Technology</label>
                                    <select name="technologty_pre[]" class="form-control" id="technologty_pre_multi_{{ $key + 1 }}" onchange="change_framework_project({{ $key + 1 }});" required>
                                        <option value=""></option>
                                        @foreach ($technologies as $technology)
                                        <option value="{{ $technology->technology_id }}" {{ ($project->technologty_pre==$technology->technology_id)? "selected" : "" }} >{{ $technology->technology_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                {{-- <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                    <label>Framework</label>
                                    <select class="form-control" required="" name="framework[]" id="framework_multi_{{ $key + 1 }}">
                                        <option value=""></option>
                                        @foreach ($frameworks as $technology)
                                        @if ($project->technologty_pre == $technology->parent_id)
                                            <option value="{{ $technology->technology_id }}" {{ ($project->framework==$technology->technology_id)? "selected" : "" }} >{{ $technology->technology_name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Industry that Product was designed for</label>
                                    <select name="industry[]" class="form-control">
                                        <option value=""></option>
                                        @foreach ($customerindustries as $industry)
                                        <option value="{{ $industry->customer_industry_id }}" {{ ($project->industry==$industry->customer_industry_id)? "selected" : "" }}>{{ $industry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Project Details</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="project_details[]" rows="3">{{ $project->project_details }}</textarea>
                            </div>

                            <div class="form-group basic-file">
                                <label>Project Upload</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="upload_file[]">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Project Url</label>
                                <input type="url" name="project_link[]" class="form-control" value="{{ $project->project_link }}" />
                            </div>
                            {{-- @isset($project->upload_file)
                                <img class="img-fluid" src="{{ url($project->upload_file) }}" />
                            @endisset --}}
                            @if(Sentinel::getUser()->interested == "2")
                            <div class="form-group">
                                <label>Employer</label>
                                <select name="employer_id[]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($employers as $employer)
                                    <option value="{{ $employer->employer_id }}" {{ ($project->employer_id==$employer->employer_id)? "selected" : "" }}>{{ $employer->employer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                            <input type="hidden" name="employer_id[]" value="0">
                            @endif
                        </div>
                    @empty
                        <div class="project-3">
                            <!-- <span class="h4 text-left mt-3 mb-4 d-inline-block">Project</span> -->
                            <input type="hidden" name="user_project_id[]" id="user_project_id" value="0">
                            <input type="hidden" name="tech_project_id" id="tech_project_id" value="0">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" name="project_name[]" class="form-control" />
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-8 col-lg-8">
                                    <label>Project Type</label>
                                    <select name="project_type[]" class="form-control" required>
                                        <option value="1">Development</option>
                                        <option value="2">Support</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group basic-info">
                                <label>Project Type</label>
                                <div class="form-check form-check-inline ml-3">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="Development" class="custom-control-input" name="project_type[]" value="1">
                                        <label class="custom-control-label" for="Development">Development</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="Support" class="custom-control-input" name="project_type[]" value="2">
                                        <label class="custom-control-label" for="Support">Support</label>
                                    </div>
                                </div>
                            </div>-->
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                    <label>Duration (Months)</label>
                                    <input type="text" name="duration[]" class="form-control" />
                                </div>

                                <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                    <label>Technology</label>
                                    <select name="technologty_pre[]" class="form-control" id="technologty_pre_multi_0" onchange="change_framework_project(0);" required>
                                        <option value=""></option>
                                        @foreach ($technologies as $technology)
                                        <option value="{{ $technology->technology_id }}" >{{ $technology->technology_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                {{-- <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                    <label>Framework</label>
                                    <select class="form-control" required="" name="framework[]" id="framework_multi_0">
                                        <option value=""></option>
                                    </select>
                                </div> --}}
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Industry that Product was designed for</label>
                                    <select name="industry[]" class="form-control">
                                        <option value=""></option>
                                        @foreach ($customerindustries as $industry)
                                        <option value="{{ $industry->customer_industry_id }}">{{ $industry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Project Details</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="project_details[]" rows="3"></textarea>
                            </div>
                            <div class="form-group basic-file">
                                <label>Project Upload</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="upload_file[]">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Project Url</label>
                                <input type="url" name="project_link[]" class="form-control"/>
                            </div>
                            @if(Sentinel::getUser()->interested == "2")
                            <div class="form-group">
                                <label>Employer</label>
                                <select name="employer_id[]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($employers as $employer)
                                    <option value="{{ $employer->employer_id }}">{{ $employer->employer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                            <input type="hidden" name="employer_id[]" value="0">
                            @endif
                        </div>
                    @endforelse
                </div>
                <div class="btn-group mt-3" role="group">
                    <button class="btn btn-md btn-info btn-copy-p" type="button">Add Project <span class="fa fa-plus"></span></button>
                    <!-- <button class="btn btn-md btn-danger btn-copy-p" type="button"></button> -->
                    <button type="button" class="remove-p btn btn-md btn-info ml-3 rounded-0">Erase Project <span class="fas fa-times"></span></button>
                </div>
                <div class="form-group text-right mt-5">
                    <div class="btn-group" role="group">
                        <button class="btn btn-outline-primary" type="button" onclick="location.href='{{ url('/resume') }}'">Skip >>></button>
                        
                        <button class="btn btn-primary" type="submit">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            Next >>>
                        </button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="project-2 d-none">
    <!-- <span class="h4 text-left mt-3 mb-4 d-inline-block">Project</span> -->
    <input type="hidden" name="user_project_id[]" id="user_project_id" value="0">
    <input type="hidden" name="tech_project_id" id="tech_project_id" value="0">
    <div class="form-group">
        <label>Project Name</label>
        <input type="text" name="project_name[]" class="form-control" />
    </div>
    <div class="form-row">
        <div class="form-group col-12 col-sm-12 col-md-8 col-lg-8">
            <label>Project Type</label>
            <select name="project_type[]" class="form-control" required>
                <option value="1">Development</option>
                <option value="2">Support</option>
            </select>
        </div>
    </div>
    <!-- <div class="form-group basic-info">
        <label>Project Type</label>
        <div class="form-check form-check-inline ml-3">
            <div class="custom-control custom-radio">
                <input type="radio" id="Development" class="custom-control-input" name="project_type[]" value="1">
                <label class="custom-control-label" for="Development">Development</label>
            </div>
        </div>
        <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
                <input type="radio" id="Support" class="custom-control-input" name="project_type[]" value="2">
                <label class="custom-control-label" for="Support">Support</label>
            </div>
        </div>
    </div> -->
    <div class="form-row">
        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
            <label>Duration (Months)</label>
            <input type="text" name="duration[]" class="form-control" />
        </div>

        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
            <label>Technology</label>
            <select name="technologty_pre[]" class="form-control" id="technologty_pre_multi" onchange="change_framework_project();" required>
                <option value=""></option>
                @foreach ($technologies as $technology)
                <option value="{{ $technology->technology_id }}" >{{ $technology->technology_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row">
        {{-- <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
            <label>Framework</label>
            <select class="form-control" required="" name="framework[]" id="framework_multi">
                <option value=""></option>
            </select>
        </div> --}}
        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
            <label>Industry that Product was designed for</label>
            <select name="industry[]" class="form-control">
                <option value=""></option>
                @foreach ($customerindustries as $industry)
                <option value="{{ $industry->customer_industry_id }}">{{ $industry->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Project Details</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="project_details[]" rows="3"></textarea>
    </div>
    <div class="form-group basic-file">
        <label>Project Upload</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" name="upload_file[]">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>
    <div class="form-group">
        <label>Project Url</label>
        <input type="url" name="project_link[]" class="form-control" />
    </div>
    @if(Sentinel::getUser()->interested == "2")
    <div class="form-group">
        <label>Employer</label>
        <select name="employer_id[]" class="form-control" required>
            <option value=""></option>
            @foreach ($employers as $employer)
            <option value="{{ $employer->employer_id }}">{{ $employer->employer_name }}</option>
            @endforeach
        </select>
    </div>
    @else
    <input type="hidden" name="employer_id[]" value="0">
    @endif
</div>
@stop
