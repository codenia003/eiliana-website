@extends('client/layout')

{{-- Page title --}}
@section('title')
My Project
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
            <span class="h5 text-white ml-2">My Project</span>
        </div>
    </div>
</div>
@stop
@section('client_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md">
    <table class="table table-striped" id="myopportunity-table">
            <thead>
            <tr>
                <th style="width: 15%;">Project Post Id</th>
                <th>Project Title</th>
                <th>Price</th>
                <th>Technology</th>
                <th>Status Date</th>
                <th>More Actions</th>
            </tr>
            </thead>
                <tbody>
                    @foreach($project_ids as $lead)
                        <tr>
                            <td>{{ $lead->project_leads_id }}</td>
                            <td>{{ $lead->projectdetail->project_title }}</td>
                            <td>{{ $lead->bid_amount }} INR /Month</td>
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
                            <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('F d, Y') }}</td>
                            <td>
                                <a href="{{ route('my-project-lead.view',$lead->project_id) }}"><i class="fas fa-info-circle"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    <div class="pager">
        {{ $project_ids->withQueryString()->links() }}
    </div>
</div>
@stop

@section('client_script')
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>
@stop
