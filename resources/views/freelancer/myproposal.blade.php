@extends('profile/layout')
@section('profile_css')

@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">My Proposal</span>
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="my-alldata card-body table-responsive-lg table-responsive-sm table-responsive-md">
    <table class="table table-striped" id="myopportunity-table">
        <thead>
         <tr>
            <th>Opportunity Id</th>
            <th>Job Name</th>
            <th>Subject</th>
            <th>Status</th>
            <th>Status Date</th>
            <th>View</th>
         </tr>
        </thead>
        <tbody>
        @foreach($leads as $lead)
            <tr>
                <td>{{ $lead->job_leads_id }}</td>
                <td><a href="{{ route('jobdetails',$lead->job_id) }}">{{ $lead->jobdetail->job_title }}</a></td>
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
                    <a href="{{ route('my-proposal.view',$lead->job_leads_id) }}"><i class="fas fa-info-circle"></i></a>
                </td> -->
                <td>
                    <a onclick="proposalDetails('{{ $lead->job_leads_id }}')"><i class="fas fa-info-circle"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pager">
        {{ $leads->withQueryString()->links() }}
    </div>
</div>
<div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ url('/freelancer/post-proposal-job-lead') }}" method="POST" id="">
                @csrf
                
                <div class="modal-header bg-blue text-white">
                    <h4 class="modal-title" id="modalLabelnews">Proposal For Freelancer </h4>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="job_schedule_id" class="col-form-label">Proposal Id:</label>
                            <input type="text" class="form-control" id="job_schedule_id" name="job_schedule_id" readonly>
                        </div>
                        <!-- <div class="form-group col">
                            <label for="date_acceptance" class="col-form-label">Acceptance Date:</label>
                            <input type="text" class="form-control" name="date_acceptance" id="date_acceptance" readonly>
                        </div> -->
                    </div>
                    <div class="form-group">
                        <label for="actual_date" class="col-form-label">Date :</label>
                        <input class="flatpickr flatpickr-input form-control" type="text" name="actual_date" value="" required>
                    </div>
                </div>
                <div class="modal-footer singup-body">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary">Send</button>
                        <button class="btn btn-outline-primary" data-dismiss="modal">Discard</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
<script type="">
     function proposalDetails(job_schedule_id){
    $('.spinner-border').removeClass("d-none");
    var url = '/freelancer/project-contract-post';

    var data= {
        _token: "{{ csrf_token() }}",
        job_schedule_id: job_schedule_id
    };
    console.log(data);
    
    $('#modal-4').modal('show');
    //$('#job_proposal_id').val(job_proposal_id);
    $('#job_schedule_id').val(job_schedule_id);
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

    //             $('#payment_button').show();
    //             $('#status').hide();

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
@section('profile_script')

@stop
