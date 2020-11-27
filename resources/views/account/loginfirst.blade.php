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
            <span class="h5 text-white ml-2">Change Your Password</span>
        </div>
      </div>
    </div>
    <div class="col-md-8 offset-md-2 mt-6 shadow p-0 login-body">
        <div class="singup-body">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <div class="card">
                            <h4 class="card-header">Change Your Password</h4>
                            <div class="card-body">
                                <form action="{{ url('/account/loginfirst') }}" method="POST" id="first_loginForm">
                                    @csrf
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirmPassword" class="form-control" />
                                    </div>
                                    <div class="form-group row justify-content-center mt-3 mb-5">
                                        <button class="btn btn-primary">
                                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                            Change Password
                                        </button>
                                        <!-- <br /> -->
                                        <!-- <p>Not a member yet? <a href="../register" class="bt">Singup Now</a></p> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col p-0 d-flex align-items-center justify-content-center bg-white bg-img-hero" style="background-image: url(/assets/img/others/change-password.png);">
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