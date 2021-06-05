<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
<table class="table table-striped table-bordered" id="finances-table" width="100%">
    <thead>
     <tr>
        <th>Proposal ID</th>
        <th>Customer Name</th>
        <th>Price Per Month</th>
        <th>Freelancer Name</th>
        <!-- <th>Contract Duration</th> -->
        <th>Resource Name</th>
        <th>Date Of Onboard</th>
        <th>Pricing Cycle</th>
        <th>Location</th>
        <th >Action</th>
     </tr>
    </thead>
    <tbody>
      
    @foreach($resources as $resource)
        <tr>
            <td>{!! $resource->jobcontractschedule->job_proposal_id !!} </td>
            <td>{!! $resource->jobcontractschedule->customer_name !!}</td>
            <td>{!! $resource->jobcontractschedule->price !!} </td>
            <td>{!! $resource->freelancer_name !!} </td>
            {{--<td>{!! $resource->contract_duration !!} </td>--}}
            <td>{!! $resource->sprovider_name !!} </td>
            <td>{!! $resource->onboard_date !!} </td>
            <td>@if($resource->pricing_cycle == 1)
                 Monthly Advance
              @elseif($resource->pricing_cycle == 2)
                 Quarterly Advance
              @elseif($resource->pricing_cycle == 3)
                 Bi-Monthly Advance
              @else
                 Yearly Advance
              @endif
            </td>
            <td>@if($resource->location == 1)
                 Customer Location
              @else
                 Offsite
              @endif
            </td>
            <td>
                 <a href="{{ route('admin.resourceDetails.edit', $resource->resource_id) }}">
                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit finance"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@section('footer_scripts')
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteLabel">Delete Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this Item? This operation is irreversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a  type="button" class="btn btn-danger Remove_square">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
 <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}">
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>

    <script>
        $('#finances-table').DataTable({
              responsive: true,
              pageLength: 10
          });
          $('#finances-table').on( 'page.dt', function () {
             setTimeout(function(){
                   $('.livicon').updateLivicon();
             },500);
          } );
          $('#finances-table').on( 'length.dt', function ( e, settings, len ) {
             setTimeout(function(){
                    $('.livicon').updateLivicon();
             },500);
          } );

          $('#delete_confirm').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget)
               var $recipient = button.data('id');
              var modal = $(this);
              modal.find('.modal-footer a').prop("href",$recipient);
          })

       </script>

@stop
