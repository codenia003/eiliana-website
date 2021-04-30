@extends('layouts/default')

{{-- Page title --}}
@section('title')
How Its Work
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

<style>
   .our-slotuion h6 {
        min-height: 20px;
    }

    .our-slotuion p {
        font-size: 13px;
        padding: 5px 3px;
        text-align: center;
        min-height: 70px;
    }
    .our-slotuion {
        float: left;
        margin: 6px;
    }
    .title h1.red {
        color: #b8180c;
        border-right: 2px solid #f89a14;
        height: 65px;
        font-size: 30px;
    }

    @media (min-width: 768px){
        .it_work {
            width: 0px;
        }
    }
</style>
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="account-page">
    <div class="bg-red">
      <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">How Its Work</span>
        </div>
      </div>
    </div>
    <div class="col-md-12 md-2 mt-6" style="margin-top: 0rem!important;">
        <div class="container">
            <div class="row">
                <div class="col p-0">
                    <section class="section container our-solution space-2" style="margin-right: -40px;">
                        <div class="text-center" style="margin-bottom: 20px;">
                            <h1 class="headingmain1">How It Works</h1>
                            <p class="subtitle1">Checkout some of the most popular services people pay for on Eiliana.</p>
                            <div class=""></div>
                        </div>
                        <div class="title col-md-4 md-2 mt-6" style="margin-top: 2rem!important;float:left;">    
                            <h1 class="red">Freelancer</h1>
                        </div>
                        <div class="col-md-8 md-2 mt-6" style="max-width:515px;float: left;margin-top: 2rem!important;">    
                             <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work" style="width: 250px;">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/solution-2.png" alt="png">
                                        </figure>
                                        <h6 class="red">Hire Best Developers for your Projects</h6>
                                        <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work" style="width: 250px;">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/solution-2.png" alt="png">
                                        </figure>
                                        <h6 class="red">Hire Best Developers for your Projects</h6>
                                        <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work" style="width: 250px;">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/solution-2.png" alt="png">
                                        </figure>
                                        <h6 class="red">Hire Best Developers for your Projects</h6>
                                        <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work" style="width: 250px;">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/solution-2.png" alt="png">
                                        </figure>
                                        <h6 class="red">Hire Best Developers for your Projects</h6>
                                        <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section container our-solution space-2" style="margin-right: -40px;">
                        
                        <div class="title col-md-4 md-2 mt-6" style="margin-top: 2rem!important;float:left;">    
                            <h1 class="red">Client</h1>
                        </div>
                        <div class="col-md-8 md-2 mt-6" style="max-width:515px;float: left;margin-top: 2rem!important;">    
                             <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work" style="width: 250px;">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/solution-2.png" alt="png">
                                        </figure>
                                        <h6 class="red">Hire Best Developers for your Projects</h6>
                                        <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work" style="width: 250px;">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/solution-2.png" alt="png">
                                        </figure>
                                        <h6 class="red">Hire Best Developers for your Projects</h6>
                                        <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work" style="width: 250px;">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/solution-2.png" alt="png">
                                        </figure>
                                        <h6 class="red">Hire Best Developers for your Projects</h6>
                                        <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work" style="width: 250px;">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/solution-2.png" alt="png">
                                        </figure>
                                        <h6 class="red">Hire Best Developers for your Projects</h6>
                                        <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
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
@stop
