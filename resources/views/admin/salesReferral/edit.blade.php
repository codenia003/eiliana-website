@extends('admin/layouts/default')

@section('title')
Sales Referral
@parent
@stop
@section('content')
  @include('common.errors')
    <section class="content-header">
     <h1>Sales Referral Edit</h1>
     <ol class="breadcrumb">
         <li>
             <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                 Dashboard
             </a>
         </li>
         <li>Sales Referral</li>
         <li class="active">Edit Sales Referral </li>
     </ol>
    </section>
    <section class="content">
    <div class="container">
      <div class="row">
             <div class="col-12">
              <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Edit  Sales Referral
                        </h4></div>
                    <br />
                <div class="card-body">
                {!! Form::model($sales_referral, ['route' => ['admin.sales-referral-assign-to-client', collect($sales_referral)->first() ], 'method' => 'post']) !!}

                @include('admin.salesReferral.fields')

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

    function salesReferralAssignToClient(sales_referral_id,company_name,contact_person,email,mobile_no,dob,city,country,lead_status){
        $('.spinner-border').removeClass("d-none");
        var url = '/admin/salesReferral/sales-referral-assign-to-client';
        var data= {
            _token: "{{ csrf_token() }}",
            sales_referral_id: sales_referral_id,
            company_name: company_name,
            contact_person: contact_person,
            email: email,
            mobile_no: mobile_no,
            dob: dob,
            city: city,
            country: country,
            lead_status: lead_status
        };
        console.log(data);
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(data) {
                var userCheck = data;
                console.log(userCheck);
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
