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
<section class="section1">
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

    <div class="slide slider1">
      <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-2-1.png);">
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

    <div class="slide slider1">
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
<!-- //Carousel End -->
@stop

{{-- content --}}
@section('content')
<section class="section container my-2">
    <!-- <div class="text-center mb-5">
      <h1 class="headingmain1">Get Work Done In Over 2500 Categories</h1>
      <div class="dividerheading"></div>
    </div> -->
    <div class="space-1 explore-more pl-4">
      <div class="row">
          <div class="col-12">
              <figure class="mt-4">
                  <img class="img-fluid" src="/assets/img/photo/new_page.png" alt="SVG">
              </figure>
          </div>
      </div>
    </div>
    <!-- a class="font-weight-700 mt-4 text-orange float-right" href="#">Explore More <span class="fa fa-angle-right"></span><span class="fa fa-angle-right"></span><span class="fa fa-angle-right"></span></a> -->
  </section>
<section class="section container our-solution four-slider">
  <div class="text-center">
    <h1 class="headingmain1">Our Solutions</h1>
    <p class="d-block mb-2 subtitle1">Apart from our talent marketplace, we provide a variety of innovative solutions that help both talents and clients grow.</p>
    <div class="dividerheading"></div>
  </div>
  <div class="our-slotuion slider mb-3 mt-3">
    <div class="multiple-carousel">
        <div class="slide">
          <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
            <figure class="max-w-10rem mx-auto mb-4">
              <img class="img-fluid" src="/assets/img/icons/solution-1.png" alt="SVG">
            </figure>
            <h3>01. JDJU XHSDHHD</h3>
            <!-- <h3>01. Code Canyon</h3> -->
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <!-- <p>Code Canyon Connect with top-tier developers for pre-written programming modules and codes that can be integrated seamlessly.</p> -->
            <a href="#" class="btn btn-outline-primary bg-orange red-linear-gradient btn-pill">Explore Now <!-- <i class="fa fa-arrow-right fa-sm ml-1"></i> --></a>
          </div>
        </div>
        <div class="slide">
          <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
            <figure class="max-w-10rem mx-auto mb-4">
              <img class="img-fluid" src="/assets/img/icons/solution-2.png" alt="SVG">
            </figure>
            <h3>02. HDHHD DHBDSBJ</h3>
            <!-- <h3>02. Sales Referral</h3> -->
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <!-- <p>Utilize your contacts! Refer a friend or a colleague and get 10% on the successful completion of the project.</p> -->
            <a href="#" class="btn btn-outline-primary bg-yellow yellow-linear-gradient btn-pill">Explore Now <!-- <i class="fa fa-arrow-right fa-sm ml-1"></i> --></a>
          </div>
        </div>
        <div class="slide">
          <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
            <figure class="max-w-10rem mx-auto mb-4">
              <img class="img-fluid" src="/assets/img/icons/solution-3.png" alt="SVG">
            </figure>
            <h3>03. JVFKNLK</h3>
            <!-- <h3>03. Project Analysis</h3> -->
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <!-- <p>Get a detailed road-map that will help you in identifying the nitty gritties of your project.</p> -->
            <a href="#" class="btn btn-outline-primary bg-orange red-linear-gradient btn-pill">Explore Now <!-- <i class="fa fa-arrow-right fa-sm ml-1"></i> --></a>
          </div>
        </div>
        <div class="slide">
          <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
            <figure class="max-w-10rem mx-auto mb-4">
              <img class="img-fluid" src="/assets/img/icons/solution-4.png" alt="SVG">
            </figure>
            <h3>04. SYAGAHA WHWHW</h3>
            <!-- <h3>04. Startup Workforce</h3> -->
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <!-- <p>Connect with bankable top-tier talents that have a proven professional experience to grow your business.</p> -->
            <a href="#" class="btn btn-outline-primary bg-yellow yellow-linear-gradient btn-pill">Explore Now <!-- <i class="fa fa-arrow-right fa-sm ml-1"></i> --></a>
          </div>
        </div>
    </div>
  </div>
</section>
<!-- <section class="section container mt-4 four-slider">
  <div class="text-center">
    <h1 class="headingmain1">Crowd <span><img src="/assets/img/heart-icon.jpg"></span> Favourites</h1>
    <p class="subtitle1">Checkout some of the most popular services people pay for on Eiliana.</p>
    <div class="dividerheading"></div>
  </div>
  <div class="banner_custom">
    <div class="banner_custom_services">
       <div class="multiple-carousel">
          <div class="slide">
             <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/1-website development-378765202.jpg">
                <div class="backgroundcontenddiv boderradius_bottom_left">
                  <h5>Logo Design</h5>
                  <p>
                    Find your brand’s identity. <br> Starting at <b>₹ 2,500</b>
                  </p>
                </div>
              </div>
          </div>
          </div>
          <div class="slide">
            <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/2-Social Media Marketing-1498591895.jpg">
                <div style="background: #f45d4e;" class="backgroundcontenddiv boderradius_bottom_right">
                  <h5>Website Development</h5>
                  <p>
                    Build your online destination. <br> Starting at <b>₹ 2,500</b>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="slide">
            <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/3-Data Science-1177306144.jpg">
                <div class="backgroundcontenddiv boderradius_bottom_left">
                  <h5>SEO</h5>
                  <p>
                    Grow your brand online. <br> Starting at <b>₹ 5,200</b>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="slide">
            <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/4-Public Cloud-360072635.jpg">
                <div style="background: #ffaa01;" class="backgroundcontenddiv boderradius_bottom_right">
                  <h5>Video Explainer</h5>
                  <p>
                    Tell your brand story. <br> Starting at <b>₹ 15,000</b>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="slide">
             <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/5-RPA-1669752424.jpg">
                <div class="backgroundcontenddiv boderradius_bottom_left">
                  <h5>Logo Design</h5>
                  <p>
                    Find your brand’s identity. <br> Starting at <b>₹ 2,500</b>
                  </p>
                </div>
              </div>
          </div>
          </div>
          <div class="slide">
            <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/6-AR&VR-613702247.jpg">
                <div style="background: #f45d4e;" class="backgroundcontenddiv boderradius_bottom_right">
                  <h5>Website Development</h5>
                  <p>
                    Build your online destination. <br> Starting at <b>₹ 2,500</b>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="slide">
            <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/7-IOT-1682068621.jpg">
                <div class="backgroundcontenddiv boderradius_bottom_left">
                  <h5>SEO</h5>
                  <p>
                    Grow your brand online. <br> Starting at <b>₹ 5,200</b>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="slide">
            <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/8-Product Management-1101896657.jpg">
                <div style="background: #ffaa01;" class="backgroundcontenddiv boderradius_bottom_right">
                  <h5>Video Explainer</h5>
                  <p>
                    Tell your brand story. <br> Starting at <b>₹ 15,000</b>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="slide">
             <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/9-App Dev-335040302.jpg">
                <div class="backgroundcontenddiv boderradius_bottom_left">
                  <h5>Logo Design</h5>
                  <p>
                    Find your brand’s identity. <br> Starting at <b>₹ 2,500</b>
                  </p>
                </div>
              </div>
          </div>
          </div>
          <div class="slide">
            <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/10-UI Design-253620970.jpg">
                <div style="background: #f45d4e;" class="backgroundcontenddiv boderradius_bottom_right">
                  <h5>Website Development</h5>
                  <p>
                    Build your online destination. <br> Starting at <b>₹ 2,500</b>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="slide">
            <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/11-3D Animation-1803523591.jpg">
                <div class="backgroundcontenddiv boderradius_bottom_left">
                  <h5>SEO</h5>
                  <p>
                    Grow your brand online. <br> Starting at <b>₹ 5,200</b>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="slide">
            <div class="crowd_favrt">
              <div class="servicesimg">
                <img src="/assets/img/eiliana-favourites/12-Cyber Security-499702849.jpg">
                <div style="background: #ffaa01;" class="backgroundcontenddiv boderradius_bottom_right">
                  <h5>Video Explainer</h5>
                  <p>
                    Tell your brand story. <br> Starting at <b>₹ 15,000</b>
                  </p>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section> -->

<section class="section container">
    <div class="services mt-5 shadow border">
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
<section class="section container py-4 mt-1">
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
            </div>
            <div class="row">
                @foreach ($jobs as $job)
                <div class="col-md-6">
                    <div class="job-details m-4 p-4">
                        <h2>{{ $job->job_title }}</h2>
                        <div class="company-info">
                            <span>{{ $job->companydetails->full_name }}</span>
                            <span>{{ $job->locations->name }}</span>
                            <span>{{ $job->experience_year }} Year - {{ $job->experience_month }} Month</span>
                        </div>
                        <p class="descx">{{ $job->role_summary }}</p>
                        <div class="find_job_button">
                            <a class="btn_small yellow-linear-gradient" href="#">Apply</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-12 text-right">
                    <a class="view-alljobs" href="#">View All Jobs <span class="fas fa-angle-right"></span><span class="fas fa-angle-right"></span><span class="fas fa-angle-right"></span></a>
                </div>
            </div>
        </div>

    </div>
</section>
<section class="section container my-2">
  <div class="text-center mb-5">
    <h1 class="headingmain1">Get Work Done In Over 2500 Categories</h1>
    <div class="dividerheading"></div>
  </div>
  <div class="space-1 explore-more pl-4">
    <div class="row">
        <div class="col-12">
            <figure class="mt-4">
                <img class="img-fluid" src="/assets/img/photo/mobile.png" alt="SVG">
            </figure>
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
  <a class="font-weight-700 mt-4 text-orange float-right" href="#">Explore More <span class="fa fa-angle-right"></span><span class="fa fa-angle-right"></span><span class="fa fa-angle-right"></span></a>
</section>
<section class="section container why-choose-us space-1 four-slider mt-4">
  <div class="text-center">
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
  </div>
</section>

<section class="section container our-solution">
  <div class="text-center w-lg-60 mx-auto">
    <h1 class="headingmain1">How It Works?</h1>
    <p class="d-block mb-2 subtitle1">At Eiliana, we believe that we’re matchmakers who help talents find the right project and clients find the right talent for their job. Checkout our video to see how we go about doing that.</p>
    <div class="dividerheading"></div>
  </div>
  <div class="our-slotuion slider mb-5 mt-5 text-center w-lg-60 mx-auto">
    <div class="video-player mx-md-auto">
        <a class="js-inline-video-player video-player-btn video-player-centered" href="#" data-toggle="modal" data-src="/assets/video/eiliana_final.mp4" data-target="#myModal">
          <img class="img-fluid video-player-preview shadow video-btn" src="/assets/img/Eiliana-video-Screen.png" alt="Image" data-target="#myModal">
        </a>
    </div>
  </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <!-- 16:9 aspect ratio -->
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow=""></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<section class="overflow-hidden newsletter d-none">
   <div class="bg-img-hero" style="background-image: url(/assets/img/eiliana-new-bg.png);background: #16226e;">
      <div class="container space-2 position-relative z-index-2">
        <div class="w-lg-70 text-center mx-md-auto">
            <h2 class="h1 text-white text-uppercase font-weight-bold mb-3">Subscribe our Monthly Newsletter</h2>
            <p class="text-white mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.</p>
            <!-- Form -->
            <!-- <form class="js-validate"> -->
                <label class="sr-only" for="signupSrEmail">Email</label>
                <div class="input-group">
                    <input type="email" class="form-control" name="email" id="signupSrEmail" placeholder="Enter your email ID" aria-label="Email" required="">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-block btn-primary red-linear-gradient">Subscribe</button>
                    </div>
                </div>
            <!-- </form> -->
            <!-- End Form -->
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
    $('.video-player-btn').click(function() {
        $videoSrc = $(this).data( "src" );
    });
    // console.log($videoSrc);
    // when the modal is opened autoplay it
    $('#myModal').on('shown.bs.modal', function (e) {

    $("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" );
    })

    // stop playing the youtube video when I close the modal
    $('#myModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#video").attr('src',$videoSrc);
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
