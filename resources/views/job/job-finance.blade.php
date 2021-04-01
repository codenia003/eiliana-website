@extends('layouts/default')

{{-- Page title --}}
@section('title')
Job Contract Details
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}">
<link href="{{ asset('vendors/flatpickr/css/flatpickr.min.css') }}" rel="stylesheet"
type="text/css"/>
@yield('profile_css')
<!--end of page level css-->
@stop

@section('top')
<div class="bg-red">
  	<div class="px-5 py-2">
    	<div class="align-items-center">
        	<span class="border-title"><i class="fa fa-bars"></i></span>
        	<span class="h5 text-white">Job Contract Details</span>
    	</div>
  	</div>
</div>
@stop
{{-- content --}}
@section('content')
<div class="profile-setting project-contract">
    <div class="container space-2">
        <div class="row">
            <div class="col-lg-8">
                <div id="notific">
                    @include('notifications')
                </div>
                 <div class="singup-body login-body profile-basic">
                    <div class="card">
                        <div class="bg-blue">
                            <div class="px-5 py-2">
                                <span class="h5 text-white" style="margin-left: -25px;">Job Contract Details</span> <small>(To be filled by developer)</small>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('job-finance.send') }}" method="POST" id="educationForm">
                                @csrf
                                <input type="hidden" name="contract_id" value="{{ $joblead->jobcontractdetails->contract_id }}">
                                <input type="hidden" name="invoice_id" value="{{ $joblead->jobcontractdetails->joborderinvoice->order_invoice_id }}">
                                <div class="main-moudle">
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Proposal Id</label>
                                            <input type="text" class="form-control" name="job_leads_id" value="{{ $joblead->job_leads_id }}" readonly>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Order Closed Value</label>
                                            <input type="text" class="form-control" name="order_closed_value" value="{{ $joblead->jobcontractdetails->order_closed_value }}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Date of Acceptance</label>
                                            <input class="form-control" type="text" name="date_acceptance" value="{{ $joblead->jobcontractdetails->date_acceptance }}" readonly>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Ordering Company Name/Individual  </label>
                                            <input type="text" class="form-control" name="ordering_com_name" value="{{ $joblead->jobcontractdetails->ordering_com_name }}" readonly>
                                        </div>
                                    </div>

                                    <h4 class="modal-title my-3">Customer Payment Schedules</h4>
                                    @foreach ($joblead->jobcontractdetails->jobpaymentschedule as $item)
                                        <div class="form-row">
                                            <div class="form-group col-3">
                                                @if ($item->advance_payment == '1')
                                                    <label>Advance Payment </label>
                                                @else
                                                    <label>{{ $item->installment_no }} Installment</label>
                                                @endif
                                                <input type="text" class="form-control" name="installment_amount" value="{{ $item->installment_amount }}" readonly>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Payment Due Date</label>
                                                <input class="form-control" type="text" name="payment_due_date" value="{{ $item->paymwnt_due_date }}" readonly>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Hrs/Milestones/Remarks </label>
                                                <input type="text" class="form-control" name="milestones_name" value="{{ $item->milestones_name }}" readonly>
                                            </div>
                                            <div class="form-group col-2">
                                                <label>Status</label>
                                                <select name="status[]" class="form-control" disabled>
                                                    <option value="1" {{ ($item->status=='1')? "selected" : "" }}>Pending</option>
                                                    <option value="2" {{ ($item->status=='2')? "selected" : "" }}>Paid</option>
                                                    <option value="3" {{ ($item->status=='3')? "selected" : "" }}>Cancel</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group text-right mt-5" id="status">
                                    <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary" type="submit">Send To Eiliana Finance</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
             @include('layouts.left')
        </div>
        <!-- End Row -->
    </div>
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/profile_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
@yield('profile_script')
<script>


</script>

<!--global js end-->
@stop

