@extends('layouts/default')

{{-- Page title --}}
@section('title')
Sales Referral
@parent
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Sales Referral</span>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="sales-referal">
	<div class="shadow1">
        <div class="container space-2">
            <div id="notific">
                @include('notifications')
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 pr-0">
                    <div class="sales-referal-body">
                        <h3>Great money @ Eiliana Project Referral program !!!</h3>
                        <p>Eiliana.com introduces a new referral marketing strategy known as “Smart Sales Referral Program” where in you can refer an IT project on Eiliana.com to us any earn commission decided by you there by creating a win win situation for yourself and your client.</p>
                        <h5>So what are you waiting for?</h5>
                        <p>Submit any IT project today and bag your chance on guaranteed payout chosen by you.</p>
                        <div class="mb-3 mt-3 singup-body">
                            <a class="btn btn-outline-primary bg-yellow yellow-linear-gradient btn-pill text-white" onclick="togglePopup()">New Lead</a>
                            {{-- <a class="btn btn-outline-primary bg-yellow yellow-linear-gradient btn-pill text-white" href="{{ url('sales-referral-form') }}">New Lead</a> --}}
                            <a class="btn btn-outline-primary bg-orange red-linear-gradient btn-pill text-white ml-3" onclick="togglePopup()">Check Status</a>
                        </div>
                        {{-- <img src="/assets/img/profile/sales-details.png" class="img-fluid" alt=""> --}}
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                    <div class="contractual">
                        {{-- <h4>Make great money through Eiliana sales Referral program !!!</h4> --}}
                		<img src="/assets/img/profile/sales-referal-new.png" class="img-fluid" alt="">
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
