@extends('layouts/default')

{{-- Page title --}}
@section('title')
Job Post
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('vendors/switchery/css/switchery.css') }}" />
<!--end of page level css-->
<style>
    .eiliana-btn {
        height: 47px;
    }
</style>
@stop

{{-- content --}}
@section('content')
<div class="job-post">
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fa fa-bars"></i></span>
                <span class="h5 text-white ml-2">Job Post</span>
            </div>
        </div>
    </div>
    <div class="shadow1">
        <div class="container space-1 space-top-lg-0 mt-lg-n10">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="mb-4 mt-3 text-right">
                        {{-- <button class="btn btn-md btn-info eiliana-btn" type="button">Save Job <i class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-md btn-info ml-3 eiliana-btn">Modify Job <i class="far fa-edit"></i></button> --}}
                    </div>
                </div>
                <!-- <div class="col-lg-1 col-md-1 col-sm-2 col-12"></div> -->
                <div class="col-lg-8 col-md-10 col-sm-8 col-12 pr-0">
                    <div id="notific">
                        @include('notifications')
                    </div>
                    <div class="advance-search singup-body login-body">
                        <form action="{{ url('/post-job-on') }}" method="POST" id="postJobForm" enctype="multipart/form-data">
                            @csrf
                            @isset(Session::get('sales_referral')['referral_id'])
                            <input type="hidden" name="referral_id" value="{{ Session::get('sales_referral')['referral_id'] }}">
                            @endisset
                            @isset(Session::get('contractsattfing')['model_engagement'])
                            <input type="hidden" name="model_engagement" value="{{ Session::get('contractsattfing')['model_engagement'] }}">
                            @endisset
                            @empty(Session::get('sales_referral')['referral_id'])
                            <input type="hidden" name="referral_id" value="0">
                            @endempty
                            <div class="card">
                                <div class="p-4">
                                    <div class="form-group">
                                        <label>About Company</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="about_company" rows="3">{{ Session::get('post_job_data')['about_company'] }}</textarea>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Notice Period(Months)</label>
                                            <br />
                                            <input type="number" name="contract_duration" class="form-control" value="{{ Session::get('post_job_data')['contract_duration'] }}" required />
                                        </div>
                                       @if(Session::get('contractsattfing')['location'])
                                        <div class="form-group col-6">
                                            <label>Location</label>
                                            <select name="location" class="form-control">
                                                <option value=""></option>
                                                @foreach ($locations as $location)
                                                <option value="{{ $location->location_id }}" {{ (Session::get('post_job_data')['location']==$location->location_id)? "selected" : "" }}>{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @else
                                        <div class="form-group col">
                                            <label>Location</label>
                                            <select name="location" class="form-control">
                                                <option value=""></option>
                                                @foreach ($locations as $location)
                                                <option value="{{ $location->location_id }}">{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                    </div>   
                                    
                                    <div class="form-group">
                                        <label>Job Title</label>
                                        <input type="text" name="job_title" class="form-control" value="{{ Session::get('post_job_data')['job_title'] }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Key Skills</label>
                                        <input type="text" name="key_skills" class="form-control" value="{{ Session::get('post_job_data')['key_skills'] }}" required />
                                    </div>
                                    {{--<div class="form-group">
                                        <label>Job Category </label>
                                        <select name="job_category" class="form-control" id="project_category" onchange="change_category();">
                                            @foreach ($jobcategorys as $category)
                                            <option value="{{ $category->id }}"  {{ (Session::get('projectcategory')['id']==$category->id)? "selected" : "" }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="project_sub">
                                        <label>Job Sub Category</label>
                                        <select name="job_sub_category" class="form-control" id="project_sub_category">
                                            <option value=""></option>
                                        </select>
                                    </div>--}}
                                    <div class="form-group">
                                        <label>Role Summary</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea2" name="role_summary" rows="3">{{ Session::get('post_job_data')['role_summary'] }}</textarea>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Total Experience</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <select class="form-control" name="experience_year">
                                                        @for ($i = 0; $i < 21; $i++)
                                                        <option value="{{ $i }}" {{ (Session::get('post_job_data')['experience_year']==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select class="form-control" name="experience_month">
                                                        @for ($i = 1; $i < 21; $i++)
                                                        <option value="{{ $i }}" {{ (Session::get('post_job_data')['experience_month']==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col">
                                            <label>Product Industry Exprience</label>
                                            <select name="product_industry_exprience" class="form-control" required>
                                                <option value=""></option>
                                                @foreach ($customerindustries as $industry)
                                                <option value="{{ $industry->customer_industry_id }}" {{ (Session::get('post_job_data')['product_industry_exprience']==$industry->customer_industry_id)? "selected" : "" }}>{{ $industry->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @if(!empty(Session::get('post_job_data')['technologty_pre']))
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>Technology Preference</label>
                                            <?php
                                                $technologty_pre = (array) Session::get('post_job_data')['technologty_pre'];
                                            ?>
                                            <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" multiple required>
                                                <option value=""></option>
                                                @foreach ($technologies as $technology) 
                                                <option value="{{ $technology->technology_id }}" {{ in_array($technology->technology_id, $technologty_pre) ? "selected" : "" }}>{{ $technology->technology_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label>Budget(Per Month)</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="budget_from" placeholder="From" value="{{ Session::get('post_job_data')['budget_from'] }}">
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" name="budget_to" placeholder="To" value="{{ Session::get('post_job_data')['budget_to'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-right mt-5">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary" onclick="location.href='/post-job'">Back</button>
                                            <button class="btn btn-primary" type="submit">
                                               Publish Online
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="col-lg-1 col-md-1 col-sm-2 col-12"></div> -->
               @include('layouts.left')
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/switchery/js/switchery.js') }}"></script>
<script>
$('#postJobForm').bootstrapValidator({});
$(window).bind("load", function() {
    change_category();
});    
$(document).ready(function() {
    $('#technologty_pre').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
    $('#framework').select2({
        theme: 'bootstrap',
        placeholder: 'Select a value',
    });
    $(".form-check-input").iCheck({
        checkboxClass: 'icheckbox_minimal-red',
    });
    var elem = document.querySelector('.js-switch2');
    var init = new Switchery(elem, {
        size: 'small',
        color: '#003466',
    });

    $(function(){
        $(".btn-copy-ug").on('click', function(){
            var element = '<div class="ug-qualification-3">'+$('.ug-qualification').html()+'</div>';
            $('.ug-qualification-1').append(element);

        });
        $(".btn-copy-pg").on('click', function(){
            var element = '<div class="pg-qualification-3">'+$('.pg-qualification').html()+'</div>';
            $('.pg-qualification-1').append(element);
        });
        $(".btn-copy-c").on('click', function(){
            var element = '<div class="certification-3">'+$('.certification').html()+'</div>';
            $('.certification-1').append(element);
        });

        // question start
        var i = 1;
        $(".btn-copy-q1").on('click', function(){
            // var count = $(".question1-3:last input#radio_count_id").val();

            var element = '<div class="question1-3 radioques'+i+'">'+$('.question1').html()+'</div>';
            $('.question1-1').append(element);

            $(".radioques"+i+"  .radioappend1").html('<input type="radio" id="Yes'+i+'" class="custom-control-input" name="question_radio'+i+'" value="1"><label class="custom-control-label" for="Yes'+i+'">Yes</label>');

            $(".radioques"+i+" .radioappend2").html('<input type="radio" id="No'+i+'" class="custom-control-input" name="question_radio'+i+'" value="0"><label class="custom-control-label" for="No'+i+'">No</label>');
            i++;

        });
        $(".btn-copy-q2").on('click', function(){
            var element = '<div class="question2-3">'+$('.question2').html()+'</div>';
            $('.question2-1').append(element);
        });
        $(".btn-copy-q3").on('click', function(){
            var element = '<div class="question3-3">'+$('.question3').html()+'</div>';
            $('.question3-1').append(element);
        });
        $(".btn-copy-q4").on('click', function(){
            var element = '<div class="question4-3">'+$('.question4').html()+'</div>';
            $('.question4-1').append(element);
        });
        $(".btn-copy-q5").on('click', function(){
            var element = '<div class="question5-3">'+$('.question5').html()+'</div>';
            $('.question5-1').append(element);
        });

        $(".btn-additional").on('click', function(){
            $('.additional-filter').removeClass("d-none");
            $('.btn-additional').addClass("d-none");
        });

        $(".btn-additional-ques").on('click', function(){
            $('.additional-filter-ques').removeClass("d-none");
            $('.btn-additional-ques').addClass("d-none");
        });

    });
    $(document).on('click','.remove-ug',function() {
        $(".ug-qualification-3:last").remove();
    });
    $(document).on('click','.remove-pg',function() {
        $(".pg-qualification-3:last").remove();
    });
    $(document).on('click','.remove-c',function() {
        $(".certification-3:last").remove();
    });

    // question start
    $(document).on('click','.remove-q1',function() {
        $(".question1-3:last").remove();
    });
    $(document).on('click','.remove-q2',function() {
        $(".question2-3:last").remove();
    });
    $(document).on('click','.remove-q3',function() {
        $(".question3-3:last").remove();
    });
    $(document).on('click','.remove-q4',function() {
        $(".question4-3:last").remove();
    });
    $(document).on('click','.remove-q5',function() {
        $(".question5-3:last").remove();
    });

});
</script>
<!--global js end-->
@stop
