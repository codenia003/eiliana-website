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
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
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
            <span class="h5 text-white ml-2">Staff Lead</span>
        </div>
    </div>
</div>
<div class="container space-1 space-top-lg-0 mt-lg-n10">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
            <div id="notific">
                @include('notifications')
            </div>
            <div class="singup-body login-body account-register">
                <div class="card">
                    <h4 class="card-header text-left">ConatactBy Client</h4>
                    <div class="card-body">
                        <form action="{{ url('/post-staffing-lead') }}" method="POST" id="staffingflead">
                            @csrf
                            <div class="form-new">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="from-name" class="col-form-label">From:</label>
                                        <input type="text" class="form-control" id="from-name" name="fromname" value="{{ Sentinel::getUser()->full_name }}" readonly>
                                    </div>
                                    <div class="form-group col">
                                        <label for="to-name" class="col-form-label">To:</label>
                                        <input type="text" class="form-control" id="to-name" name="toname" value="{{ $user->full_name }}" readonly>
                                        <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="toemail" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lead-id" class="col-form-label">Lead Id:</label>
                                    <input type="text" class="form-control" id="lead-id" name="leadid" value="{{ $staffingleads->staffing_leads_id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="col-form-label">Subject:</label>
                                    <input type="text" class="form-control" name="subject" value="{{ $staffingleads->subject }}" id="subject" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="message-text" name="messagetext" rows="3" readonly>{{ $staffingleads->message }}</textarea>
                                </div>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-primary">Convert to Opportunity</button>
                                    <button class="btn btn-outline-primary">Decline to Opportunity</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
            <div id="sidebarNav" class="navbar-collapse navbar-vertical " style="">
                <div class="position-relative max-w-50rem mx-auto mobile-profile">
                    <!-- Device Mockup -->
                    <div class="device device-iphone-x w-100 mx-auto">
                        <img class="device-iphone-x-frame" src="/assets/img/profile/mobile-bg.png" alt="Image Description">
                        <div class="device-iphone-x-screen">
                            <div class="top-mobile bg-blue bg-img-hero" style="background-image: url(/assets/img/profile/mobile-profile.png);">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <div class="img-upload">
                                            <img class="image-preview avatar-img" src="/assets/img/profile/m-photo-icon.png" class="avatar" alt="Avatar">
                                            <span>Upload Photo</span>
                                        </div>
                                        <button class="btn">{{ Sentinel::getUser()->full_name }}</button>
                                        <p class="card-text font-size-1">
                                            @isset(Sentinel::getUser()->city)
                                            {{ Sentinel::getUser()->city }},
                                            @endisset
                                            {{ Session::get('users')['country_name'] }}
                                            <br>
                                            {{ \Carbon\Carbon::parse(Sentinel::getUser()->created_at)->format('M d, Y')}}
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="bottom-menu">
                                <div class="list-group">
                                    <a class="list-group-item list-group-item-action bg-white-b {!! (Request::is('profile') ? 'active' : '' ) !!}" href="/profile">
                                        <!-- <i class="fas fa-info-circle"></i> -->
                                        <img class="img-fluid" src="/assets/img/profile/icon-1.png" alt="Avatar">
                                        <span>Primary Information</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action bg-blue {!! (Request::is('profile/education') ? 'active' : '' ) !!}" href="/profile/education">
                                        <img class="img-fluid" src="/assets/img/profile/icon-2.png" alt="Avatar">
                                        <span> Education</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action bg-white-b {!! (Request::is('profile/certification') ? 'active' : '' ) !!}" href="/profile/certification">
                                        <img class="img-fluid" src="/assets/img/profile/icon-3.png" alt="Avatar">
                                        <span> Certification</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action bg-blue {!! (Request::is('profile/professional-experience') ? 'active' : '' ) !!}" href="/profile/professional-experience">
                                        <img class="img-fluid" src="/assets/img/profile/icon-4.png" alt="Avatar">
                                        <span> Professional Experience</span>
                                    </a>
                                    <a class="list-group-item list-group-item-action bg-white-b" href="/profile">
                                        <img class="img-fluid" src="/assets/img/profile/icon-5.png" alt="Avatar">
                                        <span> Company Settings</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Device Mockup -->
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
<!--global js end-->
@stop
