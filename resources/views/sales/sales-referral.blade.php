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
<section class="jumbotron text-center">
    <div class="container">
        <div id="notific">
            @include('notifications')
        </div>
        <h1 class="jumbotron-heading">Sales Referral</h1>
        <p class="lead text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
        <p>
            <a href="{{ url('sales-referral-form') }}" class="btn btn-primary my-2">Submit From</a>
            <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
    </div>
</section>
@stop
