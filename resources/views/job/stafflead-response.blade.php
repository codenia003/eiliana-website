@extends('layouts/default')

{{-- Page title --}}
@section('title')
Job Post
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<!--end of page level css-->
<style>
    .eiliana-btn {
        height: 47px;
    }
</style>
@stop


{{-- content --}}
@section('content')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Staff Lead</span>
        </div>
    </div>
</div>
<div class="container space-1 space-top-lg-0 mt-lg-n10">
    <div class="row">
        <div class="col-md-7 offset-md-20 mt-4 shadow p-0 registration-basic register-basic">
            <div class="singup-body login-body account-register">
                <div class="card">
                    <h4 class="card-header text-left">Basic Info</h4>
                    <div class="card-body">
                        <form action="{{ url('/post-staffing-lead') }}" method="POST" id="staffingflead">
                            @csrf
                            <div class="form-new">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="from-name" class="col-form-label">From:</label>
                                        <input type="text" class="form-control" id="from-name" name="fromname" value="{{ Sentinel::getUser()->full_name }}" readonly>
                                    </div>
                                    <div class="form-group col">
                                        <label for="to-name" class="col-form-label">To:</label>
                                        <input type="text" class="form-control" id="to-name" name="toname" value="{{ $user->full_name }}" readonly>
                                        <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="toemail" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lead-id" class="col-form-label">Lead Id:</label>
                                    <input type="text" class="form-control" id="lead-id" name="leadid" value="{{ $staffingleads->staffing_leads_id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="col-form-label">Subject:</label>
                                    <input type="text" class="form-control" name="subject" id="subject">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="message-text" name="messagetext" rows="3"></textarea>
                                </div>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-primary">Send</button>
                                    <button class="btn btn-outline-primary" data-dismiss="modal">Discard</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<!--global js end-->
@stop
