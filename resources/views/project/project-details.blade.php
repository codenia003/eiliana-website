@extends('layouts/default')

{{-- Page title --}}
@section('title')
Search Project
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<!--end of page level css-->
<style>
.md-form .card-body {
    position: relative;
    padding: 5px 20px;
}
.md-form .card-body input.form-control {
    border: none;
}
.form-control:focus {
    box-shadow: none;
}
.browse-project h4 {
    font-size: 18px;
}
</style>
@stop

{{-- content --}}
@section('content')
<div class="bg-light browse-project">
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fa fa-bars"></i></span>
                <span class="h5 text-white ml-2">Project</span>
            </div>
        </div>
    </div>
    <div class="container space-top-1 space-top-md-2 space-bottom-2 space-bottom-lg-3">
        <div class="row">
            <div class="col-lg-9">
                <div class="card mb-3 mb-lg-5">
                    <div class="card-header">
                        <span class="h5 card-title text-secondary">Project Deatils</span>
                        <div class="float-right font-weight-700">
                            <span class="bid">$15 - 25 USD /hr</span>
                            <br>
                            <span class="day-left">Bidding Ends In {{ $project->expiry_days }} Days</span>
                        </div>
                    </div>
                    <!-- <div class="card-body mb-3 mb-lg-5 p-4 text-center d-block" *ngIf="loading">
                        <div class="spinner-border spinner-border-lg"></div>
                    </div> -->
                    <div class="card-body">
                        <h5>{{ $project->project_title }}</h5>
                        <p>{{ $project->project_summary }}</p>
                        <div class="skills mt-4">
                            <span class="h5">Skills Required</span>
                            <ul class="nav mt-4">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-light text-dark" href="#">Sales</a>
                                </li>
                                <li class="nav-item ml-1">
                                    <a class="nav-link btn btn-light text-dark" href="#">Internet</a>
                                </li>
                                <li class="nav-item ml-1">
                                    <a class="nav-link btn btn-light text-dark" href="#">Marketing</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mb-5 shadow p-4 mb-4">
                    <div class="border-bottom pb-4">
                        <h4>About the Employer</h4>
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
@stop
{{-- footer scripts --}}
@section('footer_scripts')

<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/login_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<!--global js end-->
@stop
