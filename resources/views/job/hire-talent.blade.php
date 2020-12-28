@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ $pagename['page_title'] }}
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<!--end of page level css-->
@stop
{{-- breadcrumb --}}
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">{{ $pagename['page_title'] }}</span>
        </div>
    </div>
</div>
@stop
{{-- content --}}
@section('content')
<div class="hire-talent">
	<div class="shadow1">   
        <div class="container space-1 space-top-lg-0 mt-lg-n10">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 col-12 pr-0">
                    <div id="notific">
                        @include('notifications')
                    </div>
                    <div class="advance-search singup-body login-body">
                        <form action="{{ url('/talent-search') }}" method="post" id="postJobForm" enctype="multipart/form-data">
                            {{-- @csrf --}}
                            <div class="card">
                                <div class="p-4">
                                	<div class="form-group basic-info">
					                    <label>Looking For</label>
					                    <div class="form-check form-check-inline ml-3">
					                        <div class="custom-control custom-radio">
					                            <input type="radio" id="Freelance" class="custom-control-input" name="lookingfor" onchange="changeLookingFor(event)" value="2">
					                            <label class="custom-control-label" for="Freelance">Freelance Projects</label>
					                        </div>
					                    </div>
					                    <div class="form-check form-check-inline">
					                        <div class="custom-control custom-radio">
					                            <input type="radio" id="Contractual" class="custom-control-input" name="lookingfor" onchange="changeLookingFor(event)" value="1">
					                            <label class="custom-control-label" for="Contractual">Contractual Staffing</label>
					                        </div>
					                    </div>
					                	<hr>
					                </div>
					                <div class="contractual d-none">
						                <div class="form-group">
	                                        <label>Duration</label>
	                                        <div class="form-row">
	                                            <div class="col">
	                                                <select class="form-control" name="experience_year">
	                                                    <option value="">From</option>}
	                                                    option
	                                                    @for ($i = 0; $i < 21; $i++)
	                                                    <option value="{{ $i }}">{{ $i }}</option>
	                                                    @endfor
	                                                </select>
	                                            </div>
	                                            <div class="col">
	                                                <select class="form-control" name="experience_month">
	                                                    <option value="">To</option>}
	                                                    option
	                                                    @for ($i = 1; $i < 21; $i++)
	                                                    <option value="{{ $i }}">{{ $i }}</option>
	                                                    @endfor
	                                                </select>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="form-group">
	                                        <label>Job Location</label>
	                                        <select name="customer_industry" class="form-control" required>
	                                            <option value=""></option>
	                                            <option value="1">1</option>
	                                            <option value="2">2</option>
	                                        </select>
	                                    </div>
					                </div>
					                <div class="projects d-none">
					                	<div class="basic-info mb-3 ">
	                                        <label>Type of Project</label>
	                                        <br>
	                                        <div class="form-check form-check-inline">
	                                            <div class="custom-control custom-radio">
	                                                <input type="radio" id="support" class="custom-control-input" name="top" value="1" checked="">
	                                                <label class="custom-control-label" for="support">Support</label>
	                                            </div>
	                                        </div>
	                                        <div class="form-check form-check-inline">
	                                            <div class="custom-control custom-radio">
	                                                <input type="radio" id="development" class="custom-control-input" name="top" value="2">
	                                                <label class="custom-control-label" for="development">Development</label>
	                                            </div>
	                                        </div>
	                                        <div class="form-check form-check-inline">
	                                            <div class="custom-control custom-radio">
	                                                <input type="radio" id="both" class="custom-control-input" name="top" value="3">
	                                                <label class="custom-control-label" for="both">Support Cum Development</label>
	                                            </div>
	                                        </div>
	                                    </div>
					                </div>
                                    <div class="form-group text-right mt-5">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary" type="submit">
                                               Search & Find >>>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
<script>

	function changeLookingFor(e) {
        var anonymous = e.target.value;
        console.log(anonymous);
        if (anonymous == '1') {
            $('.contractual').removeClass("d-none");
            $('.projects').addClass("d-none");
        } else {
        	$('.contractual').addClass("d-none");
            $('.projects').removeClass("d-none");
        }
    }
</script>
<!--global js end-->
@stop