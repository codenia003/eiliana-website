@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">My Opportunity : {{ $leads->touser->full_name }}</span>
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
                        <p class="h3">{{$leads->touser->full_name }}</p>
                        <p class="key_skills">{{ $leads->subject }}</p>
                        <p class="experience_year">{{ $leads->message }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="contract-apply text-center">
                    <ul class="list-inline mb-0">

                            <li class="list-inline-item">
                                <a class="start_chat btn-icon" data-touserid="{{$leads->touser->id }}" data-tousername="{{$leads->touser->full_name }}" data-chattype="4" title="Proposal!"><img class="img-fluid" src="/assets/img/icons/icon-6.png" alt="Avatar"></a>
                            </li>
                            <li class="list-inline-item">
                                <a class="start_chat btn-icon" data-touserid="{{$leads->touser->id }}" data-tousername="{{$leads->touser->full_name }}" data-chattype="4" title="Live Chat!"><i class="far fa-comment"></i></a>
                            </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('profile_script')
<x-chat-message/>
@stop
