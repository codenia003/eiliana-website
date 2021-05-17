@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/blog.css') }}">
<!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
<div class="container thumbnail shadow mt-5 mb-4 sorry-page" id="main">
    <div class="row" id="photo">
        <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Image">
    </div>
    <h1 class="text-danger text-center mt-0 " id="sorry">SORRY</h1>
    <p class="text-center mt-3 pt-3" id="content">We Couldn't Provide Suitable Solution</p>
    <p class="text-center" id="back">Please go back and try again</p>
    <center>
        <a href="{{ url('/') }}" class="btn btn-danger text-center mt-4 mb-5 mt-5 pl-2 pr-2" id="btn"> &nbsp;&nbsp; BACK TO EILIANA  &nbsp;&nbsp;</a>
    </center>
    <br>
    <br>
</div>

@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
