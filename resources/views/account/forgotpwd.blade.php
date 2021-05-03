@extends('layouts/default')

{{-- Page title --}}
@section('title')
Change Password
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
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="account-page">
    <div class="bg-red">
      <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Forgot Password</span>
        </div>
      </div>
    </div>
    <div class="col-md-8 offset-md-2 mt-2">
        <div id="notific">
            @include('notifications')
        </div>
    </div>
    <div class="col-md-8 offset-md-2 mt-6 shadow p-0 login-body">
        <div class="singup-body account-register">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-0">
                        <div class="card">
                            <h4 class="card-header">Forgot Password</h4>
                            <div class="card-body">
                                <form action="{{ route('forgot-password') }}" class="omb_loginForm" autocomplete="off" method="POST">
                                    {!! Form::token() !!}
                                    <div class="form-group">
                                        <label for="email">Enter your email to reset your password</label>
                                        <input type="email" class="form-control email" name="email" id="email" placeholder="Email"
                                            value="{!! old('email') !!}">
                                        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                                    </div>
                                    <div class="form-group text-center">
                                        <input class="form-control btn btn-primary btn-block" type="submit" value="Reset Your Password">
                                    </div>
                                </form>
                                Back to login page?<a href="{{ route('login') }}"> Click here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-0 d-flex align-items-center justify-content-center bg-white bg-img-hero" style="background-image: url(/assets/img/others/change-password.png);">
                        <!-- <div class="account-second-side text-center">
                            <img src="/assets/img/singin.png" class="img-fluid" alt="">
                            <p class="text-white">Not a member yet?</p>
                            <a href="/account/register" class="btn btn-light bt btn-lg">SingUp Now</a>
                        </div> -->
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
<script src="https://kit.fontawesome.com/a8d4ee811a.js" crossorigin="anonymous"></script>
<!--global js end-->
<script>
    getDetails();

    function getDetails(){
        // console.log(localStorage.getItem("reg_id"));
        var user_id = localStorage.getItem("user_id");
        $("#first_loginForm").append('<input type="hidden" name="user_id" id="user_id" value="'+user_id+'" />');
    }
</script>
@stop
