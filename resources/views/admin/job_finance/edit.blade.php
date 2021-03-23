@extends('admin/layouts/default')

@section('title')
Finances
@parent
@stop
@section('content')
  @include('common.errors')
    <section class="content-header">
     <h1>Edit Job Finance</h1>
     <ol class="breadcrumb">
         <li>
             <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                 Dashboard
             </a>
         </li>
         <li>Finances</li>
         <li class="active">Edit Job Finance </li>
     </ol>
    </section>
    <section class="content">
    <div class="container">
      <div class="row">
             <div class="col-12">
              <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Edit Job Finance
                        </h4></div>
                    <br />
                <div class="card-body">
                {!! Form::model($order_finances_id, ['route' => ['admin.job-assign-to-resource', collect($order_finances_id)->first() ], 'method' => 'patch']) !!}

                @include('admin.job_finance.fields')

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
    function JobAssignToResource(job_order_id,finance_status){
        $('.spinner-border').removeClass("d-none");
        var url = '/admin/job_finance/job-assign-to-resource';
        var data= {
            _token: "{{ csrf_token() }}",
            job_order_id: job_order_id,
            finance_status: finance_status
        };
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
