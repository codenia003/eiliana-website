@extends('layouts/default')

{{-- Page title --}}
@section('title')
Register
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
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/register.css') }}">
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="account-page">
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fas fa-bars"></i></span>
                <span class="h5 text-white ml-2">Signup @ Eiliana</span>
            </div>
        </div>
    </div>
    <div class="col-md-8 offset-md-2 mt-6">
        <div id="notific">
            @include('notifications')
        </div>
    </div>
    <div class="col-md-8 offset-md-2 mt-6 shadow p-0 login-body register">
        <div class="singup-body account-register">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <div class="card">
                            <h4 class="card-header">Signup</h4>
                            <div class="card-body">
                                <form action="{{ url('/account/register') }}" method="POST" id="reg_form">
                                    @csrf
                                    <div class="form-group input-field mb-3 {{ $errors->first('mobile', 'has-error') }}">
                                        <input type="text" class="form-control" id="mobile" name="mobile" required/>
                                        <label for="mobile">Mobile Number</label>
                                        {!! $errors->first('mobile', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group input-field {{ $errors->first('email', 'has-error') }}">
                                        @isset(Session::get('teaminvitation')['to_user'])
                                            <input type="text" class="form-control" id="email" name="email" value="{{ Session::get('teaminvitation')['to_user'] }}" required>
                                        @endisset
                                        @empty(Session::get('teaminvitation')['to_user'])
                                            <input type="text" class="form-control" id="email" name="email" required>
                                        @endempty

                                        <label for="email">Email ID</label>
                                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group form-check">
                                        <label for="acceptTerms" class="form-check-label">
                                            <input type="checkbox" name="acceptTerms" id="acceptTerms" class="custom_icheck custom-checkbox pos-rel p-l-30" />
                                            I agree to the Eiliana User agreement and privacy policy
                                        </label>
                                    </div>
                                    <div class="form-group input-field row justify-content-center mt-4 mb-5">
                                        <button class="btn btn-primary">
                                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                            Continue with OTP
                                        </button>
                                        <!-- <br />
                                        <p>Already have an account? <a href="../login" class="bt">Login</a></p> -->
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
                    <div class="col p-0 d-flex align-items-center justify-content-center bg-white bg-img-hero" style="background-image: url(/assets/img/others/singup.png);">
                        <div class="account-second-side text-center">
                            <img src="/assets/img/singin.png" class="img-fluid" alt="">
                            <p class="text-white">Already have an account?</p>
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
<script type="text/javascript" src="{{ asset('/assets/js/register_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/a8d4ee811a.js" crossorigin="anonymous"></script>
<!--global js end-->
@stop
