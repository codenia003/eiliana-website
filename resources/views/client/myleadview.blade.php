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
    <form action="{{ route('referralform') }}" method="POST">
        @csrf
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
                            <option value=""></option>
                            <option value="1" {{ ($leads->legal_status=='1')? "selected" : "" }}>Pending</option>
                            <option value="2" {{ ($leads->legal_status=='2')? "selected" : "" }}>Processing</option>
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
                <div class="form-group mt-5">
                    <div class="stafflead-basic">
                        <button class="btn btn-md btn-info bg-light-blue" type="button" onclick="identify('{{ $leads->referral_code }}','1')">Identify Consultant</button>
                        <button class="btn btn-md btn-info bg-light-blue" type="button" onclick="identify('{{ $leads->referral_code }}','2')">Contact Eiliana</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@stop

@section('profile_script')
<script>
    function identify(referral_code,conatct_type){
        if(conatct_type === '1'){
            var data= {
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
                    Swal.fire({
                        type: 'success',
                        title: 'Success...',
                        text: 'Process successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.href = '/hire-talent';
                },
                error: function(xhr, status, error) {
                    console.log("error: ",error);
                },
            });
        } else {
            alert("this is id"+ref_id);
        }
    }
</script>
@stop