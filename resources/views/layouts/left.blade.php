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
