@extends('client/layout')

{{-- Page title --}}
@section('title')
My Project Leads
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
            <span class="h5 text-white ml-2">My Project Leads</span>
        </div>
    </div>
</div>
@stop
@section('client_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md teams-basic">
        <table class="table table-striped" id="myopportunity-table">
            <thead>
            <tr>
                <th style="width: 15%;">Project Lead Id</th>
                <th>Project Title</th>
                <th>Freelancer Name</th>
                <th>Subject</th>
                <th>Delivery Time Line</th>
                <th>Status</th>
            </tr>
            </thead>
                <tbody>
                    @forelse($leads as $lead)
                        <tr>
                            <td>{{ $lead->project_leads_id }}</td>
                            <td>{{ $lead->projectdetail->project_title }}</td>
                            @if(!empty($lead->fromuser))
                             <td>{{ $lead->fromuser->full_name }}</td>
                             @else
                             <td></td>
                            @endif
                            <td>{{ $lead->subject }}</td>
                            <td>{{ $lead->delivery_timeline }} Day</td>
                            <form action="" method="POST">
                               @csrf
                                <td>
                                    <select name="project_status" id="project_status{{ $lead->project_leads_id }}" class="form-control" onchange="projectLeadStatusChange('{{ $lead->project_leads_id }}')" style="width: 105px;" required>
                                        <option value=""></option>
                                        <option value="1" {{ ($lead->status== '1')? "selected" : "" }}>Onhold</option>
                                        <option value="2" {{ ($lead->status== '2')? "selected" : "" }}>Shortlist</option>
                                        <option value="3" {{ ($lead->status== '3')? "selected" : "" }}>Reject</option>
                                    </select>
                                </td>
                            </form>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="6">
                               <h4>List is empty</h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
        </table>
        <div class="pager">
             {{ $leads->withQueryString()->links() }}
        </div>
    </div>
    <div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
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
    </div>

@stop

@section('client_script')
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>
<script>

$(document).ready(function() {
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

function projectLeadStatusChange(project_leads_id){
    //$('.spinner-border').removeClass("d-none");
    var url = '/client/proposal-project-status-change';
    var project_lead_status = $('#project_status'+ project_leads_id).val();
    var data= {
        _token: "{{ csrf_token() }}",
        project_leads_id: project_leads_id,
        project_lead_status: project_lead_status
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
                var redirect = '/client/my-project-lead/'+ project_leads_id;
                
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
                
            } else if(userCheck.success == '2') {
                var msg = userCheck.msg;
                var redirect = '/client/my-project-lead/'+ project_leads_id;
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
            }else if(userCheck.success == '3') {
                var msg = userCheck.msg;
                var redirect = '/client/my-project-lead/'+ project_leads_id;
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
            } else{
               var msg= "Oops...<br>"+ userCheck.errors;
               var redirect = '/client/my-project-lead/'+ project_leads_id;
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
