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
                                                <table class="table table-bordered table-striped" id="users">
                                                    <tr>
                                                        <td>@lang('users/title.first_name')</td>
                                                        <td>
                                                            <p class="user_name_max">{{ $user->first_name }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('users/title.last_name')</td>
                                                        <td>
                                                            <p class="user_name_max">{{ $user->last_name }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('users/title.dob')</td>
                                                        @if($user->dob=='0000-00-00')
                                                        <td>
                                                        </td>
                                                        @else
                                                        <td>
                                                            {{ $user->dob }}
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>Alias</td>
                                                        <td>
                                                            {{ $user->pseudoName }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('users/title.country')</td>
                                                        <td>
                                                            <!--  {{ $user->country }} -->
                                                            @foreach ($countries as $country)
                                                            @if($user->country==$country->id)
                                                            {{ $country->name }}
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Interested In</td>
                                                        <td>
                                                            @if($user->interested ==1)
                                                            Freelance Projects
                                                            @else
                                                            Contractual Staffing
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Anonymus</td>
                                                        <td>
                                                            @if($user->anonymous == 1)
                                                            Anonymus
                                                            @else
                                                            Public
                                                            @endif
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
                <div id="tab2" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        User Education
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach($ug_educations as $education)
                                                <table class="table table-bordered table-striped" id="users">
                                                    <h6>UG Qualification - {!! $i++ !!}</h6><br>
                                                    <tr>
                                                        <td>Qualification </td>
                                                        <td>
                                                            {{ $education->qualification->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>University Name</td>
                                                        <td>
                                                            {{ $education->university->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Year of Graduation</td>
                                                        <td>
                                                            {{ $education->month }} &nbsp- &nbsp {{ $education->year }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Education Type</td>
                                                        <td>
                                                            {{ $education->educationtype->name }}
                                                        </td>
                                                    </tr>
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
                                                            {{ $education->qualification->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>University Name</td>
                                                        <td>
                                                            {{ $education->university->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Year of Graduation</td>
                                                        <td>
                                                            {{ $education->month }} &nbsp- &nbsp {{ $education->year }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Education Type</td>
                                                        <td>
                                                            {{ $education->educationtype->name }}
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
                                                            {{ $proexps->experience_year }} Years  &nbsp - &nbsp  {{ $proexps->experience_month }} Months
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>No of Support Projects </td>
                                                          
                                                        <td>
                                                            {{ $proexps->support_project  }} 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>No of Development Projects</td>
                                                        <td>
                                                            {{ $proexps->development_project  }} 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Current Location</td>
                                                        <td>
                                                            {{ $locations->name  }} 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Preferred Location</td>
                                                        <td>
                                                            {{ $preferred_location->name  }} 
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
                                                    <img src="{{ $project->upload_file }}" alt="img" class="img-fluid"/>
                                                     @else
                                                     <img src="{{ asset('images/authors/no_avatar.jpg') }}" alt="..." class="img-fluid"/>
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
                                                            {{ $employer_detail->expected_salary_lacs }}  Lacs &nbsp- &nbsp {{ $employer_detail->expected_salary_thousand }}  Thousands
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
                                                            {{ $employer->duration_year }} Years  &nbsp- &nbsp {{ $employer->duration_month }} Months
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
$(document).ready(function() {
    $('#change-password').click(function(e) {
        e.preventDefault();
        var check = false;
        if ($('#password').val() === "") {
            alert('Please Enter password');
        } else if ($('#password').val() !== $('#password-confirm').val()) {
            alert("confirm password should match with password");
        } else if ($('#password').val() === $('#password-confirm').val()) {
            check = true;
        }

        if (check == true) {
            var sendData = '_token=' + $("input[name='_token']").val() + '&password=' + $('#password').val() + '&id=' + { { $user - > id } };
            var path = "passwordreset";
            $.ajax({
                url: path,
                type: "post",
                data: sendData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                success: function(data) {
                    $('#password, #password-confirm').val('');
                    alert('password reset successful');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('error in password reset');
                }
            });
        }
    });
});



$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    e.target // newly activated tab
    e.relatedTarget // previous active tab
    $("#clothing-nav-content .tab-pane").removeClass("show active");
});

</script>
@stop
