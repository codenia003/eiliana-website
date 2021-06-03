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
                <div class="card mb-3 mb-lg-5 project-deatils shadow border">
                    <div class="card-header">
                        <span class="h5 card-title font-weight-700">{{ $project->project_title }}</span>
                        <div class="float-right font-weight-700 mt-1">
                            {{-- <a class="btn-icon bg-blue btn rounded-0 text-white" data-toggle="modal" data-target="#modal-4">Apply Now</a> --}}
                            <a class="btn-icon bg-blue btn rounded-0 text-white" href="{{ route('projectlead.view',  $project->project_id) }}">Apply Now</a>
                        </div>
                        <div class="font-weight-500">
                            @if ($project->projectAmount->pricing_model == '1')
                                <span class="bid">@if(!empty($project->projectAmount->project_amount)){{ $project->projectCurrency->symbol }} {{ $project->projectAmount->project_amount }} - {{ $project->projectAmount->project_amount_to }}@endif /Rate Per Hour</span>

                            @elseif ($project->projectAmount->pricing_model == '2')
                                <span class="bid">@if(!empty($project->projectAmount->project_amount)){{ $project->projectCurrency->symbol }} {{ $project->projectAmount->project_amount }} - {{ $project->projectAmount->project_amount_to }}@endif /Rate Per Month</span>
                            @else
                                <span class="bid">@if(!empty($project->projectAmount->project_amount)){{ $project->projectCurrency->symbol }} {{ $project->projectAmount->project_amount }} - {{ $project->projectAmount->project_amount_to }}@endif Project Amount</span>
                            @endif
                            <br>
                            <span class="day-left">Bidding Ends In {{ $project->expiry_days }} Days</span><br>
                        </div>
                    </div>
                    <!-- <div class="card-body mb-3 mb-lg-5 p-4 text-center d-block" *ngIf="loading">
                        <div class="spinner-border spinner-border-lg"></div>
                    </div> -->
                    <div class="card-body">
                        <div class="skills">
                            <span class="h5">Project Summary: </span>
                            <p>{{ $project->project_summary }}</p>
                        </div>
                        <div class="skills mt-4">
                            <span class="h5">Years of Experience: </span>
                            <span>{{ $project->experience_year }} Years {{ $project->experience_month }} Month</span>
                        </div>
                        <div class="skills mt-4">
                            <span class="h5">Skills Required: </span>
                            <span>{{ $project->key_skills }}</span>
                        </div>
                        <div class="skills mt-4">
                            <span class="h5">Customer Industry: </span>
                            <span>{{ $project->customerindustry1->name }}</span>
                        </div>
                        <div class="skills mt-4">
                            <span class="h5">Project Sub Category: </span>
                            <span>{{ $project->projectsubcategory->name }}</span>
                        </div>
                        {{-- <hr> --}}
                        {{-- <h3>Additional Information</h3> --}}
                        <div class="skills mt-4">
                            <span class="h5">Technology/Framework: </span>
                            @foreach ($technologies as $technology)
                                {{ $loop->first ? '' : ', ' }}
                                <span>{{ $technology->technology_name }}</span>
                            @endforeach
                        </div>
                    </div>
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
