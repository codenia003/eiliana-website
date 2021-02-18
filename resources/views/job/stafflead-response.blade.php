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
        <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
            <div id="notific">
                @include('notifications')
            </div>
            <div class="singup-body login-body account-register">
                <div class="card">
                    <h4 class="card-header text-left">Contact By Client</h4>
                    <div class="card-body">
                        <form action="#" method="POST" id="staffingflead">
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
                                    <input type="text" class="form-control" name="subject" value="{{ $staffingleads->subject }}" id="subject" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="message-text" name="messagetext" rows="3" readonly>{{ $staffingleads->message }}</textarea>
                                </div>
                                <div class="stafflead-basic">
                                    <button type="button" class="btn btn-md btn-info bg-light-blue" onclick="leadConvert('{{ $staffingleads->staffing_leads_id }}','2')">Convert to Opportunity <img class="img-fluid" src="/assets/img/icons/convertlead.png"></button>
                                    <button type="button" class="btn btn-md btn-info bg-light-blue" onclick="leadConvert('{{ $staffingleads->staffing_leads_id }}','4')">Decline to Opportunity <img class="img-fluid" src="/assets/img/icons/declinelead.png" alt="Avatar"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.left')
    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<!--global js end-->
<script>
    function leadConvert(lead_id,lead_status){
        var url = '/staffing-lead-convert';
        var data= {
            _token: "{{ csrf_token() }}",
            lead_id: lead_id,
            lead_status: lead_status
        };
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(data) {
                var userCheck = data;
                if (userCheck.success == '1') {
                    Swal.fire({
                        type: 'success',
                        title: 'Success...',
                        text: userCheck.msg,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    window.location.href = '/freelancer/my-opportunity';
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: userCheck.errors,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if (userCheck.success == '2') {
                        window.location.href = '/freelancer/my-opportunity';
                    }
                }
                //
                // Swal.fire({
                //     type: 'success',
                //     title: 'Success...',
                //     text: message,
                //     showConfirmButton: false,
                //     timer: 1500
                // })

            },
            error: function(xhr, status, error) {
                console.log("error: ",error);
            },
        });
    }
</script>
@stop
