@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">My Proposal : {{ $leads->fromuser->full_name }}</span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="profile-information">
    <div class="card p-3 mb-4 pb-4">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="contract-profile mb-1">
                    <a href="#">
                        <img src="{{ asset('images/authors/no_avatar.jpg') }}" alt="..." class="img-fluid"/>
                    </a>
                </div>
            </div>
            <div class="col-md-7">
                <div class="contract-body">
                    <div class="mb-2">
                        <p class="h3">{{$leads->fromuser->full_name }}</p>
                        <p class="key_skills">{{ $leads->subject }}</p>
                        <p class="experience_year">{{ $leads->message }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="contract-apply text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a class="btn-icon" data-toggle="modal" data-target="#modal-4" title="Proposal!"><img class="img-fluid" src="/assets/img/icons/icon-6.png" alt="Avatar"></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="start_chat btn-icon" data-touserid="{{$leads->fromuser->id }}" data-tousername="{{$leads->fromuser->full_name }}" data-chattype="4" title="Live Chat!"><i class="far fa-comment"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ url('/post-staffing-lead') }}" method="POST" id="staffingflead">
                @csrf
                <div class="modal-header bg-blue text-white">
                    <h4 class="modal-title" id="modalLabelnews">Proposal For Client</h4>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="from-name" class="col-form-label">From:</label>
                            <input type="text" class="form-control" id="from-name" name="fromname" value="{{ Sentinel::getUser()->full_name }} " readonly>
                        </div>
                        <div class="form-group col">
                            <label for="to-name" class="col-form-label">To:</label>
                            <input type="text" class="form-control" id="to-name" name="toname" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lead-id" class="col-form-label">Proposal Id:</label>
                        <input type="text" class="form-control" id="lead-id" name="leadid" value="{{ $leads->job_leads_id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-form-label">Subject:</label>
                        <input type="text" class="form-control" name="subject" id="subject">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text" name="messagetext" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer singup-body">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary">Send</button>
                        <button class="btn btn-outline-primary" data-dismiss="modal">Discard</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('profile_script')
<x-chat-message/>
@stop
