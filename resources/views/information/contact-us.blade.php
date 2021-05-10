@extends('layouts/default')

{{-- Page title --}}
@section('title')
Contact Us
@parent
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
    <div class="row">
        <div class="col-md-2 md-2 mt-6"></div>
            <div class="col-md-8 md-2" style="margin-top: 2rem!important;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
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
                                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <label>Name</label>
                                                        <input type="text" name="name" class="form-control" required=""/>
                                                    </div>
                                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <label>Email id</label>
                                                        <input type="email" name="email" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                        <label>Phone number</label>
                                                        <input type="text" name="phone_no" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                                        <label>Message</label>
                                                        <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
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
        <div class="col-md-2 md-2 mt-6"></div>
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
@stop
