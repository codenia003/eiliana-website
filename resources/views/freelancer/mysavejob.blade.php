@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">My Save Job</span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md">
    <table class="table table-striped" id="myopportunity-table">
        <thead>
         <tr>
            <th> Id</th>
            <th>Job Title</th>
            <th>Date</th>
            <!-- <th>View</th> -->
         </tr>
        </thead>
        <tbody>
        @foreach($savejobs as $savejob)
            <tr>
                <td>{{ $savejob->id }}</td>
                <td>{{ $savejob->jobdetail->job_title }}</td>
                <td>{{ \Carbon\Carbon::parse($savejob->created_at)->format('F d, Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
</div>
@stop

@section('profile_script')
@stop
