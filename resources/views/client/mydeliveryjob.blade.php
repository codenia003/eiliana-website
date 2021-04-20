@extends('profile/layout')
@section('profile_css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
 <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}">
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
@section('profile_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md">
    <table class="table table-striped" id="myrequirement-table">
        <thead>
         <tr>
            <th> Id</th>
            <th>Job Title</th>
            <th>Skills</th>
            <th>Client Name</th>
            <th>Freelancer Name</th>
            <th>Status Date</th>
         </tr>
        </thead>
        <tbody>
        @foreach($delivery_job as $delvry_job)
            <tr>
                <td>{{ $delvry_job->job_order_id }}</td>
                <td>{{ $delvry_job->userjobs->jobdetail->job_title }}</td>
                <td>{{ $delvry_job->userjobs->jobdetail->key_skills }}</td>
                <td>{{ $delvry_job->userjobs->jobdetail->by_user_job->full_name }}</td>
                <td>{{ $delvry_job->userjobs->fromuser->full_name }}</td>
                <td>{{ \Carbon\Carbon::parse($delvry_job->created_at)->format('F d, Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop

@section('profile_script')
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>
<script>
    // $('#myrequirement-table').DataTable({
    //     responsive: true,
    //     pageLength: 10,
    //     searching: false,
    //     paging: false,
    //     info: false
    // });
</script>
@stop
