@extends('layouts/default')

{{-- Page title --}}
@section('title')
Job Post
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
                <span class="h5 text-white ml-2">{{ $user->full_name }}</span>
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
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#" role="tab"
                                        aria-controls="home" aria-selected="true">My Projects</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="team-tab" data-toggle="tab" href="#" role="tab"
                                        aria-controls="team" aria-selected="false">Create Team</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="saved-tab" data-toggle="tab" href="#" role="tab"
                                        aria-controls="saved" aria-selected="false">Saved Search</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="modify-tab" data-toggle="tab" href="#" role="tab"
                                        aria-controls="modify" aria-selected="false">Modify Search</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="live-tab" data-toggle="tab" href="#" role="tab"
                                        aria-controls="live" aria-selected="false">Live Chat</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
                <div id="notific">
                    @include('notifications')
                </div>
                <div class="profile-information">
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
                                        <p class="user_exper">User Experience | User Experience</p>
                                        <p class="experience_year">{{ $proexps->experience_year }} Years {{ $proexps->experience_month }} Month</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="contract-apply text-center">
                                    <ul class="list-inline mb-0">
                                        @if ($response['leadcheck'] === '0')
                                            <li class="list-inline-item">
                                                <a class="btn-icon" data-toggle="modal" data-target="#modal-4"><img class="img-fluid" src="/assets/img/icons/icon-5.png" alt="Avatar"></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="btn-icon" data-toggle="modal" data-target="#modal-4"><i class="far fa-comment"></i></a>
                                            </li>
                                        @else
                                            <li class="list-inline-item">
                                                <a class="start_chat btn-icon" data-touserid="{{ $user->id }}" data-tousername="{{ $user->full_name }}" data-chattype="4" title="Live Chat!"><img class="img-fluid" src="/assets/img/icons/icon-5.png" alt="Avatar"></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="start_chat btn-icon" data-touserid="{{ $user->id }}" data-tousername="{{ $user->full_name }}" data-chattype="4" title="Live Chat!"><i class="far fa-comment"></i></a>
                                            </li>
                                        @endif

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
                            <h3 class="card-title mt-4">Certifications</h5>
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
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div id="sidebarNav" class="navbar-collapse navbar-vertical " style="">
                    <div class="position-relative max-w-50rem mx-auto mobile-profile">
                        <!-- Device Mockup -->
                        <div class="device device-iphone-x w-100 mx-auto">
                            <img class="device-iphone-x-frame" src="/assets/img/profile/mobile-bg.png" alt="Image Description">
                            <div class="device-iphone-x-screen">
                                <div class="top-mobile bg-blue bg-img-hero" style="background-image: url(/assets/img/profile/mobile-profile.png);">
                                    <div class="row">
                                        <div class="col-4"></div>
                                        <div class="col-8">
                                            <div class="img-upload">
                                                <img class="image-preview avatar-img" src="/assets/img/profile/m-photo-icon.png" class="avatar" alt="Avatar">
                                                <span>Upload Photo</span>
                                            </div>
                                            <button class="btn">{{ Sentinel::getUser()->full_name }}</button>
                                            <p class="card-text font-size-1">
                                                @isset(Sentinel::getUser()->city)
                                                {{ Sentinel::getUser()->city }},
                                                @endisset
                                                {{ Session::get('users')['country_name'] }}
                                                <br>
                                                {{ \Carbon\Carbon::parse(Sentinel::getUser()->created_at)->format('M d, Y')}}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="bottom-menu">
                                    <div class="list-group">
                                        <a class="list-group-item list-group-item-action bg-white-b {!! (Request::is('profile') ? 'active' : '' ) !!}" href="/profile">
                                            <!-- <i class="fas fa-info-circle"></i> -->
                                            <img class="img-fluid" src="/assets/img/profile/icon-1.png" alt="Avatar">
                                            <span>Primary Information</span>
                                        </a>
                                        <a class="list-group-item list-group-item-action bg-blue {!! (Request::is('profile/education') ? 'active' : '' ) !!}" href="/profile/education">
                                            <img class="img-fluid" src="/assets/img/profile/icon-2.png" alt="Avatar">
                                            <span> Education</span>
                                        </a>
                                        <a class="list-group-item list-group-item-action bg-white-b {!! (Request::is('profile/certification') ? 'active' : '' ) !!}" href="/profile/certification">
                                            <img class="img-fluid" src="/assets/img/profile/icon-3.png" alt="Avatar">
                                            <span> Certification</span>
                                        </a>
                                        <a class="list-group-item list-group-item-action bg-blue {!! (Request::is('profile/professional-experience') ? 'active' : '' ) !!}" href="/profile/professional-experience">
                                            <img class="img-fluid" src="/assets/img/profile/icon-4.png" alt="Avatar">
                                            <span> Professional Experience</span>
                                        </a>
                                        <a class="list-group-item list-group-item-action bg-white-b" href="/profile">
                                            <img class="img-fluid" src="/assets/img/profile/icon-5.png" alt="Avatar">
                                            <span> Company Settings</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Device Mockup -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade pullDown login-body border-0" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('/post-staffing-lead') }}" method="POST" id="staffingflead">
                    @csrf
                    <div class="modal-header bg-blue text-white">
                        <h4 class="modal-title" id="modalLabelnews">Contact Freelancer</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="from-name" class="col-form-label">From:</label>
                                <input type="text" class="form-control" id="from-name" name="fromname" value="{{ Sentinel::getUser()->full_name }} " readonly>
                            </div>
                            <div class="form-group col">
                                <label for="to-name" class="col-form-label">To:</label>
                                <input type="text" class="form-control" id="to-name" name="toname" value="{{ $user->full_name }}" readonly>
                                <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                                <input type="hidden" name="toemail" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lead-id" class="col-form-label">Lead Id:</label>
                            <input type="text" class="form-control" id="lead-id" name="leadid" value="{{ $staffingleadsid }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="col-form-label">Subject:</label>
                            <input type="text" class="form-control" name="subject" id="subject">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text" name="messagetext" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer singup-body">
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Send</button>
                            <button class="btn btn-outline-primary" data-dismiss="modal">Discard</button>
                        </div>
                    </div>
                </form>
            </div>
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

    $('#staffingflead').bootstrapValidator({
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
    });
});
</script>
<x-chat-message/>
<!--global js end-->
@stop
