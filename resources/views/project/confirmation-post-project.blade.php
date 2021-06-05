@extends('layouts/default')

{{-- Page title --}}
@section('title')
Search Project
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<!--end of page level css-->
<style>
.md-form .card-body {
    position: relative;
    padding: 5px 20px;
}
.md-form .card-body input.form-control {
    border: none;
}
.form-control:focus {
    box-shadow: none;
}
.browse-project h4 {
    font-size: 18px;
}
</style>
@stop

{{-- content --}}
@section('content')
<div class="browse-project">
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fa fa-bars"></i></span>
                <span class="h5 text-white ml-2">Project Deatils</span>
            </div>
        </div>
    </div>
    <div class="container space-top-1 space-top-md-2 space-bottom-2 space-bottom-lg-3">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
                <div id="notific">
                    @include('notifications')
                </div>
                <div class="card mb-3 mb-lg-5 project-deatils shadow border">
                    <form action="{{ url('/post-project-on') }}" method="POST" id="postJobForm">
                        @csrf
                        @isset(Session::get('sales_referral')['referral_id'])
                        <input type="hidden" name="referral_id" value="{{ Session::get('sales_referral')['referral_id'] }}">
                        @endisset
                        @empty(Session::get('sales_referral')['referral_id'])
                        <input type="hidden" name="referral_id" value="0">
                        @endempty

        
                        <input type="hidden" name="project_title" value="{{ Session::get('post_project_data')['project_title'] }}">
                        <input type="hidden" name="key_skills" value="{{ Session::get('post_project_data')['key_skills'] }}">
                        <input type="hidden" name="project_summary" value="{{ Session::get('post_project_data')['project_summary'] }}">
                        <input type="hidden" name="technologty_pre" value="{{ json_encode(Session::get('post_project_data')['technologty_pre']) }}">
                        
                        <input type="hidden" name="customer_industry" value="{{ Session::get('post_project_data')['customer_industry'] }}">
                        <input type="hidden" name="experience_year" value="{{ Session::get('post_project_data')['experience_year'] }}">
                        <input type="hidden" name="experience_month" value="{{ Session::get('post_project_data')['experience_month'] }}">
                        <input type="hidden" name="amount" value="{{ Session::get('post_project_data')['amount'] }}">
                        <input type="hidden" name="amount_to" value="{{ Session::get('post_project_data')['amount_to'] }}">
                        <input type="hidden" name="model_engagement" value="{{ Session::get('post_project_data')['model_engagement'] }}">
                        <input type="hidden" name="type_of_project" value="{{ Session::get('post_project_data')['type_of_project'] }}">
                        <input type="hidden" name="project_duration_min" value="{{ Session::get('post_project_data')['project_duration_min'] }}">
                        <input type="hidden" name="project_duration_max" value="{{ Session::get('post_project_data')['project_duration_max'] }}">
                        <input type="hidden" name="project_category" value="{{ Session::get('post_project_data')['project_category'] }}">
                        <input type="hidden" name="project_sub_category" value="{{ Session::get('post_project_data')['project_sub_category'] }}">
                        <input type="hidden" name="currency_id" value="{{ Session::get('post_project_data')['currency_id'] }}">


                        <div class="card-header">
                            <span class="h5 card-title font-weight-700">{{ Session::get('post_project_data')['project_title'] }}</span>
                            <div class="font-weight-500">
                                <span class="h5">Pricing Model</span><br>
                                @if(Session::get('post_project_data')['model_engagement']=='1')
                                <span> Hourly :</span>
                                <span>Rate Per Hour</span>
                                <p>{{ Session::get('post_project_data')['amount'] }} to {{ Session::get('post_project_data')['amount_to'] }}</p>
                              @elseif(Session::get('post_project_data')['model_engagement']=='2')  
                                <span>Retainership :</span>
                                <span>Rate Per Month</span>
                                <p>{{ Session::get('post_project_data')['amount'] }} to {{ Session::get('post_project_data')['amount_to'] }}</p>
                              @else
                                <span>Project Based :</span>
                                <span>Total Project Amount</span>
                                <p>{{ Session::get('post_project_data')['amount'] }} to {{ Session::get('post_project_data')['amount_to'] }}</p>
                              @endif
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="skills">
                                <span class="h5">Project Summary: </span>
                                <p>{{ Session::get('post_project_data')['project_summary'] }}</p>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Years of Experience: </span>
                                <span>{{ Session::get('post_project_data')['experience_year'] }} Year to {{ Session::get('post_project_data')['experience_month'] }} Year</span>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Project Duration: </span>
                                <span>{{ Session::get('post_project_data')['project_duration_min'] }} to {{ Session::get('post_project_data')['project_duration_max'] }}</span>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Skills Required: </span>
                                <span>{{ Session::get('post_project_data')['key_skills'] }}</span>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Customer Industry: </span>
                                @foreach ($customerindustries as $industry)
                                    @if(Session::get('post_project_data')['customer_industry']== $industry->customer_industry_id)
                                    <span>{{ $industry->name }}</span>
                                    @endif
                                @endforeach
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Project Category: </span>
                                @foreach ($projectcategorys as $category)
                                    @if(Session::get('post_project_data')['project_category']== $category->id)
                                    <span>{{ $category->name }}</span>
                                    @endif
                                @endforeach
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Project Sub Category: </span>
                                @foreach ($subprojectcategorys as $subcategory)
                                    @if(Session::get('post_project_data')['project_sub_category']== $subcategory->id)
                                    <span>{{ $subcategory->name }}</span>
                                    @endif
                                @endforeach
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Type of Project </span>
                                @if(Session::get('post_project_data')['type_of_project']=='1')
                                    <p>Maintenance</p>
                                @elseif(Session::get('post_project_data')['type_of_project']=='2')  
                                    <p>New Development</p>
                                @else
                                    <p>Maintenance Cum New Development</p>
                               @endif
                             </div>
                            <div class="skills mt-4">
                                <span class="h5">Technology/Framework: </span>
                                <?php
                                    $technologty_pre = (array) Session::get('post_project_data')['technologty_pre'];
                                ?>
                                @foreach ($technologies as $technology)
                                    @if(in_array($technology->technology_id, $technologty_pre))
                                    <span>{{ $technology->technology_name }}</span>,
                                    @endif
                                @endforeach
                            </div>
                            <p class="mt-4 font-weight-700">Posted On {{  \Carbon\Carbon::now()->isoFormat('MMM Do YYYY') }}</p>
                            <hr>
                            <div class="singup-body">
                                <div class="form-group text-right mt-5">
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
        {{-- <div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('ProjectLead.new') }}" method="POST" id="projectlead">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->project_id }}">
                        <input type="hidden" name="to_user_id" value="{{ $project->companydetails->id }}">
                        <div class="modal-header text-black">
                            <h4 class="modal-title" id="modalLabelnews">Apply Project</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="project_id" class="col-form-label">Job ID:</label>
                                <input type="text" class="form-control" name="project_id" id="project_id" value="{{ $project->project_id }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="bid_amount" class="col-form-label">Bid Amount:</label>
                                <input type="number" class="form-control" name="bid_amount" id="bid_amount" required>
                            </div>
                            <div class="form-group">
                                <label for="subject" class="col-form-label">Subject:</label>
                                <input type="text" class="form-control" name="subject" id="subject">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text" name="messagetext" rows="3"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer singup-body">
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Apply</button>
                                <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')

<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/login_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>

<!--global js end-->
@stop
