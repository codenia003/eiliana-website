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
            <th>Sales Referral Id</th>
            <th>Company Name</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Mobile No</th>
            <th>View</th>
         </tr>
        </thead>
        <tbody>
        @foreach($leads as $lead)
            <tr>
                <td>{{ $lead->sales_referral_id }}</td>
                <td>{{ $lead->company_name }}</td>
                <td>{{ $lead->contact_person }}</td>
                <td>{{ $lead->email }}</td>
                <td>{{ $lead->mobile_no }}</td>
                <td><a href="#"><i class="fas fa-info-circle"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
