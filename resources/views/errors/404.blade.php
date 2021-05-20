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
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<style type="text/css">
 #main
{
    border-radius: 30px;
    width: 60%;
}
 #sorry
{
    font-size: 50px;
    font-weight: 400;
}
 #content
{
    font-weight: bold;
    font-size: 30px;
    font-weight: 500;
}
 #back
{
    font-size: 22px;
    opacity: 0.8;
}
 #btn
{
    background-color: #b31717;
    color: white;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
}
.#photo
{
    align-content: flex-start;
    margin-top: 20px;
    margin-left: 30px;
    height: 150px;
    width: 150px;
}
@media only screen and (max-width: 768px) {

    #main
    {
        border-radius: 12px !important;
    }
     #main img
    {
        height: 20px !important;
        margin-left: -23px !important;
        margin-top: -14px !important;
        width: 70px !important;
    }

     #sorry
    {
        margin-top: -70px !important;
        font-size: 27px !important;
    }
     #content
    {
        font-size: 13px !important;
    }
     #back
    {
        font-size: 14px !important;
    }
     #btn
    {
        margin: 0px !important;
        padding: 0px !important;
        padding-left: 4px !important;
        padding-right: 4px !important;
    }
}
 @media only screen and (max-width: 650px)
     {
        #main
        {
        
            width: 80% !important;
            border-radius: 12px !important;
           

        }
        #main img
        {
               height: 20px !important;
            margin-left: -23px !important;
                margin-top: -14px !important;
            width: 70px !important;
        }
        
        #sorry
        {
                margin-top: -111px !important;
            font-size: 27px !important;
        }
        #content
        {
            font-size: 13px !important;
        }
        #back
        {
            margin-top: -14px !important;
            font-size: 14px !important;
        }
         #btn
         {
            margin: 0px !important;
            padding: 0px !important;
            padding-left: 4px !important;
            padding-right: 4px !important;
         }
     }

</style>
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
