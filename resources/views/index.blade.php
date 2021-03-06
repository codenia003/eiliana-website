@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{$homepage->title}}
@stop
@section('meta_keywords', $homepage->keywords)
@section('meta_description', $homepage->description)



{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick-carousel/slick.css') }}">
<link href="{{ asset('vendors/sweetalert/css/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/index.css') }}">
<!--end of page level css-->

@stop

{{-- slider --}}
@section('top')
<!--Carousel Start -->
<section class="section1 only-desktop">
    <div class="slick-carousel">
        <div class="slide slider1">
            <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-1.png);">
                <div class="container space-2 space-lg-4">
                    <div class="row">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-7">
                            <div class="banner1_content">
                                <h1>Transforming lives <br>Through next <br>Generation <span
                                        class="text-orange">Resources</span> <br>And <span
                                        class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                    {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                    <div class="w-md-65 w-lg-35 w-sm-100">
                        <div class="mb-4">
                            <div class="banner1_content">
                                <h1>Transforming lives <br>Through next <br>Generation <span
                                        class="text-orange">Resources</span> <br>And <span
                                        class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                                <h1>Transforming lives <br>Through next <br>Generation <span
                                        class="text-orange">Resources</span> <br>And <span
                                        class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                    <div class="w-md-65 w-lg-35 w-sm-100">
                        <div class="mb-4">
                            <div class="banner1_content">
                                <h1>Transforming lives <br>Through next <br>Generation <span
                                        class="text-orange">Resources</span> <br>And <span
                                        class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                                <h1>Transforming lives <br>Through next <br>Generation <span
                                        class="text-orange">Resources</span> <br>And <span
                                        class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                    <div class="w-md-65 w-lg-35 w-sm-100">
                        <div class="mb-4">
                            <div class="banner1_content">
                                <h1>Transforming lives <br>Through next <br>Generation <span
                                        class="text-orange">Resources</span> <br>And <span
                                        class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- mobile wala slider --}}
<section class="section1 d-none only-mobile">
    <div class="mobile-slick-carousel">
        <div class="slide slider1">
            <div class="bg-img-hero" style="background-image: url(/assets/img/banner/Banner-1.png);">
                <div class="container space-2 space-lg-4">
                    <div class="row">
                        <div class="col-md-5 col-12">
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="banner1_content">
                                <h1>Transforming lives Through next Generation <span class="text-orange">Resources</span> And <span
                                class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                    <div class="w-md-65 w-lg-35 w-sm-100">
                        <div class="mb-4">
                            <div class="banner1_content">
                                <h1>Transforming lives Through next Generation <span class="text-orange">Resources</span> And <span
                                class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                        <div class="col-md-6 col-12">
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="banner1_content">
                                <h1>Transforming lives Through next Generation <span class="text-orange">Resources</span> And <span
                                class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                    <div class="w-md-65 w-lg-35 w-sm-100">
                        <div class="mb-4">
                            <div class="banner1_content">
                                <h1>Transforming lives Through next Generation <span class="text-orange">Resources</span> And <span
                                class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                        <div class="col-md-5 col-12">
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="banner1_content">
                                <h1>Transforming lives Through next Generation <span class="text-orange">Resources</span> And <span
                                    class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                    <div class="w-md-65 w-lg-35 w-sm-100">
                        <div class="mb-4">
                            <div class="banner1_content">
                                <h1>Transforming lives Through next Generation <span class="text-orange">Resources</span> And <span
                                    class="text-orange">Projects</span></h1>
                                <div class="group_button">
                                {{--<a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                    <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire
                                        Talent</a>--}}
                                        @if (Session::get('users')['login_as'] == '1')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('search-project') }}">Find
                                        Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3 client" data-target="{{ url('logout') }}">Hire Talent</a>
                                        @elseif (Session::get('users')['login_as'] == '2')
                                        <a class="big_btn_shadow yellow-linear-gradient text-white freelancer" data-target="{{ url('logout') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('hire-talent') }}">Hire Talent</a>
                                        @else
                                        <a class="big_btn_shadow yellow-linear-gradient text-white" href="{{ url('user-type') }}">Find Projects</a>
                                        <a class="big_btn_shadow red-linear-gradient text-white ml-3" href="{{ url('user-type') }}">Hire Talent</a>
                                        @endif
                                    {{-- <a class="big_btn_shadow red-linear-gradient text-white ml-3"
                                        href="{{ url('/hire-talent') }}">Hire Talent</a> --}}
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
                        <img class="img-fluid" src="{{ asset('assets/img/icons/serviceimg1.jpg') }}" alt="SVG">
                    </figure>
                    <div class="media-body card-header1" id="headingOne">
                        <h4 class="mb-1 text-orange" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">Highly-Skilled Freelancers</h4>
                        <p class="font-size-1 mb-0" id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                            Name the talent, and we are on it to connect. From IOS Developer freelancers to Data Scientist freelancers, all are on a surge to serve you best.</p>
                    </div>
                </div>
                <!-- End Contacts -->
            </div>

            <div class="col-md-4 mb-7 mb-md-0">
                <!-- Contacts -->
                <div class="media accordion modified-accordion">
                    <figure class="max-w-8rem mr-4 mt-4">
                        <img class="img-fluid" src="{{ asset('assets/img/icons/serviceimg2.jpg') }}" alt="SVG">
                    </figure>
                    <div class="media-body card-header1" id="headingTwo">
                        <h4 class="mb-1 text-orange" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">Transparency</h4>
                        <p class="font-size-1 mb-0" id="collapseTwo" class="collapse" aria-labelledby="headingTwo">As a client, you will always know what you’re paying for, up front. And as a freelancer, you will always get fair pay.</p>
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
                        <p class="font-size-1 mb-0" id="collapseThree" class="collapse" aria-labelledby="headingThree">We are always here to rescue. Our round-the-clock support is always available to assist you, anytime anywhere.</p>
                    </div>
                </div>
                <!-- End Contacts -->
            </div>

        </div>
    </div>
</section>

<section class="section four-slider mt-4 searv">
    <div class="hire">
        <div class="shadow1">
            <div class="container space-1">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        {{-- <h1 class="headingmain1">Frequently asked questions</h1> --}}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 pr-4">
                        <div class="refer-resource">
                            <div class="card">
                                <h4 class="card-header">Refer A Freelancer</h4>
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
                        <div class="mb-3 mb-lg-5">
                            <ul class="list-unstyled">
                                <li class="mb-4">
                                    <div class="row no-gutters d-flex align-items-center">
                                        <div class="col-md-12">
                                            <div class="contract-body position-reletive">
                                                <div class="row no-gutters">
                                                    <div class="col-md-12">
                                                        <div class="mb-2">
                                                            <div class="display-5">REFER A Freelancer AND EARN COMMISSION ON HIS FIRST PROJECT DELIVERED</div>
                                                            <figure class="mt-0">
                                                                <img class="img-fluid" src="/assets/img/profile/refere-freelancer.png" alt="SVG">
                                                            </figure>
                                                        </div>
                                                        <div class="find_job_button text-right">
                                                            {{--<a class="btn_small yellow-linear-gradient text-white" href="{{ url('freelancer-referral') }}">Refer</a>--}}
                                                            <a class="btn_small yellow-linear-gradient text-white" onclick="togglePopup()">Coming soon</a>
                                                            {{-- @else
                                                            <a class="btn_small yellow-linear-gradient text-white" data-toggle="modal" data-target="#modal-refer">Refer</a>
                                                            @endif --}}
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
            <!-- End Row -->
        </div>
    </div>
</section>

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
                <div class="col-12 col-md-7 col-lg-7 pb-lg-5 mb-md-0 pt-lg-4 pl-lg-4 pl-4">
                    <h1 class="headingmain1">Working with Eiliana brings enhanced value for freelancers, know how?</h1>
                    <ul class="list-unstyled list-article">
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> No minimum account balance required to bid for projects</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> We work on the weekly payment disbursements model</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> We will be launching our services in 70+ countries</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> Add credibility by getting reviewed by offline clients</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> Access to online project tracker for better & enhanced visibility</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> Get charged only after payment through Success fee model</li>
                        <li><img class="img-fluid" src="/assets/img/photo/icon.png"> You can keep your profile anonymous as a freelancer</li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- <a class="font-weight-700 mt-4 text-orange float-right" href="#">Explore More <span
                class="fa fa-angle-right"></span><span class="fa fa-angle-right"></span><span
                class="fa fa-angle-right"></span></a> --}}
    </div>
</section>
{{-- peomfiomf --}}
<section class="section container our-solution four-slider space-1">
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
                    @if (Session::get('users')['login_as'] == '1')
                    <a href="{{ url('search-project') . '/' .$item->slug }}"
                        class="btn btn-outline-primary bg-yellow yellow-linear-gradient btn-pill">Explore Now</a>
                    @elseif (Session::get('users')['login_as'] == '2')
                    <a href="{{ url('hire-talent') . '/' .$item->slug }}"
                        class="btn btn-outline-primary bg-yellow yellow-linear-gradient btn-pill">Explore Now</a>
                    @else
                    <a href="{{ url('user-type') . '/' .$item->slug }}"
                        class="btn btn-outline-primary bg-yellow yellow-linear-gradient btn-pill">Explore Now</a>
                    @endif
                    @else
                    @if (Session::get('users')['login_as'] == '1')
                    <a href="{{ url('search-project') . '/' .$item->slug }}"
                        class="btn btn-outline-primary bg-orange red-linear-gradient btn-pill">Explore Now</a>
                    @elseif (Session::get('users')['login_as'] == '2')
                    <a href="{{ url('hire-talent') . '/' .$item->slug }}"
                        class="btn btn-outline-primary bg-orange red-linear-gradient btn-pill">Explore Now</a>
                    @else
                    <a href="{{ url('user-type') . '/' .$item->slug }}"
                        class="btn btn-outline-primary bg-orange red-linear-gradient btn-pill">Explore Now</a>
                    @endif

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
                                                            <img src="{{ asset('assets/img/logo.png') }}" alt="..."
                                                                class="img-fluid" />
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
                                                            <p>{{ $job->experience_year }} Years {{
                                                                $job->experience_month }} Month</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="find_job_button text-center">
                                                <a class="btn_small yellow-linear-gradient"
                                                    href="{{ route('jobdetails', $job->job_id) }}">View</a>
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
                <a class="view-alljobs" href="#">View All Jobs <span class="fas fa-angle-right"></span><span
                        class="fas fa-angle-right"></span><span class="fas fa-angle-right"></span></a>
            </div> --}}
        </div>

    </div>
</section>

<div class="overflow-hidden contract-job">
    <div class="container space-0 space-top-md-1 space-bottom-2">
        <div class="row justify-content-lg-between align-items-end">
            <div class="col-md-7 col-lg-7 mb-7 mb-md-0">
                <div class="mb-4">
                    <h1 class="h2 mb-3">Smart Sales Referral Program</h1>
                    <p class="lead">Referrals are one of the most valuable forms of marketing. As per a study revealed
                        that 74% of people see referrals as the most trusted and influential form of advertising. If
                        someone you know tells you how great a freelancer is, you're likely to give it a try. Enjoy
                        eiliana.com sales referral program where you can refer an IT project and decide your payout</p>
                </div>
                <div class="row mt-4">
                    <div class="col-md-8 col-lg-8 col-12">
                        <a class="js-go-to position-static btn btn-primary btn-wide"
                            href="{{ url('sales-referral') }}">
                            Sales Referral
                        </a>
                        <div class="video">
                            <div class="video-player mx-md-auto">
                                <a class="js-inline-video-player video-player-btn video-player-centered" href="#"
                                    data-toggle="modal" data-target="#myModal">
                                    <div class="card-img-top">
                                        <img class="img-fluid video-player-preview shadow video-btn"
                                            src="/assets/img/photo/refer/3.png" alt="Image" data-target="#myModal">
                                    </div>
                                    {{-- <img class="img-fluid video-player-preview shadow video-btn"
                                        src="/assets/img/Eiliana-video-Screen.png" alt="Image" data-target="#myModal">
                                    --}}
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
                    <img class="img-fluid rounded" src="/assets/img/photo/sales-referral.jpg" alt="Image Description">
                    <div
                        class="position-absolute top-0 right-0 w-100 h-100 bg-soft-primary rounded z-index-n1 mt-5 mr-n5">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section my-2 new-page-bg bg-img-hero"
    style="background-image: url(/assets/img/photo/new_page-only.png);">
    <div class="container">
        <!-- <div class="text-center mb-5">
        <h1 class="headingmain1">Get Work Done In Over 2500 Categories</h1>
        <div class="dividerheading"></div>
        </div> -->
        <div class="explore-more">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                    <h1 class="headingmain1">Agility</h1>
                    <ul class="list-unstyled list-article">
                        <li>
                            <div class="d-flex">
                                <div class="media align-items-center align-items-sm-start mb-3">
                                    <img class="avatar avatar-sm mr-2 mt-1" src="/assets/img/photo/icon.png"
                                        alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span>Choose experienced freelancer from the Global Talent Pool.</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <div class="media align-items-center align-items-sm-start mb-3">
                                    <img class="avatar avatar-sm mr-2 mt-1" src="/assets/img/photo/icon.png"
                                        alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span>Utilize the best talent to help manage Business Risk on Pay per Use Model.</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <div class="media align-items-center align-items-sm-start mb-3">
                                    <img class="avatar avatar-sm mr-2 mt-1" src="/assets/img/photo/icon.png"
                                        alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span>Manage Delivery Model at Eiliana that facilitates smooth project Delivery.</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <div class="media align-items-center align-items-sm-start mb-3">
                                    <img class="avatar avatar-sm mr-2 mt-1" src="/assets/img/photo/icon.png"
                                        alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span>Faster project Roll out through Instant resource deployment.</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <div class="media align-items-center align-items-sm-start mb-3">
                                    <img class="avatar avatar-sm mr-2 mt-1" src="/assets/img/photo/icon.png"
                                        alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span>Access to Super Niche Skills that helps in transforming the project performance.</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-3 col-lg-3">
                    <figure class="mt-4 d-none only-mobile text-center">
                        <img class="img-fluid" src="/assets/img/photo/new_page-mobile.png" alt="SVG">
                    </figure>
                </div>
                <div class="col-12 col-md-5 col-lg-5">
                    <div class="card1">
                        <div class="eiliana-agility">
                            <form action="#" method="GET" id="register_basic_form">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label>Key Skills</label>
                                        <input type="text" name="keyskills"
                                            placeholder="Chatbots, Machine learning, Deep learning, Computer vision, Cognitive Science"
                                            class="form-control" disabled />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Total Experience</label>
                                        <div class="form-row">
                                            <div class="col-6">
                                                <select class="form-control" required="" name="experience_year"
                                                    disabled>
                                                    @for ($i = 4; $i < 21; $i++) <option value="{{ $i }}">{{ $i }} Years
                                                        </option>
                                                        @endfor
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <select class="form-control" required="" name="experience_month"
                                                    disabled>
                                                    @for ($i = 5; $i < 13; $i++) <option value="{{ $i }}">{{ $i }} Years
                                                        </option>
                                                        @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Salary Range</label>
                                        <div class="form-row">
                                            <div class="col-6">
                                                <select class="form-control" required="" name="from_salary_range"
                                                    disabled>
                                                    <option value="">10 Lacs</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <select class="form-control" required="" name="experience_month"
                                                    disabled>
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

<section class="section our-solution py-5">
    <div class="text-center w-lg-60 mx-auto">
        <h1 class="headingmain1">Reference Video</h1>
        <p class="d-block mb-2 subtitle1">At Eiliana we strive continuously to enhance value for our freelancers and customers thereby sharing  new business models and sharing dynamic concepts for transforming there businesses. Checkout our videos to see how we go about doing that.</p>
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
                                        <a class="js-inline-video-player video-player-btn video-player-centered"
                                            href="#" data-toggle="modal" data-target="#myModal">
                                            <div class="card-img-top">
                                                <img class="img-fluid video-player-preview shadow video-btn"
                                                    src="/assets/img/photo/refer/2.png" alt="Image"
                                                    data-target="#myModal">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slide">
                                <div class="crowd_favrt">
                                    <div class="video-player mx-md-auto">
                                        <a class="js-inline-video-player video-player-btn video-player-centered"
                                            href="#" data-toggle="modal" data-target="#myModal_1">
                                            <div class="card-img-top">
                                                <img class="img-fluid video-player-preview shadow video-btn"
                                                    src="/assets/img/photo/refer/1.png" alt="Image"
                                                    data-target="#myModal_1">
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
</section>

{{-- <div class="our-slotuion slider mb-5 mt-5 text-center w-lg-60 mx-auto">
    <div class="video-player mx-md-auto">
        <a class="js-inline-video-player video-player-btn video-player-centered" href="#" data-toggle="modal"
            data-target="#myModal">
            <img class="img-fluid video-player-preview shadow video-btn" src="/assets/img/Eiliana-video-Screen.png"
                alt="Image" data-target="#myModal">
        </a>
    </div>
</div> --}}
<div class="modal fade pullDown login-body border-0" id="myModal" role="dialog"
    aria-labelledby="modalLabelnews">
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

                    <video width="100%" controls>
                        <source src="{{URL::asset("assets/video/eiliana_final.mp4")}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade pullDown login-body border-0" id="myModal_1" role="dialog"
    aria-labelledby="modalLabelnews">
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

                    <video width="100%" controls>
                        <source src="{{URL::asset("assets/video/eiliana_final_2.mp4")}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //Container End -->
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!-- page level js starts-->
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/wow/js/wow.min.js') }}"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/slick-carousel/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/index.js') }}"></script>
<!--page level js ends-->
<script>
    $(document).ready(function () {
        var $videoSrc;
        // when the modal is opened autoplay it
        $('#myModal').on('shown.bs.modal', function (e) {
            $('#myModal video').trigger('play');
        });

        $('#myModal').on('hide.bs.modal', function (e) {
            $('#myModal video').trigger('pause');
        });

        $('#myModal_1').on('shown.bs.modal', function (e) {
            $('#myModal_1 video').trigger('play');
        });
        $('#myModal_1').on('hide.bs.modal', function (e) {
            $('#myModal_1 video').trigger('pause');
        });

        $('.client').on('click', function(event) {
            event.preventDefault();
            var url = $(this).data('target');
            var r = confirm("Login first by client");
            if (r == true) {
                location.replace(url);
            }
        });

        $('.freelancer').on('click', function(event) {
            event.preventDefault();
            var url = $(this).data('target');

            var r = confirm("Login first by freelancer");
            if (r == true) {
                location.replace(url);
            }
        });
        togglePopupHome();
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
