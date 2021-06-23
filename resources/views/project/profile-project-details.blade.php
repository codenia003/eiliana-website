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
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 pr-lg-0">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-5">
                        <div class="bs-advanced">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @if ($joblead->lead_status == '1')
                                    <li class="nav-item beforeaccept">
                                        <a class="nav-link" onclick="jobleadConvert('{{ $joblead->project_leads_id }}','2')">Accept Proposal</a>
                                    </li>
                                    <li class="nav-item beforeaccept">
                                        <a class="nav-link" onclick="jobleadConvert('{{ $joblead->project_leads_id }}','4')">Reject Proposal</a>
                                    </li>
                                    <li class="nav-item beforeaccept">
                                        <a class="nav-link" onclick="jobleadConvert('{{ $joblead->project_leads_id }}','5')">On Hold</a>
                                    </li>
                                    <li class="nav-item beforeaccept">
                                        <a class="nav-link" onclick="jobleadConvert('{{ $joblead->project_leads_id }}','6')">Revise Proposal</a>
                                    </li>
                                @endif
                                <li class="nav-item afteraccept d-none">
                                    <a class="nav-link" data-toggle="modal" data-target="#modal-5">Assign Other Project</a>
                                </li>
                                <li class="nav-item afteraccept d-none">
                                    <a class="nav-link start_chat btn-icon" data-touserid="{{ $user->id }}" data-tousername="{{ $user->full_name }}" data-chattype="4" title="Live Chat!">Live Chat</a>
                                </li>
                                <li class="nav-item afteraccept d-none">
                                    <a class="nav-link" data-toggle="modal" data-target="#modal-4">Contact Info</a>
                                </li>
                                <li class="nav-item">
                                    <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-lg-0">
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
                                <div class="contract-body">
                                    <div class="mb-2">
                                        <p class="h3">{{ $user->full_name }}</p>
                                        <p class="key_skills">{{ $proexps->key_skills }}{{ $proexps->profile_headline }}</p>
                                        <p class="user_exper">User Experience </p>
                                        <p class="experience_year">{{ $proexps->experience_year }} Years {{ $proexps->experience_month }} Month</p>
                                    </div>
                                </div>
                               {{--<div class="mb-2">
                                    <p class="h3">{{ $user->full_name }}</p>
                                    <p class="key_skills">{{ $proexps->key_skills }}{{ $proexps->profile_headline }}</p>
                                    <p class="user_exper">User Experience | User Experience</p>
                                    <p class="experience_year">{{ $proexps->experience_year }} Years {{ $proexps->experience_month }} Month</p>
                                </div>--}}
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
                    <div class="card p-3 mb-4 pb-4">
                        <div class="card-header">
                            <h5 class="card-title">Proposal Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="card-education">
                                <div class="project-date">
                                    <table class="table table-borderless">
                                        <tbody class="info-train">
                                            <tr>
                                            @if($joblead->projectdetail->projectAmount->pricing_model == '1')
                                              @if($joblead->referral_id != '0') 
                                                 <td class="heading">Price Per Hour<small>({{ $joblead->projectdetail->projectCurrency->symbol }})</small></td>
                                                 <td>: {{ $joblead->total_proposal_value }}</td>
                                              @else
                                                 <td class="heading">Price Per Hour<small>({{ $joblead->projectdetail->projectCurrency->symbol }})</small></td>
                                                 <td>: {{ $joblead->bid_amount }}</td>
                                              @endif
                                            @elseif ($joblead->projectdetail->projectAmount->pricing_model == '2')
                                              @if($joblead->referral_id != '0') 
                                                <td class="heading">Price Per Month<small>({{ $joblead->projectdetail->projectCurrency->symbol }})</small></td>
                                                <td>: {{ $joblead->total_proposal_value }}</td>
                                              @else
                                                <td class="heading">Price Per Month<small>({{ $joblead->projectdetail->projectCurrency->symbol }})</small></td>
                                                <td>: {{ $joblead->bid_amount }}</td>
                                              @endif
                                            @else
                                              @if($joblead->referral_id != '0') 
                                                <td class="heading">Price Per Project Amount<small>({{ $joblead->projectdetail->projectCurrency->symbol }})</small></td>
                                                <td>: {{ $joblead->total_proposal_value }}</td>
                                              @else
                                                <td class="heading">Price Per Project Amount<small>({{ $joblead->projectdetail->projectCurrency->symbol }})</small></td>
                                                <td>: {{ $joblead->bid_amount }}</td>
                                              @endif
                                            @endif
                                            </tr>

                                            {{--@if($joblead->referral_id != '0') 
                                                <tr>
                                                    <td class="heading">Sales Commission Amount<small>(%)</small></td>
                                                    <td>: {{ $joblead->sales_comm_amount }}</td>
                                                </tr>
                                            @endif--}}

                                            <tr>
                                                <td class="heading">Delivery Timeline<small>(Days)</small></td>
                                                <td>: {{ $joblead->delivery_timeline }}</td>
                                            </tr>
                                            <tr>
                                                <td class="heading">Technology</td>
                                                <td>:  
                                                    @foreach ($technologies as $technology)
                                                        {{ $loop->first ? '' : ', ' }}
                                                        {{ $technology->technology_name }}
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="heading">Subject</td>
                                                <td>:  {{ $joblead->subject }}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="heading">Message</td>
                                                <td>:  {{ $joblead->message }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                            <span class="ml-3">{{ $proexps->support_project }}</span>
                                        </li>
                                        <li>
                                            <span>Development Project</span>
                                            <span class="ml-3">{{ $proexps->development_project }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="project-slid slider">
                                    @foreach ($projects as $project)
                                    <div class="slide">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <div class="project-date">
                                                    <table class="table table-borderless">
                                                        <tbody class="info-train">
                                                            <tr>
                                                                <td class="heading">Project Name</td>
                                                                <td>: {{ $project->project_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="heading">Project Type</td>
                                                                <td>: {{ $project->projecttypes->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="heading">Technology</td>
                                                                <td>:  {{ $project->technologuname->technology_name }}</td>
                                                            </tr>
                                                            </tr>
                                                            <tr>
                                                                <td class="heading">Duration</td>
                                                                <td>:  {{ $project->duration }}</td>
                                                            </tr>
                                                            </tr>
                                                            <tr>
                                                                <td class="heading">Framework</td>
                                                                <td>:  {{ $project->frameworkname->technology_name }}</td>
                                                            </tr>
                                                            </tr>
                                                            <tr>
                                                                <td class="heading">Customer Industry</td>
                                                                <td>:  {{ $project->industry }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                @if($project->upload_file)
                                                <img src="{{ $project->upload_file }}" alt="img" class="img-fluid"/>
                                                @else
                                                <img src="{{ asset('images/authors/no_avatar.jpg') }}" alt="..." class="img-fluid"/>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
                                @foreach ($ug_educations as $education)
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <img src="{{ asset('assets/img/education.png') }}" alt="..." class="img-fluid"/>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="edu_name">{{ $education->university->name }}</div>
                                        <div class="quli_name">{{ $education->qualification->name }}</div>
                                        <div class="from_to">{{ $education->month }} - {{ $education->year }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="card-education">
                                <span class="h4 text-left mt-3 mb-4 d-inline-block">Post Graduate Qualification</span>
                                @foreach ($pg_educations as $education)
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/img/education.png') }}" alt="..." class="img-fluid"/>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="edu_name">{{ $education->university->name }}</div>
                                            <div class="quli_name">{{ $education->qualification->name }}</div>
                                            <div class="from_to">{{ $education->month }} - {{ $education->year }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <h4 class="card-title mt-4">Certifications</h4>
                            <hr>
                            <div class="card-education">
                                @foreach ($certificates as $certificate)
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/img/education.png') }}" alt="..." class="img-fluid"/>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="edu_name">{{ $certificate->name }}</div>
                                            <div class="quli_name">{{ $certificate->institutename }}</div>
                                            <div class="from_to">{{ $certificate->from_date }} - {{ $certificate->till_date }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-blue text-white">
                            <h4 class="modal-title" id="modalLabelnews">Contact Info</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="contact-info">
                                <div class="a p-1">
                                    <span class="b">Email: </span>
                                    <span><b>{{ $user->email }}</b></span>
                                </div>
                                <div class="a p-1">
                                    <span class="b">Mobile Number: </span>
                                    <span><b>{{ $user->mobile }}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade pullDown login-body border-0" id="modal-5" role="dialog" aria-labelledby="modalLabelnews">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-blue text-white">
                            <h4 class="modal-title" id="modalLabelnews">Assign Other Projects</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <form action="{{ route('assignProject') }}" method="POST" id="projectAssign">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="from_user_id" value="{{ $joblead->from_user_id }}">
                                <div class="form-group">
                                    <label>Projects</label>
                                    <select name="project_id" class="form-control" required>
                                        @foreach ($other_projects as $project)
                                        <option value="{{ $project->project_id }}">{{ $project->project_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer singup-body">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-primary"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Assign</button>
                                    <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
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
acceptshow({{ $joblead->lead_status }});
function acceptshow(lead_status){
    if(lead_status === 1) {
        $('.afteraccept').addClass("d-none");
    } else {
        $('.beforeaccept').addClass("d-none");
        $('.afteraccept').removeClass("d-none");
    }
}
function jobleadConvert(lead_id,lead_status){
    //alert(lead_id);
    $('.spinner-border').removeClass("d-none");
    var url = '/project/project-lead-convert';
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
                var msg = userCheck.msg;
                var redirect = '/project/profile-projectbid/'+ lead_id;
            } else {
                var msg = userCheck.errors;
                var redirect = '/project/profile-projectbid/'+ lead_id;
            }
            $('.beforeaccept').addClass("d-none");
            $('.afteraccept').removeClass("d-none");

            toggleRegPopup(msg,redirect);
        },
        error: function(xhr, status, error) {
            console.log("error: ",error);
        },
    });
}
$('#projectAssign').bootstrapValidator({
}).on('success.form.bv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    var bv = $form.data('bootstrapValidator');
    $('.spinner-border').removeClass("d-none");
    $.post($form.attr('action'), $form.serialize(), function(result) {
        var userCheck = result;
        if (userCheck.success == '1') {
            $('#modal-5').modal('toggle');
            $('.spinner-border').addClass("d-none");
            var msg = userCheck.msg;
            var redirect = '#';
            // Swal.fire({
            //   type: 'success',
            //   title: 'Success...',
            //   text: userCheck.msg,
            //   showConfirmButton: false,
            //   timer: 2000
            // });
        } else {
            $('#modal-4').modal('toggle');
            $('.spinner-border').addClass("d-none");
            var msg = userCheck.errors;
            var redirect = '#';
            // Swal.fire({
            //   type: 'error',
            //   title: 'Oops...',
            //   text: userCheck.errors,
            //   showConfirmButton: false,
            //   timer: 2000
            // });
        }
        toggleRegPopup(msg,redirect);
    }, 'json');
});
</script>
<x-chat-message/>
<!--global js end-->
@stop
