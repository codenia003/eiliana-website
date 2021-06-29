@extends('client/layout')

{{-- Page title --}}
@section('title')
My Delivery Jobs
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->

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
            <span class="h5 text-white ml-2">My Delivery Job</span>
        </div>
    </div>
</div>
@stop

@section('client_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md teams-basic">
    <table class="table table-striped" id="myrequirement-table">
        <thead>
            <tr>
                <th>Id</th>
                {{-- <th>Customer Name</th> --}}
                <th>Resource Name</th>
                <th>Date of Onboarding</th>
                <th>Price Per Month</th>
                <th>Contract Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach($delivery_job as $delvry_job)
            <tr>
                <td>{{ $delvry_job->job_order_id }}</td>
                {{-- <td>{{ $delvry_job->userjobs->fromuser->full_name }}</td> --}}
                <td>{{ $delvry_job->userjobs->resource_name }}</td>
                <td>{{ \Carbon\Carbon::parse($delvry_job->date_of_boarding)->format('F d, Y') }}</td>
                <td>{{ $delvry_job->userjobs->price_per_month }}</td>
                <td>{{ $delvry_job->userjobs->jobcontractschedule->contract_duration }} Months</td>
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
