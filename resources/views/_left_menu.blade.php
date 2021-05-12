<!-- Navbar -->
<!-- <div class="navbar-expand-lg navbar-expand-lg-collapse-block navbar-light"> collapse -->
<div id="sidebarNav" class="navbar-collapse">
    <!-- Card -->
    <div class="card mb-5 shadow">
        <div class="card-body">
            <div class="basic-padding">
                <div class="mb-2">
                    <h5 class="card-title">Welcome back,</h5>
                    <p>{{ Sentinel::getUser()->full_name }}</p>
                </div>
            </div>
            <div class="basic-list">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action {!! (Request::is('home') ? 'active' : '' ) !!}" href="{{ url('home') }}">Dashboard</a>
                    <a class="list-group-item list-group-item-action {!! (Request::is('profile') ? 'active' : '' ) !!}" href="{{ url('profile') }}">Update Profile</a>
                    {{--<div class="singup-body login-body profile-basic">
                        <div class="card-body p-4">
                            <form action="{{ url('/profile/updateProfileResume') }}" method="POST" id="basic_form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group basic-file">
                                    <label>Attach Resume</label>
                                    <div class="custom-file" style="height: calc(1.5em + 0.75rem + 8px);">
                                        <input type="file" class="custom-file-input" id="customFile" name="resume_file">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">
                                    <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                    Next >>>
                                </button>
                            </form>
                        </div>
                    </div> --}}
                    {{-- @if(!Sentinel::inRole('user')) --}}
                    @if (Session::get('users')['login_as'] == '1')
                    <a class="list-group-item list-group-item-action {!! (Request::is('team') ? 'active' : '' ) !!}" href="{{ url('company/teams') }}">Teams</a>
                    @endif
                </div>
            </div>
        </div>
  </div>
  <!-- End Card -->
</div>
<!-- </div> -->
<!-- End Navbar -->
