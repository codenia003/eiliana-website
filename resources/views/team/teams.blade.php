@extends('profile/layout')
<style>
      .profile-basic button.btn-info span {
            float: right;
            font-size: 20px;
            position: relative;
            left: -10px;
        }
        .teams-1{
            margin-top: 56px;
        }
        .singup-body .btn-group .btn {
            padding: 0 40px!important;
            height: 50px!important;
            margin-left: 8px!important;
            width: auto;
        }
</style>
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
<div class="card mb-3 mb-lg-5">
    <div class="card-header listofteam">
        <h5 class="card-title"><span>Team List</span>
            <a class="btn btn-primary bg-orange float-right" data-toggle="modal" data-target="#modal-4">Add Team</a>
        </h5>
    </div>
    <!-- Body -->
    <div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Recipient’s Mail ID</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teaminvitations as $invitation)
                <tr>
                    <td>{{ $invitation->to_user }}</td>
                    <td>{{ $invitation->subject }}</td>
                    <td>{{ $invitation->message }}</td>
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
    <div class="modal fade pullDown login-long-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="row teams">
                <div class="col-md-4 md-2 mt-6">
                    <h2>CONTRACT STAFFING</h2>
                    </div>
                    <div class="col-md-8 md-2 mt-6 bench-img">
                        <img src="/assets/img/instant-bench.png">
                    </div>
                </div>
                <form action="{{ route('registerteams') }}" method="POST" id="registerteams">
                    @csrf
                    <div class="modal-header bg-blue text-white">
                        <h4 class="modal-title" id="modalLabelnews">Add Teams</h4>
                    </div>
                    <div class="modal-body login-body singup-body">
                        <div class="teams-1">
                            <div class="teams">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="from" class="col-form-label">Recipient’s Name:</label>
                                        <input type="email" class="form-control" name="from[]" id="from" value="{{ Sentinel::getUser()->email }}" readonly>
                                    </div>
                                    <div class="form-group col">
                                        <label for="to" class="col-form-label">Recipient’s Mail ID:</label>
                                        <input type="email" class="form-control" name="to_user[]" id="to" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="subject" class="col-form-label">Subject:</label>
                                        <input type="text" class="form-control" name="subject[]" id="subject">
                                    </div>
                                    <div class="form-group col">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <input type="text" class="form-control" name="messagetext[]" id="message-text">
                                    </div>
                                    <div class="form-group col">
                                        <label for="user-bid" class="col-form-label">User Bid:</label>
                                        <select class="form-control" required="" name="user_bid[]" id="user-bid">
                                            <option value=""></option>
                                            <option value="0">User can not bid</option>
                                            <option value="1">User can bid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 profile-basic">
                            <button class="btn btn-md btn-info btn-copy-t" type="button">Add <span class="fa fa-plus"></span></button>
                            <button type="button" class="remove-t btn btn-md btn-info ml-3 rounded-0">Erase <span class="fas fa-times"></span></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 md-2 mt-6 teams_img">
                        <img src="/assets/img/teams.png">
                        </div>
                        <div class="col-md-8 md-2 mt-6">
                            <div class="form-group text-right mt-5">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-primary" type="submit">
                                        SUBMIT
                                    </button>
                                    <button class="btn btn-outline-primary" type="reset">CANCEL</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer singup-body">
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Submit</button>
                            <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
  </div>
@stop
@section('profile_script')
<script>
    $(function(){
        $(".btn-copy-t").on('click', function(){
            var element = '<div class="teams-3">'+$('.teams').html()+'</div>';
            $('.teams-1').append(element);
        });
    });
    $(document).on('click','.remove-t',function() {
        $(".teams-3:last").remove();
    });
</script>
@endsection