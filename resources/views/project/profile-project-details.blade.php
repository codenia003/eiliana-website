@extends('layouts/default')

{{-- Page title --}}
@section('title')
Project Post
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick-carousel/slick.css') }}">
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<!--end of page level css-->
<style>
    .eiliana-btn {
        height: 47px;
    }
</style>
@stop

{{-- content --}}
@section('content')
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fa fa-bars"></i></span>
                <span class="h5 text-white ml-2"></span>
            </div>
        </div>
    </div>
    <div class="container space-1 space-top-lg-0 mt-lg-n10">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-5">
                        <div class="bs-advanced">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" onclick="jobleadConvert('{{ $joblead->project_leads_id }}','2')">Accept</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="jobleadConvert('{{ $joblead->project_leads_id }}','4')">Reject</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="jobleadConvert('{{ $joblead->project_leads_id }}','5')">On Hold</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Assign Other Project</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link start_chat btn-icon" data-touserid="{{ $user->id }}" data-tousername="{{ $user->full_name }}" data-chattype="4" title="Live Chat!">Live Chat</a>
                                </li>
                                <li class="nav-item">
                                    <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
                <div id="notific">
                    @include('notifications')
                </div>
                <div class="profile-information">
                    {{-- <div class="stafflead-basic mb-4">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        <button type="button" class="btn btn-md btn-info bg-light-blue" onclick="jobleadConvert('{{ $joblead->project_leads_id }}','2')">Accept</button>
                        <button type="button" class="btn btn-md btn-info bg-light-blue" onclick="jobleadConvert('{{ $joblead->project_leads_id }}','4')">Reject</button>
                        <button type="button" class="btn btn-md btn-info bg-light-blue" onclick="jobleadConvert('{{ $joblead->project_leads_id }}','5')">On Hold</button>
                    </div> --}}
                    <div class="card p-3 mb-4 pb-4">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="contract-profile mb-1">
                                    <a href="#">
                                        <img src="{{ asset('images/authors/no_avatar.jpg') }}" alt="..." class="img-fluid"/>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                               <div class="mb-2">
                                        <p class="h3">{{ $user->full_name }}</p>
                                        <p class="key_skills">{{ $proexps->key_skills }}{{ $proexps->profile_headline }}</p>
                                        <p class="user_exper">User Experience | User Experience</p>
                                        <p class="experience_year">{{ $proexps->experience_year }} Years {{ $proexps->experience_month }} Month</p>
                                    </div>
                            </div>
                            <div class="col-md-2">
                                <div class="contract-apply text-center">
                                    <ul class="list-inline mb-0">
                                        {{-- <li class="list-inline-item">
                                            <a class="btn-icon" data-toggle="modal" data-target="#modal-4"><img class="img-fluid" src="/assets/img/icons/icon-5.png" alt="Avatar"></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a class="btn-icon" data-toggle="modal" data-target="#modal-4"><i class="far fa-comment"></i></a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="pricing-model col-md-9">
                                <div class="a p-1">
                                    <span class="b">Pricing Model: </span>
                                    <span>Hourly | Retainership | Project Based</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-3 my-5 pb-4">
                        <div class="card-header">
                            <h5 class="card-title">Projects</h5>
                        </div>
                        <div class="card-body">
                            <div class="project">
                                <div class="project-count">
                                    <ul>
                                        <li>
                                            <span>Support Project</span>
                                            <span class="ml-3"></span>
                                        </li>
                                        <li>
                                            <span>Development Project</span>
                                            <span class="ml-3"></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="project-slid slider">

                                 </div>
                            </div>
                        </div>

                    </div>
                    <div class="card p-3 mb-4 pb-4">
                        <div class="card-header">
                            <h5 class="card-title">Educations</h5>
                        </div>
                        <div class="card-body">
                            <div class="card-education">
                                <span class="h4 text-left mt-3 mb-4 d-inline-block">Under Graduate Qualification</span>

                            </div>
                            <div class="card-education">
                                <span class="h4 text-left mt-3 mb-4 d-inline-block">Post Graduate Qualification</span>

                            </div>
                            <h3 class="card-title mt-4">Certifications</h5>
                            <hr>

                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.left')
        </div>
    </div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/slick-carousel/slick.min.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $('.project-slid').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        nextArrow: "<span class=\"fa fa-angle-right slick-arrow slick-arrow-soft-white slick-arrow-right slick-arrow-centered-y rounded-circle mr-sm-2 mr-xl-4\"></span>",
        prevArrow: "<span class=\"fa fa-angle-left slick-arrow slick-arrow-soft-white slick-arrow-left slick-arrow-centered-y rounded-circle ml-sm-2 ml-xl-4\"></span>",
        autoplay: false,
        autoplaySpeed: 1500,
        arrows: true,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 1
            }
        }]
    });
});
function jobleadConvert(lead_id,lead_status){
    // alert(lead_id);
    $('.spinner-border').removeClass("d-none");
    var url = '/job/job-lead-convert';
    var data= {
        _token: "{{ csrf_token() }}",
        lead_id: lead_id,
        lead_status: lead_status
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
<x-chat-message/>
<!--global js end-->
@stop
