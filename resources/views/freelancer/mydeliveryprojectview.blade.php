@extends('layouts/default')

{{-- Page title --}}
@section('title')
Delivery Project View
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Delivery Project View</span>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container space-1 space-top-lg-0 mt-lg-n10">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
            <div class="card mb-3 mb-lg-5 project-deatils shadow border">
                <form action="{{ url('/post-job-on') }}" method="POST" id="postJobForm">
                    {{-- <div class="card-header">
                        <span class="h5 card-title font-weight-700">Title</span>
                    </div> --}}

                    <div class="card-body">
                        @if($finance->contractdetails->model_engagement == '1')
                        <div class="skills">
                            <span class="h5">No Of Hours Purchase: </span>
                            @foreach($finance->contractdetails->paymentschedule as $paymentschedule)
                            <p>{{ $paymentschedule->hours_purchase }}</p>
                            @endforeach
                        </div>
                        <div class="skills">
                            <span class="h5">No Of Hours Consume: </span>
                            <p>NA</p>
                        </div>
                        <div class="skills">
                            <span class="h5">No Of Hours Balance: </span>
                            <p>NA</p>
                        </div>
                        
                        @elseif($finance->contractdetails->model_engagement == '2')
                            <div class="skills">
                                <span class="h5">Billing Period From</label><small>(Month)</small>: </span>
                                <p>project_duration_max</p>
                            </div>
                            <div class="skills">
                                <span class="h5">Billing Period To</label><small>(Month)</small>: </span>
                                <p>{{ $finance->projectdetail->project_duration_max }}</p>
                            </div>
                        @else
                            <div class="skills">
                                <span class="h5">Porject Start Date: </span>
                                <p></p>
                            </div>
                            <div class="skills">
                                <span class="h5">Porject End Date: </span>
                                <p>NA</p>
                            </div>
                        @endif
                        <hr>
                        <div class="singup-body">
                            <div class="form-group text-right mt-4">
                                <div class="btn-group" role="group">
                                    <a class="btn btn-primary" href="{{ route('project-schedule.my',$delivery_project->project_leads_id) }}">
                                        Schedule
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>       
        </div>
        @include('layouts.left')
    </div>
</div>
@stop

@section('footer_scripts')
@stop