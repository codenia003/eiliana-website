@extends('layouts/default')

{{-- Page title --}}
@section('title')
Home
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/flatpickr/css/flatpickr.min.css') }}" rel="stylesheet"
type="text/css"/>
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="profile-setting">
	<div class="bg-red">
	  <div class="px-5 py-2">
	    <div class="align-items-center">
	        <span class="border-title"><i class="fa fa-bars"></i></span>
	        <span class="h5 text-white ml-2">Dashboard</span>
	    </div>
	  </div>
	</div>
	<div class="container space-2">
	    <div class="row">
	        <div class="col-lg-3">
			    <div id="notific">
		            @include('notifications')
		        </div>
	        	@include('_left_menu')
	        </div>
	        <div class="col-lg-9">
	            <div class="card mb-3 mb-lg-5 shadow">
				    <div class="card-header">
				        <h5 class="card-title">Recent Projects</h5>
				    </div>
				    <!-- Body -->
				    <div class="card-body">
				        <div class="card-body card-body-centered" style="min-height: 15rem;">
						    <p>Start bidding now on projects that meet your skills.</p>
                            @if (Session::get('users')['login_as'] == '1')
                            <a class="btn btn-primary bg-orange" href="{{ url('search-project') }}">Browse Projects And Jobs</a>
                            @else
                            <a class="btn btn-primary bg-orange" href="{{ url('hire-talent') }}">Browse Freelancer And Talent</a>
                            @endif
                            <!-- <a class="btn btn-primary bg-orange" routerLink="/project/1">Browse Projects</a> -->
						 </div>
				    </div>
				    <!-- End Body -->
				</div>
	        </div>
	    </div>
	    <!-- End Row -->
	</div>
	@if (Session::get('users')['login_as'] == '1') {
		{{-- freelancer --}}
		@foreach ($job_onboarding as $key => $onboarding)
		<div class="modal fade pullDown login-body border-0 modal-refer betaversion" id="onboarding_{{ $key+1 }}" role="dialog" aria-labelledby="modalLabelnews">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<button class="btn times" data-dismiss="modal"><i class="fas fa-times"></i></button>
						<div class="eiliana-logo">
							<img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="SVG">
							<h4>On Boardind</h4>
							<div class="onboarding border-0 login-body">
								<div class="form-row">
									<div class="form-group col-12">
										<label>Date of Onboarding</label>
										<input class="flatpickr flatpickr-input form-control" type="text" name="date_onboarding" id="date_onboarding_{{ $key+1 }}" required>
										<input type="hidden" id="job_leads_{{ $key+1 }}" value="{{ $finances->userjobs->job_leads_id }}">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer eiliana-refer">
						<button class="btn btn-primary red-linear-gradient" type="button" onclick="sendToFreelancer('{{ $finances->job_order_id }}','{{ $key+1 }}')"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Submit</button>
						<button class="btn btn-outline-primary red-linear-gradient" type="button" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	@else
		{{-- customer --}}
		@foreach ($job_finances as $key => $finances)
		<div class="modal fade pullDown login-body border-0 modal-refer betaversion" id="onboarding_{{ $key+1 }}" role="dialog" aria-labelledby="modalLabelnews">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<button class="btn times" data-dismiss="modal"><i class="fas fa-times"></i></button>
						<div class="eiliana-logo">
							<img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="SVG">
							<h4>On Boardind</h4>
							<div class="onboarding border-0 login-body">
								<div class="form-row">
									<div class="form-group col-12">
										<label>Date of Onboarding</label>
										<input class="flatpickr flatpickr-input form-control" type="text" name="date_onboarding" id="date_onboarding_{{ $key+1 }}" required>
										<input type="hidden" id="job_leads_{{ $key+1 }}" value="{{ $finances->userjobs->job_leads_id }}">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer eiliana-refer">
						<button class="btn btn-primary red-linear-gradient" type="button" onclick="sendToFreelancer('{{ $finances->job_order_id }}','{{ $key+1 }}')"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Submit</button>
						<button class="btn btn-outline-primary red-linear-gradient" type="button" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		@endforeach

	@endif
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!-- page level js starts-->	
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
		flatpickr('.flatpickr', {
			minDate: 'today',
			dateFormat: 'Y-m-d',
		});
    });
    function toggleBoardPopup(id){
		$('#onboarding_'+id).modal('show');
	}
	function sendToFreelancer(job_order_id,key) {
        $('.spinner-border').removeClass("d-none");
        var url = 'client/job-onboarding';
        var date_onboarding = $('#date_onboarding_'+key).val();
        var job_leads_id = $('#job_leads_'+key).val();
        var data= {
            _token: "{{ csrf_token() }}",
            job_order_id:job_order_id,
            job_leads_id:job_leads_id,
            date_onboarding: date_onboarding,
            status: "1"
        };
		console.log(data);
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(data) {
                var userCheck = data;
				$('#onboarding_'+key).modal('hide');
                $('.spinner-border').addClass("d-none");
            },
            error: function(xhr, status, error) {
                console.log("error: ",error);
            },
        });
    }
</script>
@foreach ($job_finances as $key => $item)
<script>
		toggleBoardPopup({{ $key+1 }});
</script>
@endforeach
<!--page level js ends-->
@stop
