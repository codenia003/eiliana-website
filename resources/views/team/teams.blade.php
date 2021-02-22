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
<div class="card mb-3 mb-lg-5">
    <div class="card-header">
      <h5 class="card-title">Teams
      <a class="btn btn-primary bg-orange float-right" data-toggle="modal" data-target="#modal-4">Add Team</a>
      </h5>
    </div>
    <!-- Body -->
    {{-- <div class="card-body">
      <div class="card-body" style="min-height: 15rem;">
        <table class="table">
            <thead>
              <tr>
                <th>Project Name</th>
                <th>Project Description</th>
                <th>Expiry Datetime</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr *ngFor="let project of projects">
                <td>{{project.project_name}}</td>
                <td>{{project.project_description}}</td>
                <td>{{project.expiry_datetime}}</td>
                <td style="white-space: nowrap">
                  <a routerLink="edit/{{project.id}}" class="btn btn-sm btn-primary mr-1">Edit</a>
                </td>
              </tr>
              <tr *ngIf="!projects">
                <td colspan="4" class="text-center">
                  <span  *ngIf="loading" class="spinner-border spinner-border-lg align-center"></span>
                  <span  *ngIf="!loading">Project list is empty</span>
                </td>
              </tr>
            </tbody>
        </table>
      </div>
    </div> --}}
    <!-- End Body -->
    <div class="modal fade pullDown login-long-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('registerteams') }}" method="POST" id="registerteams">
                    @csrf
                    <div class="modal-header bg-blue text-white">
                        <h4 class="modal-title" id="modalLabelnews">Add Teams</h4>
                    </div>
                    <div class="modal-body login-body">
                        <div class="teams-1">
                            <div class="teams">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="from" class="col-form-label">From:</label>
                                        <input type="email" class="form-control" name="from[]" id="from" value="{{ Sentinel::getUser()->email }}" readonly>
                                    </div>
                                    <div class="form-group col">
                                        <label for="to" class="col-form-label">To:</label>
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
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 profile-basic">
                            <button class="btn btn-md btn-info btn-copy-t" type="button">Add <span class="fa fa-plus"></span></button>
                            <button type="button" class="remove-t btn btn-md btn-info ml-3 rounded-0">Erase <span class="fas fa-times"></span></button>
                        </div>
                    </div>
                    <div class="modal-footer singup-body">
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Apply</button>
                            <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
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
