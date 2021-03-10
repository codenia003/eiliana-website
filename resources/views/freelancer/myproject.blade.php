@extends('profile/layout')
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
@section('profile_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md">
    <table class="table table-striped" id="myopportunity-table">
        <thead>
         <tr>
            <th>Project Id</th>
            <th>Project Name</th>
            <th>Subject</th>
            <th>Status</th>
            <th>Status Date</th>
            <th>View</th>
         </tr>
        </thead>
        <tbody>
        @foreach($leads as $lead)
            <tr>
                <td>{{ $lead->project_leads_id }}</td>
                <td><a href="{{ route('project.view',$lead->project_id) }}">{{ $lead->projectdetail->project_title }}</a></td>
                <td>{{ $lead->subject }}</td>
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
                <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('F d, Y') }}</td>
                <td>
                    {{-- <a href="{{ route('project.view',$lead->project_id) }}"><i class="fas fa-info-circle"></i></a> --}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pager">
        {{ $leads->withQueryString()->links() }}
    </div>
</div>
@stop
