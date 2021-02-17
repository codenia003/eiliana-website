@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">My Lead</span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md">
    <table class="table table-striped" id="myrequirement-table">
        <thead>
         <tr>
            <th>Referral Code</th>
            <th>Company Name</th>
            <th>Contact Person</th>
            <th>Designation</th>
            <th>Status</th>
            <th>Mobile No</th>
            <th>View</th>
         </tr>
        </thead>
        <tbody>
        @foreach($leads as $lead)
            <tr>
                <td>{{ $lead->referral_code }}</td>
                <td>{{ $lead->company_name }}</td>
                <td>{{ $lead->contact_person }}</td>
                <td>{{ $lead->designation }}</td>
                <td>
                    @if ($lead->lead_status == 1)
                    Pending
                    @elseif($lead->lead_status == 2)
                    Process
                    @elseif($lead->lead_status == 3)
                    Complete
                    @else
                    Cancel
                    @endif
                </td>
                <td>{{ $lead->mobile_no }}</td>
                <td><a href="{{ route('my-lead.view',$lead->sales_referral_id) }}"><i class="fas fa-info-circle"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
