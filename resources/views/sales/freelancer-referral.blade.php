@extends('layouts/default')

{{-- Page title --}}
@section('title')
Freelancer Referral
@parent
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Referral A Freelancer</span>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="sales-referal">
	<div class="shadow1">
        <div class="container space-2">
            <div id="notific">
                @include('notifications')
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 pr-lg-0">
                    <div class="freee-referal-body card shadow login-body">
                        <form action="{{ route('freelancerreferral.new') }}" method="POST" id="projectlead">
                            @csrf
                            <div class="card-body">
                                <div class="card-header">
                                    {{-- <img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="SVG"> --}}
                                    <h4>Fill The Referral Details</h4>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="first_name" class="col-form-label">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" required>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="last_name" class="col-form-label">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="email" class="col-form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="phone" class="col-form-label">Phone Number</label>
                                        <input type="number" class="form-control" name="phone" id="phone" min="0" oninput="validity.valid||(value='');" required>
                                    </div>
                                </div>
                                <div class="eiliana-refer">
                                    <button class="btn btn-primary red-linear-gradient"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Generate Link</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="freee-secons-side text-center">
                		<img src="/assets/img/photo/refer/free-referal-t.png" class="img-fluid img1" alt="">
                		<h4>Refer your friend to us</h4>
                        <img src="/assets/img/photo/refer/free-referal-b.png" class="img-fluid img2" alt="">
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade pullDown login-body border-0 modal-refer" id="modal-refer" role="dialog" aria-labelledby="modalLabelnews">
    <div class="modal-dialog" role="document">
        <div class="modal-content d-none after-referal">
            <div class="modal-body">
                <button class="btn times" data-dismiss="modal"><i class="fas fa-times"></i></button>
                <div class="eiliana-logo">
                    <img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="SVG">
                    <h4>Referral Link</h4>
                    <div class="referral_link"></div>
                </div>
            </div>
            <div class="modal-footer eiliana-refer">
                <input type="hidden" name="referral_code" value="0" id="referral_code">
                <button class="btn btn-primary yellow-linear-gradient"  onclick="copyToClipboard('#copy_url')">Copy Link</button>
                <button class="btn btn-outline-primary red-linear-gradient" type="button" onclick="sendToUser()"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Email to Your Friend</button>
            </div>
        </div>
    </div>
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<script>
    $('#projectlead').bootstrapValidator({
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $('.spinner-border').removeClass("d-none");
        $.post($form.attr('action'), $form.serialize(), function(result) {
            var userCheck = result;
            $('.after-referal').removeClass("d-none");
            $('#projectlead').bootstrapValidator('resetForm', true);
            $('.spinner-border').addClass("d-none");
            $('.referral_link').html('<h5 id="copy_url">'+userCheck.referral_link+'</h5>');
            $('#referral_code').val(userCheck.referral_code);
            $('#modal-refer').modal('show');

        }, 'json');
    });

    function sendToUser() {
        $('.spinner-border').removeClass("d-none");
        var url = '/freelancer-referral-email';
        var referral_code = $('#referral_code').val();
        var data= {
            _token: "{{ csrf_token() }}",
            referral_code:referral_code,
            status: '1'
        };
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(data) {
                var userCheck = data;
                $('.spinner-border').addClass("d-none");
            },
            error: function(xhr, status, error) {
                console.log("error: ",error);
            },
        });
    }
</script>
@stop
