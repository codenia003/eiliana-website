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
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/flatpickr/css/flatpickr.min.css') }}" rel="stylesheet"
type="text/css"/>
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
                <span class="h5 text-white ml-2"></span>
            </div>
        </div>
    </div>
    <div class="container space-1 space-top-lg-0 mt-lg-n10">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
                <div class="card mb-3 mb-lg-5 project-deatils shadow border">
                    <form action="{{ url('/post-job-on') }}" method="POST" id="postJobForm">
                        @csrf
                        @isset(Session::get('sales_referral')['referral_id'])
                        <input type="hidden" name="referral_id" value="{{ Session::get('sales_referral')['referral_id'] }}">
                        @endisset
                        @isset(Session::get('contractsattfing')['model_engagement'])
                        <input type="hidden" name="model_engagement" value="{{ Session::get('contractsattfing')['model_engagement'] }}">
                        @endisset
                        @empty(Session::get('sales_referral')['referral_id'])
                        <input type="hidden" name="referral_id" value="0">
                        @endempty

                        <input type="hidden" name="notice_period" value="{{ Session::get('post_job_data')['notice_period'] }}">
                        <input type="hidden" name="job_title" value="{{ Session::get('post_job_data')['job_title'] }}">
                        <input type="hidden" name="key_skills" value="{{ Session::get('post_job_data')['key_skills'] }}">
                        <input type="hidden" name="role_summary" value="{{ Session::get('post_job_data')['role_summary'] }}">
                        <input type="hidden" name="technologty_pre" value="{{ json_encode(Session::get('post_job_data')['technologty_pre']) }}">
                        <input type="hidden" name="customer_industry" value="{{ Session::get('post_job_data')['customer_industry'] }}">
                        <input type="hidden" name="experience_year" value="{{ Session::get('post_job_data')['experience_year'] }}">
                        <input type="hidden" name="experience_month" value="{{ Session::get('post_job_data')['experience_month'] }}">
                        <input type="hidden" name="budget_from" value="{{ Session::get('post_job_data')['budget_from'] }}">
                        <input type="hidden" name="budget_to" value="{{ Session::get('post_job_data')['budget_to'] }}">
                        <input type="hidden" name="location" value="{{ Session::get('post_job_data')['location'] }}">
                        <input type="hidden" name="contract_duration_from" value="{{ Session::get('post_job_data')['contract_duration_from'] }}">
                        <input type="hidden" name="contract_duration_to" value="{{ Session::get('post_job_data')['contract_duration_to'] }}">

                        <div class="card-header">
                            <span class="h5 card-title font-weight-700">{{ Session::get('post_job_data')['job_title'] }}</span> 
                            {{-- <div class="font-weight-500">
                                <span class="day-left">Bidding Ends In {{ $job->expiry_days }} Days</span><br>
                            </div> --}}
                        </div>

                        <div class="card-body">
                            <div class="skills">
                                <span class="h5">Job Description: </span>
                                <p>{{ Session::get('post_job_data')['role_summary'] }}</p>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Budget: </span>
                                <span>{{ Session::get('post_job_data')['budget_from'] }} to {{ Session::get('post_job_data')['budget_to'] }}</span>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Notice Period(Months): </span>
                                <span>{{ Session::get('post_job_data')['notice_period'] }}</span>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Experience Required: </span>
                                <span>{{ Session::get('post_job_data')['experience_year'] }} Year to {{ Session::get('post_job_data')['experience_month'] }} Year</span>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Contract Duration: </span>
                                <span>{{ Session::get('post_job_data')['contract_duration_from'] }}  Month to {{ Session::get('post_job_data')['contract_duration_to'] }} Month</span>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Skills Required: </span>
                                <span>{{ Session::get('post_job_data')['key_skills'] }}</span>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Customer Industry: </span>
                                <span>
                                    @foreach ($customerindustries as $industry)
                                        @if(Session::get('post_job_data')['customer_industry']== $industry->customer_industry_id)
                                            <span>{{ $industry->name }}</span>
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Technology: </span>
                                <?php $technologty_pre = (array) Session::get('post_job_data')['technologty_pre']; ?>
                                @foreach ($technologies as $technology)
                                    @if(in_array($technology->technology_id, $technologty_pre))
                                        <span>{{ $technology->technology_name }}</span> ,
                                    @endif
                                @endforeach
                            </div>
                            <p class="mt-4 font-weight-700">Posted On {{  \Carbon\Carbon::now()->isoFormat('MMM Do YYYY') }}</p>

                            <hr>
                            <div class="singup-body">
                                <div class="form-group text-right mt-4">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary" type="submit">
                                            Publish Online
                                        </button>
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

{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>

<!--global js end-->
@stop
