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
                <div id="notific">
                    @include('notifications')
                </div>
                <div class="card mb-3 mb-lg-5 project-deatils shadow border">
                    <div class="card-header">
                        <span class="h5 card-title font-weight-700">{{ $job->job_title }}</span>
                        <div class="float-right font-weight-700 mt-1">
                            <a class="btn-icon bg-blue btn rounded-0 text-white" href="{{ route('joblead.view',  $job->job_id) }}">Apply Now</a>&nbsp;
                            {{-- <a class="btn-icon bg-blue btn rounded-0 text-white" data-toggle="modal" data-target="#modal-4">Apply Now</a>&nbsp; --}}
                            @if(!empty($savejob))
                                <a class="btn-icon bg-blue btn rounded-0 text-white" onclick="SaveJob('{{ $job->job_id }}')"><i class="fas fa-star"></i></a>
                            @else
                                <a class="btn-icon bg-blue btn rounded-0 text-white" onclick="SaveJob('{{ $job->job_id }}')"><i class="far fa-star"></i></a>
                            @endif
                        </div>
                        <div class="font-weight-500">
                            <span class="day-left">Bidding Ends In {{ $job->expiry_days }} Days</span><br>
                        </div>
                    </div>  

                    <div class="card-body">
                        {{-- @if ($job->companydetails->company_name)
                        {{ $job->companydetails->company_name }}
                        @else
                        {{ $job->companydetails->full_name }}
                        @endif
                        <p>{{ $job->locations->name }}</p> --}}
                        <div class="skills">
                            <span class="h5">Job Description: </span>
                            <p>{{ $job->role_summary }}</p>
                        </div>
                        <div class="skills mt-4">
                            <span class="h5">Budget: </span>
                            <span>{{ $job->budget_from }} to {{ $job->budget_to }}</span>
                        </div>
                        <div class="skills mt-4">
                            <span class="h5">Years of Experience: </span>
                            <span>{{ $job->experience_year }} Year to  {{ $job->experience_month }} Year</span>
                        </div>
                        <div class="skills mt-4">
                            <span class="h5">Skills Required: </span>
                            <span>{{ $job->key_skills }}</span>
                        </div>
                        <div class="skills mt-4">
                            <span class="h5">Customer Industry: </span>
                            <span>{{ $job->customerindustry1->name }}</span>
                        </div>
                        <div class="skills mt-4">
                            <span class="h5">Technology: </span>
                            @foreach ($technologies as $technology)
                                {{ $loop->first ? '' : ', ' }}
                                <span>{{ $technology->technology_name }}</span>
                            @endforeach
                        </div>
                        <p class="mt-4 font-weight-700">Posted On {{  \Carbon\Carbon::parse($job->created_at)->isoFormat('MMM Do YYYY') }}</p>
                    </div>
                </div>       
            </div>
            @include('layouts.left')
        </div>
        {{-- <div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
            <div class="modal-dialog" role="document" style="max-width: 900px !important;">
                <div class="modal-content">
                    <form action="{{ route('postJobLead.new') }}" method="POST" id="staffingflead">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                        <input type="hidden" name="to_user_id" value="{{ $job->companydetails->id }}">
                        <div class="modal-header bg-blue text-white">
                            <h4 class="modal-title" id="modalLabelnews">Apply JOB</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                               <div class="form-group col-6">
                                    <label for="job_id" class="col-form-label">Job ID:</label>
                                    <input type="text" class="form-control" name="job_id" id="job_id" value="{{ $job->job_id }}" readonly="">
                               </div>
                               <div class="form-group col-6">
                                    <label for="application_date" class="col-form-label">Application date:</label>
                                    <input class="flatpickr flatpickr-input form-control" type="text" name="application_date" id="application_date">
                                </div>
                            </div>

                            <div class="form-row">
                               <div class="form-group col-6">
                                    <label for="current_ctc" class="col-form-label">Current ctc:</label>
                                    <input type="text" class="form-control" name="current_ctc" id="current_ctc" value="{{ $job->companydetails->id }}" readonly="">
                               </div>
                               <div class="form-group col-6">
                                    <label for="expected_ctc" class="col-form-label">Expected ctc:</label>
                                    <input type="text" class="form-control" name="expected_ctc" id="expected_ctc">
                                </div>
                            </div>

                            <div class="form-row">
                               <div class="form-group col-6">
                                    <label for="notice_period" class="col-form-label">Notice Period:</label>
                                    <input type="text" class="form-control" name="notice_period" id="notice_period">
                               </div>
                               <div class="form-group col-6">
                                    <label for="subject" class="col-form-label">Subject:</label>
                                    <input type="text" class="form-control" name="subject" id="subject">
                                </div>
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
@stop

{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>

<script>
function SaveJob(job_id){
    //$('.spinner-border').removeClass("d-none");
    var url = '/job/save-job';
    var data= {
        _token: "{{ csrf_token() }}",
        job_id: job_id
    };
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            var userCheck = data;
            //$('.spinner-border').addClass("d-none");
            if (userCheck.success == '1') {
                Swal.fire({
                    type: 'success',
                    title: 'Success...',
                    text: userCheck.msg,
                    showConfirmButton: false,
                    timer: 2000
                });
                  window.location.href = '/job'+"/"+job_id;
                // window.location.href = '/freelancer/my-opportunity';
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: userCheck.errors,
                    showConfirmButton: false,
                    timer: 3000
                });
                   window.location.href = '/job'+"/"+job_id;
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

function padStart(str) {
    return ('0' + str).slice(-2)
}

</script>

<!--global js end-->
@stop
