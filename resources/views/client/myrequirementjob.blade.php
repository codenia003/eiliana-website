@extends('client/layout')

{{-- Page title --}}
@section('title')
My Job Post
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
            <span class="h5 text-white ml-2">My Job Post</span>
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
                <th>Location</th>
                <th>Status</th>
            </tr>
            </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td>{{ $lead->job_id }}</td>
                            <td>{{ $lead->job_title }}</td>
                            <td>{{ rtrim(rtrim($lead->budget_to, '0'), '.') }} INR /Month</td>
                            @if(!empty($lead->technologys->technology_name))
                               <td>{{ $lead->technologys->technology_name }}</td>
                            @else
                               <td>Any</td>
                            @endif

                            {{--<?php 
                                $technologty_pre = explode(',', $lead->technologty_pre);
                            ?>
                            <td>
                            @foreach ($technologty_pre as $tech)
                               @foreach ($technologies as $technology)
                                    @if($tech == $technology->technology_id)
                                        {{ $loop->first ? '' : ', ' }}
                                        @if(!empty($technology->technology_name))
                                        {{ $technology->technology_name }}
                                        @endif
                                    @else
                                       Any  
                                    @endif
                                @endforeach
                            @endforeach--}}

                            <td>{{ $lead->notice_period }} Days</td>
                            <td>{{ $lead->locations->name }}</td>
                            <form action="" method="POST">
                               @csrf
                                <td>
                                    <select name="job_status" id="job_status{{ $lead->job_id }}" class="form-control" onchange="jobStatusChange('{{ $lead->job_id }}')" style="width: 105px;" required>
                                        <option value=""></option>
                                        <option value="1" {{ ($lead->status== '1')? "selected" : "" }}>Online</option>
                                        <option value="2" {{ ($lead->status== '2')? "selected" : "" }}>Closed</option>
                                        <option value="3" {{ ($lead->status== '3')? "selected" : "" }}>Repost</option>
                                    </select>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
        </table>
        {{--<div class="pager">
            {{ $leads->withQueryString()->links() }}
        </div>--}}
    </div>

@stop

@section('client_script')
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>
<script>

function jobStatusChange(job_id){
    //$('.spinner-border').removeClass("d-none");
    var url = '/client/job-status-change';
    var job_status = $('#job_status'+ job_id).val();
    var data= {
        _token: "{{ csrf_token() }}",
        job_id: job_id,
        job_status: job_status
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
                var redirect = '/client/my-requirement-job';
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }

            } else if(userCheck.success == '2') {
                var msg = userCheck.msg;
                var redirect = '/client/my-requirement-job';
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }

            } else {
                var msg= "Oops...<br>"+ userCheck.errors;
                var redirect = '/client/my-requirement-job';
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
