@extends('client/layout')

{{-- Page title --}}
@section('title')
My Delivery Projects
@parent
@stop


@section('header_styles')
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
            <span class="h5 text-white ml-2">My Delivery Projects</span>
        </div>
    </div>
</div>
@stop
@section('client_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md">
    <table class="table table-striped" id="myrequirement-table">
        <thead>
         <tr>
            <th style="width: 10%;"> Id</th>
            <th>Project Title</th>
            <th>Skills</th>
            <th>Freelancer Name</th>
            <th>Mode of Engagement</th>
            <th>Status Date</th>
         </tr>
        </thead>
        <tbody>
        @foreach($delivery_project as $delivry_project)
            <tr>
                <td>{{ $delivry_project->order_finance_id }}</td>
                <td>{{ $delivry_project->userprojects->projectdetail->project_title }}</td>
                <td>{{ $delivry_project->userprojects->projectdetail->key_skills }}</td>
                <td>{{ $delivry_project->userprojects->fromuser->full_name }}</td>
                <td>
                    @if ($delivry_project->userprojects->projectdetail->projectamount->pricing_model == '1')
                        Hourly
                    @elseif($delivry_project->userprojects->projectdetail->projectamount->pricing_model == '2')
                        Retainership
                    @else
                        Project Amount
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($delivry_project->created_at)->format('F d, Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop

@section('client_script')
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
