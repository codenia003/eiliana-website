@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Contract Details </span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="profile-information">
    <div id="notific">
        @include('notifications')
    </div>
     <div class="singup-body login-body profile-basic">
        <div class="card">
        <div class="bg-blue">
            <div class="px-5 py-2">
                <span class="h5 text-white" style="margin-left: -25px;">Contract Details</span>
            </div>
        </div>
            <div class="card-body p-4">
                <form action="" method="POST" id="educationForm">
                    @csrf
                    <input type="hidden" name="" value="">
                    <div class="main-moudle">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Proposal Id</label>
                                <input type="text" class="form-control" name="proposal_id" value="" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Order Closed Value</label>
                                <input type="text" class="form-control" name="ord_closed_value" value="" readonly>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Date of Acceptance</label>
                                <input class="form-control" type="text" name="acceptance_date" value="" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Ordering Company Name/Individual  </label>
                                <input type="text" class="form-control" name="ord_company_name" value="" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <div class="form-group basic-file">
                                    <label>Upload Documents</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="upload_file" readonly>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Sales Commission Amount </label><small>(Excluding GST)</small>
                                <input type="text" class="form-control" name="sales_comm_amount" value="" readonly>
                            </div>
                        </div>
                        <!-- <div class="form-group basic-info mb-3">
                            <label>Model Of Engagement</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="hourly" class="custom-control-input" name="title1" checked>
                                    <label class="custom-control-label" for="hourly">Hourly</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="pt_rentainer" class="custom-control-input" name="title1">
                                    <label class="custom-control-label" for="pt_rentainer">P.T.Rentainer</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="project_based" class="custom-control-input" name="title1">
                                    <label class="custom-control-label" for="project_based"> Project-based</label>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group basic-info mb-3">
                            <label>Model Of Engagement:
                                    <span>Hourly</span>
                            </label>
                        </div>
                        <!-- <div class="form-row">
                            <div class="form-group col-6">
                                <label>Advance Payment details</label>
                                <input type="text" class="form-control" name="advance_payment_details" value="" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Remarks </label>
                                <input type="text" class="form-control" name="remarks" value="" readonly>
                            </div>
                        </div> -->

                        <!-- <div class="form-row">
                            <div class="form-group col-5">
                                <label>Invoice Number </label><small>(Against Advance)</small>
                                <input type="text" class="form-control" name="invoive_no" value="" readonly>
                            </div>
                            <div class="form-group col-2">
                                <label>Invoice Date</label>
                                <input class="form-control" type="text" name="invoice_date" value="" readonly>
                            </div>
                            <div class="form-group col-5">
                                <label>Invoice Amount</label><small>(Including GST)</small>
                                <input type="text" class="form-control" name="invoice_amount" value="" readonly>
                            </div>
                        </div> -->
                        <div class="form-row">
                            <div class="form-group col-5">
                                <label>Advance Payment </label><small>(Excluding GST)</small>
                                <input type="text" class="form-control" name="advance_payment" value="" readonly>
                            </div>
                            <div class="form-group col-3">
                                <label>Payment Due Date</label>
                                <input class="form-control" type="text" name="payment_due_date" value="" readonly>
                            </div>
                            <div class="form-group col-4">
                                <label>Hrs/Milestones/Remarks </label>
                                <input type="text" class="form-control" name="milestones_name" value="" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-5">
                                <label><span class="sub_module_num">2</span>. Installment </label><small>(Excluding GST)</small>
                                <input type="text" class="form-control" value="" readonly>
                            </div>
                            <div class="form-group col-3">
                                <label>Payment Due Date</label>
                                <input class="form-control" type="text" name="dob" value="" readonly>
                            </div>
                            <div class="form-group col-4">
                                <label>Hrs/Milestones/Remarks </label>
                                <input type="text" class="form-control" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer singup-body" id="payment_button" style="border-top: 1px solid #ffffff;">
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary">
                            <span class=" spinner-border-sm mr-1"></span>
                            Payment </button>
                        </div>
                    </div>
                     <div class="form-group text-right mt-5" id="status">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary" type="button" onclick="contractDetails('')">Accept</button>
                            <button class="btn btn-primary" type="button" onclick="contractDetails('')">Reject</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('profile_script')
{{-- <x-chat-message/> --}}
<script>
$('#payment_button').hide();
function contractDetails(schedule_id,lead_status){
    $('.spinner-border').removeClass("d-none");
    $('#payment_button').show();
    $('#status').hide();
    var url = '/client/contract-detail-schedule';
    var data= {
        _token: "{{ csrf_token() }}",
        schedule_id: schedule_id,
        lead_status: lead_status
    };
    // $.ajax({
    //     type: 'POST',
    //     url: url,
    //     data: data,
    //     success: function(data) {
    //         var userCheck = data;
    //         $('.spinner-border').addClass("d-none");
    //         if (userCheck.success == '1') {
    //             Swal.fire({
    //                 type: 'success',
    //                 title: 'Success...',
    //                 text: userCheck.msg,
    //                 showConfirmButton: false,
    //                 timer: 2000
    //             });

    //             // window.location.href = '/freelancer/my-opportunity';
    //         } else {
    //             Swal.fire({
    //                 type: 'error',
    //                 title: 'Oops...',
    //                 text: userCheck.errors,
    //                 showConfirmButton: false,
    //                 timer: 3000
    //             });
    //             // if (userCheck.success == '2') {
    //             //     window.location.href = '/freelancer/my-opportunity';
    //             // }
    //         }

    //     },
    //     error: function(xhr, status, error) {
    //         console.log("error: ",error);
    //     },
    // });
}
</script>
@stop
