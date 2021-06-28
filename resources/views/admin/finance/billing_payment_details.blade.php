@extends('admin/layouts/default')

@section('title')
Billing and Payment Details
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Billing and Payment</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Billing and Payment Details</li>
        <li class="active">Billing and Payment Details</li>
    </ol>
</section>
<section class="content">
<div class="container">
    <div class="row">
     <div class="col-12">
     @include('flash::message')
        <div class="card border-primary ">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title float-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                   Billing and Payment Details
                </h4>
            </div>
            <br />
            <div class="card-body table-responsive">
            <div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
            @if($finance->contractdetails->model_engagement == '1')
                <table class="table table-striped table-bordered" id="finances-table" width="100%">
                    <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Invoice Date</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Per Hour Rate</th>
                        <th>No Of Hour Purchase</th>
                        <th>Total Hourly Amount</th>
                        <th>Sales Commission</th>
                        <th>Description</th>
                        <th>GST Amount</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if(!empty($finance->contractdetails->orderinvoice))
                                <td>{!! $finance->contractdetails->orderinvoice->invoice_no !!}</td>
                            @else
                               <td></td>
                            @endif 

                            @if(!empty($finance->contractdetails->orderinvoice))
                                <td>{!! $finance->contractdetails->orderinvoice->invoice_due_date !!}</td>
                            @else
                               <td></td>
                            @endif    

                            @if(!empty($finance->contractdetails))
                                <td>{!! $finance->projectdetail->companydetails->full_name !!} </td>
                            @else
                               <td></td>
                            @endif

                            @if(!empty($finance->contractdetails))
                                <td>{!! $finance->projectdetail->companydetails->address !!} </td>
                            @else
                               <td></td>
                            @endif

                            @if(!empty($finance->projectdetail->projectCurrency))
                                <td>{!! $finance->projectdetail->projectCurrency->symbol !!} {!! $finance->bid_amount  !!}</td>
                            @endif

                            @foreach($finance->contractdetails->paymentschedule as $paymentschedule)
                                <td>{!! $paymentschedule->hours_purchase  !!}</td>
                            @endforeach

                            <?php
                                    $hours_purchase_r = 0;
                                    foreach($finance->contractdetails->paymentschedule as $paymentschedule){
                                        $hours_purchase_r += $paymentschedule->hours_purchase;
                                    }
                                    $total_installment = $finance->contractdetails->order_closed_value * $hours_purchase_r;
                                    
                            ?>

                            <td>{{ $total_installment }}</td>

                            @if($finance->projectdetail->referral_id != 0)
                                <td>{{ $finance->sales_comm_amount }}%</td>
                            @else
                                <td>0</td>    
                            @endif

                            <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a 
                                galley of type and scrambled it to make a type specimen book.</td>
                            <td>0</td>
                            @if(!empty($finance->contractdetails->orderinvoice->invoice_amount))
                               <td>{!! $finance->contractdetails->orderinvoice->invoice_amount !!}</td>
                            @else
                               <td></td>
                            @endif
                            <td>
                                <a href="{{ route('admin.generate-invoice', $finance->project_leads_id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit finance"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group text-right mt-5" style="text-align: left !important;">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" style="font-size: 16px !important;" type="button" onclick="sendToCustomer('{{ $finance->project_leads_id }}')">
                            Send To Customer 
                        </button>
                    </div>
                </div>
            @elseif($finance->contractdetails->model_engagement == '2')   
                <table class="table table-striped table-bordered" id="finances-table" width="100%">
                    <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Invoice Date</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Service Charge Per Month</th>
                        <th>Contract Duration</th>
                        <th>Billing Period</th>
                        <th>Sales Commission</th>
                        <th>Description</th>
                        <th>GST Amount</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if(!empty($finance->contractdetails->orderinvoice))
                                <td>{!! $finance->contractdetails->orderinvoice->invoice_no !!}</td>
                            @else
                               <td></td>
                            @endif 

                            @if(!empty($finance->contractdetails->orderinvoice))
                                <td>{!! $finance->contractdetails->orderinvoice->invoice_due_date !!}</td>
                            @else
                               <td></td>
                            @endif    

                            @if(!empty($finance->contractdetails))
                                <td>{!! $finance->projectdetail->companydetails->full_name !!} </td>
                            @else
                               <td></td>
                            @endif

                            @if(!empty($finance->contractdetails))
                                <td>{!! $finance->projectdetail->companydetails->address !!} </td>
                            @else
                               <td></td>
                            @endif

                            @if(!empty($finance->projectdetail->projectCurrency))
                                <td>{!! $finance->projectdetail->projectCurrency->symbol !!} {!! $finance->bid_amount  !!}</td>
                            @endif

                            @if(!empty($finance->projectdetail->project_duration_max))
                                <td>{!! $finance->projectdetail->project_duration_max  !!}</td>
                            @endif

                            <td></td>

                            @if($finance->projectdetail->referral_id != 0)
                                <td>{{ $finance->sales_comm_amount }}%</td>
                            @else
                                <td>0</td>    
                            @endif

                            <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a 
                                galley of type and scrambled it to make a type specimen book.</td>
                            <td>0</td>
                            @if(!empty($finance->contractdetails->orderinvoice->invoice_amount))
                               <td>{!! $finance->contractdetails->orderinvoice->invoice_amount !!}</td>
                            @else
                               <td></td>
                            @endif
                            <td>
                                <a href="{{ route('admin.generate-invoice', $finance->project_leads_id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit finance"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group text-right mt-5" style="text-align: left !important;">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" style="font-size: 16px !important;" type="button" onclick="sendToCustomer('{{ $finance->project_leads_id }}')">
                            Send To Customer 
                        </button>
                    </div>
                </div>
            @else
            <table class="table table-striped table-bordered" id="finances-table" width="100%">
                    <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Invoice Date</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Service Charge</th>
                        <th>Milestone No.</th>
                        <th>Sales Commission</th>
                        <th>Description</th>
                        <th>GST Amount</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if(!empty($finance->contractdetails->orderinvoice))
                                <td>{!! $finance->contractdetails->orderinvoice->invoice_no !!}</td>
                            @else
                               <td></td>
                            @endif 

                            @if(!empty($finance->contractdetails->orderinvoice))
                                <td>{!! $finance->contractdetails->orderinvoice->invoice_due_date !!}</td>
                            @else
                               <td></td>
                            @endif    

                            @if(!empty($finance->contractdetails))
                                <td>{!! $finance->projectdetail->companydetails->full_name !!} </td>
                            @else
                               <td></td>
                            @endif

                            @if(!empty($finance->contractdetails))
                                <td>{!! $finance->projectdetail->companydetails->address !!} </td>
                            @else
                               <td></td>
                            @endif

                            @foreach($finance->projectschedulee->schedulemodulee as $schedulemodulee)
                                <td>{!! $finance->projectdetail->projectCurrency->symbol !!} {!! $schedulemodulee->payable_amount !!}</td>
                                <td>{!! $schedulemodulee->milestone_no  !!}</td>
                            @endforeach

                            @if($finance->projectdetail->referral_id != 0)
                                <td>{{ $finance->sales_comm_amount }}%</td>
                            @else
                                <td>0</td>    
                            @endif

                            <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a 
                                galley of type and scrambled it to make a type specimen book.</td>
                            <td>0</td>
                            @if(!empty($finance->contractdetails->orderinvoice->invoice_amount))
                               <td>{!! $finance->contractdetails->orderinvoice->invoice_amount !!}</td>
                            @else
                               <td></td>
                            @endif
                            <td>
                                <a href="{{ route('admin.generate-invoice', $finance->project_leads_id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit finance"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group text-right mt-5" style="text-align: left !important;">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" style="font-size: 16px !important;" type="button" onclick="sendToCustomer('{{ $finance->project_leads_id }}')">
                            Send To Customer 
                        </button>
                    </div>
                </div>
            @endif
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
                        

                        function sendToCustomer(project_leads_id){
                            $('.spinner-border').removeClass("d-none");
                            var url = '/admin/finance/send-to-customer';
                            var data= {
                                _token: "{{ csrf_token() }}",
                                project_leads_id: project_leads_id
                            };
                            console.log(data);
                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: data,
                                success: function(data) {
                                    var userCheck = data;
                                    $('.spinner-border').addClass("d-none");
                                    if (userCheck.success == '1') {
                                        Swal.fire({
                                            type: 'success',
                                            title: 'Success...',
                                            text: userCheck.msg,
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                        // window.location.href = '/freelancer/my-opportunity';
                                    } else {
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Oops...',
                                            text: userCheck.errors,
                                            showConfirmButton: false,
                                            timer: 3000
                                        });
                                        // if (userCheck.success == '2') {
                                        //     window.location.href = '/freelancer/my-opportunity';
                                        // }
                                    }

                                },
                                error: function(xhr, status, error) {
                                    console.log("error: ",error);
                                },
                            });
                        }

                    </script>
                @stop
            </div>
        </div>
     </div>
   </div>
 </div>
</section>
@stop
