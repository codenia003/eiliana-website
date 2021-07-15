@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
Pricing Plan
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
        padding: 0px 6px;
        text-align: center;
        min-height: 14px;
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
    .pricing_plan h2.red {
        background-color: #e8240c;
        color: white;
        padding: 19px;
        margin: -16px -16px 17px;
        margin-top: -24px;
    }

    .pricing_plan h2.blue {
        background-color: #0b316b;
        color: white;
        padding: 19px;
        margin: -16px -16px 17px;
        margin-top: -24px;
    }

    .contract-staffing{
        margin-top: 2rem!important;
        float:left;
        margin-left: -376px;
    }

    @media only screen and (max-width: 768px) {
        .our-solution .title {
            margin-left: 0px;
        }
        .contract-staffing{
            margin-left: 0px;
        }

        .pricing_plan h2.blue {
            background-color: #0b316b;
            color: white;
            padding: 19px;
            margin: -16px -24px 17px;
            margin-top: -24px;
        }

        .pricing_plan h2.red {
            background-color: #e8240c;
            color: white;
            padding: 19px;
            margin: -16px -24px 17px;
            margin-top: -24px;
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
            <span class="h5 text-white ml-2">Our Flexible Pricing Plan</span>
        </div>
      </div>
    </div>
    <div class="col-md-12 md-2 mt-6" style="margin-top: 0rem!important;">
        <div class="container">
            <div class="row">
                <div class="col p-0">
                    <section class="section container our-solution space-2" style="margin-right: -5px;">
                        <div class="text-center" style="margin-bottom: 20px;">
                            <h1 class="headingmain1">Our Flexible Pricing Plan</h1>
                            <p class="subtitle1">Checkout some of the most popular services people pay for on Eiliana.</p>
                            <div class=""></div>
                        </div>
                        <div style="margin-bottom: 150px;">
                        <div class="title col-md-4 md-2 mt-6" style="margin-top: 2rem!important;float:left;">    
                            <h1 class="red">Projects</h1>
                        </div>
                        <div class="col-md-8 md-2 mt-6" style="max-width:515px;float: left;margin-top: 2rem!important;">    
                             <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                        collaborate, and get work done flexibly and securely</p>
                        </div>
                        </div>
                        <div class="col-md-4 our-solution" style="float: left;">
                            <div class="pricing_plan">
                                <div class="text-center px-lg-3 p-4 mb-3 mt-3">
                                    <figure class="max-w-10rem mx-auto mb-2" style="max-width: 7.5rem;margin-top: -6px;">
                                        <img class="img-fluid" src="/assets/img/profile/hire-1.png" alt="png">
                                    </figure>
                                    <p style="color: #274f8c;font-size: 20px;font-weight: 500;">Lorem ipsum dolor sit amet, 
                                    consectetur adipiscing elit. Mauris hendrerit id quam vel convallis.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 our-solution" style="float: left;">
                            <div class="pricing_plan">
                                <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border" style="height: 315px;">
                                    <h2 class="red">Start-up Plan</h2>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 our-solution" style="float: left;">
                            <div class="pricing_plan">
                                <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border" style="height: 315px;">
                                    <h2 class="blue">Advance Plan</h2>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section container our-solution space-2" style="margin-right: -5px;">
                        <div style="margin-bottom: 150px;">
                            <div class="title contract-staffing col-md-4 md-2 mt-6">    
                                <h1 class="red">Contract Staffing</h1>
                            </div>
                            <div class="col-md-8 md-2 mt-6" style="max-width:515px;float: left;margin-top: 2rem!important;">    
                                <p>Get all the technical gadgetry haselfree! Eiliana makes it easy for quality projects and resources to connect, 
                                            collaborate, and get work done flexibly and securely</p>
                            </div>
                        </div>
                        <div class="col-md-4 our-solution" style="float: left;">
                            <div class="pricing_plan">
                                <div class="text-center px-lg-3 p-4 mb-3 mt-3">
                                    <figure class="max-w-10rem mx-auto mb-2" style="max-width: 8.5rem;">
                                        <img class="img-fluid" src="/assets/img/profile/hire-2.png" alt="png">
                                    </figure>
                                    <p style="color: #274f8c;font-size: 20px;font-weight: 500;">Lorem ipsum dolor sit amet, 
                                    consectetur adipiscing elit. Mauris hendrerit id quam vel convallis.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 our-solution" style="float: left;">
                            <div class="pricing_plan">
                                <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border" style="height: 315px;">
                                    <h2 class="red">Start-up Plan</h2>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 our-solution" style="float: left;">
                            <div class="pricing_plan">
                                <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border" style="height: 315px;">
                                    <h2 class="blue">Advance Plan</h2>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p><hr>
                                    <p>Get all the technical gadgetry</p>
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
