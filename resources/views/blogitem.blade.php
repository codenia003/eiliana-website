@extends('layouts/default')

{{-- Page title --}}
@section('title')
Blog
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/blog.css') }}">
<!--end of page level css-->
<style type="text/css">
    #photo
    {
        height: 500px ;
        width: 800px;
        border-radius: 9px !important;
    }
    #info
    {
        font-family: serif;
        font-size: 17px;
    }
    #footer
    {
        font-size: 18px;
        margin-right: 300px !important;
    }
    #footer_div
    {
        margin-right: 300px !important;
    }
    /*now code for media query*/
    @media (min-width: 750px)and (max-width: 1150px)
    {
        #title
        {
         font-size: 22px !important ;
         margin-left: 20px !important;
        }
        #photo
        {
        height: 500px !important;
        width: 700px !important;
        border-radius: 9px !important;
        margin-left: 20px !important;
        }
        #info
        {
            font-family: serif;
            font-size: 17px;
            margin-left: 20px !important;
        }
        #footer
        {
            font-size: 17px;
            margin-left: 20px !important;
            margin-right: 10px !important;
        }
        #footer_div
        {
            padding-right: 200px;
        }
    }
    @media (min-width: 550px)and (max-width: 750px)
    {
        #title
        {
            
         font-size: 20px !important ;
         margin-left: 20px !important;
        }
        #photo
        {
        height: 500px !important;
        width: 500px !important;
        border-radius: 9px !important;
        margin-left: 20px !important;
        }
        #info
        {
            font-family: serif;
            font-size: 17px;
            margin-left: 20px !important;
        }
        #footer
        {
            font-size: 17px;
            margin-left: 20px !important;
            margin-right: 100px !important;
            margin-right: 116px !important;
        }
        #footer p
        {
            margin-right: 126px !important;
        }
    }
    @media (min-width: 400px)and (max-width: 550px)
    {
        #title
        {
            
         font-size: 18px !important ;
         margin-left: 15px !important;
        }
        #photo
        {
        height: 400px !important;
        width: 370px !important;
        border-radius: 9px !important;
        margin-left: 10px !important;
        }
        #info
        {
            font-family: serif;
            font-size: 15px;
            margin-left: 10px !important;
        }
        #footer
        {
            font-size: 15px;
            margin-left: 10px !important;
            margin-right: 5px !important;
        }
    }
    @media (min-width: 200px)and (max-width: 400px)
    {
        #title
        {
                /*color: red !important;*/
             font-size: 16px !important ;
             margin-left: 5px !important;
        }
        #photo
        {
            width: 252px !important;
            height: 200px !important;
        border-radius: 9px !important;
        margin-left: 5px !important;
        }
        #info
        {
            font-family: serif;
            font-size: 15px;
            margin-left: 5px !important;
        }
        #footer
        {
            font-size: 15px;
            margin: 0px !important;
            padding: 0px !important;
            margin-left: 1px !important;
            margin-right: 0px !important;
        }
    }

</style>
@stop

{{-- Page content --}}
@section('content')

<div class="account-page">
    <div class="bg-red">
      <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Blog</span>
        </div>
      </div>
    </div>
    <div class="col-md-12 md-2 ">
        
    </div>
</div>
<hr>
<!-- Container Section Strat -->
 <div class="container blogpage">
    <div class="container-fluid m-0 p-0 mt-1" >
        <h2 class="text-primary" id="title">{{$blog->title}}</h2>
    </div>
    <div class="container-fluid m-0 p-0 mb-5 mt-1">
        <p class=" mt-2 text-dark " id="info"> By Jyotsana Punj<!-- {{$blog->author->first_name . ' ' . $blog->author->last_name}} --> &nbsp;&nbsp;&nbsp;<?php  echo date_format($blog->created_at,"M d, Y"); ?></p>
    </div>
    <div class="container-fluid m-0 p-0 mb-5 mt-1" >
        <!-- <img id="photo" class="shadow-sm rounded-lg" src="/assets/img/photo/back.jpg" class="img-fluid p-4" alt=""> -->
        @if($blog->image)
                <img id="photo" class="shadow-sm rounded-lg" src="{{ URL::to('/uploads/blog/'.$blog->image)  }}" class="img-fluid" alt="Image">
                @endif

    </div>
    <br>
    <div class="container-fluid m-0 p-0 mb-5" id="footer_div">
        <p id="footer">{!! $blog->content !!}</p>
    </div>
 </div >
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
