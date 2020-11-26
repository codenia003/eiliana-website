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
.js-custom-select {
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #f8f9fa;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
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
<div class="browse-project">
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fa fa-bars"></i></span>
                <span class="h5 text-white ml-2">Search Project</span>
            </div>
        </div>
    </div>
    <div class="container space-top-1 space-top-md-2 space-bottom-2 space-bottom-lg-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="search-box mb-3 mb-lg-5">
                     <div class="md-form">
                        <form action="{{ url('/search-project') }}" method="GET" id="omb_searchForm" class="card card-sm">
                            <div class="card-body row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fa fa-search h4 text-body"></i>
                                </div>
                                <!--end of col-->
                                <div class="col">
                                    <input class="form-control form-control-lg form-control-borderless" name="keyword" type="search" value="{{ $keyword }}" placeholder="Search topics or keywords" required="">
                                </div>
                                <!--end of col-->
                                <div class="col-auto">
                                    <button class="btn btn-primary bg-orange btn-rounded my-2 ml-1" type="submit">Search</button>
                                </div>
                                <!--end of col-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mb-5 shadow p-4">
                    <div class="border-bottom pb-4 mb-4">
                        <h4>My recent searches</h4>
                    </div>
                    <div class="border-bottom pb-4 mb-4">
                        <h4 class="mb-2">Filter by:</h4>
                        <strong>Budget</strong>
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-lg text-body my-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="brandAdidas">
                                <label class="custom-control-label" for="brandAdidas">Fixed Price Project</label>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-sm btn-block btn-soft-secondary transition-3d-hover">Clear All</button> -->
                </div>
            </div>
            <div class="col-lg-9">
                @if (count($projects) >= 1)
                <div class="card mb-3 mb-lg-5">
                    <!-- Sorting -->
                    <div class="row align-items-center p-4">
                        <div class="col-lg-7 mb-3 mb-lg-0">
                            <select class="js-custom-select mr-2">
                                <option value="sort1">Newest first</option>
                                <option value="sort2">Low budget first</option>
                                <option value="sort3">High budget first</option>
                                <option value="sort4">Low bid/entry</option>
                                <option value="sort5">High bid/entry</option>
                            </select>            
                            <span class="font-size-1 ml-1">{{ $count }} Projects jobs found</span>
                        </div>
                        <div class="col-lg-5 align-self-lg-end text-lg-right">
                            <!-- <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <select class="js-custom-select">
                                        <option value="sort1">Highest rated</option>
                                        <option value="sort2">Newest</option>
                                        <option value="sort3">Lowest price</option>
                                        <option value="sort4">Highest price</option>
                                    </select>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                    <!-- End Sorting -->
                    <ul class="list-unstyled border-top">
                        @foreach ($projects as $project)
                        <!-- Project -->
                        <li class="card border-bottom shadow-none p-4">
                            <div class="row no-gutters">
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <span class="d-block font-size-1">
                                                <a class="text-inherit text-dark font-weight-700 mr-1" href="/project/{{ $project['project_id'] }}">{{ $project['project_name'] }}</a>
                                                <span class="text-left ml-1">{{ $project['expiry_days'] }} Days left</span>
                                                <span class="badge badge-success badge-pill ml-1">Verified</span>
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                           <p class="project-description">{{ $project['project_description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="project-price mb-3">
                                        <strong>$123</strong>
                                        <span> (Avg Bid)</span>
                                    </div>
                                    <div class="project-bids">
                                        <span>3 bids</span>
                                    </div>
                                    <!-- <a href="apply/{{ $project['project_id'] }}" class="btn btn-primary bg-orange mr-1 my-2">Apply</a> -->
                                </div>
                            </div>
                        </li>
                        <!-- End Project -->
                        @endforeach
                    </ul>
                </div>
                @else
                <div class="card mb-3 mb-lg-5 p-4 text-center d-block">
                    <!-- <div class="spinner-border spinner-border-lg"></div> -->
                    <div>Search list is empty</div>
                </div>
                @endif
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