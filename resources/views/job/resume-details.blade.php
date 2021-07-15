@extends('layouts/default')

{{-- Page title --}}
@section('title')
Resume Preview :
@if(isset($user->full_name))
    {{ $user->full_name }}
@endif
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
                <span class="h5 text-white ml-2">
                    Resume Preview :
                    @if(isset($user->full_name))
                        {{ $user->full_name }}
                    @endif
                    </span>
            </div>
        </div>
    </div>
    <div class="container space-1 space-top-lg-0 mt-lg-n10">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-5">

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
                                    {{-- <a href="#"> --}}
                                        @if(Sentinel::getUser()->pic)
                                        <img src="{{ url('/') }}{{ Sentinel::getUser()->pic }}" alt="..." class="img-fluid"/>
                                        @else
                                        <img src="{{ asset('assets/img/profile/mobile-profile.png') }}" alt="..." class="img-fluid"/>
                                        @endif
                                    {{-- </a> --}}
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="contract-body">
                                    <div class="mb-2">
                                        <p class="h3">
                                            @if(isset($user->full_name))
                                            {{ $user->full_name }}
                                            @endif
                                        </p>
                                        <p class="key_skills">
                                            @if(isset($proexps->key_skills))
                                                {{ $proexps->key_skills }}
                                            @endif
                                            @if(isset($proexps->profile_headline))
                                                {{ $proexps->profile_headline }}
                                            @endif
                                        </p>
                                        <p class="user_exper">User Experience </p>
                                        <p class="experience_year">
                                            @if(isset($proexps->experience_year))
                                                {{ $proexps->experience_year }}
                                            @endif
                                            Years
                                            @if(isset($proexps->experience_month))
                                                {{ $proexps->experience_month }}
                                            @endif Month
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="contract-apply text-center">
                                    <ul class="list-inline mb-0">


                                    </ul>
                                </div>
                            </div>
                            <!-- <div class="pricing-model col-md-9">
                                <div class="a p-1">
                                    <span class="b">Pricing Model: </span>
                                    <span>Hourly | Retainership | Project Based</span>
                                </div>
                            </div> -->
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
                                            <span class="ml-3">
                                                @if(isset($proexps->support_project))
                                                    {{ $proexps->support_project }}
                                                @endif
                                            </span>
                                        </li>
                                        <li>
                                            <span>Development Project</span>
                                            <span class="ml-3">
                                                @if(isset($proexps->development_project))
                                                    {{ $proexps->development_project }}
                                                @endif
                                            </span>
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
                                                                <td>:
                                                                    @if(isset($project->project_name))
                                                                    {{ $project->project_name }}
                                                                @endif </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="heading">Project Type</td>
                                                                <td>:
                                                                @if(isset($project->projecttypes->name))
                                                                    {{ $project->projecttypes->name }}
                                                                @endif
                                                                 </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="heading">Technology</td>
                                                                <td>:
                                                                    @if(isset($project->technologuname->technology_name))
                                                                    {{ $project->technologuname->technology_name }}
                                                                @endif
                                                                 </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td class="heading">Duration<small>(Month)</small></td>
                                                                <td>:  {{ $project->duration }}</td>
                                                            </tr>
                                                            
                                                            {{--<tr>
                                                                <td class="heading">Framework</td>
                                                                <td>:
                                                                    @if(isset($project->frameworkname->technology_name))
                                                                    {{ $project->frameworkname->technology_name }}
                                                                @endif
                                                                  </td>
                                                            </tr>--}}
                                                            
                                                            <tr>
                                                                <td class="heading">Customer Industry</td>
                                                                <td>:
                                                                    @if(isset($project->customerindustry->name))
                                                                    {{ $project->customerindustry->name }}
                                                                @endif
                                                                 </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                @if(isset($project->upload_file))
                                                    @if($project->upload_file)
                                                <img src=" @if(isset($project->upload_file))
                                                                    {{ $project->upload_file }}
                                                                @endif " alt="img" class="img-fluid"/>
                                                    @else
                                                    <img src="{{ asset('images/authors/no_avatar.jpg') }}" alt="..." class="img-fluid"/>
                                                    @endif
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
                                        <div class="edu_name">
                                            @if(isset($education->university->name))
                                                {{ $education->university->name }}
                                            @endif
                                                </div>
                                        <div class="quli_name">
                                        @if(isset($education->qualification->name))
                                                {{ $education->qualification->name }}
                                        @endif
                                        </div>
                                        <div class="from_to">
                                        @if(isset($education->month))
                                                {{ $education->month }}
                                        @endif
                                         - @if(isset($education->year))
                                                {{ $education->year }}
                                        @endif</div>
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
                                            <div class="edu_name">
                                                @if(isset($education->university->name))
                                                    {{ $education->university->name }}
                                                @endif
                                                </div>
                                            <div class="quli_name">
                                                @if(isset($education->qualification->name))
                                                    {{ $education->qualification->name }}
                                                @endif
                                                </div>
                                            <div class="from_to">
                                                @if(isset($education->month))
                                                    {{ $education->month }}
                                                @endif

                                               - @if(isset($education->year))
                                                    {{ $education->year }}
                                                @endif</div>
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
                                            <div class="edu_name">
                                                @if(isset($certificate->name))
                                                    {{ $certificate->name }}
                                                @endif
                                            </div>
                                            <div class="quli_name">
                                                @if(isset($certificate->institutename))
                                                    {{ $certificate->institutename }}
                                                @endif
                                            </div>
                                            <div class="from_to">
                                                 @if(isset($certificate->from_date))
                                                    {{ $certificate->from_date }}
                                                @endif
                                                - @if(isset($certificate->till_date))
                                                    {{$certificate->till_date }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right mt-5 singup-body">
                        <div class="btn-group" role="group">
                            <a href="{{ route('welcome') }}"  class="btn btn-primary">
                                Submit >>>
                            </a>
                            <!-- <button class="btn btn-outline-primary" type="reset">Discard</button> -->
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
                $('#subject').val('');
                $('#message-text').val('');
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
});
</script>
<x-chat-message/>
<!--global js end-->
@stop
