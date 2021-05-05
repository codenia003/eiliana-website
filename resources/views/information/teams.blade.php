@extends('information/layout')
@section('information_css')

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
        <form action="#" method="POST" id="teams_form">
            @csrf
            <div class="teams-1">
            <table class="table table-striped" id="myopportunity-table">
            <thead>
            <tr>
                <th>Recipient’s Name </th>
                <th>Recipient’s Mail ID</th>
                <th>Subject </th>
                <th>Message</th>
                <th>User Type</th>
            </tr>
            </thead>
                <tbody>
                        <div class="teams-3 remove-qual">
                            <input type="hidden" name="graduation_type[]" value="3">
                            <input type="hidden" name="education_id[]" id="education_id" value="">
                            <tr>
                                <td><input type="text" class="form-control" id="name" name="uname"></td>
                                <td><input type="text" class="form-control" id="name" name="uname"></td>
                                <td><input type="text" class="form-control" id="name" name="uname"></td>
                                <td><input type="text" class="form-control" id="name" name="uname"></td>
                                <td><select name="user_type" class="form-control">
                                    <option value=""></option>
                                </select></td>
                            </tr>
                        </div>
                    </tbody>
                </table>
            </div>    
            <div class="mb-3 mt-3 duplicate-team">
                <button class="btn btn-md btn-info btn-copy-team" type="button">ADD MEMBER <span class="fa fa-plus"></span></button>
                <button type="button" class="remove-team btn btn-md btn-info ml-3 rounded-0">ERASE MEMBER <span class="fas fa-times"></span></button>
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
        </form>
       </div>
    </div>
    <div class="teams-2 d-none">
        <input type="hidden" name="graduation_type[]" value="3">
        <input type="hidden" name="education_id[]" id="education_id" value="0">
        <div class="table-responsive-lg table-responsive-sm table-responsive-md">
            <table class="table table-striped" id="myopportunity-table">
                <tbody>
                    <tr>
                        <td style="border-top: 1px solid #ffffff;"><input type="text" class="form-control" id="name" name="uname"></td>
                        <td style="border-top: 1px solid #ffffff;"><input type="text" class="form-control" id="name" name="uname"></td>
                        <td style="border-top: 1px solid #ffffff;"><input type="text" class="form-control" id="name" name="uname"></td>
                        <td style="border-top: 1px solid #ffffff;"><input type="text" class="form-control" id="name" name="uname"></td>
                        <td style="border-top: 1px solid #ffffff;"><select name="user_type" class="form-control">
                            <option value=""></option>
                        </select></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('information_script')

@stop
