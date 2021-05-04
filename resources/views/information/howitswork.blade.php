@extends('layouts/default')

{{-- Page title --}}
@section('title')
How Its Work
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick-carousel/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/index.css') }}">
<!--end of page level css-->
@stop

{{-- content --}}
@section('content')
<div class="account-page">
    <div class="bg-red">
      <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">How Its Work</span>
        </div>
      </div>
    </div>
    <div class="col-md-12 md-2 mt-2 howitswork">
        <div class="container">
            <div class="row">
                <div class="col p-0">
                    <section class="section container our-solution space-2">
                        <div class="text-center" style="margin-bottom: 20px;height: 110px;">
                            <h1 class="headingmain1">How It Works</h1>
                            <p class="subtitle1">At Eiliana, we believe that we’re the bridge between the one’s who help talents find the right project and clients
                                find the right talent for their job. Checkout our process below <br>to see how we go about doing that.</p>
                            <div class=""></div>
                        </div>
                        <div class="title col-md-4 md-2 mt-6">
                            <h1 class="red">Freelancer</h1>
                        </div>
                        <div class="col-md-8 md-2 mt-6 freelancer">
                             <p>Bring your Skills, find opportunities at each level of your freelancing career,
                                meet clients you’re excited to work with at your own comfort zone, exploring
                                new ways of earning and take your career to new heights.</p>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/sign-up1.png" alt="png">
                                        </figure>
                                        <h6 class="red">Sign Up</h6>
                                        <p>Register yourself free at our portal and explore the new ways of
                                             increasing your income</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/create-your-profile.png" alt="png">
                                        </figure>
                                        <h6 class="red">Create Your Profile</h6>
                                        <p>Outline your profile by defining your core skills and services you offer, create your
                                             portfolio including your area of expertise and stand out from the crowd.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/job-posting.png" alt="png">
                                        </figure>
                                        <h6 class="red">View Current Job Posting</h6>
                                        <p>Browse all the job
                                            listings filtered based on your skills and get
                                            notified when the right job is available or directly search.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/best-bid.png" alt="png">
                                        </figure>
                                        <h6 class="red">Submit your best bid</h6>
                                        <p>Study the project and put your best foot forward showcasing your
                                            ability to do the job and why you should be considered for the project.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/hired-and-earn.png" alt="png">
                                        </figure>
                                        <h6 class="red">Get Hired and Earn</h6>
                                        <p>Finalize the agreement to start work, deliver high
                                            quality work and earn the predetermined amount and as per the schedule.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section container our-solution space-2">

                        <div class="title col-md-4 md-2 mt-6">
                            <h1 class="red">Client</h1>
                        </div>
                        <div class="col-md-8 md-2 mt-6 client">
                             <p>With endless opportunities to explore, we provide expert freelancers based on
                                the skill set and expertise required to fulfill your project enabling you to upgrade
                                and grow your business. Turn on the spark of your business idea into reality.</p>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/sign-up2.png" alt="png">
                                        </figure>
                                        <h6 class="red">Sign Up</h6>
                                        <p>Register yourself free at our portal and open the
                                            door of growing your business</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/post-your-project.png" alt="png">
                                        </figure>
                                        <h6 class="red">Post your Project</h6>
                                        <p>Broadcast your project details based on your key skill and expertise requirement to
                                            complete the project and start receiving the competitive bids from freelancers.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/search-your-freelancer.png" alt="png">
                                        </figure>
                                        <h6 class="red">Search your Freelancer</h6>
                                        <p>Find excelled quality freelancer which are perfect for your project ,
                                            review their profile performance, feedback and connect with them accordingly, </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/finalize-the-project.png" alt="png">
                                        </figure>
                                        <h6 class="red">Finalize the Project</h6>
                                        <p>Compare the proposal and choose best fit for your work.Agree on the scope of work,
                                            payment terms and deliverable mutually and start the project work. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="our-slotuion mb-3 mt-3">
                            <div class="">
                                <div class="it_work">
                                    <div class="text-center px-lg-3 shadow p-4 mb-3 mt-3 border">
                                        <figure class="max-w-10rem mx-auto mb-2">
                                            <img class="img-fluid" src="/assets/img/icons/pay-as-per-schedule.png" alt="png">
                                        </figure>
                                        <h6 class="red">Pay as per Schedule</h6>
                                        <p>Decide your payment schedule well in advance and ask the eiliana.com to
                                            release the funds to the freelancer once the milestone is achieved.  </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</div>

@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!-- page level js starts-->
<script type="text/javascript" src="{{ asset('js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/wow/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/slick-carousel/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/index.js') }}"></script>
<!--page level js ends-->
@stop
