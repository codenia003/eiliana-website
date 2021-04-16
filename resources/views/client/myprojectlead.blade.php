@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">My Project</span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md">
    <table class="table table-striped" id="myopportunity-table">
        <thead>
         <tr>
            <th>Project Lead Id</th>
            <th>Project Name</th>
            <th>Subject</th>
            <th>Status</th>
            <th>Status Date</th>
            <!-- <th>View</th> -->
         </tr>
        </thead>
        <tbody>
        @foreach($leads as $lead)
            <tr>
                <td>{{ $lead->project_leads_id }}</td>
                <td><a href="javascript:;" data-toggle="modal" data-target="#addModal" data-id="{{ $lead->project_leads_id }}" data-bidamount="{{ $lead->bid_amount }}" data-subject="{{ $lead->subject }}" data-message="{{ $lead->message }}" data-display_status="{{ $lead->display_status }}" > {{ $lead->projectdetail->project_title }}</a></td>
                <td>{{ $lead->subject }}</td>
                <td>
                    @if ($lead->lead_status == 1)
                    Pending
                    @elseif($lead->lead_status == 2)
                    Process
                    @elseif($lead->lead_status == 3)
                    Complete
                    @else
                    Cancel
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('F d, Y') }}</td>
                <!-- <td>
                    <a href="{{ route('project-schedule.my',$lead->project_leads_id) }}"><i class="fas fa-info-circle"></i></a>
                </td> -->
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pager">
        {{ $leads->withQueryString()->links() }}
    </div>
</div>
<!-- <div id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div role="document">
    <div >
     <div >
       <h5 id="exampleModalLabel">Project Lead Detail </h5>
       <button type=button data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <form action="" method="POST">
       <div >
        <div >
          <label for="exampleInputEmail1">Project Lead Id</label>
          <input type=text id="id" name=id readonly="">
        </div>
        <div >
          <label for="exampleInputEmail1">Bid Amount</label>
          <input type=text id="bidamount" name=bidamount readonly="">
        </div>
        <div >
          <label for="exampleInputEmail1">Subject</label>
          <input type=text id="subject" name=subject value="" readonly="">
        </div>
        <div >
          <label for="exampleInputEmail1">Message </label>
          <input type=text id="message" name=message value="" readonly="">
        </div>
        <div >
          <label for="exampleInputEmail1">Display Status </label>
          <input type=text id="display_status" name=display_status value="" readonly="">
        </div>
       </div>
       <div >
        <button type=button data-dismiss="modal">Close</button>
       </div>
     </form>
    </div>
  </div>
 </div> -->

@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/flatpickr/js/flatpickr.min.js') }}" type="text/javascript"></script>

<script>
  $('.addAttr').click(function() {
  var id = $(this).data('id');   
  var bidamount = $(this).data('bidamount'); 
  var subject = $(this).data('subject');   
  var message = $(this).data('message'); 
  var display_status = $(this).data('display_status');  

  $('#id').val(id); 
  $('#bidamount').val(bidamount); 
  $('#subject').val(subject); 
  $('#message').val(message); 
  $('#display_status').val(display_status); 
  } );
 </script>

