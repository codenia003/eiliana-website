@extends('information/layout')
@section('information_css')
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
@stop

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
@section('information_content')
    <div class="row teams">
        <div class="col-md-4 md-2 mt-6">
           <h2>CONTRACT STAFFING</h2>
        </div>
        <div class="col-md-8 md-2 mt-6 bench-img">
            <img src="/assets/img/instant-bench.png">
        </div>
    </div>
    <div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md teams-basic">
        <form action="{{ route('registerteams') }}" method="POST" id="registerteams" class="list-form">
            @csrf
                <table class="table table-striped team-form" id="myopportunity-table">
                    <thead>
                    <tr>
                        <th>Recipient’s Name </th>
                        <th>Recipient’s Mail ID</th>
                        <th>Subject </th>
                        <th>Message</th>
                        <th>User Type</th>
                    </tr>
                    </thead>
                </table>
                <div class="teams_data-1" style="margin-top: 12px;">
                    <div class="teams_data">
                        <div class="form-row">
                            <div class="form-group col">
                                <input type="text" class="form-control" name="uname[]" id="uname" required/>
                            </div>
                            <div class="form-group col">
                                <input type="email" class="form-control" name="to_user[]" id="to_user" required/>
                            </div>
                            <div class="form-group col">
                                <input type="text" class="form-control" name="subject[]" id="subject" required/>
                            </div>
                            <div class="form-group col">
                                <input type="text" class="form-control" name="messagetext[]" id="messagetext" required/>
                            </div>
                            <div class="form-group col">
                                <select class="form-control" name="user_bid[]" id="user_bid" required="">
                                    <option value="0">Admin</option>
                                    <option value="1">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 duplicate-team">
                    <button class="btn btn-md btn-info btn-copy-team" type="button">ADD MEMBER <span class="fa fa-plus"></span></button>
                    <button type="button" class="remove-team1 btn btn-md btn-info ml-3 rounded-0">ERASE MEMBER <span class="fas fa-times"></span></button>
                </div>
                <div class="row teams-basic">
                    <div class="col-md-4 md-2 mt-6 teams_img">
                    <img src="/assets/img/teams.png">
                    </div>

                    <div class="col-md-8 md-2 mt-6" style="margin-top: 15rem !important;">
                    <div class="form-group text-right mt-5">
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary">
                                    <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                    SUBMIT
                                </button>
                                <a  href="{{ URL::to('/company/bench')  }}" class="btn btn-primary" type="reset">CANCEL</a>
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
@stop
@section('information_script')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/team_register.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/a8d4ee811a.js" crossorigin="anonymous"></script>
<!--global js end-->
<script>
    $(function(){
        $(".btn-copy-team").on('click', function(){
            var element = '<div class="teams_data-3">'+$('.teams_data').html()+'</div>';
            $('.teams_data-1').append(element);
        });
    });
    $(document).on('click','.remove-team1',function() {
        $(".teams_data-3:last").remove();
    });
</script>
@endsection
