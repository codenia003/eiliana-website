@extends('client/layout')

{{-- Page title --}}
@section('title')
My Contract Job
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

<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
 <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}">

 <style>
		.profile-setting .my-alldata tr:nth-child(even) {
			background-color: #ffffff;
		}
		
</style>
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">My Contract Job</span>
        </div>
    </div>
</div>
@stop
@section('client_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md teams-basic">
        <table class="table table-striped" id="myopportunity-table">
            <thead>
            <tr>
                <th style="width: 15%;">Job Post Id</th>
                <th>Job Title</th>
                <th>Price</th>
                <th>Technology</th>
                <th>Notice Period</th>
                <th>Status</th>
                <th>More Actions</th>
            </tr>
            </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td>{{ $lead->job_leads_id }}</td>
                            <td>{{ $lead->jobdetail->job_title }}</td>
                            <td>{{ $lead->jobdetail->budget_to }} INR /Month</td>
                            
                            @if(!empty($lead->jobdetail->technologty_pre))
                                <td>
                                    @foreach (App\Models\Technology::whereIn('technology_id', explode(',', $lead->jobdetail->technologty_pre))->get() as $data)
                                    {{ $data->technology_name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif                                          
                                    @endforeach
                                </td>
                            @else
                                <td>Any</td>
                            @endif
                            <td>{{ $lead->notice_period }} Days</td>
                            <form action="" method="POST">
                               @csrf
                                <td>
                                    <select name="job_status" id="job_status{{ $lead->job_leads_id }}" class="form-control" onchange="jobStatusChange('{{ $lead->job_leads_id }}')" style="width: 170px;" required>
                                        <option value=""></option>
                                        <option value="1" {{ ($lead->status== '1')? "selected" : "" }}>Resume Onhold</option>
                                        <option value="2" {{ ($lead->status== '2')? "selected" : "" }}>Resume Shortlist</option>
                                        <option value="3" {{ ($lead->status== '3')? "selected" : "" }}>Resume Reject</option>
                                        <option value="4" {{ ($lead->status== '4')? "selected" : "" }}>Revise Proposal</option>
                                        <option value="5" {{ ($lead->status== '5')? "selected" : "" }}>Proposal Accepted</option>
                                    </select>
                                </td>
                            </form>
                            @if($lead->status== '4')
                              <td><a style="font-weight: 600;" href="{{ url('/freelancer/contractual-job-inform'. '/' . $lead->job_leads_id) }}">Review Proposal</a></td>
                            @elseif($lead->status== '5')
                              <td><a style="font-weight: 600;" onclick="jobOnboarding('{{ $lead->jobcontractschedule->job_schedule_id }}')">Onboard</a></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
        </table>
        {{--<div class="pager">
            {{ $leads->withQueryString()->links() }}
        </div>--}}
    </div>
    <div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ url('/freelancer/post-proposal-job-lead') }}" method="POST" id="">
                @csrf
                
                <div class="modal-header bg-blue text-white">
                    <h4 class="modal-title" id="modalLabelnews">Proposal For Client </h4>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="job_schedule_id" class="col-form-label">Proposal Id:</label>
                            <input type="text" class="form-control" id="job_schedule_id" name="job_schedule_id" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="actual_date" class="col-form-label">Date Of Onboarding :</label>
                        <input class="flatpickr flatpickr-input form-control" type="text" name="actual_date" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" name="remarks" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer singup-body">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary">Send To Customer</button>
                        <button class="btn btn-outline-primary" data-dismiss="modal">Discard</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('client_script')
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>
<script>

function jobStatusChange(job_leads_id){
    //$('.spinner-border').removeClass("d-none");
    var url = '/freelancer/proposal-job-status-change';
    var job_lead_status = $('#job_status'+ job_leads_id).val();
    var data= {
        _token: "{{ csrf_token() }}",
        job_leads_id: job_leads_id,
        job_lead_status: job_lead_status
    };
    //console.log(data);
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            var userCheck = data;
            //$('.spinner-border').addClass("d-none");
            if (userCheck.success == '1') {
                var msg = userCheck.msg;
                var redirect = '/freelancer/my-contract_job';
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }

            } else if(userCheck.success == '2') {
                var msg = userCheck.msg;
                var redirect = '/freelancer/my-contract_job';
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }

            }else if(userCheck.success == '3') {
                var msg = userCheck.msg;
                var redirect = '/freelancer/my-contract_job';
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
            }else if(userCheck.success == '4') {
                var msg = userCheck.msg;
                var redirect = '/freelancer/my-contract_job';
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
            }else if(userCheck.success == '5') {
                var msg = userCheck.msg;
                var redirect = '/freelancer/my-contract_job';
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
            } else {
                var msg= "Oops...<br>"+ userCheck.errors;
                var redirect = '/freelancer/my-contract_job';
                toggleRegPopup(msg,redirect);

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

function jobOnboarding(job_schedule_id){
    $('.spinner-border').removeClass("d-none");

    var data= {
        _token: "{{ csrf_token() }}",
        job_schedule_id: job_schedule_id
    };
    console.log(data);
    
    $('#modal-4').modal('show');
    $('#job_schedule_id').val(job_schedule_id);
    // $.ajax({
    //     type: 'POST',
    //     url: url,
    //     data: data,
    //     success: function(data) {
    //         var userCheck = data;
    //         $('.spinner-border').addClass("d-none");
    //         if (userCheck.success == '1') {
    //             Swal.fire({
    //                 type: 'success',
    //                 title: 'Success...',
    //                 text: userCheck.msg,
    //                 showConfirmButton: false,
    //                 timer: 2000
    //             });

    //             $('#payment_button').show();
    //             $('#status').hide();

    //             // window.location.href = '/freelancer/my-opportunity';
    //         } else {
    //             Swal.fire({
    //                 type: 'error',
    //                 title: 'Oops...',
    //                 text: userCheck.errors,
    //                 showConfirmButton: false,
    //                 timer: 3000
    //             });
    //             // if (userCheck.success == '2') {
    //             //     window.location.href = '/freelancer/my-opportunity';
    //             // }
    //         }

    //     },
    //     error: function(xhr, status, error) {
    //         console.log("error: ",error);
    //     },
    // });
}

</script>    
@stop
