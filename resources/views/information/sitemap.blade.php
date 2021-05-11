@extends('layouts/default')

{{-- Page title --}}
@section('title')
Site Map
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div class="account-page">
    <div class="bg-red">
      <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Sitemap</span>
        </div>
      </div>
    </div>
    <div class="col-md-12 md-2 mt-6">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{ url('job-posting') }}">Job Posting</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('how-its-work') }}">How Its Work</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('sales-referral') }}">Sales Referral</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('account/login') }}">Account Login</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('pricing-plan') }}">Pricing Plan</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('about') }}">About</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('careers') }}">Careers</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('blog') }}">Blog</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('customers') }}">Customers</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('hire-us') }}">Hire us</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('terms-and-conditions') }}">Terms and Conditions</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('contact-us') }}">Contact Us</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('careers') }}">Careers</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('about') }}">About</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('account/register') }}">Account Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
