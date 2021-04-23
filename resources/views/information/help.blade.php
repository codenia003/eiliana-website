@extends('layouts/default')

{{-- Page title --}}
@section('title')
Help
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="account-page">
    <div class="bg-red">
      <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Help</span>
        </div>
      </div>
    </div>
    <div class="col-md-8 offset-md-2 mt-6">
        <div class="container">
            <div class="row">
                <div class="col p-0">
                    <p>Help</p>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
