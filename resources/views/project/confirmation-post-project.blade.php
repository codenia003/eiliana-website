@extends('layouts/default')

{{-- Page title --}}
@section('title')
Post Project
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<!--end of page level css-->
<style>
.md-form .card-body {
    position: relative;
    padding: 5px 20px;
}
.md-form .card-body input.form-control {
    border: none;
}
.form-control:focus {
    box-shadow: none;
}
.browse-project h4 {
    font-size: 18px;
}
</style>
@stop

{{-- content --}}
@section('content')
<div class="bg-light browse-project">
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fa fa-bars"></i></span>
                <span class="h5 text-white ml-2">Post Project</span>
            </div>
        </div>
    </div>
    <div class="container space-top-1 space-top-md-2 space-bottom-2 space-bottom-lg-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3 mb-lg-5">
                    <div class="card-header">
                        <span class="h5 card-title text-secondary">{{ Session::get('post_project_data')['project_title'] }}</span>
                    </div>
                    <!-- <div class="card-body mb-3 mb-lg-5 p-4 text-center d-block" *ngIf="loading">
                        <div class="spinner-border spinner-border-lg"></div>
                    </div> -->
                    <div class="card-body">
                        <form action="{{ url('/post-project-on') }}" method="POST" id="postJobForm">
                            @csrf
                            @isset(Session::get('sales_referral')['referral_id'])
                            <input type="hidden" name="referral_id" value="{{ Session::get('sales_referral')['referral_id'] }}">
                            @endisset
                            @empty(Session::get('sales_referral')['referral_id'])
                            <input type="hidden" name="referral_id" value="0">
                            @endempty

            
                            <input type="hidden" name="project_title" value="{{ Session::get('post_project_data')['project_title'] }}">
                            <input type="hidden" name="key_skills" value="{{ Session::get('post_project_data')['key_skills'] }}">
                            <input type="hidden" name="project_summary" value="{{ Session::get('post_project_data')['project_summary'] }}">
                            <input type="hidden" name="technologty_pre" value="{{ json_decode(Session::get('post_project_data')['technologty_pre'],TRUE)}}">
                            <input type="hidden" name="customer_industry" value="{{ Session::get('post_project_data')['customer_industry'] }}">
                            <input type="hidden" name="experience_year" value="{{ Session::get('post_project_data')['experience_year'] }}">
                            <input type="hidden" name="experience_month" value="{{ Session::get('post_project_data')['experience_month'] }}">
                            <input type="hidden" name="amount" value="{{ Session::get('post_project_data')['amount'] }}">
                            <input type="hidden" name="amount_to" value="{{ Session::get('post_project_data')['amount_to'] }}">
                            <input type="hidden" name="model_engagement" value="{{ Session::get('post_project_data')['model_engagement'] }}">
                            <input type="hidden" name="type_of_project" value="{{ Session::get('post_project_data')['type_of_project'] }}">
                            <input type="hidden" name="project_duration_min" value="{{ Session::get('post_project_data')['project_duration_min'] }}">
                            <input type="hidden" name="project_duration_max" value="{{ Session::get('post_project_data')['project_duration_max'] }}">
                            <input type="hidden" name="project_category" value="{{ Session::get('post_project_data')['project_category'] }}">
                            <input type="hidden" name="project_sub_category" value="{{ Session::get('post_project_data')['project_sub_category'] }}">
                            <input type="hidden" name="currency_id" value="{{ Session::get('post_project_data')['currency_id'] }}">

                            {{--<h5>{{ Session::get('post_job_data')['job_title'] }}</h5>--}}
                            <div class="skills mt-4">
                                <span class="h5">Project Description</span>
                                <p>{{ Session::get('post_project_data')['project_summary'] }}</p>
                            </div>
                            
                            <div class="skills mt-4">
                                <span class="h5">Project Duration</span>
                                <p>{{ Session::get('post_project_data')['project_duration_min'] }} to {{ Session::get('post_project_data')['project_duration_max'] }}</p>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Total Experience</span>
                                <p>{{ Session::get('post_project_data')['experience_year'] }} Years {{ Session::get('post_project_data')['experience_month'] }} Month</p>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Skills</span>
                                <p>{{ Session::get('post_project_data')['key_skills'] }}</p>
                            </div>
                            <div class="skills mt-4">
                                <span class="h5">Pricing Model</span>
                              @if(Session::get('post_project_data')['model_engagement']=='1')
                                <p> Hourly :</p>
                                <span>Rate Per Hour</span>
                                <p>{{ Session::get('post_project_data')['amount'] }} to {{ Session::get('post_project_data')['amount_to'] }}</p>
                              @elseif(Session::get('post_project_data')['model_engagement']=='2')  
                                <p>Retainership :</p>
                                <span>Rate Per Month</span>
                                <p>{{ Session::get('post_project_data')['amount'] }} to {{ Session::get('post_project_data')['amount_to'] }}</p>
                              @else
                                <p>Project Based :</p>
                                <span>Total Project Amount</span>
                                <p>{{ Session::get('post_project_data')['amount'] }} to {{ Session::get('post_project_data')['amount_to'] }}</p>
                              @endif
                            </div>
                            <div class="skills mt-4">
                               <span class="h5">Type of Project :</span>
                              @if(Session::get('post_project_data')['type_of_project']=='1')
                                <span>Maintenance</span>
                              @elseif(Session::get('post_project_data')['type_of_project']=='2')  
                                <span>New Development</span>
                              @else
                                <span>Maintenance Cum New Development</span>
                              @endif
                            </div>
                            <hr>
                            <h3>Additional Information</h3>
                            <div class="skills mt-4">

                                <span class="h5">Project Category: </span>
                                @foreach ($projectcategorys as $category)
                                    @if(Session::get('post_project_data')['project_category']== $category->id)
                                    <span>{{ $category->name }}</span>
                                    @endif
                                @endforeach
                                <br>

                                <span class="h5">Project Sub Category: </span>
                                @foreach ($subprojectcategorys as $subcategory)
                                    @if(Session::get('post_project_data')['project_sub_category']== $subcategory->id)
                                    <span>{{ $subcategory->name }}</span>
                                    @endif
                                @endforeach
                                <br>

                                <span class="h5">Customer Industry: </span>
                                @foreach ($customerindustries as $industry)
                                    @if(Session::get('post_project_data')['customer_industry']== $industry->customer_industry_id)
                                    <span>{{ $industry->name }}</span>
                                    @endif
                                @endforeach
                                <br>

                                <span class="h5">Technology Preference: </span>
                                <?php
                                    $technologty_pre = (array) Session::get('post_project_data')['technologty_pre'];
                                ?>
                                @foreach ($technologies as $technology)
                                    @if(in_array($technology->technology_id, $technologty_pre))
                                    <span>{{ $technology->technology_name }}</span>,
                                    @endif
                                @endforeach
                                
                            </div>
                            <!-- <div class="skills mt-4">
                                <ul class="nav mt-4">
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-light text-dark" href="#">Sales</a>
                                    </li>
                                    <li class="nav-item ml-1">
                                        <a class="nav-link btn btn-light text-dark" href="#">Internet</a>
                                    </li>
                                    <li class="nav-item ml-1">
                                        <a class="nav-link btn btn-light text-dark" href="#">Marketing</a>
                                    </li>
                                </ul>
                            </div> -->
                            <div class="form-group text-right mt-5">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-primary" type="submit">
                                        Publish Online
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')

<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/frontend/login_custom.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script>
$('#projectlead').bootstrapValidator({
    fields: {
        subject: {
            validators: {
                notEmpty: {
                    message: 'The subject is required',
                },
            },
        },
        messagetext: {
            validators: {
                notEmpty: {
                    message: 'The message is required',
                },
            },
        },
    },
}).on('success.form.bv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    var bv = $form.data('bootstrapValidator');
    $('.spinner-border').removeClass("d-none");
    $.post($form.attr('action'), $form.serialize(), function(result) {
        var userCheck = result;
        if (userCheck.success == '1') {
            $('#modal-4').modal('toggle');
            $('#subject').val('');
            $('#message-text').val('');
            $('.spinner-border').addClass("d-none");
            Swal.fire({
              type: 'success',
              title: 'Success...',
              text: userCheck.msg,
              showConfirmButton: false,
              timer: 2000
            });
        } else {
            $('#modal-4').modal('toggle');
            $('#subject').val('');
            $('#message-text').val('');
            $('.spinner-border').addClass("d-none");
            Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: userCheck.errors,
              showConfirmButton: false,
              timer: 2000
            });
        }
    }, 'json');
});</script>

<!--global js end-->
@stop
