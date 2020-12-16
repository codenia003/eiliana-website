<div id="sidebarNav" class="navbar-collapse navbar-vertical " style="">
    <!-- Card -->
    <div class="card mb-5 shadow d-none">
        <div class="card-body">
            <div class="basic-padding">
                <!-- <div class="form-group basic-info mb-5 text-center">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="public" name="anonymous" class="custom-control-input" value="0" {{ (Sentinel::getUser()->anonymous=="0")? "checked" : "" }} onchange="changeAnonymus(event)">
                            <label class="custom-control-label" for="public">Public</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="anonymous" name="anonymous" class="custom-control-input" value="1" {{ (Sentinel::getUser()->anonymous=="1")? "checked" : "" }} onchange="changeAnonymus(event)">
                            <label class="custom-control-label" for="anonymous">Anonymus</label>
                        </div>
                    </div>
                </div> -->
                <!-- Avatar -->
                <div class="text-center mb-5">
                    <div class="avatar avatar-xxl avatar-circle mb-3">
                        
                        
                        <div>
                            @if(Sentinel::getUser()->pic)
                            <img class="image-preview avatar-img" src="#" class="avatar" alt="Avatar">
                            @else
                            <img class="avatar-img" src="/assets/img/profile/avatar_icon.png" alt="Image Description">
                            @endif
                            <span class="border-circle-green"></span>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <h5 class="card-title text-secondary">{{ Sentinel::getUser()->full_name }}  <button class="btn btn-white float-right"><i class="fa fa-pencil" aria-hidden="true"></i></button></h5>
                    
                    <p class="card-text font-size-1">{{ Sentinel::getUser()->city }} {{ Session::get('users')['country_name'] }} - {{ \Carbon\Carbon::parse(Sentinel::getUser()->created_at)->format('F d, Y, g:m a')}}</p>
                </div>
            </div>
            <div class="basic-list">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action {!! (Request::is('profile') ? 'active' : '' ) !!}" href="/profile">Primary Information</a>
                    <!-- <a class="list-group-item list-group-item-action" href="/profile/addtional-info">Additional Information</a> -->
                    <a class="list-group-item list-group-item-action {!! (Request::is('profile/education') ? 'active' : '' ) !!}" href="/profile/education">Education</a>
                    <a class="list-group-item list-group-item-action {!! (Request::is('profile/certification') ? 'active' : '' ) !!}" href="/profile/certification">Certification</a>
                    <a class="list-group-item list-group-item-action {!! (Request::is('profile/professional-experience') ? 'active' : '' ) !!}" href="/profile/professional-experience">Professional Experience</a>
                    <!-- <a class="list-group-item list-group-item-action {!! (Request::is('profile/tax') ? 'active' : '' ) !!}" href="/profile/tax">Tax Information</a>
                    <a class="list-group-item list-group-item-action {!! (Request::is('profile/financial') ? 'active' : '' ) !!}" href="/profile/financial">Financial Accounts</a>
                    <a class="list-group-item list-group-item-action" href="/profile">Membership & Credits</a>
                    <a class="list-group-item list-group-item-action" href="/profile">Members (Connections), Teams and Permissions</a> -->
                    <a class="list-group-item list-group-item-action" href="/profile">Company Settings</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Card -->
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
                        <a class="list-group-item list-group-item-action bg-white-b active" href="/profile">
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
