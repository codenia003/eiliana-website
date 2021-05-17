@extends('layouts/default')

{{-- Page title --}}
@section('title')
Logout
@parent
@stop


{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('css/pages/form2.css') }}" rel="stylesheet" />
<link href="{{ asset('css/pages/form3.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/login.css') }}">
<style>
       .account-second-side p {
			font-size: 14px;
			font-weight: 400;
			color: #454d84 !important;
		}

        .account-register{
            margin-left: -175px;
        }

		.account-second-side a.bt {
			color: #ffffff;
			font-size: 13px !important;
			border-radius: 0px;
			padding: 8px 20px;
			font-weight: 400;
			background-color: #de4b39;
			border-color: #de4b39;
			border-radius: 40px;
			float: right;
		}

        .account-second-side .logout_img{
            width: 232px;
            border-radius: 50%;
            margin-top: 303px;
            margin-bottom: 5px;
        }

		.logout_page {
			border: 1px solid #e4e0e0;
			border-radius: 30px;
            margin-left: 100px;
		}

        .logout_sidebar{
            margin: 50px;
            height: 238px;
        }

		.big-img {
            border-right: 2px solid #3b5998;
			margin: 50px;
			height: 176px;
            margin-left: -90px;
        }

        .logout_content{
            width: 470px;
            margin-top: 215px;
        }

		@media only screen and (max-width: 768px){
			.big-img {
				border-right: 2px solid #ffffff;
                margin-left: 45px;
                margin-top: 90px;
			}

            .logout_page .logout_img{
                border-right: 2px solid #ffffff;
                width: 232px;
                border-radius: 50%;
                margin-top: 303px;
                margin-bottom: 5px;
                margin: 50px;
                height: 176px;
            }
            .logout_page .logout_content{
                height: 120px;
                margin-top: 0px;
            }
            .logout_page {
                margin-left: 0px;
            }
            .account-register {
                margin-left: 0px;
            }

            .logout_sidebar {
                margin-left: 74px !important;;
            }
        
        }
</style>
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="account-page">
    <div class="bg-red">
      <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Logout </span>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-8 offset-md-2 mt-6 shadow p-0 logout_page">
        <div class="singup-body account-register">
            <div class="container">
                <div class="row">
				    <div class="col p-0 d-flex align-items-center justify-content-center bg-img-hero big-img">
                        <div class="account-second-side text-center">
                        @if(!empty($user->pic))
                            <img src="{!! $user->pic !!}" class="img-fluid logout_img" alt="">
                          @else
                            <img src="/assets/img/user_img.jpg" class="img-fluid logout_img" alt="">
                          @endif 
                            <h2 style="font-size: 25px;color: #41418a;">{!! $user->first_name !!} {!! $user->last_name !!}</h2>
                            <p>@if($user->company_name){!! $user->company_name !!}@endif <br> {!! $user_country->name !!}</p>
                            <!-- <a href="/account/register" class="btn btn-light bt btn-lg">Signup Now</a> -->
                        </div>
                    </div>
                    <div class="col p-0 d-flex align-items-center justify-content-center bg-img-hero logout_sidebar">
                        <div class="account-second-side text-center">
                            <img src="/assets/img/logout_page.png" class="img-fluid logout_content" alt="">
                            <button class="login_signup red-linear-gradient text-white ml-3" onclick="location.href='/account/login'">Refer of frelancer</button>
                            <button class="login_signup red-linear-gradient text-white ml-3" onclick="location.href='/account/login'">Login</button>
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
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/login_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<!--global js end-->
@stop
