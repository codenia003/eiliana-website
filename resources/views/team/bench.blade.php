@extends('team/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Teams</span>
        </div>
    </div>
</div>
@stop
@section('profile_content')

    <div class="card-header listofteam">

        @if(isset($role[0]->user_type_parent_id))
            @if($role[0]->user_type_parent_id!=1)
                <h5 class="card-title">
                    <a  href="{{ URL::to('/company/teams')  }}" class="btn btn-primary bg-orange float-right">Add Team</a>
                </h5>
            @endif
        @endif
    </div>

   {{-- @isset(Session::get('teaminvitation')['to_user'])
     @if(user_type_parent_id == '0') --}}
        <div class="card-header listofteam">
            <h5 class="card-title">
                <a  href="{{ URL::to('/company/teams')  }}" class="btn btn-primary bg-orange float-right">Add Team</a>
            </h5>
        </div>
     {{-- @endif
    @endisset     --}}
>>>>>>> 7ed1705869dc2e907f7e022cb2975bfaecc19b46
    <!-- Body -->
    <div class="row teams-header">
        <div class="col-md-4 md-2 mt-6">
           <h2>MY BENCH</h2>
        </div>
        <div class="col-md-8 md-2 mt-6 bench-img">
            <img src="/assets/img/instant-bench.png">
        </div>
    </div>
    <div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md teams-basic">
        <table class="table table-striped" id="myopportunity-table">
            <thead>
            <tr>
                <th>Name </th>
                <th>Email</th>
                <th>Experience </th>
                <th>Key Skills</th>
                <th>Status</th>
            </tr>
            </thead>
                <tbody>
                    @foreach($teaminvitations as $invitation)
                    <tr>
                        <td>{{ $invitation->name }}</td>
                        <td>{{ $invitation->to_user }}</td>
                        <td></td>
                        <td></td>
                        <td style="white-space: nowrap">
                            @if ($invitation->status == 1)
                            Accept
                            @elseif($invitation->status == 2)
                            Reject
                            @else
                            Pending
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
        <div class="pager">
            {{ $teaminvitations->withQueryString()->links() }}
        </div>
    </div>

    <!-- End Body -->
@stop
