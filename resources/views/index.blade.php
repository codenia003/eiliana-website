@extends('layouts/default')

{{-- Page title --}}
@section('title')
Home
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick-carousel/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/index.css') }}">
<!--end of page level css-->
@stop

{{-- slider --}}
@section('top')
<!--Carousel Start -->
<section class="section1 d-none d-sm-block">
    <div class="slick-carousel">
      <div class="slide slider1">
        <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-1.png);">
            <div class="container space-2 space-lg-4">
              <div class="row">
                <div class="col-md-5">
                </div>
                <div class="col-md-7">
                  <div class="banner1_content">
                    <h1>Transforming lives <br>Through next <br>Generation <span class="text-orange">Resources</span> <br>And <span class="text-orange">Projects</span></h1>
                    <div class="group_button">
                      <a class="big_btn_shadow yellow-linear-gradient text-white" href="#">Find Projects</a>
                      <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#">Hire Talent</a>
                      {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="slide slider2">
          <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-2-1.png);">
            <div class="container space-2 space-lg-4">
                <div class="w-md-65 w-lg-35">
                    <div class="mb-4">
                        <div class="banner1_content">
                          <h1>Transforming lives <br>Through next <br>Generation <span class="text-orange">Resources</span> <br>And <span class="text-orange">Projects</span></h1>
                          <div class="group_button">
                            <a class="big_btn_shadow yellow-linear-gradient text-white" href="#">Find Projects</a>
                            <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#">Hire Talent</a>
                            {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="slide slider3">
          <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-3.png);">
            <div class="container space-2 space-lg-4">
              <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                  <div class="banner1_content">
                    <h1>Transforming lives <br>Through next <br>Generation <span class="text-orange">Resources</span> <br>And <span class="text-orange">Projects</span></h1>
                    <div class="group_button">
                      <a class="big_btn_shadow yellow-linear-gradient text-white" href="#">Find Projects</a>
                      <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#">Hire Talent</a>
                      {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="slide slider4">
          <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-4.png);">
            <div class="container space-2 space-lg-4">
                <div class="w-md-65 w-lg-35">
                    <div class="mb-4">
                        <div class="banner1_content">
                          <h1>Transforming lives <br>Through next <br>Generation <span class="text-orange">Resources</span> <br>And <span class="text-orange">Projects</span></h1>
                          <div class="group_button">
                            <a class="big_btn_shadow yellow-linear-gradient text-white" href="#">Find Projects</a>
                            <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#">Hire Talent</a>
                            {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="slide slider5">
        <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-5.png);">
            <div class="container space-2 space-lg-4">
              <div class="row">
                <div class="col-md-5">
                </div>
                <div class="col-md-7">
                  <div class="banner1_content">
                    <h1>Transforming lives <br>Through next <br>Generation <span class="text-orange">Resources</span> <br>And <span class="text-orange">Projects</span></h1>
                    <div class="group_button">
                      <a class="big_btn_shadow yellow-linear-gradient text-white" href="#">Find Projects</a>
                      <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#">Hire Talent</a>
                      {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="slide slider6">
          <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-6-1.png);">
            <div class="container space-2 space-lg-4">
                <div class="w-md-65 w-lg-35">
                    <div class="mb-4">
                        <div class="banner1_content">
                          <h1>Transforming lives <br>Through next <br>Generation <span class="text-orange">Resources</span> <br>And <span class="text-orange">Projects</span></h1>
                          <div class="group_button">
                            <a class="big_btn_shadow yellow-linear-gradient text-white" href="#">Find Projects</a>
                            <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#">Hire Talent</a>
                            {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section1 d-block d-sm-none">
    <div class="mobile-slick-carousel">
      <div class="slide slider1">
        <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-1.png);">
            <div class="container space-2 space-lg-4">
              <div class="row">
                <div class="col-md-5">
                </div>
                <div class="col-md-7">
                  <div class="banner1_content">
                    <h1>Transforming lives <br>Through next <br>Generation <span class="text-orange">Resources</span> <br>And <span class="text-orange">Projects</span></h1>
                    <div class="group_button">
                      <a class="big_btn_shadow yellow-linear-gradient text-white" href="#">Find Projects</a>
                      <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#">Hire Talent</a>
                      {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="slide slider3">
        <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-3.png);">
          <div class="container space-2 space-lg-4">
            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6">
                <div class="banner1_content">
                  <h1>Transforming lives <br>Through next <br>Generation <span class="text-orange">Resources</span> <br>And <span class="text-orange">Projects</span></h1>
                  <div class="group_button">
                    <a class="big_btn_shadow yellow-linear-gradient text-white" href="#">Find Projects</a>
                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#">Hire Talent</a>
                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
  </section>
<!-- //Carousel End -->
@stop

{{-- content --}}
@section('content')
<section class="section container">
    <div class="services mt-5 border">
      <div class="row">
        <div class="col-md-4 mb-7 mb-md-0">
            <!-- Contacts -->
            <div class="media accordion modified-accordion">
                <figure class="max-w-8rem mr-4 mt-4">
                    <img class="img-fluid" src="/assets/img/icons/serviceimg1.jpg" alt="SVG">
                </figure>
                <div class="media-body card-header1" id="headingOne">
                    <h4 class="mb-1 text-orange" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">In-Demand Skills</h4>
                    <p class="font-size-1 mb-0" id="collapseOne" class="collapse show" aria-labelledby="headingOne">From iOS Developers to Data Scientists, our ever-growing talent pool has the most trending skillset.</p>
                </div>
            </div>
            <!-- End Contacts -->
        </div>

        <div class="col-md-4 mb-7 mb-md-0">
            <!-- Contacts -->
            <div class="media accordion modified-accordion">
                <figure class="max-w-8rem mr-4 mt-4">
                    <img class="img-fluid" src="/assets/img/icons/serviceimg2.jpg" alt="SVG">
                </figure>
                <div class="media-body card-header1" id="headingTwo">
                    <h4 class="mb-1 text-orange" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Transparent Pay</h4>
                    <p class="font-size-1 mb-0" id="collapseTwo" class="collapse" aria-labelledby="headingTwo">As a client you will always know what you’re paying for, upfront. And as a talent you will always get your payments timely.</p>
                </div>
            </div>
            <!-- End Contacts -->
        </div>
        <div class="col-md-4 mb-7 mb-md-0">
            <!-- Contacts -->
            <div class="media accordion modified-accordion">
                <figure class="max-w-8rem mr-4 mt-4">
                    <img class="img-fluid" src="/assets/img/icons/serviceimg3.jpg" alt="SVG">
                </figure>
                <div class="media-body card-header1" id="headingThree">
                    <h4 class="mb-1 text-orange" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">24X7 Support</h4>
                    <p class="font-size-1 mb-0" id="collapseThree" class="collapse" aria-labelledby="headingThree">Got questions? Our round-the-clock support is always available to assist you, anytime anywhere.</p>
                </div>
            </div>
            <!-- End Contacts -->
        </div>

      </div>
    </div>
</section>
<section class="section my-2 new-page-bg bg-img-hero" style="background-image: url(/assets/img/photo/new_page-only.png);">
    <div class="container">
        <!-- <div class="text-center mb-5">
        <h1 class="headingmain1">Get Work Done In Over 2500 Categories</h1>
        <div class="dividerheading"></div>
        </div> -->
        <div class="explore-more">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                    <h1 class="headingmain1">Agility @Eiliana</h1>
                    <ul class="list-unstyled list-article">
                        <li>
                            <div class="d-flex">
                                <div class="media align-items-center align-items-sm-start mb-3">
                                    <img class="avatar avatar-sm mr-2 mt-1" src="/assets/img/photo/icon.png" alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span>Choose experienced Professionals from Global Talent Pool.</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <div class="media align-items-center align-items-sm-start mb-3">
                                    <img class="avatar avatar-sm mr-2 mt-1" src="/assets/img/photo/icon.png" alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span>Experienced Professionals availablity helps manage Business Risk on Pay Per Use Model.</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <div class="media align-items-center align-items-sm-start mb-3">
                                    <img class="avatar avatar-sm mr-2 mt-1" src="/assets/img/photo/icon.png" alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span>Managed Delivery Model at Eiliana facilitates smooth project Delivery.</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <div class="media align-items-center align-items-sm-start mb-3">
                                    <img class="avatar avatar-sm mr-2 mt-1" src="/assets/img/photo/icon.png" alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span>Access to Super Niche Skills improves project performance.</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-3 col-lg-3">
                </div>
                <div class="col-12 col-md-5 col-lg-5">
                    <div class="card1">
                        <div class="eiliana-agility">
                            <form action="#" method="GET" id="register_basic_form">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label>Key Skills</label>
                                        <input type="text" name="keyskills" placeholder="Chatbots, Machine learning, Deep learning, Computer vision, Cognitive Science" class="form-control" disabled/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Total Experience</label>
                                        <div class="form-row">
                                            <div class="col-6">
                                                <select class="form-control" required="" name="experience_year" disabled>
                                                    @for ($i = 4; $i < 21; $i++)
                                                    <option value="{{ $i }}">{{ $i }} Years</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <select class="form-control" required="" name="experience_month" disabled>
                                                    @for ($i = 5; $i < 13; $i++)
                                                    <option value="{{ $i }}">{{ $i }} Years</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Salary Range</label>
                                        <div class="form-row">
                                            <div class="col-6">
                                                <select class="form-control" required="" name="from_salary_range" disabled>
                                                    <option value="">10 Lacs</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <select class="form-control" required="" name="experience_month" disabled>
                                                    <option value="">20 Lacs</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <select name="technologty_pre" class="form-control" id="technologty_pre" disabled>
                                        <option value="">Delhi</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- <figure class="mt-4">
                        <img class="img-fluid" src="/assets/img/photo/new_page.png" alt="SVG">
                    </figure> --}}
                </div>
            </div>
        </div>
    </div>
  </section>
<section class="section container our-solution four-slider space-2">
    <div class="text-center">
        <h1 class="headingmain1">Crowd <span><img src="/assets/img/heart-icon.jpg"></span> Favourites</h1>
        <p class="subtitle1">Checkout some of the most popular services people pay for on Eiliana.</p>
        <div class="dividerheading"></div>
    </div>
  <div class="our-slotuion slider mb-3 mt-3">
    <div class="multiple-carousel">
        @foreach ($projectcategories as $item)
            <div class="slide">
                <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                    <figure class="max-w-10rem mx-auto mb-2">
                        <img class="img-fluid" src="/assets/img/icons/{{ $item->image }}" alt="png">
                    </figure>
                    <h3>{{ $item->name }}</h3>
                    @if ($loop->even)
                    <h6 class="yellow">{{ $item->heading }}</h6>
                    @else
                    <h6 class="red">{{ $item->heading }}</h6>
                    @endif
                    <p>{{ $item->descriptor }}</p>
                    @if ($loop->even)
                    <a href="{{ url('category') . '/' .$item->slug }}" class="btn btn-outline-primary bg-yellow yellow-linear-gradient btn-pill">Explore Now</a>
                    @else
                    <a href="{{ url('category') . '/' .$item->slug }}" class="btn btn-outline-primary bg-orange red-linear-gradient btn-pill">Explore Now</a>
                    @endif
                </div>
            </div>
        @endforeach

    </div>
  </div>
</section>

<section class="section container py-4 mt-1 contract-job d-none">
    <div class="text-center">
        <h1 class="headingmain1">Looking For A Project</h1>
        <p class="subtitle1">Tell us your preference and we’ll help you choose the right one.</p>
        <div class="dividerheading"></div>
    </div>
    <div class="banner_custom">
        <div class="singup-body login-body account-register">
            <div class="row">
                <div class="col-md-12">
                    <div class="card1">
                        <h4 class="card-header text-left">Find Your Contract Job</h4>
                        <div class="card-body">
                            {{-- <form action="{{ url('search-project') }}" method="GET" id="register_basic_form"> --}}
                            <form action="#" method="GET" id="register_basic_form">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-3 col-12 mr-5">
                                        <label>Key Skills</label>
                                        <input type="text" name="keyskills" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-3 col-12 mr-5">
                                        <label>Location</label>
                                        <input type="text" name="location" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-3 col-12 mr-4">
                                        <label>Experience</label>
                                        <input type="text" name="experience" class="form-control" />
                                    </div>
                                    <div class="form-group col pt-2">
                                        <br>
                                        <div class="find_job_button">
                                            <button class="big_btn_shadow red-linear-gradient text-white">
                                                Find Job
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4 class="featured-jobs mx-4">Featured Jobs</h4>
                    <div class="browse-job-posting">
                        <div class="mb-3 mb-lg-5">
                            <ul class="list-unstyled">
                                @foreach ($jobs as $job)
                                <li class="card p-4 mb-4">
                                    <div class="row no-gutters d-flex align-items-center">
                                        <div class="col-md-9">
                                            <div class="contract-body">
                                                <div class="row no-gutters">
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <div class="display-5">Profile Title</div>
                                                            <p>{{ $job->job_title }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="contract-profile mb-1">
                                                            <img src="{{ asset('assets/img/logo.png') }}" alt="..." class="img-fluid"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2">
                                                    <a href="{{ route('jobdetails', $job->job_id) }}" class="h3">{{ $job->about_company }}</a>
                                                </div>
                                                <div class="mb-2">
                                                    <div class="display-5">Job Description</div>
                                                    <p class="description">{{ $job->role_summary }}</p>
                                                </div>
                                                <div class="row no-gutters">
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <div class="display-5">Location</div>
                                                            <p>Delhi</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <div class="display-5">Experience</div>
                                                            <p>{{ $job->experience_year }} Years {{ $job->experience_month }} Month</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="find_job_button text-center">
                                                <a class="btn_small yellow-linear-gradient" href="{{ route('jobdetails', $job->job_id) }}">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-12 text-right">
                <a class="view-alljobs" href="#">View All Jobs <span class="fas fa-angle-right"></span><span class="fas fa-angle-right"></span><span class="fas fa-angle-right"></span></a>
            </div> --}}
        </div>

    </div>
</section>

<div class="overflow-hidden contract-job">
    <div class="container space-2 space-top-md-2 space-bottom-3">
        <div class="row justify-content-lg-between align-items-end">
            <div class="col-md-7 col-lg-7 mb-7 mb-md-0">
                <div class="mb-4">
                    <h1 class="h2 mb-3">Smart Sales Referral Program</h1>
                    <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
                </div>
                <div class="row mt-4">
                    <div class="col-md-8 col-lg-8 col-12">
                        <a class="js-go-to position-static btn btn-primary btn-wide" href="{{ url('sales-referral-form') }}">
                            Sales Referral
                        </a>
                        <div class="video">
                            <div class="video-player mx-md-auto">
                                <a class="js-inline-video-player video-player-btn video-player-centered" href="#" data-toggle="modal" data-target="#myModal">
                                    <div class="card-img-top">
                                        <img class="img-fluid video-player-preview shadow video-btn" src="/assets/img/photo/refer/3.png" alt="Image" data-target="#myModal">
                                    </div>
                                    {{-- <img class="img-fluid video-player-preview shadow video-btn" src="/assets/img/Eiliana-video-Screen.png" alt="Image" data-target="#myModal"> --}}
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-4 col-lg-4 col-12">

                    </div> --}}
                </div>
            </div>

            <div class="col-md-5 d-none d-sm-block">
                <div class="position-relative">
                    <img class="img-fluid rounded" src="/assets/img/photo/sales-referral.jpg"
                        alt="Image Description">
                    <div class="position-absolute top-0 right-0 w-100 h-100 bg-soft-primary rounded z-index-n1 mt-5 mr-n5">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section my-2 mobile-bg">
    <div class="container">
        {{-- <div class="text-center mb-5">
            <h1 class="headingmain1">Get Work Done In Over 2500 Categories</h1>
            <div class="dividerheading"></div>
        </div> --}}
        <div class="space-0 explore-more">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-5 col-lg-5 pb-lg-5 mb-md-0 pt-lg-4 p-5">
                    <figure class="mt-4">
                        <img class="img-fluid" src="/assets/img/photo/mobile-only.png" alt="SVG">
                    </figure>
                </div>
                <div class="col-12 col-md-7 col-lg-7 pb-lg-5 mb-md-0 pt-lg-4 pl-lg-5 pl-4">
                    <h1 class="headingmain1">Bringing the new age projects to your doorstep</h1>
                    <ul class="list-unstyled list-article">
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> Enhanced Exposure while working with Global Clients</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> Anonymity for freelancers </li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> Achieve Incremental Revenues & make life better!</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> Manifest your creativity & Be Future Ready- Gig Strong!</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> Fine tune your Financial Aspirations with Freedom & Flexibility</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> Secured & Weekly Payments Schedule by Eiliana</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> No Minimum Account Balance</li>
                    </ul>
                </div>
                {{-- <div class="col-12 col-md col-lg pb-lg-5 mb-md-0 border-right pt-lg-4">
                <ul class="list-unstyled list-article">
                <li><a class="link-underline" href="#">App Development</a></li>
                <li><a class="link-underline" href="#">Designing & Architecture</a></li>
                <li><a class="link-underline" href="#">IT Infrastructure</a></li>
                <li><a class="link-underline" href="#">SAP Skills</a></li>
                <li><a class="link-underline" href="#">Oracle</a></li>
                <li><a class="link-underline" href="#">Talent Management</a></li>
                <li><a class="link-underline" href="#">Finance</a></li>
                </ul>
            </div>

            <div class="col-12 col-md col-lg pb-lg-5 mb-md-0 border-right pt-lg-4">
                <ul class="list-unstyled list-article">
                <li><a class="link-underline" href="#">Sales & Marketing</a></li>
                <li><a class="link-underline" href="#">Legal</a></li>
                <li><a class="link-underline" href="#">CXO On Demand</a></li>
                <li><a class="link-underline" href="#">HTML</a></li>
                <li><a class="link-underline" href="#">Translation</a></li>
                <li><a class="link-underline" href="#">Python</a></li>
                <li><a class="link-underline" href="#">MySQL</a></li>
                </ul>
            </div>

            <div class="col-12 col-md col-lg pb-lg-5 mb-md-0 border-right pt-lg-4">
                <ul class="list-unstyled list-article">
                <li><a class="link-underline" href="#">Article Writing</a></li>
                <li><a class="link-underline" href="#">UX Writing</a></li>
                <li><a class="link-underline" href="#">Creative Writing</a></li>
                <li><a class="link-underline" href="#">Banner Design</a></li>
                <li><a class="link-underline" href="#">Illustration</a></li>
                <li><a class="link-underline" href="#">Ghostwriting</a></li>
                <li><a class="link-underline" href="#">Data Entry</a></li>
                <li><a class="link-underline" href="#">3D Animation</a></li>
                </ul>
            </div>

            <div class="col-12 col-md col-lg pb-lg-5 mb-md-0 border-right pt-lg-4">
                <ul class="list-unstyled list-article">
                <li><a class="link-underline" href="#">Android Developer</a></li>
                <li><a class="link-underline" href="#">Bookkeeper</a></li>
                <li><a class="link-underline" href="#">Content Writer</a></li>
                <li><a class="link-underline" href="#">Copywriter</a></li>
                <li><a class="link-underline" href="#">Customer Service</a></li>
                <li><a class="link-underline" href="#">Database Administrator</a></li>
                <li><a class="link-underline" href="#">Data Scientist</a></li>
                <li><a class="link-underline" href="#">Facebook Developer</a></li>
                </ul>
            </div>

            <div class="col-12 col-md col-lg pb-lg-5 mb-md-0 pt-lg-4">
                <ul class="list-unstyled list-article">
                <li><a class="link-underline" href="#">Graphic Designer</a></li>
                <li><a class="link-underline" href="#">Information Security Analyst</a></li>
                <li><a class="link-underline" href="#">iOS Developer</a></li>
                <li><a class="link-underline" href="#">Java Developer</a></li>
                <li><a class="link-underline" href="#">JavaScript Developer</a></li>
                <li><a class="link-underline" href="#">Logo Designer</a></li>
                <li><a class="link-underline" href="#">Mobile App Developer</a></li>
                <li><a class="link-underline" href="#">PHP Developer</a></li>
                </ul>
            </div> --}}
            </div>
        </div>
        {{-- <a class="font-weight-700 mt-4 text-orange float-right" href="#">Explore More <span class="fa fa-angle-right"></span><span class="fa fa-angle-right"></span><span class="fa fa-angle-right"></span></a> --}}
    </div>
</section>
<section class="section four-slider mt-4 searv">
    <div class="hire">
        <div class="shadow1">
            <div class="container space-1">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <h1 class="headingmain1">Frequently asked questions</h1>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 pr-4">
                        <div class="refer-resource">
                            <div class="card">
                                <h4 class="card-header">Refer A Resource</h4>
                                <div class="card-body">
                                    <figure class="mt-0">
                                        <img class="img-fluid" src="/assets/img/photo/refer-a-resource.png" alt="SVG">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                        {{-- <h4 class="featured-jobs mx-4">Featured Jobs</h4> --}}
                        <div class="browse-job-posting">
                            <div class="mb-3 mb-lg-5">
                                <ul class="list-unstyled">
                                    <li class="card p-4 mb-4">
                                        <div class="row no-gutters d-flex align-items-center">
                                            <div class="col-md-12">
                                                <div class="contract-body">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-12">
                                                            <div class="mb-2">
                                                                <div class="display-5">What is development and IT?</div>
                                                                <p>Development refers to the creation and management of business technology, including computer applications, financial systems, and logistical solutions that help an organization run its operational processes.</p>
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="display-5">What is development and IT?</div>
                                                                <p>Development refers to the creation and management of business technology, including computer applications, financial systems, and logistical solutions that help an organization run its operational processes.</p>
                                                            </div>
                                                            <div class="find_job_button text-right">
                                                                <a class="btn_small yellow-linear-gradient" href="#">Sale</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
    {{-- <div class="text-center">
    <h1 class="headingmain1">Why Choose Us?</h1>
    <p class="subtitle1">Firstly, for talents, we have tons of jobs that will help you utilize your skills and earn some (actually, more than some) extra bucks on the side. Secondly, for clients, we have thousands of talented individuals who are ready to take on all kinds of projects, right from app development to logo design.</p>
    <p class="subtitle2"><b>And lastly, there are a bunch of nifty reasons why you’ll Eiliana.</b></p>
    <div class="dividerheading"></div>
  </div>
  <div class="banner_custom">
    <div class="banner_custom_services">
      <div class="multiple-carousel">
        <div class="slide">
          <div class="crowd_favrt">
            <div class="servicesimg">
              <img class="img-fluid" src="/assets/img/eiliana-why-choose-us/1-Anonimity-1814278721.jpg">
              <div class="backgroundcontenddiv boderradius_bottom_left shadow bg-white text-center mb-4">
                <!-- <h5 class="text-orange">Complete Anonymity</h5> -->
                <h5 class="text-orange">HDGH HBCHD</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="slide">
          <div class="crowd_favrt">
            <div class="servicesimg">
              <img class="img-fluid" src="/assets/img/eiliana-why-choose-us/2-Business Generation-1534355573.jpg">
              <div class="backgroundcontenddiv boderradius_bottom_right shadow bg-white text-center mb-4">
                <!-- <h5 class="text-orange">Start-up</h5> -->
                <h5 class="text-orange">4RSK SDKSL</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="slide">
          <div class="crowd_favrt">
            <div class="servicesimg">
              <img class="img-fluid" src="/assets/img/eiliana-why-choose-us/3-Online Bid-769403827.jpg">
              <div class="backgroundcontenddiv boderradius_bottom_left shadow bg-white text-center mb-4">
                <!-- <h5 class="text-orange">Business Geneartion</h5> -->
                <h5 class="text-orange">NHAHGA HHSH</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="slide">
          <div class="crowd_favrt">
            <div class="servicesimg">
              <img class="img-fluid" src="/assets/img/eiliana-why-choose-us/4-Faster roll out-1495084820.jpg">
              <div class="backgroundcontenddiv boderradius_bottom_right shadow bg-white text-center mb-4">
                <!-- <h5 class="text-orange">Faster Rollout</h5> -->
                <h5 class="text-orange">GSHSH SHSHS</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="slide">
          <div class="crowd_favrt">
            <div class="servicesimg">
              <img class="img-fluid" src="/assets/img/eiliana-why-choose-us/5-team building-1493445596.jpg">
              <div class="backgroundcontenddiv boderradius_bottom_left shadow bg-white text-center mb-4">
                <!-- <h5 class="text-orange">Cost Optimization</h5> -->
                <h5 class="text-orange">HGDHG HJDHDHKD</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="slide">
          <div class="crowd_favrt">
            <div class="servicesimg">
              <img class="img-fluid" src="/assets/img/eiliana-why-choose-us/6-Learning-529026958.jpg">
              <div class="backgroundcontenddiv boderradius_bottom_right shadow bg-white text-center mb-4">
                <h5 class="text-orange">247SURY JDBCJ</h5>
                <!-- <h5 class="text-orange">24X7 Support</h5> -->
              </div>
            </div>
          </div>
        </div>
        <div class="slide">
          <div class="crowd_favrt">
            <div class="servicesimg">
              <img class="img-fluid" src="/assets/img/eiliana-why-choose-us/7-Project Analysis-250380139.jpg">
              <div class="backgroundcontenddiv boderradius_bottom_left shadow bg-white text-center mb-4">
                <h5 class="text-orange">DHDH HDHD DHDH</h5>
                <!-- <h5 class="text-orange">Team Creation & Bidding</h5> -->
              </div>
            </div>
          </div>
        </div>
        <div class="slide">
         <div class="crowd_favrt">
            <div class="servicesimg">
              <img class="img-fluid" src="/assets/img/eiliana-why-choose-us/8-Talent-1208199004.jpg">
              <div class="backgroundcontenddiv boderradius_bottom_right shadow bg-white text-center mb-4">
                <h5 class="text-orange">HGDHGDS DHDHD</h5>
                <!-- <h5 class="text-orange">Faster Rollout</h5> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
</section>

<section class="section our-solution">
        <div class="text-center w-lg-60 mx-auto">
        <h1 class="headingmain1">How It Works?</h1>
        <p class="d-block mb-2 subtitle1">At Eiliana, we believe that we’re matchmakers who help talents find the right project and clients find the right talent for their job. Checkout our video to see how we go about doing that.</p>
        <div class="dividerheading"></div>
    </div>
    <div class="container">
      <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-12">
            <figure class="mt-5">
                <img class="img-fluid" src="/assets/img/photo/stock-howtes.png" alt="SVG">
            </figure>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                <div class="banner_custom">
                    <div class="banner_custom_services">
                        <div class="multiple-three-carousel">
                            <div class="slide">
                                <div class="crowd_favrt">
                                    <div class="video-player mx-md-auto">
                                        <a class="js-inline-video-player video-player-btn video-player-centered" href="#" data-toggle="modal" data-target="#myModal">
                                            <div class="card-img-top">
                                                <img class="img-fluid video-player-preview shadow video-btn" src="/assets/img/photo/refer/2.png" alt="Image" data-target="#myModal">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slide">
                                <div class="crowd_favrt">
                                    <div class="video-player mx-md-auto">
                                        <a class="js-inline-video-player video-player-btn video-player-centered" href="#" data-toggle="modal" data-target="#myModal">
                                            <div class="card-img-top">
                                                <img class="img-fluid video-player-preview shadow video-btn" src="/assets/img/photo/refer/1.png" alt="Image" data-target="#myModal">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
    </div>

  {{-- <div class="our-slotuion slider mb-5 mt-5 text-center w-lg-60 mx-auto">
    <div class="video-player mx-md-auto">
        <a class="js-inline-video-player video-player-btn video-player-centered" href="#" data-toggle="modal" data-target="#myModal">
          <img class="img-fluid video-player-preview shadow video-btn" src="/assets/img/Eiliana-video-Screen.png" alt="Image" data-target="#myModal">
        </a>
    </div>
  </div> --}}
  <div class="modal fade pullDown login-body border-0" id="myModal" role="dialog" aria-labelledby="modalLabelnews">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue text-white">
                <h4 class="modal-title" id="modalLabelnews">How It Works?</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="main-moudle">

                    <video width="690" height="340" controls>
                        <source src="{{URL::asset("/assets/video/eiliana_final.mp4")}}" type="video/mp4">
                      Your browser does not support the video tag.
                  </video>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- //Container End -->
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!-- page level js starts-->
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/wow/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/slick-carousel/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/index.js') }}"></script>
<!--page level js ends-->
<script>
$(document).ready(function() {
    var $videoSrc;
    // when the modal is opened autoplay it
    $('#myModal').on('shown.bs.modal', function (e) {
        $('video').trigger('play');
    })

    $('#myModal').on('hide.bs.modal', function (e) {
        $('video').trigger('pause');
    })
});

</script>

<!-- <script>
  var coll = document.getElementsByClassName("demand_skills");
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var demand_skills = this.nextElementSibling;
      if (demand_skills.style.display === "block") {
        demand_skills.style.display = "none";
      } else {
        demand_skills.style.display = "block";
      }
    });
  }
</script> -->
@stop
