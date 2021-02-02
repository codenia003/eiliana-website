@extends('admin/layouts/default')
{{-- Page title --}}
@section('title')
View User Details
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<meta name="csrf_token" content="{{ csrf_token() }}">
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet" />
<link href="{{ asset('css/pages/user_profile.css') }}" rel="stylesheet" />
@stop
{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>User Information</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="#">Users</a>
        </li>
        <li class="active">User Information</li>
    </ol>
</section>
<!--section ends-->
<section class="content user_profile  pr-3 pl-3">
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav  nav-tabs first_svg">
                <li class="nav-item">
                    <a href="#tab1" data-toggle="tab" class="nav-link active">
                        <i class="livicon" data-name="user" data-size="16" data-c="#777" data-hc="#000" data-loop="true"></i>
                        Primary Information</a>
                </li>
                <li class="nav-item">
                    <a href="#tab2" data-toggle="tab" class="nav-link">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                        Education</a>
                </li>
                <li class="nav-item">
                    <a href="#tab3" data-toggle="tab" class="nav-link">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>Certification
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab4" data-toggle="tab" class="nav-link">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>Professional Experience
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab5" data-toggle="tab" class="nav-link">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>Project
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab6" data-toggle="tab" class="nav-link">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>Employer Details
                    </a>
                </li>
                <!--  <li class="nav-item">
                        <a href="{{ URL::to('admin/user_profile') }}" class=" nav-link" >
                            <i class="livicon" data-name="gift" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Advanced User Profile</a>
                    </li> -->
            </ul>
            <div class="tab-content mar-top" id="clothing-nav-content">
                <div id="tab1" class="tab-pane fade show active">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        User Information
                                        <button class="btn btn-primary" onclick="editfrom_data()" style="float: right;">Edit</button>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="img-file">
                                                @if($user->pic)
                                                <img src="{{ $user->pic }}" alt="img" class="img-fluid" />
                                                @elseif($user->gender === "male")
                                                <img src="{{ asset('images/authors/avatar3.png') }}" alt="..." class="img-fluid" />
                                                @elseif($user->gender === "female")
                                                <img src="{{ asset('images/authors/avatar5.png') }}" alt="..." class="img-fluid" />
                                                @else
                                                <img src="{{ asset('images/authors/no_avatar.jpg') }}" alt="..." class="img-fluid" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                <form action="{{ url('admin/users/updateinformation') }}" method="POST">
                                                    @csrf
                                                    <table class="table table-bordered table-striped" id="users">
                                                        <tr>
                                                            <td>@lang('users/title.first_name')</td>
                                                            <td>
                                                                <p class="none_edit user_name_max">{{ $user->first_name }}</p>
                                                                <input class="form-control d-none edit_from" type="text" name="first_name" value="{{ $user->first_name }}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.last_name')</td>
                                                            <td>
                                                                <p class="none_edit user_name_max">{{ $user->last_name }}</p>
                                                                <input class="form-control d-none edit_from" type="text" name="last_name" value="{{ $user->last_name }}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.dob')</td>
                                                            @if($user->dob=='0000-00-00')
                                                            <td>
                                                            </td>
                                                            @else
                                                            <td>
                                                                <p class="none_edit user_name_max">{{ \Carbon\Carbon::parse($user->dob)->format('d F, Y')}}</p>
                                                                <input type="date" name="dob" class="form-control d-none edit_from" value="{{ $user->dob }}" />
                                                            </td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Alias</td>
                                                            <td>
                                                                <p class="none_edit user_name_max">{{ $user->pseudoName }}</p>
                                                                <input class="form-control d-none edit_from" type="text" name="pseudoName" value="{{ $user->pseudoName }}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.country')</td>
                                                            <td>
                                                                <!--  {{ $user->country }} -->
                                                                @foreach ($countries as $country)
                                                                @if($user->country==$country->id)
                                                                <p class="none_edit user_name_max">{{ $country->name }}</p>
                                                                @endif
                                                                @endforeach
                                                                <select name="country" class="form-control d-none edit_from">
                                                                    <option value="">--Select--</option>
                                                                    @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}" {{ ($user->country==$country->id)? "selected" : "" }}>{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Interested In</td>
                                                            <td>
                                                                @if($user->interested ==1)
                                                                <p class="none_edit user_name_max">Freelance Projects</p>
                                                                @else
                                                                <p class="none_edit user_name_max">Contractual Staffing</p>
                                                                @endif
                                                                <div class="form-group basic-info d-none edit_from">
                                                                    <div class="form-check form-check-inline ml-3">
                                                                        <div class="custom-control custom-radio">
                                                                            <input type="radio" id="Freelance" class="custom-control-input" name="interested" disabled="" value="1" {{ ($user->interested=="1")? "checked" : "" }}>
                                                                            <label class="custom-control-label" for="Freelance">Freelance Projects</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <div class="custom-control custom-radio">
                                                                            <input type="radio" id="Contractual" class="custom-control-input" name="interested" disabled="" value="2" {{ ($user->interested=="2")? "checked" : "" }}>
                                                                            <label class="custom-control-label" for="Contractual">Contractual Staffing</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Anonymus</td>
                                                            <td>
                                                                @if($user->anonymous == 1)
                                                                <p class="none_edit user_name_max">Anonymus</p>
                                                                @else
                                                                <p class="none_edit user_name_max"> Public</p>
                                                                @endif
                                                                <div class="form-group basic-info mb-3 d-none edit_from">
                                                                    <div class="form-check form-check-inline ml-3">
                                                                        <div class="custom-control custom-radio">
                                                                            <input type="radio" id="public" name="anonymous" class="custom-control-input" value="0" disabled="" {{ (Sentinel::getUser()->anonymous=="0")? "checked" : "" }}>
                                                                            <label class="custom-control-label" for="public">Public</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <div class="custom-control custom-radio">
                                                                            <input type="radio" id="anonymous" name="anonymous" class="custom-control-input" value="1" disabled="" {{ (Sentinel::getUser()->anonymous=="1")? "checked" : "" }}>
                                                                            <label class="custom-control-label" for="anonymous">Anonymus</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <input type="hidden" name="id" value="{{$user->id}}">
                                                    </table>
                                                    <div class="modal-footer d-none edit_from">
                                                        <button class="btn btn-primary" type="Submit">Submit</button>
                                                        <p onclick="editfrom_cancel()" class="btn btn-primary">Cancel</p>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        User Education
                                        <button class="btn btn-primary" onclick="edit_education_data()" style="float: right;">Edit</button>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <!-- <form action="" method=""> -->
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                             <form action="{{ url('admin/users/update-education') }}" method="POST">
                                                    @csrf   
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach($ug_educations as $education)
                                                <table class="table table-bordered table-striped" id="users">
                                                    <h6>UG Qualification - {!! $i++ !!}</h6><br>
                                                    <tr>
                                                        <td>Qualification </td>
                                                        <td>
                                                            <p class="none_education_edit user_name_max">{{ $education->qualification->name }}</p>
                                                            <select name="degree[]" class="form-control col-6 d-none education_edit">
                                                                <option value=""></option>
                                                                @foreach ($response['qualifications'] as $qualification)
                                                                @if ($qualification->type == 'UG')
                                                                <option value="{{ $qualification->qualification_id }}" {{ ($education->degree==$qualification->qualification_id)? "selected" : "" }}>{{ $qualification->name }}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>University Name</td>
                                                        <td>
                                                            <p class="none_education_edit user_name_max">{{ $education->university->name }}<p>
                                                                    <select name="name[]" class="form-control col-6 d-none education_edit">
                                                                        <option value=""></option>
                                                                        @foreach ($response['universities'] as $university)
                                                                        <option value="{{ $university->university_id }}" {{ ($education->name==$university->university_id)? "selected" : "" }}>{{ $university->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Year of Graduation</td>
                                                        <td>
                                                            <p class="none_education_edit user_name_max">{{ $education->month }} &nbsp- &nbsp {{ $education->year }}</p>
                                                            <div class="form-group col-6 d-none education_edit">
                                                                <div class="form-row ">
                                                                    <div class="col">
                                                                        <select class="form-control" required="" name="month[]">
                                                                            <option value="">From</option>
                                                                            @for ($i = 2000; $i < 2021; $i++) <option value="{{ $i }}" {{ ($education->month==$i)? "selected" : "" }}>{{ $i }}</option>
                                                                                @endfor
                                                                        </select>
                                                                    </div>
                                                                    <div class="col">
                                                                        <select class="form-control" required="" name="year[]">
                                                                            <option value="">Till</option>
                                                                            @for ($i = 2000; $i < 2021; $i++) <option value="{{ $i }}" {{ ($education->year==$i)? "selected" : "" }}>{{ $i }}</option>
                                                                                @endfor
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Education Type</td>
                                                        <td>
                                                            <p class="none_education_edit user_name_max">{{ $education->educationtype->name }}</p>
                                                            <select name="education_type[]" class="form-control d-none col-6 education_edit" required>
                                                                <option value=""></option>
                                                                @foreach ( $response['educationtype'] as $etype)
                                                                <option value="{{ $etype->education_type_id }}" {{ ($education->education_type==$etype->education_type_id)? "selected" : "" }}>{{ $etype->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <input type="hidden" name="education_id[]" id="education_id" value="{{ $education->education_id }}">
                                                </table>
                                                @endforeach
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach($pg_educations as $education)
                                                <table class="table table-bordered table-striped" id="users">
                                                    <h6>PG Qualification - {!! $i++ !!}</h6><br>
                                                    <tr>
                                                        <td>PG Qualification</td>
                                                        <td>
                                                            <p class="none_education_edit user_name_max">{{ $education->qualification->name }}</p>
                                                            <select name="degree[]" class="form-control col-6 d-none education_edit" required>
                                                                <option value=""></option>
                                                                @foreach ($response['qualifications'] as $qualification)
                                                                @if ($qualification->type == 'PG')
                                                                <option value="{{ $qualification->qualification_id }}" {{ ($education->degree==$qualification->qualification_id)? "selected" : "" }}>{{ $qualification->name }}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>University Name</td>
                                                        <td>
                                                            <p class="none_education_edit user_name_max">{{ $education->university->name }}</p>
                                                            <select name="name[]" class="form-control col-6 d-none education_edit">
                                                                <option value=""></option>
                                                                @foreach ($response['universities'] as $university)
                                                                <option value="{{ $university->university_id }}" {{ ($education->name==$university->university_id)? "selected" : "" }}>{{ $university->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Year of Graduation</td>
                                                        <td>
                                                            <p class="none_education_edit user_name_max"> {{ $education->month }} &nbsp- &nbsp {{ $education->year }}</p>
                                                            <div class="form-group col-6 d-none education_edit">
                                                                <div class="form-row">
                                                                    <div class="col">
                                                                        <select class="form-control" required="" name="month[]">
                                                                            <option value="">From</option>
                                                                            @for ($i = 2000; $i < 2021; $i++) <option value="{{ $i }}" {{ ($education->month==$i)? "selected" : "" }}>{{ $i }}</option>
                                                                                @endfor
                                                                        </select>
                                                                    </div>
                                                                    <div class="col">
                                                                        <select class="form-control" required="" name="year[]">
                                                                            <option value="">Till</option>
                                                                            @for ($i = 2000; $i < 2021; $i++) <option value="{{ $i }}" {{ ($education->year==$i)? "selected" : "" }}>{{ $i }}</option>
                                                                                @endfor
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Education Type</td>
                                                        <td>
                                                            <p class="none_education_edit user_name_max">{{ $education->educationtype->name }}</p>
                                                            <select name="education_type[]" class="form-control col-6 d-none education_edit" required>
                                                                <option value=""></option>
                                                                @foreach ($response['educationtype'] as $etype)
                                                                <option value="{{ $etype->education_type_id }}" {{ ($education->education_type==$etype->education_type_id)? "selected" : "" }}>{{ $etype->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <input type="hidden" name="education_id[]" id="education_id" value="{{ $education->education_id }}">
                                                </table>
                                                <div class="modal-footer d-none education_edit">
                                                        <button class="btn btn-primary" type="Submit">Submit</button>
                                                        <p onclick="editeducation_cancel()" class="btn btn-primary">Cancel</p>
                                                    </div>
                                                 @endforeach
                                            </form>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        User Certification
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach ($certificates as $certificate)
                                                <table class="table table-bordered table-striped" id="users">
                                                    <h6> Certificate - {!! $i++ !!}</h6>
                                                    <tr>
                                                        <td>Certification Number</td>
                                                        <td>
                                                            {{ $certificate->certificate_no }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Certification Name</td>
                                                        <td>
                                                            {{ $certificate->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Institute Name</td>
                                                        <td>
                                                            {{ $certificate->institutename }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Year of Certification</td>
                                                        <td>
                                                            {{ $certificate->from_date }} &nbsp- &nbsp {{ $certificate->till_date }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab4" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Professional Experience
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                <table class="table table-bordered table-striped" id="users">
                                                    <h6>Professional Experience</h6>
                                                    <tr>
                                                        <td> Technology Preference</td>
                                                        <td>
                                                            @foreach ($technologies as $technology)
                                                            {{ $technology->technology_name }} ,
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Framework</td>
                                                        <td>
                                                            @foreach ($childtechnologies as $technology)
                                                            {{ $technology->technology_name }} ,
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Profile Headline</td>
                                                        <td>
                                                            {{ $proexps->profile_headline }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Key Skills</td>
                                                        <td>
                                                            {{ $proexps->key_skills }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Experience</td>
                                                        <td>
                                                            {{ $proexps->experience_year }} Years &nbsp - &nbsp {{ $proexps->experience_month }} Months
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>No of Support Projects </td>
                                                        <td>
                                                            {{ $proexps->support_project }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>No of Development Projects</td>
                                                        <td>
                                                            {{ $proexps->development_project }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Current Location</td>
                                                        <td>
                                                            {{ $locations->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Preferred Location</td>
                                                        <td>
                                                            {{ $preferred_location->name }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab5" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Projects
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach ($projects as $project)
                                                <table class="table table-bordered table-striped" id="users">
                                                    <h6>Projects - {{$i++}}</h6>
                                                    <tr>
                                                        <td>Project Name </td>
                                                        <td>
                                                            {{ $project->project_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Type </td>
                                                        <td>
                                                            {{ $project->projecttypes->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Technology </td>
                                                        <td>
                                                            {{ $project->technologuname->technology_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Duration </td>
                                                        <td>
                                                            {{ $project->duration }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Framework</td>
                                                        <td>
                                                            {{ $project->frameworkname->technology_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Customer Industry</td>
                                                        <td>
                                                            {{ $project->customerindustry->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Details </td>
                                                        <td>
                                                            {{ $project->project_details }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Upload </td>
                                                        <td>
                                                            @if($project->upload_file)
                                                            <img src="{{ $project->upload_file }}" alt="img" class="img-fluid" />
                                                            @else
                                                            <img src="{{ asset('images/authors/no_avatar.jpg') }}" alt="..." class="img-fluid" />
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Employer Name</td>
                                                        <td>
                                                            {{ $project->employername->employer_name }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab6" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Employer Details
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach ($employer_details as $employer_detail)
                                                <table class="table table-bordered table-striped" id="users">
                                                    <tr>
                                                        <td>Current Salary</td>
                                                        <td>
                                                            {{ $employer_detail->current_salary_lacs }} Lacs &nbsp- &nbsp {{ $employer_detail->current_salary_thousand }} Thousands
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Expected Salary</td>
                                                        <td>
                                                            {{ $employer_detail->expected_salary_lacs }} Lacs &nbsp- &nbsp {{ $employer_detail->expected_salary_thousand }} Thousands
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Notice Period</td>
                                                        <td>
                                                            {{ $employer_detail->notice_period }} Days
                                                        </td>
                                                    </tr>
                                                </table>
                                                @endforeach
                                                <br>
                                                @foreach ($employers as $employer)
                                                <table class="table table-bordered table-striped" id="users">
                                                    <h6>Employer - {{ $i++ }}</h6>
                                                    <tr>
                                                        <td>Employer Name</td>
                                                        <td>
                                                            {{ $employer->employer_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Designation</td>
                                                        <td>
                                                            {{ $employer->designationtype->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Employment Type</td>
                                                        <td>
                                                            {{ $employer->employertype->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Employment Duration</td>
                                                        <td>
                                                            {{ $employer->duration_year }} Years &nbsp- &nbsp {{ $employer->duration_month }} Months
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Job Profile</td>
                                                        <td>
                                                            {{ $employer->job_profile }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    e.target // newly activated tab
    e.relatedTarget // previous active tab
    $("#clothing-nav-content .tab-pane").removeClass("show active");
});

function editfrom_data() {
    $('.none_edit').addClass("d-none");
    $('.edit_from').removeClass("d-none");
}

function editfrom_cancel() {
    $('.none_edit').removeClass("d-none");
    $('.edit_from').addClass("d-none");
}

function edit_education_data() {
    $('.none_education_edit').addClass("d-none");
    $('.education_edit').removeClass("d-none");
}

function editeducation_cancel() {
    $('.none_education_edit').removeClass("d-none");
    $('.education_edit').addClass("d-none");
}

</script>
@stop
