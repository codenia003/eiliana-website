@extends('layouts/default')

{{-- Page title --}}
@section('title')
Basic Information
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
                <span class="h5 text-white ml-2">Account Registration</span>
            </div>
        </div>
    </div>
    <div class="col-md-8 offset-md-2 mt-6">
        <div id="notific">
            @include('notifications')
        </div>
    </div>
    <div class="col-md-7 offset-md-20 mt-6 shadow p-0 registration-basic register-basic">
        <div class="singup-body login-body account-register">
            <div class="card">
                <h4 class="card-header text-left">Basic Info</h4>
                <div class="card-body">
                    <form action="{{ url('/account/registerbasic') }}" method="POST" id="register_basic_form">
                        @csrf
                        <div class="form-group">
                            <label for="applyas">Apply As</label>
                            <select name="applyas" class="form-control" onchange="changeCompnay(event)">
                                <option value="">--Select--</option>
                                @foreach ($roles as $role)
                                @if ($role->status == 1)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group basic-info">
                            <label>Register As</label>
                            <br>
                            <div class="form-check form-check-inline mb-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="register_as1" class="custom-control-input" name="register_as" value="1" checked>
                                    <label class="custom-control-label" for="register_as1">Freelancer</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="register_as2" class="custom-control-input" name="register_as" value="2">
                                    <label class="custom-control-label" for="register_as2">Client</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="register_as3" class="custom-control-input" name="register_as" value="3">
                                    <label class="custom-control-label" for="register_as3">Both</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row company_show d-none">
                            <div class="form-group col-12">
                                <label>Company Name</label>
                                <input type="text" name="company_name" class="form-control" />
                            </div>
                            <div class="form-group col-12">
                                <label>GST Number/PAN Number</label>
                                <input type="text" name="gst_number" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group basic-info d-none">
                            <label>Title</label>
                            <div class="form-check form-check-inline ml-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="mr" class="custom-control-input" name="title" value="Mr" checked>
                                    <label class="custom-control-label" for="mr">Mr.</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="mrs" class="custom-control-input" name="title" value="Mrs">
                                    <label class="custom-control-label" for="mrs">Mrs.</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group basic-info">
                            <label>Do you keep your profile anonymous?</label>
                            <br>
                            <div class="form-check form-check-inline mb-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Yes" class="custom-control-input" name="anonymous" value="1" onchange="changeAnonymus(event)" checked>
                                    <label class="custom-control-label" for="Yes">Yes</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="No" class="custom-control-input" name="anonymous" value="0" onchange="changeAnonymus(event)">
                                    <label class="custom-control-label" for="No">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" />
                            </div>

                            <div class="form-group col-6">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" class="form-control"/>
                        </div>

                        <div class="form-row">
                            <div class="form-group col anonymousShow">
                                <label>Alias</label>
                                <input type="text" name="pseudoName" class="form-control" />
                            </div>

                            <div class="form-group col anonymousShow-1">
                                <label>Date Of Birth</label>
                                <input type="date" placeholder="DD/MM/YYYY" name="dob" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select name="country" class="form-control">
                                <option value="">--Select--</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-right mt-5">
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary">
                                    <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                    Next <i class="fa fa-angle-right"></i>
                                </button>
                                <button class="btn btn-outline-primary" type="reset" id="reset">Discard</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
<script>
    getDetails();

    function getDetails(){
        // console.log(localStorage.getItem("reg_id"));
        var reg_id = localStorage.getItem("reg_id");
        var username = Math.random().toString(36).substring(7);
        var password = Math.random().toString(36).substring(7);

        $("#register_basic_form").append('<input type="hidden" name="registration_id" id="registration_id" value="'+reg_id+'" />');
        $("#register_basic_form").append('<input type="hidden" name="username" id="username" value="'+username+'" />');
        $("#register_basic_form").append('<input type="hidden" name="password" id="password" value="'+password+'" />');
        $("#register_basic_form").append('<input type="hidden" name="password_confirm" id="password_confirm" value="'+password+'" />');
    }

    function changeAnonymus(e) {
        var publicAnonymus = e.target.value;
        // console.log(publicAnonymus);
        if (publicAnonymus == '1') {
            $('.anonymousShow-1').removeClass("col-12");
            $('.anonymousShow-1').addClass("col")
            $('.anonymousShow').removeClass("d-none");
        } else {
            $('.anonymousShow').addClass("d-none");
            $('.anonymousShow-1').removeClass("col");
            $('.anonymousShow-1').addClass("col-12");
        }
    }

    function changeCompnay(e){
        var value = e.target.value;
        // console.log(value);
        if (value == "2") {
            $('.company_show').addClass("d-none");
            $('.anonymousShow-1 label').text("Date Of Birth");
        } else {
            $('.company_show').removeClass("d-none");
            $('.anonymousShow-1 label').text("Date Of Incorporation");
        }
    }

</script>
<!--global js starts-->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/register_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/a8d4ee811a.js" crossorigin="anonymous"></script>
<!--global js end-->
@stop
