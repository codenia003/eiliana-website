@extends('layouts/default')

{{-- Page title --}}
@section('title')
Coming Soon
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick-carousel/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/index.css') }}">
<style>
	.login_signup {
		display: none;
	}
	.language {
	    display: none;
	}
	footer.custome-footer {
	    display: none;
	}
</style>
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
                  <!-- <p>Nullam quis ante. Etiam sit amet orci eget eros faucibus <br>tincidunt. Duis leo. Fringilla mauris sit amet. Donec sodales</p> -->
                  <div class="group_button">
                    <a class="big_btn_shadow yellow-linear-gradient text-white" href="#"><!-- <span><i class="fa fa-search"></i></span> --> Find Projects</a>
                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#"><!-- <span><i class="fa fa-user"></i></span> --> Hire Talent</a>
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
                        <!-- <p>Nullam quis ante. Etiam sit amet orci eget eros faucibus <br>tincidunt. Duis leo. Fringilla mauris sit amet. Donec sodales</p> -->
                        <div class="group_button">
                          <a class="big_btn_shadow yellow-linear-gradient text-white" href="#">Find Projects</a>
                          <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#">Hire Talent</a>
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
                  <!-- <p>Nullam quis ante. Etiam sit amet orci eget eros faucibus <br>tincidunt. Duis leo. Fringilla mauris sit amet. Donec sodales</p> -->
                  <div class="group_button">
                    <a class="big_btn_shadow yellow-linear-gradient text-white" href="#"><!-- <span><i class="fa fa-search"></i></span> --> Find Projects</a>
                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#"><!-- <span><i class="fa fa-user"></i></span> --> Hire Talent</a>
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
                        <!-- <p>Nullam quis ante. Etiam sit amet orci eget eros faucibus <br>tincidunt. Duis leo. Fringilla mauris sit amet. Donec sodales</p> -->
                        <div class="group_button">
                          <a class="big_btn_shadow yellow-linear-gradient text-white" href="#"><!-- <span><i class="fa fa-search"></i></span> --> Find Projects</a>
                          <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#"><!-- <span><i class="fa fa-user"></i></span> --> Hire Talent</a>
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
                  <!-- <p>Nullam quis ante. Etiam sit amet orci eget eros faucibus <br>tincidunt. Duis leo. Fringilla mauris sit amet. Donec sodales</p> -->
                  <div class="group_button">
                    <a class="big_btn_shadow yellow-linear-gradient text-white" href="#"><!-- <span><i class="fa fa-search"></i></span> --> Find Projects</a>
                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#"><!-- <span><i class="fa fa-user"></i></span> --> Hire Talent</a>
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
                        <!-- <p>Nullam quis ante. Etiam sit amet orci eget eros faucibus <br>tincidunt. Duis leo. Fringilla mauris sit amet. Donec sodales</p> -->
                        <div class="group_button">
                          <a class="big_btn_shadow yellow-linear-gradient text-white" href="#"><!-- <span><i class="fa fa-search"></i></span> --> Find Projects</a>
                          <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="#"><!-- <span><i class="fa fa-user"></i></span> --> Hire Talent</a>
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

@stop

@section('footer_scripts')
<!-- page level js starts-->
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/wow/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/slick-carousel/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/index.js') }}"></script>
<!--page level js ends-->
@stop