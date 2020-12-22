@extends('search/layout')

@section('search_content')
<div class="browse-project">
    <div class="mb-3 mb-lg-5">
        <ul class="list-unstyled">
            <!-- Project -->
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
                                        <div class="display-5">Key Skills</div>
                                        <p>Website Designing</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contract-profile mb-1">
                                        <img src="{{ asset('assets/img/logo.png') }}" alt="..." class="img-fluid"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="display-5">Job Description</div>
                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Industry</div>
                                        <p>Website Designing</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Experience</div>
                                        <p>4 Years 5 Month</p>
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
                                        <div class="display-5">Key Skills</div>
                                        <p>Website Designing</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contract-profile mb-1">
                                        <img src="https://codeniatechnologies.com/images/codenia-logo.png" alt="..." class="img-fluid"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="display-5">Job Description</div>
                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Industry</div>
                                        <p>Website Designing</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="display-5">Experience</div>
                                        <p>4 Years 5 Month</p>
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
            <!-- End Project -->
        </ul>
    </div>
    <!-- <div class="card mb-3 mb-lg-5 p-4 text-center d-block">
        <div>Search list is empty</div>
    </div> -->
</div>
@stop