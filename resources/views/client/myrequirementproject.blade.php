@extends('client/layout')

{{-- Page title --}}
@section('title')
My Project Post
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
            <span class="h5 text-white ml-2">My Project Post</span>
        </div>
    </div>
</div>
@stop
@section('client_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md teams-basic">
        <table class="table table-striped" id="myopportunity-table">
            <thead>
            <tr>
                <th style="width: 15%;">Project Post Id</th>
                <th>Project Title</th>
                <th>Price</th>
                <th>Model Of Engagement</th>
                <th>Technology</th>
                <th>Contract Duration</th>
                <th>Status</th>
            </tr>
            </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td>{{ $lead->project_id }}</td>
                            <td>{{ $lead->project_title }}</td>
                            @if($lead->projectamount->pricing_model == '1')
                               <td>{{ rtrim(rtrim($lead->projectamount->project_amount_to, '0'), '.') }} INR /Hour</td>
                               <td>Hourly</td>
                            @elseif($lead->projectamount->pricing_model == '2')
                                <td>{{ rtrim(rtrim($lead->projectamount->project_amount_to, '0'), '.') }} INR /Month</td>
                                <td>Retainer</td>
                            @else
                                <td>{{ rtrim(rtrim($lead->projectamount->project_amount_to, '0'), '.') }} INR /Amount</td>
                                <td>Project Based</td>
                            @endif
                            
                            @if(!empty($lead->technologty_pre))
                            <td>
                                @foreach (App\Models\Technology::whereIn('technology_id', explode(',', $lead->technologty_pre))->get() as $data)
                                {{ $data->technology_name }}
                                    @if (!$loop->last)
                                        ,
                                    @endif                                          
                                @endforeach
                            </td>
                            @else
                                <td>Any</td>
                            @endif

                            <td>{{ $lead->project_duration_max }}</td>
                            <form action="" method="POST">
                               @csrf
                                <td>
                                    <select name="project_status" id="project_status{{ $lead->project_id }}" class="form-control" onchange="projectStatusChange('{{ $lead->project_id }}')" style="width: 105px;" required>
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
        <div class="pager">
             {{ $leads->withQueryString()->links() }}
        </div>
    </div>

@stop

@section('client_script')
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>
<script>

function projectStatusChange(project_id){
    //$('.spinner-border').removeClass("d-none");
    var url = '/client/project-status-change';
    var project_status = $('#project_status'+ project_id).val();
    var data= {
        _token: "{{ csrf_token() }}",
        project_id: project_id,
        project_status: project_status
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
                var redirect = '/client/my-requirement-project';
                
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
                
            } else if(userCheck.success == '2') {
                var msg = userCheck.msg;
                var redirect = '/client/my-requirement-project';
                var result = confirm('Are you sure you want to change this status?');
                if (result) {
                    toggleRegPopup(msg,redirect);
                }
            } else{
               var msg= "Oops...<br>"+ userCheck.errors;
               var redirect = '/client/my-requirement-project';
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
