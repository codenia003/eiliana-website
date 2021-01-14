@extends('layouts/default')

{{-- Page title --}}
@section('title')
Job Post
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('vendors/switchery/css/switchery.css') }}" />
<!--end of page level css-->
<style>
    .eiliana-btn {
        height: 47px;
    }
</style>
@stop

{{-- content --}}
@section('content')
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fa fa-bars"></i></span>
                <span class="h5 text-white ml-2">{{ $user->full_name }}</span>
            </div>
        </div>
    </div>
    <div class="container space-1 space-top-lg-0 mt-lg-n10">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="mb-4 mt-3 text-right">
                    <button class="btn btn-md btn-info eiliana-btn" type="button">Modify Search <i class="far fa-edit"></i></button>
                    <button type="button" class="btn btn-md btn-info ml-3 eiliana-btn">New Search <i class="far fa-edit"></i></button>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
                <div id="notific">
                    @include('notifications')
                </div>
                <div class="">

                </div>
            </div>
        </div>
    </div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/switchery/js/switchery.js') }}"></script>
<script></script>
<!--global js end-->
@stop
