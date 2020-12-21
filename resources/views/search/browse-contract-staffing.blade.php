@extends('search/layout')

@section('search_content')
<div class="browse-project">
    @if (count($projects) >= 1)
    <div class="card mb-3 mb-lg-5">
        <!-- Sorting -->
        <div class="row align-items-center p-4">
            <div class="col-lg-7 mb-3 mb-lg-0">
                <select class="js-custom-select mr-2">
                    <option value="sort1">Newest first</option>
                    <option value="sort2">Low budget first</option>
                    <option value="sort3">High budget first</option>
                    <option value="sort4">Low bid/entry</option>
                    <option value="sort5">High bid/entry</option>
                </select>            
                <span class="font-size-1 ml-1">{{ $count }} Projects jobs found</span>
            </div>
        </div>
        <!-- End Sorting -->
        <ul class="list-unstyled border-top">
            @foreach ($projects as $project)
            <!-- Project -->
            <li class="card border-bottom shadow-none p-4">
                <div class="row no-gutters">
                    <div class="col-md-9">
                        <div class="card-body">
                            <div class="mb-4">
                                <span class="d-block font-size-1">
                                    <a class="text-inherit text-dark font-weight-700 mr-1" href="/project/{{ $project['project_id'] }}">{{ $project['project_name'] }}</a>
                                    <span class="text-left ml-1">{{ $project['expiry_days'] }} Days left</span>
                                    <span class="badge badge-success badge-pill ml-1">Verified</span>
                                </span>
                            </div>
                            <div class="mb-3">
                               <p class="project-description">{{ $project['project_description'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="project-price mb-3">
                            <strong>$123</strong>
                            <span> (Avg Bid)</span>
                        </div>
                        <div class="project-bids">
                            <span>3 bids</span>
                        </div>
                        <!-- <a href="apply/{{ $project['project_id'] }}" class="btn btn-primary bg-orange mr-1 my-2">Apply</a> -->
                    </div>
                </div>
            </li>
            <!-- End Project -->
            @endforeach
        </ul>
    </div>
    @else
    <div class="card mb-3 mb-lg-5 p-4 text-center d-block">
        <!-- <div class="spinner-border spinner-border-lg"></div> -->
        <div>Search list is empty</div>
    </div>
    @endif
</div>
@stop