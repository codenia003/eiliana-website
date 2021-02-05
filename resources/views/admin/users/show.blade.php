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
            <ul class="nav  nav-tabs first_svg" id="myTab">
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
                                                    @endforeach
                                                    <div class="modal-footer d-none education_edit">
                                                        <button class="btn btn-primary" type="Submit">Submit</button>
                                                        <p onclick="editeducation_cancel()" class="btn btn-primary">Cancel</p>
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
                <div id="tab3" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        User Certification
                                        <button class="btn btn-primary" onclick="edit_certificate_data()" style="float: right;">Edit</button>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                <form action="{{ url('admin/users/update-certificate') }}" method="POST">
                                                    @csrf
                                                    @php
                                                    $i = 1;
                                                    @endphp
                                                    @foreach ($certificates as $certificate)
                                                    <table class="table table-bordered table-striped" id="users">
                                                        <h6> Certificate - {!! $i++ !!}</h6>
                                                        <tr>
                                                            <td>Certification Number</td>
                                                            <td>
                                                                <p class="none_certificate_edit user_name_max">{{ $certificate->certificate_no }}</p>
                                                                <input type="text" name="certificate_no[]" class="form-control d-none certificate_edit" value="{{ $certificate->certificate_no }}" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Certification Name</td>
                                                            <td>
                                                                <p class="none_certificate_edit user_name_max">{{ $certificate->name }}</p>
                                                                <input type="text" name="name[]" class="form-control d-none certificate_edit" value="{{ $certificate->name }}" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Institute Name</td>
                                                            <td>
                                                                <p class="none_certificate_edit user_name_max">{{ $certificate->institutename }}</p>
                                                                <input type="text" name="institutename[]" class="form-control d-none certificate_edit" value="{{ $certificate->institutename }}" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Year of Certification</td>
                                                            <td>
                                                                <p class="none_certificate_edit user_name_max">{{ $certificate->from_date }} &nbsp- &nbsp {{ $certificate->till_date }}</p>
                                                                <div class="form-group col-6 d-none certificate_edit">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <select class="form-control" required="" name="from_date[]">
                                                                                <option value="">From</option>
                                                                                @for ($i = 2000; $i < 2021; $i++) <option value="{{ $i }}" {{ ($certificate->from_date==$i)? "selected" : "" }}>{{ $i }}</option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                        <div class="col">
                                                                            <select class="form-control" required="" name="till_date[]">
                                                                                <option value="">Till</option>
                                                                                @for ($i = 2000; $i < 2021; $i++) <option value="{{ $i }}" {{ ($certificate->from_date==$i)? "selected" : "" }}>{{ $i }}</option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <input type="hidden" name="certificate_id[]" value="{{ $certificate->certificate_id}}">
                                                    @endforeach
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <div class="modal-footer d-none certificate_edit">
                                                        <button class="btn btn-primary" type="Submit">Submit</button>
                                                        <p onclick="editcertificate_cancel()" class="btn btn-primary">Cancel</p>
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
                <div id="tab4" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Professional Experience
                                        <button class="btn btn-primary" onclick="edit_professinal_exp()" style="float: right;">Edit</button>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                <form action="{{ url('admin/users/update-professionalexp') }}" method="POST">
                                                    @csrf
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
                                                                <p class="none_professionalexp_edit user_name_max">{{ $proexps->profile_headline }}</p>
                                                                <input type="text" name="profile_headline" class="form-control d-none professionalexp_edit" value="{{ $proexps->profile_headline }}" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Key Skills</td>
                                                            <td>
                                                                <p class="none_professionalexp_edit user_name_max">{{ $proexps->key_skills }}</p>
                                                                <input type="text" name="key_skills" class="form-control d-none professionalexp_edit" value="{{ $proexps->key_skills }}" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Experience</td>
                                                            <td>
                                                                <p class="none_professionalexp_edit user_name_max">{{ $proexps->experience_year }} Years &nbsp - &nbsp {{ $proexps->experience_month }} Months</p>
                                                                <div class="form-group col-6 d-none professionalexp_edit">
                                                                    <div class="form-row">
                                                                        <div class="col-5">
                                                                            <select class="form-control" required="" name="experience_year">
                                                                                @for ($i = 0; $i < 21; $i++) <option value="{{ $i }}" {{ ($proexps->experience_year==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <select class="form-control" required="" name="experience_month">
                                                                                @for ($i = 1; $i < 13; $i++) <option value="{{ $i }}" {{ ($proexps->experience_month==$i)? "selected" : "" }}>{{ $i }} Months</option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>No of Support Projects </td>
                                                            <td>
                                                                <p class="none_professionalexp_edit user_name_max">{{ $proexps->support_project }}</p>
                                                                {!! Form::selectRange('support_project', 1, 20, $proexps->support_project, ['class' => 'form-control d-none professionalexp_edit','required' =>'']) !!}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>No of Development Projects</td>
                                                            <td>
                                                                <p class="none_professionalexp_edit user_name_max">{{ $proexps->development_project }}</p>
                                                                {!! Form::selectRange('development_project', 1, 20, $proexps->development_project, ['class' => 'form-control d-none professionalexp_edit','required' =>'']) !!}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Current Location</td>
                                                            <td>
                                                                <p class="none_professionalexp_edit user_name_max">{{ $locations->name }}</p>
                                                                <select name="current_location" class="form-control d-none professionalexp_edit" required>
                                                                    @foreach ($response['locations'] as $location)
                                                                    <option value="{{ $location->location_id }}" {{ ($proexps->current_location == $location->location_id)? "selected" : "" }}>{{ $location->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Preferred Location</td>
                                                            <td>
                                                                <p class="none_professionalexp_edit user_name_max">{{ $preferred_location->name }}</p>
                                                                <select name="preferred_location" class="form-control d-none professionalexp_edit" required>
                                                                    @foreach ($response['locations'] as $location)
                                                                    <option value="{{ $location->location_id }}" {{ ($proexps->preferred_location == $location->location_id)? "selected" : "" }}>{{ $location->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <input type="hidden" name="professional_experience_id" value="{{ $proexps->professional_experience_id }}">
                                                    <div class="modal-footer d-none professionalexp_edit">
                                                        <button class="btn btn-primary" type="Submit">Submit</button>
                                                        <p onclick="editprofessionalexp_cancel()" class="btn btn-primary">Cancel</p>
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
                <div id="tab5" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Projects
                                        <button class="btn btn-primary" onclick="edit_project()" style="float: right;">Edit</button>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                <form action="{{ url('admin/users/update-project') }}" method="POST">
                                                    @csrf
                                                    @php
                                                    $i = 1;
                                                    @endphp
                                                    @foreach ($projects as $project)
                                                    <table class="table table-bordered table-striped" id="users">
                                                        <h6>Projects - {{$i++}}</h6>
                                                        <tr>
                                                            <td>Project Name </td>
                                                            <td>
                                                                <p class="none_project_edit user_name_max">{{ $project->project_name }}</p>
                                                                <input type="text" name="project_name[]" class="form-control col-6 d-none project_edit" value="{{ $project->project_name }}" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Project Type </td>
                                                            <td>
                                                                <p class="none_project_edit user_name_max">{{ $project->projecttypes->name }}</p>
                                                                <select name="project_type[]" class="form-control col-6 d-none project_edit" required>
                                                                    @foreach ($response['projecttypes'] as $type)
                                                                    <option value="{{ $type->project_type_id }}" {{ ($project->project_type==$type->project_type_id)? "selected" : "" }}>{{ $type->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Technology </td>
                                                            <td>
                                                                <p class="none_project_edit user_name_max">{{ $project->technologuname->technology_name }}</p>
                                                                <select name="technologty_pre[]" class="form-control col-6 d-none project_edit" id="technologty_pre" required>
                                                                    @foreach ($response['technologies'] as $technology)
                                                                    <option value="{{ $technology->technology_id }}" {{ ($project->technologty_pre==$technology->technology_id)? "selected" : "" }}>{{ $technology->technology_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Duration </td>
                                                            <td>
                                                                <p class="none_project_edit user_name_max">{{ $project->duration }}</p>
                                                                <input type="text" name="duration[]" class="form-control col-6 d-none project_edit" value="{{ $project->duration }}" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Framework</td>
                                                            <td>
                                                                <p>{{ $project->frameworkname->technology_name }}</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Customer Industry</td>
                                                            <td>
                                                                <p class="none_project_edit user_name_max">{{ $project->customerindustry->name }}</p>
                                                                <select name="industry[]" class="form-control col-6 d-none project_edit">
                                                                    @foreach ($response['customer_industrys'] as $customer_industry)
                                                                    <option value="{{ $customer_industry->customer_industry_id }}" {{ ($project->industry == $customer_industry->customer_industry_id)? "selected" : "" }}>{{ $customer_industry->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Project Details </td>
                                                            <td>
                                                                <p class="none_project_edit user_name_max">{{ $project->project_details }}</p>
                                                                <textarea class="form-control col-6 d-none project_edit" id="exampleFormControlTextarea1" name="project_details[]" rows="3">{{ $project->project_details }}</textarea>
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
                                                                <!--  <div class="custom-file col-6 d-none">
                                                                <input type="file" class="custom-file-input" id="customFile" name="upload_file[]">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div> -->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Employer Name</td>
                                                            <td>
                                                                {{ $project->employername->employer_name }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <input type="hidden" name="user_project_id[]" id="user_project_id" value="{{ $project->user_project_id }}">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    @endforeach
                                                    <div class="modal-footer d-none project_edit">
                                                        <button class="btn btn-primary" type="Submit">Submit</button>
                                                        <p onclick="editproject_cancel()" class="btn btn-primary">Cancel</p>
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
                <div id="tab6" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Employer Details
                                        <button class="btn btn-primary" onclick="edit_employer()" style="float: right;">Edit</button>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                <form action="{{ url('admin/users/update-employer') }}" method="POST">
                                                    @csrf
                                                    @php
                                                    $a = 1;
                                                    @endphp
                                                    @foreach ($employer_details as $employer_detail)
                                                    <table class="table table-bordered table-striped" id="users">
                                                        <tr>
                                                            <td>Current Salary</td>
                                                            <td>
                                                                <p class="none_employer_edit user_name_max">{{ $employer_detail->current_salary_lacs }} Lacs &nbsp- &nbsp {{ $employer_detail->current_salary_thousand }} Thousands</p>
                                                                <div class="form-group col-6 d-none employer_edit">
                                                                    <div class="form-row">
                                                                        <div class="col-5 pr-1">
                                                                            <select class="form-control" required="" name="current_salary_lacs">
                                                                                <option value=""></option>
                                                                                @for ($i = 0; $i < 51; $i++) <option value="{{ $i }}" {{ ($employer_detail->current_salary_lacs==$i)? "selected" : "" }}>{{ $i }} Lacs</option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-5 ml-3">
                                                                            <select class="form-control" required="" name="current_salary_thousand">
                                                                                <option value=""></option>
                                                                                @for ($i = 0; $i < 100; $i+=5) <option value="{{ $i }}" {{ ($employer_detail->current_salary_thousand==$i)? "selected" : "" }}>{{ $i }} Thousand</option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Expected Salary</td>
                                                            <td>
                                                                <p class="none_employer_edit user_name_max">{{ $employer_detail->expected_salary_lacs }} Lacs &nbsp- &nbsp {{ $employer_detail->expected_salary_thousand }} Thousands</p>
                                                                <div class="form-group col-6 d-none employer_edit">
                                                                    <div class="form-row">
                                                                        <div class="col-5 pr-1">
                                                                            <select class="form-control" required="" name="expected_salary_lacs">
                                                                                @for ($i = 0; $i < 51; $i++) <option value="{{ $i }}" {{ ($employer_detail->expected_salary_lacs==$i)? "selected" : "" }}>{{ $i }} Lacs</option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-5 ml-3">
                                                                            <select class="form-control" required="" name="expected_salary_thousand">
                                                                                @for ($i = 0; $i < 100; $i+=5) <option value="{{ $i }}" {{ ($employer_detail->expected_salary_thousand==$i)? "selected" : "" }}>{{ $i }} Thousand</option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Notice Period</td>
                                                            <td>
                                                                <p class="none_employer_edit user_name_max">{{ $employer_detail->notice_period }} Days</p>
                                                                <select class="form-control col-6 d-none employer_edit" required="" name="notice_period">
                                                                    <option value=""></option>
                                                                    @for ($i = 15; $i < 180; $i+=15) <option value="{{ $i }}" {{ ($employer_detail->notice_period==$i)? "selected" : "" }}>{{ $i }}</option>
                                                                        @endfor
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    @endforeach
                                                    <br>
                                                    @foreach ($employers as $employer)
                                                    <table class="table table-bordered table-striped" id="users">
                                                        <h6>Employer - {{ $a++ }}</h6>
                                                        <tr>
                                                            <td>Employer Name</td>
                                                            <td>
                                                                <p class="none_employer_edit user_name_max">{{ $employer->employer_name }}</p>
                                                                <input type="text" name="employer_name[]" class="form-control col-6 d-none employer_edit" value="{{ $employer->employer_name }}" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Designation</td>
                                                            <td>
                                                                <p class="none_employer_edit user_name_max">{{ $employer->designationtype->name }}</p>
                                                                <select name="designation[]" class="form-control col-6 d-none employer_edit" required>
                                                                    @foreach ($response['designations'] as $designation)
                                                                    <option value="{{ $designation->designation_id }}" {{ ($employer->designation==$designation->designation_id)? "selected" : "" }}>{{ $designation->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Employment Type</td>
                                                            <td>
                                                                <p class="none_employer_edit user_name_max">{{ $employer->employertype->name }}</p>
                                                                <select name="employment_type[]" class="form-control col-6 d-none employer_edit" required>
                                                                    @foreach ($response['employertype'] as $type)
                                                                    <option value="{{ $type->employer_type_id }}" {{ ($employer->employment_type==$type->employer_type_id)? "selected" : "" }}>{{ $type->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Employment Duration</td>
                                                            <td>
                                                                <p class="none_employer_edit user_name_max">{{ $employer->duration_year }} Years &nbsp- &nbsp {{ $employer->duration_month }} Months</p>
                                                                <div class="form-group col-6 d-none employer_edit">
                                                                    <div class="form-row">
                                                                        <div class="col-5 pr-1">
                                                                            <select class="form-control" required="" name="duration_year[]">
                                                                                <option value=""></option>
                                                                                @for ($i = 0; $i < 21; $i++) <option value="{{ $i }}" {{ ($employer->duration_year==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-5 ml-3">
                                                                            <select class="form-control" required="" name="duration_month[]">
                                                                                <option value=""></option>
                                                                                @for ($i = 1; $i < 13; $i++) <option value="{{ $i }}" {{ ($employer->duration_month==$i)? "selected" : "" }}>{{ $i }} Months</option>
                                                                                    @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Job Profile</td>
                                                            <td>
                                                                <p class="none_employer_edit user_name_max">{{ $employer->job_profile }}</p>
                                                                <textarea class="form-control col-6 d-none employer_edit" name="job_profile[]" rows="4" cols="50" required>{{ $employer->job_profile }}</textarea>
                                                            </td>
                                                        </tr>
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <input type="hidden" name="employer_details_id" id="employer_details_id " value="{{ $employer_detail->employer_details_id }}">
                                                        <input type="hidden" name="employer_id[]" id="employer_id" value="{{ $employer->employer_id }}">
                                                        @endforeach
                                                    </table>
                                                    <div class="modal-footer d-none employer_edit">
                                                        <button class="btn btn-primary" type="Submit">Submit</button>
                                                        <p onclick="editemployer_cancel()" class="btn btn-primary">Cancel</p>
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

function edit_certificate_data() {
    $('.none_certificate_edit').addClass("d-none");
    $('.certificate_edit').removeClass("d-none");
}

function editcertificate_cancel() {
    $('.none_certificate_edit').removeClass("d-none");
    $('.certificate_edit').addClass("d-none");
}

function edit_professinal_exp() {
    $('.none_professionalexp_edit').addClass("d-none");
    $('.professionalexp_edit').removeClass("d-none");
}


function editprofessionalexp_cancel() {
    $('.none_professionalexp_edit').removeClass("d-none");
    $('.professionalexp_edit').addClass("d-none");
}

function edit_project() {
    $('.none_project_edit').addClass("d-none");
    $('.project_edit').removeClass("d-none");
}

function editproject_cancel() {
    $('.none_project_edit').removeClass("d-none");
    $('.project_edit').addClass("d-none");
}

function edit_employer() {
    $('.none_employer_edit').addClass("d-none");
    $('.employer_edit').removeClass("d-none");
}

function editemployer_cancel() {
    $('.none_employer_edit').removeClass("d-none");
    $('.employer_edit').addClass("d-none");
}

</script>
@stop
