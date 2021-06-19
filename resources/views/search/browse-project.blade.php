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
        <a href="{{ url('advance-search/projects')}}" class="btn btn-block btn-lg btn-secondary">Advance Search</a>
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
<div class="browse-contract-staffing">
    <div class="mb-3 mb-lg-5">
        <ul class="list-unstyled">
            <!-- Project -->
            @forelse ($projects as $project)
            <li class="card p-4 mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="contract-body">
                            <div class="row no-gutters">
                                @if($project->referral_id != '0')
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <span class="display-5" style="font-size: 16px;">Posted By - Eiliana Sales Referral Program</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contract-profile mb-1 text-right">
                                            <img src="{{ asset('assets/img/logo.png') }}" alt="..." class="img-fluid w-25"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <div class="display-5">Project Title</div>
                                            <a href="{{ url('project') }}/{{ $project->project_id }}" class="h3">{{ $project->project_title }}</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contract-profile mb-1 text-right">
                                            
                                        </div>
                                    </div>
                                @else
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <div class="display-5">Project Title</div>
                                        <a href="{{ url('project') }}/{{ $project->project_id }}" class="h3">{{ $project->project_title }}</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contract-profile mb-1 text-right">
                                        <img src="{{ asset('assets/img/logo.png') }}" alt="..." class="img-fluid w-25"/>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <div class="display-5">Project Summary</div>
                                <p class="description">{!! \Illuminate\Support\Str::words($project->project_summary, 50,'...')  !!}</p>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Budget</div>
                                        <p><span>{{ $project->projectCurrency->symbol  }}</span>
                                            {{round($project->projectamount->project_amount_to, 2)}}
                                            @if ($project->projectamount->pricing_model == '1') 
                                                <span>Rate Per Hour</span>
                                            @elseif($project->projectamount->pricing_model == '2')
                                                <span>Rate Per Month</span>
                                            @else
                                                <span>Project Cost</span> 
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Project Sub Category</div>
                                        <p>{{ $project->projectsubcategory->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Customer Industry</div>
                                        <p>{{ $project->customerindustry1->name }}</p>
                                        {{-- <p>@if($project->locations != null){{ $project->locations->name }}@endif</p> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 duration">
                                        <div class="display-5">Technology</div>
                                        @foreach (App\Models\Technology::whereIn('technology_id', explode(',', $project->technologty_pre))->get() as $data)
                                            {{ $data->technology_name }}
                                            @if (!$loop->last)
                                                ,
                                            @endif                                          
                                        @endforeach
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
            {{ $projects->withQueryString()->links() }}
        </ul>
    </div>
</div>
@stop
