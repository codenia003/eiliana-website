@extends('layouts/default')

{{-- Page title --}}
@section('title')
Login
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
            <span class="h5 text-white ml-2">Login</span>
        </div>
      </div>
    </div>
    <div class="col-md-8 offset-md-2 mt-6 shadow p-0 login-body">
        <div class="singup-body account-register">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <div class="card">
                            <h4 class="card-header">Login</h4>
                            <div class="card-body">
                                <form action="{{ url('/account/login') }}" method="POST" id="omb_loginForm">
                                    @csrf
                                    <div class="form-group input-field">
                                        <input type="text" name="email" class="form-control" required/>
                                        <label for="username">Email ID</label>
                                    </div>
                                    <div class="form-group input-field">
                                        <input type="password" name="password" class="form-control" required />
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group form-check col-4 pl-1">
                                            <input type="checkbox" id="remenber" class="form-check-input" required />
                                            <label for="remenber" class="form-check-label">Remember</label>
                                        </div>
                                        <div class="form-group col-8">
                                           <!-- <p class="text-right"><a href="{{ route('forgot-password') }}" class="bt">Forgot Username/Password</a></p> -->
                                           <p class="text-right"><a href="#" class="bt">Forgot Password</a></p>
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center mt-3 mb-5">
                                        <button class="btn btn-primary">
                                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                            Login
                                        </button>
                                        <!-- <br /> -->
                                        <!-- <p>Not a member yet? <a href="../register" class="bt">Singup Now</a></p> -->
                                    </div>
                                </form>
                                <div class="omb_row-sm-offset-3 omb_socialButtons text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item"><a href="{{ url('/facebook') }}" class="btn btn-icon btn-ghost-light bg-facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="list-inline-item"><a href="{{ url('/google') }}" class="btn btn-icon btn-ghost-light"><i class="fab fa-google"></i></a></li>
                                        <li class="list-inline-item"><a href="{{ url('/linkedin') }}" class="btn btn-icon btn-ghost-light bg-linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col p-0 d-flex align-items-center justify-content-center bg-white bg-img-hero" style="background-image: url(/assets/img/others/login-1.png);">
                        <div class="account-second-side text-center">
                            <img src="/assets/img/singin.png" class="img-fluid" alt="">
                            <p class="text-white">Not a member yet?</p>
                            <a href="/account/register" class="btn btn-light bt btn-lg">SignUp Now</a>
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