<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @section('title')
        | Welcome To Eiliana
        @show
    </title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-m.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900" rel="stylesheet" type="text/css"/>
    <!--end of global css-->
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>

<body>
    <!-- Header Start -->
    <header>
        <div class="section px-5 py-2">
            @if(Sentinel::guest())
            <nav class="navbar navbar-expand-lg navbar-light custom_header">
                <a class="navbar-brand" href="/"><img src="/assets/img/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto topnav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Post a Project</a>
                            <!-- <a class="nav-link" href="{{ url('/job-posting') }}">Post a Project</a> -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">How It Works</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Our Products</a>
                        </li>
                        <li class="nav-item">
                            <button class="login_signup yellow-linear-gradient text-white" onclick="location.href='/account/login'">Login</button>
                        </li>
                        <li class="nav-item">
                            <button class="login_signup red-linear-gradient text-white ml-3" onclick="location.href='/account/register'">Sign Up</button>
                        </li>
                        <li class="nav-item dropdown language">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="/assets/img/lnguage_icon.jpg">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"><img src="/assets/img/lnguage_icon.jpg"> India</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            @else
            <nav class="navbar navbar-expand-xl navbar-light custom_header">
                <a class="navbar-brand" href="/home" ><img src="/assets/img/logo.png"></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collection of nav links, forms, and other content for toggling -->
                <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
                   <!--  <div class="navbar-form form-inline">
                        <div class="input-group search-box">
                            <input class="form-control mr-sm-2" type="search" placeholder="Find project & hire talent" aria-label="Search">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        </div>
                    </div> -->
                    <div class="navbar-nav ml-auto">
                        <a href="#" class="nav-item nav-link active">Free Credit</a>
                        <a href="#" class="nav-item nav-link">My Works</a>
                        <a href="{{ url('/job-posting') }}" class="nav-item nav-link login_signup">Post Project</a>
                        <!-- <a href="#" class="nav-item nav-link messages"><i class="fa fa-comments"></i><span class="badge">10</span></a> -->
                        <a href="#" class="nav-item nav-link notifications"><i class="far fa-bell"></i></i><span class="badge">2</span></a>
                        <div class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">
                                @if(Sentinel::getUser()->pic)
                                <img src="{{ asset('images/authors/no_avatar.jpg') }}" class="avatar" alt="Avatar">
                                @else
                                <img src="/assets/img/profile/avatar.svg" class="avatar" alt="Avatar">
                                @endif
                                {{ Sentinel::getUser()->full_name }} 
                                <b class="caret"></b>
                            </a>
                            <div class="dropdown-menu">
                                <a href="/home" class="dropdown-item"><i class="fa fa-user-o"></i> Dashboard</a>
                                <a href="/profile" class="dropdown-item"><i class="fa fa-sliders"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ URL::to('logout') }}" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            @endif
        </div>
    </header>

    <!-- //Header End -->

    <!-- slider / breadcrumbs section -->
    @yield('top')

    <!-- Content -->
    @yield('content')

    <!-- Footer Section Start -->
    <footer class="custome-footer">
        <div class="container space-1">
            <div class="row mb-9">
                <div class="col-lg-3 mb-5 mb-lg-0">
                    <h5 class="text-white font-weight-500">Categories</h5>
                    <!-- Nav Link -->
                    <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Graphics & Design</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Digital Marketing</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Video & Animation</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Music & Audio</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Programming & Tech</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Business</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Sitemap</a></li>
                    </ul>
                    <!-- End Nav Link -->
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-5 mb-lg-0">
                    <h5 class="text-white font-weight-500">Features</h5>
                    <!-- Nav Link -->
                    <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Press</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Release notes</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Integrations</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Pricing</a></li>
                    </ul>
                    <!-- End Nav Link -->
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-5 mb-lg-0">
                    <h5 class="text-white font-weight-500">Company</h5>
                    <!-- Nav Link -->
                    <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">About</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Careers</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Blog</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Customers</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="#">Hire us</a></li>
                    </ul>
                    <!-- End Nav Link -->
                </div>
                <div class="col-md-6 col-lg-5">
                    <!-- Form -->
                    <div class="js-validate mb-2">
                        <h5 class="text-white font-weight-500 mb-3">Stay up to date</h5>
                        <div class="form-row">
                            <div class="col">
                                <div class="js-form-message">
                                    <label class="sr-only" for="subscribeSrEmail">Email address</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" id="subscribeSrEmail" placeholder="Email address" aria-label="Email address" required data-msg="Please enter a valid email address.">
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Form -->
                    <ul class="list-inline mb-0">
                        <!-- Social Networks -->
                        <li class="list-inline-item">
                            <a class="btn btn-icon btn-ghost-light bg-facebook" href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-icon btn-ghost-light bg-twitter" href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-icon btn-ghost-light bg-linkedin" href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-icon btn-ghost-light bg-instagram" href="#">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <!-- End Social Networks -->
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"
        data-original-title="Return to top" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>



    <!--global js starts-->
    <script type="text/javascript" src="{{ asset('js/frontend/lib.js') }}"></script>
    <!--global js end-->
    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->
    <script>
        $(".navbar-toggler-icon").click(function () {
        $(this).closest('.navbar').find('.collapse').toggleClass('collapse1')
    })

    $(function () {
        $('[data-toggle="tooltip"]').tooltip().css('font-size', '14px');
    })
    </script>
</body>

</html>
