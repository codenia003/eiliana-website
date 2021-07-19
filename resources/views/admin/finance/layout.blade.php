<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @section('title')
            | Eiliana Invoice
        @show
    </title>

    <!-- global css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/invoice.css') }}">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- API 2 -->
    <script type="text/javascript" src="http://www.stampready.net/api2/api.js"></script>
    <!-- end of global css -->

    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
<style>

        @import url('https://fonts.googleapis.com/css?family=Montserrat');
        @import url('https://fonts.googleapis.com/css?family=Open Sans');

        .container{
            margin-top:20px;
        }
        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }
        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .image-preview-input-title {
            margin-left:2px;
        }
        .image_radius{
            border-top-right-radius: 4px !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-bottom-right-radius: 4px !important;
        }
        .fileinput .thumbnail > img{
            width:100%;
        }
        .color_a{
            color: #333;
        }
        .btn-file > input{
            width: auto;
        }
        #modalLabelnews1 {
            color: #003466;
            border-bottom: #003466;
            text-align: center;
       }
       #modalLabelnews1:after {
            content: " ";
            border-bottom-style: double;
            border-bottom-width: 1px;
            display: block;
            width: 32%;
            text-align: center;
            margin: auto !important;
        }

        .page-sidebar .page-sidebar-menu .sub-menu li > a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu .sub-menu li > a {
            display: block;
            margin: 0;
            padding: 10px 15px 10px 30px;
            text-decoration: none;
            font-size: 13px;
            background: none;
        }
    </style>
<body class="skin-josh">
<header class="header">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <img src="{{ asset('assets/img/logo-dark.png') }}" alt="logo" style="width: 50%;">
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right toggle">
            <ul class="nav navbar-nav  list-inline">
                
                @include('admin.layouts._notifications')
                <li class=" nav-item dropdown user user-menu">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        @if(Sentinel::getUser()->pic)
                            <img src="{{ Sentinel::getUser()->pic }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>

                        @elseif(Sentinel::getUser()->gender === "male")
                            <img src="{{ asset('images/authors/avatar3.png') }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>

                        @elseif(Sentinel::getUser()->gender === "female")
                            <img src="{{ asset('images/authors/avatar5.png') }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>

                        @else
                            <img src="{{ asset('images/authors/no_avatar.jpg') }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>
                        @endif
                        <div class="riot">
                            <div>
                                <p class="user_name_max">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            @if(Sentinel::getUser()->pic)
                                <img src="{{  Sentinel::getUser()->pic }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>

                            @elseif(Sentinel::getUser()->gender === "male")
                                <img src="{{ asset('images/authors/avatar3.png') }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>

                            @elseif(Sentinel::getUser()->gender === "female")
                                <img src="{{ asset('images/authors/avatar5.png') }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>
                            @else
                                <img src="{{ asset('images/authors/no_avatar.jpg') }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>
                            @endif
                            <p class="topprofiletext">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
                        </li>
                        <!-- Menu Body -->
                        {{-- <li>
                            <a href="{{ URL::route('admin.users.show',Sentinel::getUser()->id) }}">
                                <i class="livicon" data-name="user" data-s="18"></i>
                                My Profile
                            </a>
                        </li> --}}
                        <li role="presentation"></li>
                        {{-- <li>
                            <a href="{{ route('admin.users.edit', Sentinel::getUser()->id) }}">
                                <i class="livicon" data-name="gears" data-s="18"></i>
                                Account Settings
                            </a>
                        </li> --}}
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="float-left">
                                <a href="{{ URL::route('lockscreen',Sentinel::getUser()->id) }}">
                                    <i class="livicon" data-name="lock" data-size="16" data-c="#555555" data-hc="#555555" data-loop="true"></i>
                                    Lock
                                </a>
                            </div>
                            <div class="float-right">
                                <a href="{{ URL::to('admin/logout') }}">
                                    <i class="livicon" data-name="sign-out" data-s="18"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>
<div class="wrapper ">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side ">
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">
                <div class="nav_icons">
                    <ul class="sidebar_threeicons">
                        <li>
                            <a href="{{ URL::to('#') }}">
                                <i class="livicon" data-name="table" title="Advanced tables" data-loop="true"
                                   data-color="#418BCA" data-hc="#418BCA" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('#') }}">
                                <i class="livicon" data-name="list-ul" title="Tasks" data-loop="true"
                                   data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('#') }}">
                                <i class="livicon" data-name="image" title="Gallery" data-loop="true"
                                   data-color="#F89A14" data-hc="#F89A14" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('#') }}">
                                <i class="livicon" data-name="user" title="Users" data-loop="true"
                                   data-color="#6CC66C" data-hc="#6CC66C" data-s="25"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
                @include('admin.layouts._left_menu')
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side">

        <!-- Notifications -->
        <div id="notific">
        @include('notifications')
        </div>
         <!-- Content -->
        @yield('content')

    </aside>
    <!-- right-side -->
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top"
   data-toggle="tooltip" data-placement="left">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>
<!-- global js -->

<script src="{{ asset('js/admin.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/sweetalert/js/sweetalert2.js') }}" type="text/javascript"></script>
<!-- end of global js -->
<!-- begin page level js -->
@yield('footer_scripts')
<script>
 function sendToCustomer(project_leads_id){
    $('.spinner-border').removeClass("d-none");
    var url = '/admin/finance/send-to-customer';
    var data= {
        _token: "{{ csrf_token() }}",
        project_leads_id: project_leads_id
    };
    console.log(data);
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
</body>
</html>
