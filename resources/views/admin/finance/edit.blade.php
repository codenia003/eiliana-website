@extends('admin/layouts/default')

@section('title')
Finances
@parent
@stop
@section('content')
  @include('common.errors')
    <section class="content-header">
     <h1>Finances Edit</h1>
     <ol class="breadcrumb">
         <li>
             <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                 Dashboard
             </a>
         </li>
         <li>Finances</li>
         <li class="active">Edit Finance </li>
     </ol>
    </section>
    <section class="content">
    <div class="container">
      <div class="row">
             <div class="col-12">
              <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Edit  Finance
                        </h4></div>
                    <br />
                <div class="card-body">
                {!! Form::model($finance, ['route' => ['admin.assign-to-resource', collect($finance)->first() ], 'method' => 'patch']) !!}

                @include('admin.finance.fields')

                {!! Form::close() !!}
                </div>
              </div>
           </div>
        </div>
    </div>
   </section>
 @stop
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("form").submit(function() {
                $('input[type=submit]').attr('disabled', 'disabled');
                return true;
            });
        });
    </script>
<script>
    $(".user_details").keyup(function(){
        assignToResource();
    });

    function assignToResource(order_finance_id,user_id,project_leads_id,total_advance_payment,total_price,finance_status){
        $('.spinner-border').removeClass("d-none");
        var gst_no = $(".gst_no").val();
        var pan_card = $(".pan_card").val();
        var url = '/admin/finance/assign-to-resource';
        var data= {
            _token: "{{ csrf_token() }}",
            order_finance_id: order_finance_id,
            finance_status: finance_status,
            user_id: user_id,
            project_leads_id: project_leads_id,
            total_advance_payment: total_advance_payment,
            total_price: total_price,
            gst_no: gst_no,
            pan_card: pan_card
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

    // function GenerateBill(project_leads_id,total_advance_payment,status){
    //     $('.spinner-border').removeClass("d-none");
    //     var url = '/admin/finance/generate-invoice';
    //     var data= {
    //         _token: "{{ csrf_token() }}",
    //         project_leads_id: project_leads_id,
    //         total_advance_payment: total_advance_payment,
    //         status: status
    //     };
    //     console.log(data);
    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         data: data,
    //         success: function(data) {
    //             var userCheck = data;
    //             $('.spinner-border').addClass("d-none");
    //             if (userCheck.success == '1') {
    //                 Swal.fire({
    //                     type: 'success',
    //                     title: 'Success...',
    //                     text: userCheck.msg,
    //                     showConfirmButton: false,
    //                     timer: 2000
    //                 });
    //             } else {
    //                 Swal.fire({
    //                     type: 'error',
    //                     title: 'Oops...',
    //                     text: userCheck.errors,
    //                     showConfirmButton: false,
    //                     timer: 3000
    //                 });
    //             }

    //         },
    //         error: function(xhr, status, error) {
    //             console.log("error: ",error);
    //         },
    //     });
    // }

    function GenerateBill(project_leads_id){
        //location.href = '/admin/finance/generate-invoice/'+ project_leads_id;
        location.href = '/admin/finance/billingPayment/'+ project_leads_id;
    }
</script> 
@stop
