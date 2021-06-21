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
                                   @if($job->referral_id != '0')
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                              <span class="h5 card-title" style="font-weight: 600;"> Posted By: </span> 
                                              <span class="h5 font-weight-500" style="font-size: 15px;color: red;font-weight: bolder;">Eiliana Sales Referral Program</span>
                                                <!-- <span class="display-5" style="font-size: 16px;">Posted By - Eiliana Sales Referral Program</span> -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="contract-profile mb-1 text-right">
                                                <img src="{{ asset('assets/img/logo.png') }}" alt="..." class="img-fluid"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <div class="display-5">Job Title</div>
                                                <a href="{{ route('jobdetails', $job->job_id) }}" class="h3">{{ $job->job_title }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="contract-profile mb-1 text-right">
                                                
                                            </div>
                                        </div>
                                    @else
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <div class="display-5">Job Title</div>
                                            <a href="{{ route('jobdetails', $job->job_id) }}" class="h3">{{ $job->job_title }}</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contract-profile mb-1 text-right">
                                            <img src="{{ asset('assets/img/logo.png') }}" alt="..." class="img-fluid"/>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="mb-4">
                                <div class="display-5">Job Description</div>
                                <p class="description">{!! \Illuminate\Support\Str::words($job->role_summary, 50,'...')  !!}</p>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Customer Industry</div>
                                        <p>{{ $job->customerindustry1->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Experience required</div>
                                        <p>{{ $job->experience_year }} Year to {{ $job->experience_month }} Year</p>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Location</div>
                                        <p>@if($job->location != null){{ $job->locations->name }}@endif</p>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="mb-3 duration">
                                        <div class="display-5">Budget Per Month</div>
                                        <p>{{ $job->budget_from }} to {{ $job->budget_to }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 duration">
                                        <div class="display-5">Contract Duration</div>
                                        <p>{{ $job->contract_duration_from }} Month to {{ $job->contract_duration_to }} Month</p>
                                    </div>
                                </div>
                                @if($job->referral_id != '0') 
                                    <div class="col-md-6"> 
                                        <div class="mb-2">
                                            <div class="display-5">Eiliana Sales Referral Program</div>
                                        </div>
                                    </div>
                                @endif
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