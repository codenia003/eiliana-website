@extends('client/layout')

{{-- Page title --}}
@section('title')
My Job Leads
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
            <span class="h5 text-white ml-2">My Job Leads</span>
        </div>
    </div>
</div>
@stop
@section('client_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md teams-basic">
        <table class="table table-striped" id="myopportunity-table">
            <thead>
            <tr>
                <th style="width: 15%;">Job Lead Id</th>
                <th>Job Title</th>
                <th>Freelancer Name</th>
                <th>Notice Period</th>
                <th>Bid Amount <small> (Excluding GST)</small></th>
                <th>Status</th>
            </tr>
            </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td>{{ $lead->job_leads_id }}</td>
                            <td>{{ $lead->jobdetail->job_title }}</td>
                            @if(!empty($lead->fromuser))
                             <td>{{ $lead->fromuser->full_name }}</td>
                             @else
                             <td></td>
                            @endif
                            <td>{{ $lead->notice_period }} Days</td>
                            <td>{{ $lead->bid_amount }} INR /Month</td>
                            <form action="" method="POST">
                               @csrf
                                <td>
                                    <select name="job_status" id="job_status{{ $lead->job_leads_id }}" class="form-control" onchange="jobLeadStatusChange('{{ $lead->job_leads_id }}')" style="width: 170px;" required>
                                        <option value=""></option>
                                        <option value="1" {{ ($lead->status== '1')? "selected" : "" }}>Resume Onhold</option>
                                        <option value="2" {{ ($lead->status== '2')? "selected" : "" }}>Resume Shortlist</option>
                                        <option value="3" {{ ($lead->status== '3')? "selected" : "" }}>Resume Reject</option>
                                        <option value="4" {{ ($lead->status== '4')? "selected" : "" }}>Revise Proposal</option>
                                        <option value="5" {{ ($lead->status== '5')? "selected" : "" }}>Proposal Accepted</option>
                                    </select>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
        </table>
        <div class="pager">
             {{ $leads->withQueryString()->links() }}
        </div>
    </div>
    <div class="row teams-header">
        <div class="col-md-4 md-2 mt-6">
           <h2>Resource Details</h2>
        </div>
        <div class="col-md-8 md-2 mt-6 bench-img">
           
        </div>
    </div>
    <div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md teams-basic" >
                <table class="table table-striped team-form" id="myopportunity-table">
                    <thead>
                    <tr>
                        <th>Freelancer Name </th>
                        <th>Service Provider Name</th>
                        <th>Date Of Onboard </th>
                        <th>Onboard Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($resource_leads as $resource_lead)
                        <tr>
                            <td>{{ $resource_lead->freelancer_name }}</td>
                            <td>{{ $resource_lead->sprovider_name }}</td>
                            <td>{{ $resource_lead->onboard_date }}</td>
                            <td>
                                @if($resource_lead->onboard_status == '1')
                                    Onboarded 
                                @else
                                    Not Onboarded
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
    </div>

    <!-- <div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
        <div class="modal-dialog" role="document" style="max-width: 900px !important;">
            <div class="modal-content">
                <form action="#" method="POST" id="staffingflead">
                    @csrf
                    <div class="modal-header bg-blue text-white">
                        <h4 class="modal-title" id="modalLabelnews">Project Lead Detail</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="id" class="col-form-label">Project Lead Id:</label>
                                <input type="text" class="form-control" name="id" id="id" value="" readonly="">
                            </div>
                            <div class="form-group col-6">
                                <label for="bidamount" class="col-form-label">Bid Amount:</label>
                                <input class="form-control" type="text" name="bidamount" id="bidamount" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="subject" class="col-form-label">Subject:</label>
                                <input type="text" class="form-control" name="subject" id="subject" value="" readonly="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
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
    </div> -->

@stop

@section('client_script')
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>
<script>


$(document).ready(function() {

    flatpickr('.flatpickr');

  $('.addAttr').click(function() {
    var id = $(this).data('id');  
    console.log(id); 
    var bidamount = $(this).data('bidamount'); 
    var subject = $(this).data('subject');   
    var message = $(this).data('message'); 
    var display_status = $(this).data('display_status');  

    $('#id').val(id); 
    $('#bidamount').val(bidamount); 
    $('#subject').val(subject); 
    $('#message').val(message); 
    $('#display_status').val(display_status); 
  });
});

$("#onboard_status").change(function(){
    $(this).find("option:selected").each(function(){
        var optionValue = $(this).attr("value");
        //alert(optionValue);
        if(optionValue == '1'){
            $("#onboard_button").show();
            $("#onboard_status").hide();
        } else{
            $("#onboard_button").hide();
            $("#onboard_status").show();
        }
    });
}).change();

function jobLeadStatusChange(job_leads_id){
    //$('.spinner-border').removeClass("d-none");
    var url = '/client/proposal-job-status-change';
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
            if(userCheck.success == '1') {
                var msg = userCheck.msg;
                var redirect = '/client/my-job-lead/'+ job_leads_id;
                
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
                
            } else if(userCheck.success == '2') {
                var msg = userCheck.msg;
                var redirect = '/client/my-job-lead/'+ job_leads_id;
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
            }else if(userCheck.success == '3') {
                var msg = userCheck.msg;
                var redirect = '/client/my-job-lead/'+ job_leads_id;
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
            }else if(userCheck.success == '4') {
                var msg = userCheck.msg;
                var redirect = '/client/my-job-lead/'+ job_leads_id;
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
            }else if(userCheck.success == '5') {
                var msg = userCheck.msg;
                var redirect = '/client/my-job-lead/'+ job_leads_id;
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
            }else{
               var msg= "Oops...<br>"+ userCheck.errors;
               var redirect = '/client/my-job-lead/'+ job_leads_id;
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

    // $('#myrequirement-table').DataTable({
    //     responsive: true,
    //     pageLength: 10,
    //     searching: false,
    //     paging: false,
    //     info: false
    // });
</script>
@stop
