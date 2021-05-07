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

		.login-body {
			border: 1px solid #e4e0e0;
			border-radius: 30px;
		}

		.big-img {
			border-right: 2px solid #ffffff;
			margin: 50px;
			height: 176px;
        }

		@media (min-width: 768px){
			.big-img {
				border-right: 2px solid #3b5998;
			}

            /* .account-page {
				width: 1643px;
			} */
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
    <div class="col-md-8 offset-md-2 mt-6 shadow p-0 login-body">
        <div class="singup-body account-register">
            <div class="container">
                <div class="row">
				    <div class="col p-0 d-flex align-items-center justify-content-center bg-white bg-img-hero big-img">
                        <div class="account-second-side text-center">
                            <img src="/assets/img/user_img.jpg" class="img-fluid" alt="" style="width: 232px;border-radius: 50%;margin-top: 303px;margin-bottom: 5px;">
                            <h2 style="font-size: 25px;color: #41418a;">Carles Brown</h2>
                            <!-- <h2 style="font-size: 25px;color: #41418a;">{!! Session::get('users') !!}</h2> -->
							<p>Wizard Infoways Private Limited <br> Noida India</p>
                            <!-- <a href="/account/register" class="btn btn-light bt btn-lg">Signup Now</a> -->
                        </div>
                    </div>
                    <div class="col p-0 d-flex align-items-center justify-content-center bg-white bg-img-hero" style="margin: 50px;height: 238px;">
                        <div class="account-second-side text-center">
                            <img src="/assets/img/logout1.png" class="img-fluid" alt="" style="width: 370px;margin-top: 228px;">
                            <a href="#" class="btn btn-light bt btn-lg" style="float: none;margin-left: 32px;">Refer of frelancer</a>
                            <a href="/account/login" class="btn btn-light bt btn-lg">Login</a>
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
