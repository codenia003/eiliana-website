@extends('search/layout')
@section('search_tab_content')
<div class="row">
    <div class="col-md-10 col-lg-10 col-sm-10 col-10 mb-5">
        <div class="bs-advanced">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#" role="tab"
                        aria-controls="home" aria-selected="true">My Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" id="team-tab" data-toggle="tab" href="#" role="tab"
                        aria-controls="team" aria-selected="false">Create Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" id="saved-tab" data-toggle="tab" href="#" role="tab"
                        aria-controls="saved" aria-selected="false">Saved Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" id="modify-tab" data-toggle="tab" href="#" role="tab"
                        aria-controls="modify" aria-selected="false">Modify Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" id="live-tab" data-toggle="tab" href="#" role="tab"
                        aria-controls="live" aria-selected="false">Live Chat</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-lg-2 col-sm-2 col-2 mb-5 btn-advanced">
        <a href="{{ url('advance-search/jobs')}}" class="btn btn-block btn-lg btn-secondary">Advance Search</a>
        {{-- <div class="btn-group btn-advanced">
            <button type="button" class="btn btn-block btn-lg btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-filter"></i>
                Sort By
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#"> Option Link 1</a>
                <a class="dropdown-item" href="#">Option Link 2 </a>
                <a class="dropdown-item" href="#">Option Link 3</a>
            </div>
        </div> --}}
    </div>
</div>
@stop
@section('search_content')
<div class="browse-job-posting">
    <div class="mb-3 mb-lg-5">
        <ul class="list-unstyled">
            <!-- Project -->
            @forelse ($jobs as $job)
            <li class="card p-4 mb-4">
                <div class="row no-gutters">
                    <div class="col-md-3 d-none">
                        <div class="contract-profile mb-1">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="..." class="img-fluid"/>
                        </div>
                        <div class="contract-apply text-center">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="#" class="btn-icon"><img class="img-fluid" src="/assets/img/icons/icon-5.png" alt="Avatar"></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn-icon"><img class="img-fluid" src="/assets/img/icons/icon-6.png" alt="Avatar"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="refer-a-friend">
                            <a href="#" class="" title="">Refer a friend</a>
                        </div>
                        <div class="user-details">

                        </div>
                    </div>
                    <div class="col-md-12">
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
                                        <img src="{{ asset('assets/img/logo.png') }}" alt="..." class="img-fluid"/>
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
                                        <div class="display-5">Industry</div>
                                        <p>{{ $job->profile_headline }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Experience</div>
                                        <p>{{ $job->experience_year }} Years {{ $job->experience_month }} Month</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Location</div>
                                        <p>Delhi</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 duration">
                                        <div class="display-5">Duration of Project</div>
                                        <p>10</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <li class="card p-4 mb-4">
                <div class="text-center d-block">
                    <div>Search list is empty</div>
                </div>
            </li>
            @endforelse
            <!-- End Project -->
        </ul>
        <ul class="pager">
            {{ $jobs->withQueryString()->links() }}
        </ul>
    </div>
</div>
@stop
