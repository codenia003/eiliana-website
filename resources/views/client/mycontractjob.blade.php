@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">My Contract Job</span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md">
    <table class="table table-striped" id="myopportunity-table">
        <thead>
         <tr>
            <!-- <th>Job Lead Id</th> -->
            <th>Job Name</th>
            <th>Subject</th>
            <th>Status</th>
            <th>Status Date</th>
            <!-- <th>View</th> -->
         </tr>
        </thead>
        <tbody>
        @foreach($jobs as $jobes)
           @foreach($jobes->jobbidresponse as $job)
            <tr>
                <!-- <td>{{ $job->Job_id }}</td> -->
                <td>
                <a class="addAttr" data-toggle="modal" data-target="#modal-4" data-id="{{ $job->Job_leads_id }}" data-subject="{{ $job->subject }}" data-message="{{ $job->message }}" data-display_status="{{ $job->display_status }}" > {{ $jobes->job_title }}</a>
                </td>
                <td>{{ $job->subject }}</td>
                <td>
                    @if ($job->lead_status == 1)
                    Pending
                    @elseif($job->lead_status == 2)
                    Process
                    @elseif($job->lead_status == 3)
                    Complete
                    @else
                    Cancel
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($job->created_at)->format('F d, Y') }}</td>
            </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
    <div class="pager">
        {{ $jobs->withQueryString()->links() }}
    </div>
</div>
<div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
        <div class="modal-dialog" role="document" style="max-width: 900px !important;">
            <div class="modal-content">
                <form action="#" method="POST" id="staffingflead">
                    @csrf
                    <div class="modal-header bg-blue text-white">
                        <h4 class="modal-title" id="modalLabelnews">Job Lead Detail</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="id" class="col-form-label">Job Lead Id:</label>
                                <input type="text" class="form-control" name="id" id="id" value="" readonly="">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="subject" class="col-form-label">Subject:</label>
                                <input type="text" class="form-control" name="subject" id="subject" value="" readonly="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message" rows="3" readonly></textarea>
                        </div>

                    </div>
                    <!-- <div class="modal-footer singup-body">
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Apply</button>
                            <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $('.addAttr').click(function() {
    var id = $(this).data('id');  
    console.log(id); 
    var subject = $(this).data('subject');   
    var message = $(this).data('message'); 
    var display_status = $(this).data('display_status');  

    $('#id').val(id); 
    $('#subject').val(subject); 
    $('#message').val(message); 
    $('#display_status').val(display_status); 
  });
});
 </script>

