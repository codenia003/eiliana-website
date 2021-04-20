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
            <th>Project Title</th>
            <th>Skills</th>
            <th>Client Name</th>
            <th>Freelancer Name</th>
            <th>Status Date</th>
         </tr>
        </thead>
        <tbody>
        @foreach($delivery_project as $delivry_project)
            <tr>
                <td>{{ $delivry_project->order_finance_id }}</td>
                <td>{{ $delivry_project->userprojects->projectdetail->project_title }}</td>
                <td>{{ $delivry_project->userprojects->projectdetail->key_skills }}</td>
                <td>{{ $delivry_project->userprojects->projectdetail->companydetails->full_name }}</td>
                <td>{{ $delivry_project->userprojects->fromuser->full_name }}</td>
                <td>{{ \Carbon\Carbon::parse($delivry_project->created_at)->format('F d, Y') }}</td>
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
