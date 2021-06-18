@extends('profile/layout')
@section('profile_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">My Lead : {{ $leads->referral_code }}</span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div id="notific">
    @include('notifications')
</div>
<div class="advance-search singup-body login-body">
    <div class="card">
        <div class="card-body p-4">
            <div class="form-row">
                <div class="form-group col">
                    <label>Company Name</label>
                    <input type="text" name="company_name" class="form-control" value="{{ $leads->company_name }}" disabled />
                </div>
                <div class="form-group col">
                    <label>Legal Status</label>
                    <select name="legal_status" class="form-control" disabled>
                    @foreach($company_types as $compny_type)
                        <option value="{{ $compny_type->id }}" {{ ($leads->legal_status==$compny_type->id)? "selected" : "" }}>{{ $compny_type->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label>Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" value="{{ $leads->contact_person }}" disabled />
                </div>
                <div class="form-group col">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control" value="{{ $leads->designation }}" disabled />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label>Email Address</label>
                    <input type="text" name="email" class="form-control" value="{{ $leads->email }}" disabled />
                </div>
                <div class="form-group col">
                    <label>Mobile No</label>
                    <input type="text" name="mobile_no" class="form-control" value="{{ $leads->mobile_no }}" disabled />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label>Website Address</label>
                    <input type="text" name="website_address" class="form-control" value="{{ $leads->website_address }}" disabled />
                </div>
                <div class="form-group col">
                    <label>Requirment Details</label>
                    <input type="text" name="requirment_details" class="form-control" value="{{ $leads->requirment_details }}" disabled />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label>Customer Industry</label>
                    <select name="customer_industry" class="form-control" disabled>
                        <option value=""></option>
                        <option value="1" {{ ($leads->customer_industry=='1')? "selected" : "" }}>Pending</option>
                        <option value="2" {{ ($leads->customer_industry=='2')? "selected" : "" }}>Processing</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label>Date/Time Connect</label>
                    <input type="text" name="datetimeconnect" class="form-control" value="{{ $leads->datetimeconnect }}" disabled />
                </div>
            </div>
            <div class="form-group basic-info mb-3">
                <label>Has lead generator spoken to the customer and confirmed the requriment</label>
                <br>
                <div class="form-check form-check-inline ml-3">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="Yes" name="confirmed" class="custom-control-input" value="0" {{ ($leads->confirmed=="0")? "checked" : "" }} disabled>
                        <label class="custom-control-label" for="Yes">Yes</label>
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="No" name="confirmed" class="custom-control-input" value="1" {{ ($leads->confirmed=="1")? "checked" : "" }} disabled>
                        <label class="custom-control-label" for="No">No</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label>Commission Type</label>
                    <select name="commission_type" class="form-control" disabled>
                        <option value=""></option>
                        <option value="1" {{ ($leads->commission_type=='1')? "selected" : "" }}>Percentage</option>
                        <option value="2" {{ ($leads->commission_type=='2')? "selected" : "" }}>Processing</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label>Expected Commission(%/INR)</label>
                    <input type="text" name="expected_commission" class="form-control" value="{{ $leads->expected_commission }}" disabled />
                </div>
            </div>
            <div class="form-group">
                <label>Lead Status: </label>
                <b class="">
                    @if ($leads->lead_status == 1)
                    Pending: Eiliana review your sales referral lead
                    @elseif($leads->lead_status == 2)
                    Assign: Now you can Identify Consultant
                    @elseif($leads->lead_status == 3)
                    Complete
                    @elseif($leads->lead_status == 4)
                    Reject: Eiliana reject your sales referral lead
                    @endif
                </b>
            </div>
            <div class="form-group text-right mt-5">
                <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                <div class="btn-group" role="group">
                    <button class="btn btn-primary" type="button" onclick="identify('{{ $leads->sales_referral_id }}','{{ $leads->referral_code }}','1')">Identify Consultant</button>
                    <button class="btn btn-primary" type="button" onclick="showModel('2')">Contact Eiliana</button>
                </div>
            </div>
            {{--<div class="form-group mt-5">
                <div class="stafflead-basic">
                    <button class="btn btn-md btn-info bg-light-blue" type="button" onclick="identify('{{ $leads->sales_referral_id }}','{{ $leads->referral_code }}','1')">Identify Consultant</button>
                    <button class="btn btn-md btn-info bg-light-blue" type="button" onclick="showModel('2')">Contact Eiliana</button>
                </div>
            </div>--}}
        </div>
    </div>
</div>
<div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ url('/post-sales-referral-to-eiliana') }}" method="POST" id="staffingflead">
                @csrf
                <input type="hidden" name="sales_referral_id" id="sales_referral_id" value="{{ $leads->sales_referral_id }}">
                <div class="modal-header bg-blue text-white">
                    <h4 class="modal-title" id="modalLabelnews">Contact Eiliana: <span>Do you need to support in eiliana</span></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="lead-id" class="col-form-label">Referral Code:</label>
                        <input type="text" class="form-control" id="lead-id" name="referral_code" value="{{ $leads->referral_code }}" readonly>
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
                        <button class="btn btn-primary" type="submit"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Send</button>
                        <button class="btn btn-outline-primary" data-dismiss="modal">Discard</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('profile_script')
<script>
    function identify(referral_id,referral_code,conatct_type){
        if(conatct_type === '1'){
            var data= {
                referral_id:referral_id,
                referral_code:referral_code,
                conatct_type:conatct_type
            };
            $.ajax({
                type: 'GET',
                url: '/sales/identifyconsultant',
                data: data,
                contentType: 'application/json',
                dataType: "json",
                success: function(data) {
                    if(data.success === '1'){
                        var msg = data.msg;
                        var redirect = '/hire-talent-sales';
                        // Swal.fire({
                        //     type: 'success',
                        //     title: 'Success...',
                        //     text: data.msg,
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // });
                        //window.location.href = '/hire-talent-sales';
                    } else {
                        var msg = data.msg;
                        var redirect = '/hire-talent-sales';
                        // Swal.fire({
                        //     type: 'info',
                        //     title: 'Oops...',
                        //     text: data.msg,
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // });
                    }
                    toggleRegPopup(msg,redirect);
                },
                error: function(xhr, status, error) {
                    console.log("error: ",error);
                },
            });
        } else {
            // alert("this is id"+ref_id);
            $('#modal-4').modal('show');
        }
    }

    function showModel(conatct_type){
        if(conatct_type === '2'){
            $('#modal-4').modal('show');
        }
    }

    $('#staffingflead').bootstrapValidator({
        fields: {
            subject: {
                validators: {
                    notEmpty: {
                        message: 'The subject is required',
                    },
                },
            },
            messagetext: {
                validators: {
                    notEmpty: {
                        message: 'The message is required',
                    },
                },
            },
        },
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $('.spinner-border').removeClass("d-none");
        $.post($form.attr('action'), $form.serialize(), function(result) {
            var userCheck = result;
            //console.log(userCheck);
            if (userCheck.success == '1') {
                $('#modal-4').modal('toggle');
                $('#subject').val('');
                $('#message-text').val('');
                $('.spinner-border').addClass("d-none");
                var msg = userCheck.msg;
                var redirect = '/client/my-lead/'+ userCheck.sales_referral_id;
                // Swal.fire({
                //   type: 'success',
                //   title: 'Success...',
                //   text: userCheck.msg,
                //   showConfirmButton: false,
                //   timer: 2000
                // });
            } else {
                $('#modal-4').modal('toggle');
                $('#subject').val('');
                $('#message-text').val('');
                $('.spinner-border').addClass("d-none");
                var msg = userCheck.errors;
                var redirect = '/client/my-lead/'+ userCheck.sales_referral_id;
                // Swal.fire({
                //   type: 'error',
                //   title: 'Oops...',
                //   text: userCheck.errors,
                //   showConfirmButton: false,
                //   timer: 2000
                // });
            }
            toggleRegPopup(msg,redirect);
        }, 'json');
    });
</script>
@stop
