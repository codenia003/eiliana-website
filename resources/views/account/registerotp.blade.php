@extends('layouts/default')

{{-- Page title --}}
@section('title')
OTP Verification
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
<style>
       .align-items-center .login_side {
            margin-top: 42px;
		}

        .align-items-center .otp_img {
            margin-top: 94px;
		}

        .register-otp{
            margin-bottom: -30px !important;
        }

		@media only screen and (max-width: 768px){
            .register-otp{
                margin-bottom: 0px !important;
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
                <span class="border-title"><i class="fas fa-bars"></i></span>
                <span class="h5 text-white ml-2">OTP Verification</span>
            </div>
        </div>
    </div>
    <div class="col-md-8 offset-md-2 mt-6">
        <div id="notific">
            @include('notifications')
        </div>
    </div>
    <div class="col-md-8 offset-md-2 mt-6 shadow p-0 login-body register-otp">
        <div class="singup-body register-otp account-register">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-0">
                        <div class="card">
                            <h4 class="card-header">OTP Verification</h4>
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="/assets/img/otp-verif.png" class="img-fluid" alt="">
                                </div>
                                <p class="d-flex"><i class="fa fa-arrow-right"></i><span class="text-dark">Please enter the one-time password to verify your account</span></p>
                                <p class="text-secondary ml-4" id="mobile_otp"></p>
                                <form action="{{ url('/account/registerotp') }}" method="POST" id="otp_form" class="list-form">
                                    @csrf
                                    <div class="form-group input-field">
                                        <input type="text" name="otp" id="otp" class="form-control" required />
                                        <label for="otp">OTP For Email</label>
                                    </div>
                                    <div class="form-group input-field">
                                        <input type="text" name="otpm" id="otpm" class="form-control" required />
                                        <label for="otpm">OTP For Mobile</label>

                                    </div>
                                    <div class="form-group row justify-content-center mt-5 mb-2">
                                        <button class="btn btn-primary">
                                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                            Validate
                                        </button>
                                        <a onclick="resendOtp()" class="bt text-blue">Resend One-Time-Password</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-12 col-sm-12 col-md-6 col-lg-6 p-0 d-flex align-items-center justify-content-center bg-img-hero" style="background-image: url(/assets/img/others/OTP-verification.jpg);">
                        <div class="account-second-side text-center">
                            <img src="/assets/img/singin.png" class="img-fluid" alt="">
                            <p class="text-white">Already have an account?</p>
                            <a href="/account/login" class="btn btn-light bt btn-lg">Login</a>
                        </div>
                    </div>--}}
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-0 align-items-center justify-content-center">
                        <div class="account-second-side text-center login_side">
                            <img src="/assets/img/singin.png" class="img-fluid" alt="">
                            <p class="text-white">Already have an account?</p>
                            <a href="/account/login" class="btn btn-light bt btn-lg">Login</a>
                        </div>
                        <div class="account-second-side text-center otp_img">
                            <img src="/assets/img/others/OTP-verification.jpg" class="img-fluid" alt="">
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
<script>
    getDetails();

    function getDetails(){
        // console.log(localStorage.getItem("reg_id"));
        var reg_id = localStorage.getItem("reg_id");
        var mobile_otp_x = localStorage.getItem("mobile_otp");
        var email_otp = localStorage.getItem("email_otp");

        var mobile_otp = 'A one time password has been send to <b>'+email_otp+'</b> and Email <b>'+mobile_otp_x+'</b>';
        $("#mobile_otp").append(mobile_otp);
        $("#otp_form").append('<input type="hidden" name="reg_id" id="reg_id" value="'+reg_id+'" />');
    }

    function resendOtp(){
        // console.log('otp send');
        var url = '/account/resendotp';
        var reg_id = localStorage.getItem("reg_id");
        var data= {
            _token: "{{ csrf_token() }}",
            reg_id:reg_id
        };
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(data) {
                var userCheck = data;
                if (userCheck.success == '1') {
                    Swal.fire({
                        type: 'success',
                        title: 'Success...',
                        text: userCheck.errors,
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: userCheck.errors,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }

            },
            error: function(xhr, status, error) {
                console.log("error: ",error);
            },
        });
    }

</script>
@stop
