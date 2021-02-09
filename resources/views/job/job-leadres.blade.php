@extends('layouts/default')

{{-- Page title --}}
@section('title')
Job Lead Response
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<!--end of page level css-->
<style>
    .eiliana-btn {
        height: 47px;
    }
    .skills {
        float: left;
        width: 50%;
    }
</style>
@stop

{{-- content --}}
@section('content')
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fa fa-bars"></i></span>
                <span class="h5 text-white ml-2"></span>
            </div>
        </div>
    </div>
    <div class="container space-1 space-top-lg-0 mt-lg-n10">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 pr-0">
                <div id="notific">
                    @include('notifications')
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card mb-3 mb-lg-5">
                            <div class="card-header">
                                <span class="h5 card-title text-secondary">Job Deatils</span>
                            </div>
                            <!-- <div class="card-body mb-3 mb-lg-5 p-4 text-center d-block" *ngIf="loading">
                                <div class="spinner-border spinner-border-lg"></div>
                            </div> -->
                            <div class="card-body">
                                <h5>{{ $job->job_title }}</h5>
                                @if ($job->companydetails->company_name)
                                {{ $job->companydetails->company_name }}
                                @else
                                {{ $job->companydetails->full_name }}
                                @endif
                                <p>{{ $job->locations->name }}</p>
                                <p>Posted On {{  \Carbon\Carbon::parse($job->created_at)->isoFormat('MMM Do YYYY') }}</p>
                                <div class="skills mt-4">
                                    <span class="h5">Job Description</span>
                                    <p>{{ $job->role_summary }}</p>
                                </div>
                                <div class="skills mt-4">
                                    <span class="h5">Budget</span>
                                    <p>{{ $job->budget_from }} to {{ $job->budget_to }}</p>
                                </div>
                                <div class="skills mt-4">
                                    <span class="h5">Years of Experience</span>
                                    <p>{{ $job->experience_year }} Years {{ $job->experience_month }} Month</p>
                                </div>
                                <div class="skills mt-4">
                                    <span class="h5">Skills Required</span>
                                    <p>{{ $job->key_skills }}</p>
                                </div>
                                <hr>
                                <div class="skills mt-4">
                                    <span class="h5">Technology: </span>
                                    @foreach ($technologies as $technology)
                                        {{ $loop->first ? '' : ', ' }}
                                        <span>{{ $technology->technology_name }}</span>
                                    @endforeach
                                    <br>
                                    <span class="h5">Framework: </span>
                                    @foreach ($childtechnologies as $technology)
                                        {{ $loop->first ? '' : ', ' }}
                                        <span>{{ $technology->technology_name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card mb-5 shadow p-4 mb-4">
                            <div class="border-bottom pb-4">
                                <h4>About the Company</h4>
                                <p>{{ $job->about_company }}</p>
                                <p>
                                    @if ($job->companydetails->company_name)
                                    {{ $job->companydetails->company_name }}
                                    @else
                                    {{ $job->companydetails->full_name }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 offset-1">
                        <div class="browse-contract-staffing">
                            <div class="mb-3 mb-lg-5">
                                <ul class="list-unstyled">
                                    <!-- leads by freelancers -->
                                    @forelse ($job->jobleadresponse as $joblead)
                                    <li class="card p-4 mb-4">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="contract-profile mb-1">
                                                    <a href="#">
                                                        <img src="{{ asset('images/authors/no_avatar.jpg') }}" alt="..." class="img-fluid"/>
                                                    </a>
                                                </div>
                                                <div class="contract-apply text-center">
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn-icon"><img class="img-fluid" src="/assets/img/icons/icon-5.png" alt="Avatar"></a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn-icon"><img class="img-fluid" src="/assets/img/icons/icon-6.png" alt="Avatar"></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- <div class="refer-a-friend">
                                                    <a href="#" class="" title="">Refer a friend</a>
                                                </div> -->
                                                <div class="user-details">

                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="contract-body">
                                                    <div class="mb-2">
                                                        <a href="{{ url('job/profilejoblead') }}/{{ $joblead->job_leads_id }}" class="h3">{{ $joblead->fromuser->full_name }}</a>
                                                        @if ($joblead->lead_status === '1')
                                                        <span class="badge badge-success float-right h4">New</span>
                                                        @endif
                                                    </div>
                                                    <div class="row no-gutters">
                                                        <div class="col-md-6">
                                                            <div class="mb-2">
                                                                <div class="display-5">Key Skills</div>
                                                                <p>{{ $joblead->fromuser->userprofessionalexp->key_skills }} {{ $joblead->fromuser->userprofessionalexp->profile_headline }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 d-none">
                                                            <div class="contract-profile mb-1">
                                                                <img src="{{ asset('assets/img/logo.png') }}" alt="..." class="img-fluid"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row no-gutters">
                                                        <div class="col-md-6">
                                                            <div class="mb-2">
                                                                <div class="display-5">Industry</div>
                                                                <p>Website Designing</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-2">
                                                                <div class="display-5">Experience</div>
                                                                <p>{{ $joblead->fromuser->userprofessionalexp->experience_year }} Years {{ $joblead->fromuser->userprofessionalexp->experience_month }} Month</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-2">
                                                                <div class="display-5">Location</div>
                                                                <p>{{ $joblead->fromuser->userprofessionalexp->currentlocation->name }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3 duration">
                                                                <div class="display-5">No of Projects</div>
                                                                <p>{{ $joblead->fromuser->support_project + $joblead->fromuser->development_project }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @empty
                                    <li class="card p-4 mb-4">
                                        <div class="text-center d-block">
                                            <div>Search list is empty</div>
                                        </div>
                                    </li>
                                    @endforelse
                                    <!-- End Project -->
                                </ul>
                                {{-- <ul class="pager">
                                    {{ $jobleads->withQueryString()->links() }}
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script></script>
<!--global js end-->
@stop
