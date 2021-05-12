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

<div class="container thumbnail shadow mt-5 mb-4" style="border-radius: 30px;width: 70%;">
    <div class="row" style="align-content: flex-start; margin-top: 30px;margin-left: 30px;height: 150px;width: 150px;">
        <img src="{{ URL::to('/uploads/blog/eiliana.png')  }}" class="img-fluid" alt="Image">
    </div>
    <h1 class="text-danger text-center mt-4 pt-5" style="font-size: 50px;font-weight: 400;">SORRY</h1>
    <p class="text-center mt-3 pt-3" style="font-weight: bold;font-size: 30px;font-weight: 500;">We Coundn't Provide Suitable Solution</p>
    <p class="text-center" style="font-size: 22px;opacity: 0.8;">Please go back and tya again</p>
    <center>
        <a href="#" class="btn btn-danger text-center mt-4 mb-5 mt-5 pl-2 pr-2" style="background-color: #b31717; color: white;border-radius: 20px;font-size: 13px;font-weight: bold;"> &nbsp;&nbsp; BACK TO EILIANA  &nbsp;&nbsp;</a>
    </center>
    <br>
    <br>
</div>

@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
