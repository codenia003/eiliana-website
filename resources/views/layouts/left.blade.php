<div class="col-lg-4 col-md-4 col-sm-4 col-12">
    <div id="sidebarNav" class="navbar-collapse navbar-vertical " style="">
        <div class="position-relative max-w-50rem mx-auto mobile-profile">
            <!-- Device Mockup -->
            <div class="device device-iphone-x w-100 mx-auto">
                <img class="device-iphone-x-frame" src="/assets/img/profile/mobile-bg.png" alt="Image Description">
                <div class="device-iphone-x-screen">
                    @if(Sentinel::getUser()->pic)
                    <div class="top-mobile bg-blue bg-img-hero" style="background-image: url({{ url('/') }}{{ Sentinel::getUser()->pic }});">
                    @else
                    <div class="top-mobile bg-blue bg-img-hero" style="background-image: url(/assets/img/profile/mobile-profile.png);">
                    @endif
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-8">
                                <div class="img-upload">
                                    <img class="image-preview avatar-img" src="/assets/img/profile/m-photo-icon.png" class="avatar" alt="Avatar">
                                    <span><button class="btn" style="color: white;background: none;margin-left: -22px;font-weight: inherit;" onclick="imageUpload(event)">Upload Photo</button></span>
                                </div>
                                @isset(Sentinel::getUser()->full_name)
                                <button class="btn">{{ Sentinel::getUser()->full_name }}</button>
                                @endisset
                                <p class="card-text font-size-1">
                                    @isset(Sentinel::getUser()->city)
                                    {{ Sentinel::getUser()->city }},
                                    @endisset
                                    {{ Session::get('users')['country_name'] }}
                                    <br>
                                    @isset(Sentinel::getUser()->created_at)
                                    {{ \Carbon\Carbon::parse(Sentinel::getUser()->created_at)->format('M d, Y')}}
                                    @endisset
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
                            <a class="list-group-item list-group-item-action bg-white-b {!! (Request::is('profile/projects') ? 'active' : '' ) !!}" href="/profile/projects">
                                <img class="img-fluid" src="/assets/img/profile/icon-5.png" alt="Avatar">
                                <span> Projects</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Device Mockup -->
        </div>
    </div>
</div>


<div class="modal fade pullDown login-long-body border-0" id="modalIimage" role="dialog" aria-labelledby="modalLabelnews">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue text-white">
                <h4 class="modal-title" id="exampleModalLabel">Upload Image</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/profile/uploadProfilePic') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="control-label">Profile Photo:</label>
                            </div>
                            <div class="col-lg-10">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 200px;">
                                        @if(Sentinel::getUser()->pic)
                                            <img src="{{ url('/') }}{{ Sentinel::getUser()->pic }}" alt="img"
                                                class="img-fluid"/>
                                        @else
                                            <img src="{{ asset('assets/img/profile/mobile-profile.png') }}" alt="..."
                                                class="img-fluid"/>
                                        @endif
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-primary btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="pic" id="pic" />
                                        </span>
                                        <span class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">
                        <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function imageUpload(input) {
        $("#modalIimage").modal('show');
    }
</script>
