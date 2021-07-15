@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
Contact Us
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick-carousel/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/index.css') }}">
<!--end of page level css-->
<style>
    .profile-basic .card-header {
        display: block;
    }
</style>
@stop

{{-- content --}}
@section('content')
<div class="account-page">
    <div class="bg-red">
      <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Contact Us</span>
        </div>
      </div>
    </div>
    <div class="col-md-12 md-2 mt-6">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 p-0">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="singup-body shadow login-body profile-basic" style="border: 1px solid #a3a3a3;">
                        <div class="card">
                            <h4 class="card-header">Contact Us</h4>
                            <div class="card-body p-4">
                                <form action="{{ url('/contact-us-post') }}" method="POST" id="contact_form">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-12">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" required=""/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        @if (Session::get('users')['login_as'] == '1')
                                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                            <label>Email id</label>
                                            <input type="email" name="email" class="form-control" value="{{ session()->get('users')->email }}" readonly>
                                        </div>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                            <label>Email id</label>
                                            <input type="email" name="email" class="form-control" value="{{ session()->get('users')->email }}" readonly>
                                        </div>
                                        @else
                                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                            <label>Email id</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                        @endif
                                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6">
                                            <label>Phone number</label>
                                            <input type="text" name="phone_no" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-12">
                                            <label>Subject</label>
                                            <input type="text" name="subject" class="form-control" required=""/>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                            <label>Message</label>
                                            <textarea name="message" id="" cols="30" rows="6" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group text-right mt-5">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary" type="submit">
                                                <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
<!-- page level js starts-->
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/wow/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/slick-carousel/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/index.js') }}"></script>
<!--page level js ends-->
<script>
      $('#contact_form').bootstrapValidator({});
</script>
@stop
