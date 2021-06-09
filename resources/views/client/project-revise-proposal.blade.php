@extends('layouts/default')

{{-- Page title --}}
@section('title')
Revise Proposal
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}">
<link href="{{ asset('vendors/flatpickr/css/flatpickr.min.css') }}" rel="stylesheet"
type="text/css"/>
@yield('profile_css')
<!--end of page level css-->
@stop

@section('top')
<div class="bg-red">
  	<div class="px-5 py-2">
    	<div class="align-items-center">
        	<span class="border-title"><i class="fa fa-bars"></i></span>
        	<span class="h5 text-white">Revise Proposal</span>
    	</div>
  	</div>
</div>
@stop
{{-- content --}}
@section('content')
<div class="profile-setting project-contract">
	<div class="container space-2">
	    <div class="row">
	        <div class="col-lg-8">
	        	<div id="notific">
		            @include('notifications')
		        </div>
	             <div class="singup-body login-body profile-basic">
					<div class="card">
                        {{-- <div class="bg-blue">
                            <div class="px-5 py-2">
                                <span class="h5 text-white" style="margin-left: -25px;">Contract Details</span> <small>(To be filled by developer)</small>
                            </div>
                        </div> --}}
                        <div class="bg-blue">
                            <div class="px-5 py-2">
                                <span class="h5 text-white" style="margin-left: -25px;">Please confirm the details below</span>
                            </div>
                        </div>
						<div class="card-body p-4">
                            <form action="{{ route('project-revise-proposal') }}" method="POST" id="projectlead" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="project_id" value="{{ $project->project_id }}">
                                <input type="hidden" name="project_leads_id" value="{{ $project->project_leads_id }}">
                                <!-- <div class="modal-header text-black bg-img-hero" style="background-image: url(/assets/img/others/applyproject-removebg.png);background-size: contain;background-position: right;">
                                    <h4 class="modal-title" id="modalLabelnews">Revise Proposal</h4>
                                </div> -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="project_id" class="col-form-label">Project ID:</label>
                                        <input type="text" class="form-control" name="project_id" id="project_id" value="{{ $project->project_id }}" readonly="">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="bid_amount" class="col-form-label">Bid Amount({{ $project->projectdetail->projectCurrency->symbol }}):</label>
                                            <input type="number" class="form-control" name="bid_amount" id="bid_amount" value="{{ $project->bid_amount }}" readonly>
                                        </div>
                                        <div class="form-group col">
                                            <label for="engagement" class="col-form-label">Mode of engagement:</label>
                                            @if ($project->projectdetail->projectAmount->pricing_model == '1')
                                                <input type="text" class="form-control" value="Rate Per Hour" readonly>
                                            @elseif ($project->projectdetail->projectAmount->pricing_model == '2')
                                                <input type="text" class="form-control" value="Rate Per Month" readonly>
                                            @else
                                                <input type="text" class="form-control" value="Project Amount" readonly>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="delivery_timeline" class="col-form-label">Delivery Timeline(Days):</label>
                                        <input type="number" class="form-control" name="delivery_timeline" id="delivery_timeline" value="{{ $project->delivery_timeline }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Technology Preference</label>
                                        <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" multiple disabled>
                                            <option value=""></option>
                                            @foreach ($technologies as $technology)
                                            <option value="{{ $technology->technology_id }}" {{ (in_array($technology->technology_id, explode(',', $project->technologty_pre))) ? 'selected' : '' }} >{{ $technology->technology_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject" class="col-form-label">Subject:</label>
                                        <input type="text" class="form-control" name="subject" id="subject" value="{{ $project->subject }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text" name="messagetext" rows="3" readonly>{{ $project->message }}</textarea>
                                    </div>
                                    <!-- <div class="form-group basic-file">
                                        <label>Attach File/Resume</label>
                                        <div class="custom-file" style="height: calc(1.5em + 0.75rem + 8px);">
                                            <input type="file" class="custom-file-input" id="customFile" name="attach_file">
                                            <label class="custom-file-label" for="customFile">Attach File/Resume</label>
                                        </div>
                                    </div> -->

                                    <!-- <div class="singup-body float-right mt-3">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary" type="submit"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Submit</button>
                                            <button class="btn btn-primary" type="reset">Discard</button>
                                        </div>
                                    </div> -->
                                    <div class="form-group text-right mt-5">
                                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary" type="button" onclick="reviseProposalStatus('{{ $project->project_leads_id }}','2')">Accept</button>
                                            {{--<button class="btn btn-primary" type="button" onclick="projectleadSchedule('{{ $project->project_leads_id }}','3')">Modify</button>--}}
                                            <button class="btn btn-primary" type="button" onclick="reviseProposalStatus('{{ $project->project_leads_id }}','3')">Reject</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
	        </div>
            {{-- <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="search-project projects space-2">
                    <img src="/assets/img/others/applyproject-removebg.png" class="img-fluid" alt="">
                    <img src="/assets/img/others/applyproject-removebg.png" class="img-fluid" alt="">
                </div>
            </div> --}}
			@include('layouts.left')
	    </div>
	    <!-- End Row -->
	</div>
</div>

@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
<script>
    $('#technologty_pre').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
    $('#projectlead').bootstrapValidator({
        fields: {
            subject: {
                validators: {
                    notEmpty: {
                        message: 'The subject is required',
                    },
                },
            },
            messagetext: {
                validators: {
                    notEmpty: {
                        message: 'The message is required',
                    },
                },
            },
        },
    });

function reviseProposalStatus(project_leads_id,status){
    $('.spinner-border').removeClass("d-none");
    var url = '/client/project-revise-proposal';
    var data= {
        _token: "{{ csrf_token() }}",
        project_leads_id: project_leads_id,
        status: status
    };
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            var userCheck = data;
            $('.spinner-border').addClass("d-none");
            if (userCheck.success == '1') {
                Swal.fire({
                    type: 'success',
                    title: 'Success...',
                    text: userCheck.msg,
                    showConfirmButton: false,
                    timer: 2000
                });
                // window.location.href = '/freelancer/my-opportunity';
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: userCheck.errors,
                    showConfirmButton: false,
                    timer: 3000
                });
                // if (userCheck.success == '2') {
                //     window.location.href = '/freelancer/my-opportunity';
                // }
            }

        },
        error: function(xhr, status, error) {
            console.log("error: ",error);
        },
    });
}
</script>

<!--global js end-->
@stop

