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
            <th>Status Date</th>
            <th>View</th>
         </tr>
        </thead>
        <tbody>
        @foreach($project_ids as $lead)
            <tr>
                <td>{{ $lead->project_id }}</td>
                <td><a href="{{ route('project.view',$lead->project_id) }}">{{ $lead->project_title }}</a></td>
               
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
