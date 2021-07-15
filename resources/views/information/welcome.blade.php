@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
Welcome
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
@if ($response['success'] == '0')
<div class="welcome-page" style="background-color: #fba602;">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                    <div class="col-md-4">
                        <div class="welcome">
                            <div class="wel-img">
                                    <img class="img-fluid" src="/assets/img/profile/hire-1.png" alt="png">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 welcome-content">
                        <div class="welcome">
                            <div class="col-lg-8 content1">
                                @if (isset(Session::get('users')['login_as']))
                                <h2 class="user-name" style="font-family: serif;">Hi {{ Sentinel::getUser()->full_name }},</h2>
                                @endif
                                <h2 class="user-text" style="font-family: serif;">Welcome to Eiliana Family !!!</h2>
                                <p>We are building the largest community of Gig-<br>
                                Resources globally who will transform the lives of billions of <br>
                                people through their technology enabled solutions. Look for-<br>ward
                                for your valuable and greater contrubtion.</p>
                            </div>
                        </div>
                        <div class="col p-0 d-flex align-items-center">
                            <div class="account-second-side text-center">
                                <button class="login_signup_blue blue-linear-gradient text-white ml-3" onclick="togglePopup()">BROWSE PROJECTS</button>
                                <button class="login_signup red-linear-gradient text-white ml-3" onclick="togglePopup()">SALES REFERRAL</button>
                                <!-- <a onclick="togglePopup()" class="btn btn-light bt btn-lg blue">BROWSE PROJECTS</a>
                                <a onclick="togglePopup()" class="btn btn-light bt btn-lg red">SALES REFERRAL</a> -->
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="welcome-page welcom-update bg-img-hero" style="background-image: url(/assets/img/profile/welcome.png);">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                    <div class="col-md-5">
                        {{-- <div class="welcome">
                            <div class="wel-img">
                                    <img class="img-fluid" src="/assets/img/profile/hire-1.png" alt="png">
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-md-7 welcome-content">
                        <div class="welcome">
                            <div class="content1">
                                @if (isset(Session::get('users')['login_as']))
                                <h2 class="user-name" style="font-family: serif;">Hi {{ Sentinel::getUser()->full_name }},</h2>
                                @endif
                                <h2 class="user-text" style="font-family: serif;">Congratulations !!!</h2>
                                <p>Your resume has been updated successfully. <br> we will keep informing you about the new assignments Basis the new criterion suggested by you.</p>
                            </div>
                        </div>
                        <div class="p-0 d-flex align-items-center">
                        <div class="account-second-side text-center">
                            <button class="login_signup blue-linear-gradient text-white ml-3" onclick="togglePopup()">BROWSE PROJECTS</button>
                            <button class="login_signup red-linear-gradient text-white ml-3" onclick="togglePopup()">SALES REFERRAL</button>
                            <!-- <a onclick="togglePopup()" class="btn btn-light bt btn-lg blue">BROWSE PROJECTS</a>
                            <a onclick="togglePopup()" class="btn btn-light bt btn-lg red">SALES REFERRAL</a> -->
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endif
@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
