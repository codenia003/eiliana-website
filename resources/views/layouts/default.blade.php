<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="-vzG1ZlYcexP65J-fgwdsJYu7YafFOJ5JNjIGZvfhj4">
    <title>
        @section('title')
        | Welcome To Eiliana
        @show
    </title>
    <meta name="description" content="@yield('meta_description','Hire Best Developers for your Projects')">
    <meta name="keywords" content="@yield('meta_keywords','development-testing')">
    <link rel="canonical" href="{{url()->current()}}"/>

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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y58JLJ1H42"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-Y58JLJ1H42');
    </script>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '150843163659487');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=150843163659487&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <script data-ad-client="ca-pub-9845401906196049" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-194797679-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-194797679-1');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KN2CX4K');</script>
    <!-- End Google Tag Manager -->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KN2CX4K"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</head>

<body>
    <!-- Header Start -->
    <header>
        <div class="section px-lg-5 px-3 py-lg-2 py-1">
            @if(Sentinel::guest())
            <nav class="navbar navbar-expand-lg navbar-light custom_header">
                <a class="navbar-brand" href="/"><img src="/assets/img/logo.png"></a>
                {{-- <li class="log">
                    <a class="login" href="#">Login</a>
                </li>
                <li class="log">
                    <a class="signup" href="#">SignUp</a>
                </li> --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto topnav">
                        <li class="nav-item">
                            {{-- <a class="nav-link" href="#">Post a Project</a> --}}
                            <a class="nav-link" href="{{ url('/job-posting') }}">Post a Project</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('howitswork') }}">How It Works</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('sales-referral') }}">Sales Referral</a>
                        </li>
                        <li class="nav-item d-none d-sm-block">
                            <button class="login_signup yellow-linear-gradient text-white" onclick="location.href='/account/login'">Login</button>
                        </li>
                        <li class="nav-item d-none d-sm-block">
                            <button class="login_signup red-linear-gradient text-white ml-3" onclick="location.href='/account/register'">Sign Up</button>
                        </li>
                        <li class="nav-item d-block d-sm-none mb-3">
                            <button class="login_signup yellow-linear-gradient text-white" onclick="location.href='/account/login'">Login</button>
                            <button class="login_signup red-linear-gradient text-white ml-3" onclick="location.href='/account/register'">Sign Up</button>
                        </li>
                        {{-- <li class="nav-item dropdown language">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="/assets/img/lnguage_icon.jpg">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"><img src="/assets/img/lnguage_icon.jpg"> India</a>
                            </div>
                        </li> --}}
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
                        @if (Session::get('users')['login_as'] == '1')
                           <!--  <li class="nav-item">
                                <a class="nav-link" href="{{ url('/freelancer/my-lead') }}">My Lead</a>
                            </li> -->
                            <li class="nav-item">
                                {{-- <a class="nav-link" href="{{ url('/freelancer/my-lead') }}">My Sales Referral</a> --}}
                                <a class="nav-link" onclick="togglePopup()">My Sales Referral</a>
                            </li>
                            <li class="nav-item opportunity" id="myDropdown">
                                <a data-toggle="dropdown" class="nav-link dropdown-toggle user-action" href="#" style="font-size: 14px;">My Opportunity
                                <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu sub_navbar">
                                   <li class="nav-item">
                                    <a class="dropdown-item" href="#" style="font-size: 14px;font-weight: 500;color: #000 !important;">My Proposal &nbsp;&nbsp;&nbsp;&nbsp;&raquo;</a>
                                       <ul class="submenu1 submenu_item">
                                            <li>
                                                {{-- <a class="dropdown-item submenu_down" href="url('/freelancer/my-contract_job')">Contract Job</a> --}}
                                                <a class="dropdown-item submenu_down" onclick="togglePopup()">Contract Job</a>
                                            </li>
                                            <li>
                                                {{-- <a class="dropdown-item submenu_down" href="{{ url('/freelancer/my-project') }}">Project</a> --}}
                                                <a class="dropdown-item submenu_down" onclick="togglePopup()">Project</a>
                                            </li>
                                        </ul>
                                   </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                {{-- <a class="nav-link" href="{{ url('/freelancer/my-save-job') }}">My Save Job</a> --}}
                                <a class="nav-link" onclick="togglePopup()">My Save Job</a>
                            </li>
                        @else
                            <li class="nav-item">
                                {{-- <a class="nav-link" href="{{ url('/client/my-lead') }}">My Sales Referral</a> --}}
                                <a class="nav-link" onclick="togglePopup()">My Sales Referral</a>
                            </li>

                            <li class="nav-item opportunity" id="myDropdown">
                                <a data-toggle="dropdown" class="nav-link dropdown-toggle user-action" href="#">My Opportunity <b class="caret"></b></a>
                                <ul class="dropdown-menu sub_navbar">
                                    <li class="nav-item">
                                      <a class="dropdown-item" href="#" style="font-size: 14px;font-weight: 500;color: #000 !important;">My Proposal &nbsp;&nbsp;&nbsp;&nbsp;&raquo;</a>
                                       <ul class="submenu1 submenu_item">
                                            <li>
                                                {{-- <a class="dropdown-item submenu_down" href="{{ url('/client/my-contract-job') }}">Contract Job</a> --}}
                                                <a class="dropdown-item submenu_down" onclick="togglePopup()">Contract Job</a>
                                            </li>
                                            <li>
                                                {{-- <a class="dropdown-item submenu_down" href="{{ url('/client/my-project') }}">Project</a> --}}
                                                <a class="dropdown-item submenu_down" onclick="togglePopup()">Project</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="#" style="font-size: 14px;font-weight: 500;color: #000 !important;">My Requirement &nbsp;&nbsp;&nbsp;&nbsp;&raquo;</a>
                                        <ul class="submenu1 submenu_item">
                                            <li>
                                                {{-- <a class="dropdown-item submenu_down" href="{{ url('/client/my-requirement-job') }}">Contract Job</a> --}}
                                                <a class="dropdown-item submenu_down" onclick="togglePopup()">Contract Job</a>
                                            </li>
                                            <li>
                                                {{-- <a class="dropdown-item submenu_down" href="{{ url('/client/my-requirement-project') }}">Project</a> --}}
                                                <a class="dropdown-item submenu_down" onclick="togglePopup()">Project</a>
                                            </li>
                                        </ul>
                                   </li>
                                   <li class="nav-item">
                                        <a class="dropdown-item" href="#" style="font-size: 14px;font-weight: 500;color: #000 !important;">My Delivery &nbsp;&nbsp;&nbsp;&nbsp;&raquo;</a>
                                        <ul class="submenu1 submenu_item">
                                            <li>
                                                {{-- <a class="dropdown-item submenu_down" href="{{ url('/client/my-delivery-job') }}">Contract Job</a> --}}
                                                <a class="dropdown-item submenu_down" onclick="togglePopup()">Contract Job</a>
                                            </li>
                                            <li>
                                                {{-- <a class="dropdown-item submenu_down" href="{{ url('/client/my-delivery-project') }}">Project</a> --}}
                                                <a class="dropdown-item submenu_down" onclick="togglePopup()">Project</a>
                                            </li>
                                        </ul>
                                   </li>
                                </ul>
                           </li>
                            <a href="{{ url('/job-posting') }}" class="nav-item nav-link login_signup">Post Project</a>
                        @endif
                        <x-database-notifications/>
                        <div class="nav-item user-avator">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">
                                @if(Sentinel::getUser()->pic)
                                <img src="{{ url('/') }}{{ Sentinel::getUser()->pic }}" class="avatar" alt="Avatar">
                                @else
                                <img src="/assets/img/profile/avatar.svg" class="avatar" alt="Avatar">
                                @endif
                                @if(isset(Sentinel::getUser()->anonymous))
                                    @if(Sentinel::getUser()->anonymous=='0')
                                        {{ Sentinel::getUser()->full_name }}
                                    @endif
                                    @if(Sentinel::getUser()->anonymous=='1')
                                        {{Sentinel::getUser()->pseudoName}}
                                    @endif
                                @endif
                                
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
    <div id="wrapper">
        <!-- slider / breadcrumbs section -->
        @yield('top')
        <div class="table-responsive">
            <div id="user_details"></div>
            <div id="user_model_details"></div>
        </div>

        <!-- Content -->
        @yield('content')
    </div>

    <div id="warning-message">
        <div class="container thumbnail shadow mt-5 mb-4 sorry-page" id="main">
            <div class="row" id="photo">
                <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Image">
            </div>
            <h1 class="text-danger text-center mt-0 " id="sorry">SORRY</h1>
            <p class="text-center mt-3 pt-3" id="content">We are supporting portrait mode only for now. Please switch the mode</p>
            <br>
            <br>
        </div>
    </div>


    <div class="modal fade pullDown login-body border-0 modal-refer betaversion" id="modal-refer" role="dialog" aria-labelledby="modalLabelnews">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="btn times" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <div class="eiliana-logo">
                        <img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="SVG">
                        <h4>Beta Version</h4>
                        <div class="beta-parent">
                            <p>We are pleased to welcome you to experience the beta version of our portal. Currently we are open for freelancers and agencies registration only.</p>
                            {{-- <p>We are pleased to welcome you to experience the beta version of our portal.
                            <br> This section is still in the finalization phase , kindly bear with us.</p> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer eiliana-refer">
                    <button class="btn btn-outline-primary red-linear-gradient" type="button" data-dismiss="modal"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- now code for registeration popup model -->
    <div class="modal fade pullDown login-body border-0 reg-refer betaversion" id="reg-refer" role="dialog" aria-labelledby="modalLabelnews">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="btn times" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <div class="eiliana-logo">
                        <img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="SVG">
                        <!-- <h4>Beta Version</h4> -->
                        <div class="beta-parent" id="msg">
                            <p>Account sucessfully created, Redirect to profile!</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer eiliana-refer">
                    <a id="link" class="btn btn-outline-primary red-linear-gradient" href="{{url('profile')}}">OK</a>
                    <!-- <button class="btn btn-outline-primary red-linear-gradient" type="button" data-dismiss="modal"><span class="spinner-border spinner-border-sm mr-1 d-none"></span> Close</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Section Start -->
    <footer class="custome-footer">
        <div class="container space-1">
            <div class="row mb-9">
                <div class="col-lg-3 mb-5 mb-lg-0">
                    <h5 class="text-white font-weight-500">Categories</h5>
                    <!-- Nav Link -->
                    <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                        @foreach($categories as $category)
                            @if (Session::get('users')['login_as'] == '1')
                                <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ url('search-project') . '/' .$category->slug}}">{{ $category->name}}</a></li>
                                @elseif (Session::get('users')['login_as'] == '2')
                                <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ url('search-project') . '/' .$category->slug}}">{{ $category->name}}</a></li>
                                @else
                                <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ url('user-type') . '/' .$category->slug}}">{{ $category->name}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <!-- End Nav Link -->
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-5 mb-lg-0">
                    <h5 class="text-white font-weight-500">Features</h5>
                    <!-- Nav Link -->
                    <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                        {{-- <li class="nav-item"><a class="nav-link text-white pl-0" onclick="togglePopup()" href="#">Press</a></li> --}}
                        <li class="nav-item"><a class="nav-link text-white pl-0" onclick="togglePopup()">Release notes</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" onclick="togglePopup()">Integrations</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" onclick="togglePopup()">Pricing</a></li>
                        {{-- <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ route('pricingplan') }}">Pricing</a></li> --}}
                    </ul>
                    <!-- End Nav Link -->
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-5 mb-lg-0">
                    <h5 class="text-white font-weight-500">Company</h5>
                    <!-- Nav Link -->
                    <ul class="nav nav-sm nav-x-0 nav-white flex-column">
                        {{-- <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ route('about') }}">About</a></li> --}}
                        <li class="nav-item"><a class="nav-link text-white pl-0" onclick="togglePopup()">About</a></li>
                        {{-- <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ route('careers') }}">Careers</a></li> --}}
                        <li class="nav-item"><a class="nav-link text-white pl-0" onclick="togglePopup()">Careers</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ route('blog') }}">Blogs</a></li>
                        {{-- <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ route('customers') }}">Customers</a></li> --}}
                        <li class="nav-item"><a class="nav-link text-white pl-0" onclick="togglePopup()">Customers</a></li>
                        {{-- <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ route('hire-us') }}">Hire us</a></li> --}}
                        <li class="nav-item"><a class="nav-link text-white pl-0" onclick="togglePopup()">Hire us</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ route('termsandconditions') }}">Terms & Privacy Policy</a></li>
                        <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ route('contact-us') }}">Contact Us</a></li>
                        {{-- <li class="nav-item"><a class="nav-link text-white pl-0" href="{{ route('sitemap') }}">Sitemap</a></li> --}}
                        <li class="nav-item"><a class="nav-link text-white pl-0" onclick="togglePopup()">Sitemap</a></li>
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
                            <a class="btn btn-icon btn-ghost-light bg-facebook" href="https://www.facebook.com/eilianaglobal" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-icon btn-ghost-light bg-twitter" href="https://twitter.com/ComEiliana" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-icon btn-ghost-light bg-linkedin" href="https://www.linkedin.com/company/76387030/admin/" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-icon btn-ghost-light bg-instagram" href="https://www.instagram.com/eiliana_global/" target="_blank">
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
    <script type="text/javascript" src="{{ asset('/assets/js/custom.js') }}"></script>
    <script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
    <script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('js/pages/form_examples.js') }}"></script>
    <!--global js end-->
    <script>
        function togglePopupHome(){
            $('#modal-refer').modal('show');
        }
        function toggleRegPopup()
        {
            
            $('#reg-refer').modal('show');
        }
        function togglePopup(){
            
            $('#modal-refer').modal('show');
            $('.beta-parent').html('<p>We are pleased to welcome you to experience the beta version of our portal. This section is still in the finalization phase , kindly bear with us.</p>');
        }
    </script>
    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->

</body>

</html>
