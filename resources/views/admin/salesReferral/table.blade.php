<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
<table class="table table-striped table-bordered" id="finances-table" width="100%">
    <thead>
     <tr>
        <th>Sr.No</th>
        <th>Customer Name</th>
        <th>Sales Executive</th>
        <th>Status</th>
        <th >Action</th>
     </tr>
    </thead>
    <tbody>
      @php
            $a = 1;
      @endphp
     @foreach($sales_referrals as $sales_referral)
        <tr>
            <td>{!! $a++ !!}</td>
            <td>{!! $sales_referral->companydetails->full_name !!} </td>
            <td>{!! $sales_referral->contact_person !!} </td>
            <td>@if($sales_referral->lead_status == 1)
               Pending
              @elseif($sales_referral->lead_status == 2)
               Assign
              @elseif($sales_referral->lead_status == 3)
               Complete
              @elseif($sales_referral->lead_status == 4)
               Reject
              @endif
            </td>
            <td>
                 <a href="{{ route('admin.salesReferral.edit', $sales_referral->sales_referral_id) }}">
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
