<!-- Navbar -->
<!-- <div class="navbar-expand-lg navbar-expand-lg-collapse-block navbar-light"> collapse -->
<div id="sidebarNav" class="navbar-collapse navbar-vertical " style="">
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
                    {{-- <a class="list-group-item list-group-item-action {!! (Request::is('my-project') ? 'active' : '' ) !!}" href="{{ url('my-project') }}">My Project</a> --}}
                    <!-- <a class="list-group-item list-group-item-action {!! (Request::is('portfolio') ? 'active' : '' ) !!}" href="{{ url('portfolio') }}">Portfolio</a> -->
                </div>
            </div>
        </div>
  </div>
  <!-- End Card -->
</div>
<!-- </div> -->
<!-- End Navbar -->
