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
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 pr-0">
                <div id="notific">
                    @include('notifications')
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card mb-3 mb-lg-5">
                            <div class="card-header">
                                <span class="h5 card-title text-secondary">Job Deatils</span>
                                <div class="float-right font-weight-700">
                                    <a class="btn-icon bg-blue btn rounded-0 text-white" data-toggle="modal" data-target="#modal-4">Apply Now</a>
                                </div>
                            </div>
                            <!-- <div class="card-body mb-3 mb-lg-5 p-4 text-center d-block" *ngIf="loading">
                                <div class="spinner-border spinner-border-lg"></div>
                            </div> -->
                            <div class="card-body">
                                <h5>{{ $job->job_title }}</h5>
                                @if ($job->companydetails->company_name)
                                {{ $job->companydetails->company_name }}
                                @else
                                {{ $job->companydetails->full_name }}
                                @endif
                                <p>{{ $job->locations->name }}</p>
                                <p>Posted On {{  \Carbon\Carbon::parse($job->created_at)->isoFormat('MMM Do YYYY') }}</p>
                                <div class="skills mt-4">
                                    <span class="h5">Job Description</span>
                                    <p>{{ $job->role_summary }}</p>
                                </div>
                                <div class="skills mt-4">
                                    <span class="h5">Budget</span>
                                    <p>{{ $job->budget_from }} to {{ $job->budget_to }}</p>
                                </div>
                                <div class="skills mt-4">
                                    <span class="h5">Years of Experience</span>
                                    <p>{{ $job->experience_year }} Years {{ $job->experience_month }} Month</p>
                                </div>
                                <div class="skills mt-4">
                                    <span class="h5">Skills Required</span>
                                    <p>{{ $job->key_skills }}</p>
                                </div>
                                <hr>
                                <h3>Additional Information</h3>
                                <div class="skills mt-4">
                                    <span class="h5">Technology: </span>
                                    @foreach ($technologies as $technology)
                                        {{ $loop->first ? '' : ', ' }}
                                        <span>{{ $technology->technology_name }}</span>
                                    @endforeach
                                    <br>
                                    <span class="h5">Framework: </span>
                                    @foreach ($childtechnologies as $technology)
                                        {{ $loop->first ? '' : ', ' }}
                                        <span>{{ $technology->technology_name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card mb-5 shadow p-4 mb-4">
                            <div class="border-bottom pb-4">
                                <h4>About the Company</h4>
                                <p>{{ $job->about_company }}</p>
                                <p>
                                    @if ($job->companydetails->company_name)
                                    {{ $job->companydetails->company_name }}
                                    @else
                                    {{ $job->companydetails->full_name }}
                                    @endif
                                </p>
                            </div>
                            <!-- <div class="border-bottom pb-4 mt-4">
                                <h4 class="mb-2"><strong>Employer Verification</strong></h4>
                            </div> -->
                        </div>
                        {{-- <div class="card mb-5 shadow p-4">
                            <ul class="list-unstyled list-sm-article">
                                <li>
                                    <a class="row align-items-center mx-n2 font-size-1" href="javascript:;">
                                        <div class="col-10 px-2">
                                            <span class="text-dark">Bid Left</span>
                                        </div>

                                        <div class="col-2 text-right px-2">
                                            <span>12</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="row align-items-center mx-n2 font-size-1" href="javascript:;">
                                        <div class="col-10 px-2">
                                            <span class="text-dark">Average Bid</span>
                                        </div>
                                        <div class="col-2 text-right px-2">
                                            <span>12</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('postJobLead.new') }}" method="POST" id="staffingflead">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                        <input type="hidden" name="to_user_id" value="{{ $job->companydetails->id }}">
                        <div class="modal-header bg-blue text-white">
                            <h4 class="modal-title" id="modalLabelnews">Apply JOB</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="job_id" class="col-form-label">Job ID:</label>
                                <input type="text" class="form-control" name="job_id" id="job_id" value="{{ $job->job_id }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="application_date" class="col-form-label">Application date:</label>
                                <input class="flatpickr flatpickr-input form-control" type="text" name="application_date" id="application_date">
                            </div>
                            <div class="form-group">
                                <label for="current_ctc" class="col-form-label">Current ctc:</label>
                                <input type="text" class="form-control" name="current_ctc" id="current_ctc" value="{{ $job->companydetails->id }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="expected_ctc" class="col-form-label">Expected ctc:</label>
                                <input type="text" class="form-control" name="expected_ctc" id="expected_ctc">
                            </div>
                            <div class="form-group">
                                <label for="notice_period" class="col-form-label">Notice Period:</label>
                                <input type="text" class="form-control" name="notice_period" id="notice_period">
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
        </div>
    </div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        flatpickr('.flatpickr');
    });
</script>    
<script>
$('#staffingflead').bootstrapValidator({
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
        application_date: {
            validators: {
                notEmpty: {
                    message: 'The application date is required',
                },
            },
        },
        notice_period: {
            validators: {
                notEmpty: {
                    message: 'The notice period is required',
                },
            },
        },
    },
}).on('success.form.bv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    var bv = $form.data('bootstrapValidator');
    $('.spinner-border').removeClass("d-none");
    $.post($form.attr('action'), $form.serialize(), function(result) {
        var userCheck = result;
        if (userCheck.success == '1') {
            $('#modal-4').modal('toggle');
            $('#subject').val('');
            $('#message-text').val('');
            $('#notice_period').val('');
            $('.spinner-border').addClass("d-none");
            Swal.fire({
              type: 'success',
              title: 'Success...',
              text: userCheck.msg,
              showConfirmButton: false,
              timer: 2000
            });
        } else {
            $('#modal-4').modal('toggle');
            $('#subject').val('');
            $('#message-text').val('');
            $('#notice_period').val('');
            $('.spinner-border').addClass("d-none");
            Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: userCheck.errors,
              showConfirmButton: false,
              timer: 2000
            });
        }
    }, 'json');
});</script>

<!--global js end-->
@stop
