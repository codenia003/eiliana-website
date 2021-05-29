@extends('client/layout')
@section('client_css')
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
            <span class="h5 text-white ml-2">My Requirement Job</span>
        </div>
    </div>
</div>
@stop
@section('client_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md teams-basic">
        <table class="table table-striped" id="myopportunity-table">
            <thead>
            <tr>
                <th>Job Post Id</th>
                <th>Job Title</th>
                <th>Skills</th>
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
                            <td>{{ $lead->key_skills }}</td>
                            <td>{{ $lead->notice_period }}</td>
                            <td>{{ $lead->locations->name }}</td>
                            <form action="{{ route('project-contract-payment') }}" method="POST">
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
                Swal.fire({
                    type: 'success',
                    title: 'Success...',
                    text: userCheck.msg,
                    showConfirmButton: false,
                    timer: 2000
                });

                // window.location.href = '/freelancer/my-opportunity';
            } else if(userCheck.success == '2') {
                Swal.fire({
                    type: 'success',
                    title: 'Success...',
                    text: userCheck.msg,
                    showConfirmButton: false,
                    timer: 2000
                });

                // window.location.href = '/freelancer/my-opportunity';
            } else if(userCheck.success == '3') {
                Swal.fire({
                    type: 'success',
                    title: 'Success...',
                    text: userCheck.msg,
                    showConfirmButton: false,
                    timer: 2000
                });

                // window.location.href = '/freelancer/my-opportunity';
            } else{
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
