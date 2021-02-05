@extends('layouts/default')

{{-- Page title --}}
@section('title')
Job Post
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('vendors/switchery/css/switchery.css') }}" />
<!--end of page level css-->
<style>
    .eiliana-btn {
        height: 47px;
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
                                <div class="float-right font-weight-700">
                                </div>
                            </div>
                            <!-- <div class="card-body mb-3 mb-lg-5 p-4 text-center d-block" *ngIf="loading">
                                <div class="spinner-border spinner-border-lg"></div>
                            </div> -->
                            <div class="card-body">
                                <h5>{{ $job->job_title }}</h5>
                                <p>{{ $job->role_summary }}</p>
                                <div class="skills mt-4">
                                    <span class="h5">Skills Required</span>
                                    <p>{{ $job->key_skills }}</p>
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
                            <!-- <div class="border-bottom pb-4 mt-4">
                                <h4 class="mb-2"><strong>Employer Verification</strong></h4>
                            </div> -->
                        </div>
                        <div class="card mb-5 shadow p-4">
                            <ul class="list-unstyled list-sm-article">
                                <li>
                                    <a class="row align-items-center mx-n2 font-size-1" href="javascript:;">
                                        <div class="col-10 px-2">
                                            <span class="text-dark">Bid Left</span>
                                        </div>

                                        <div class="col-2 text-right px-2">
                                            <span>12</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="row align-items-center mx-n2 font-size-1" href="javascript:;">
                                        <div class="col-10 px-2">
                                            <span class="text-dark">Average Bid</span>
                                        </div>
                                        <div class="col-2 text-right px-2">
                                            <span>12</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
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
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/switchery/js/switchery.js') }}"></script>
<script></script>
<!--global js end-->
@stop
