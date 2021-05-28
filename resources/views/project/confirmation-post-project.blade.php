@extends('layouts/default')

{{-- Page title --}}
@section('title')
Post Project
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
@stop

{{-- content --}}
@section('content')
<div class="job-post">
    <div class="bg-red">
        <div class="px-5 py-2">
            <div class="align-items-center">
                <span class="border-title"><i class="fa fa-bars"></i></span>
                <span class="h5 text-white ml-2">Project Post</span>
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
                <div class="col-lg-8 col-md-8 col-sm-8 col-12 pr-0">
                    <div id="notific">
                        @include('notifications')
                    </div>
                    <div class="advance-search singup-body login-body">
                        <form action="{{ url('/post-project-on') }}" method="POST" id="postJobForm" enctype="multipart/form-data">
                            @csrf
                            @isset(Session::get('sales_referral')['referral_id'])
                            <input type="hidden" name="referral_id" value="{{ Session::get('sales_referral')['referral_id'] }}">
                            @endisset
                            @empty(Session::get('sales_referral')['referral_id'])
                            <input type="hidden" name="referral_id" value="0">
                            @endempty
                            <div class="card">
                                <div class="p-4">
                                    {{--<div class="form-group">
                                        <label>About Company</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="about_company" rows="3" required></textarea>
                                    </div>--}}
                                    <div class="form-group">
                                        <label>Project Category</label>
                                        <select name="project_category" class="form-control" id="project_category" onchange="change_category();" required>
                                            @foreach ($projectcategorys as $category)
                                            <option value="{{ $category->id }}" {{ (Session::get('post_project_data')['project_category']==$category->id )? "selected" : "" }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="project_sub">
                                        <label>Project Sub Category</label>
                                        <select name="project_sub_category" class="form-control" id="project_sub_category">
                                           @foreach ($subprojectcategorys as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ (Session::get('post_project_data')['project_sub_category']==$subcategory->id )? "selected" : "" }}>{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                     
                                    @if(!empty(Session::get('post_project_data')['technologty_pre']))
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>Technology Preference</label>
                                            <?php
                                                $technologty_pre = (array) Session::get('post_project_data')['technologty_pre'];
                                            ?>
                                            {{--<select name="technologty_pre[]" class="form-control select2" id="technologty_pre" onchange="change_framework();" multiple required>--}}
                                            <select name="technologty_pre[]" class="form-control select2" id="technologty_pre" multiple required>
                                                <option value=""></option>
                                                @foreach ($technologies as $technology) 
                                                <option value="{{ $technology->technology_id }}" {{ in_array($technology->technology_id, $technologty_pre) ? "selected" : "" }}>{{ $technology->technology_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    {{--<div class="form-group basic-info mb-3">
                                        <label>Pricing Model</label>
                                        <br />
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="hourly" class="custom-control-input" name="model_engagement" value="1" {{ (Session::get('contractsattfing')['model_engagement']=='1')? "checked" : "" }} onchange="changePricingModel()" checked="">
                                                <label class="custom-control-label" for="hourly">Hourly</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="retainership" class="custom-control-input" name="model_engagement" value="2" {{ (Session::get('contractsattfing')['model_engagement']=='2')? "checked" : "" }} onchange="changePricingModel()">
                                                <label class="custom-control-label" for="retainership">Retainership</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="projectbase" class="custom-control-input" name="model_engagement" value="3" {{ (Session::get('post_project_data')['model_engagement']=='3')? "checked" : "" }} onchange="changePricingModel()">
                                                <label class="custom-control-label" for="projectbase">Project Based</label>
                                            </div>
                                        </div>
                                    </div>--}}
                                    <div class="form-group basic-info mb-3">
                                        <label>Pricing Model</label>
                                        <br />
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="hourly" class="custom-control-input" name="model_engagement" value="1" {{ (Session::get('post_project_data')['model_engagement']=='1')? "checked" : "" }} onchange="changePricingModel()" checked="">
                                                <label class="custom-control-label" for="hourly">Hourly</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="retainership" class="custom-control-input" name="model_engagement" value="2" {{ (Session::get('post_project_data')['model_engagement']=='2')? "checked" : "" }} onchange="changePricingModel()">
                                                <label class="custom-control-label" for="retainership">Retainership</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="projectbase" class="custom-control-input" name="model_engagement" value="3" {{ (Session::get('post_project_data')['model_engagement']=='3')? "checked" : "" }} onchange="changePricingModel()">
                                                <label class="custom-control-label" for="projectbase">Project Based</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="hourly">Rate Per Hour</label>
                                        <label class="retainership d-none">Rate Per Month</label>
                                        <label class="project-based d-none">Total Project Amount</label>
                                        @if(Session::get('post_project_data')['model_engagement']=='1')
                                        <div class="form-row">
                                            <div class="col-4">
                                                <input type="text" name="amount" class="form-control" value="{{ Session::get('post_project_data')['amount'] }}" required />
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="amount_to" class="form-control" value="{{ Session::get('post_project_data')['amount_to'] }}" required />
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control" name="currency_id">
                                                    @foreach ($currency as $currencies)
                                                        <option value="{{ $currencies->currency_id }}" {{ (Session::get('post_project_data')['currency_id']==$currencies->currency_id)? "selected" : "" }}>{{ $currencies->code }} - {{ $currencies->symbol}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @elseif(Session::get('post_project_data')['model_engagement']=='2')
                                        <div class="form-row">
                                            <div class="col-4">
                                                <input type="text" name="amount" class="form-control" value="{{ Session::get('post_project_data')['amount'] }}" required />
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="amount_to" class="form-control" value="{{ Session::get('post_project_data')['amount_to'] }}" required />
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control" name="currency_id">
                                                    @foreach ($currency as $currencies)
                                                        <option value="{{ $currencies->currency_id }}" {{ (Session::get('post_project_data')['currency_id']==$currencies->currency_id)? "selected" : "" }}>{{ $currencies->code }} - {{ $currencies->symbol}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @else
                                        <div class="form-row">
                                            <div class="col-4">
                                                <input type="text" name="amount" class="form-control" value="{{ Session::get('post_project_data')['amount'] }}" required />
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="amount_to" class="form-control" value="{{ Session::get('post_project_data')['amount_to'] }}" required />
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control" name="currency_id">
                                                    @foreach ($currency as $currencies)
                                                        <option value="{{ $currencies->currency_id }}" {{ (Session::get('post_project_data')['currency_id']==$currencies->currency_id)? "selected" : "" }}>{{ $currencies->code }} - {{ $currencies->symbol}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Project Title</label>
                                        <input type="text" name="project_title" class="form-control" value="{{ Session::get('post_project_data')['project_title'] }}" required />
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Key Skills</label>
                                            <input type="text" name="key_skills" class="form-control" value="{{ Session::get('post_project_data')['key_skills'] }}" required />
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Project Duration</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="number" placeholder="Min" class="form-control"  name="project_duration_min" value="{{ Session::get('post_project_data')['project_duration_min'] }}"/>
                                                </div>
                                                <div class="col">
                                                    <input type="number" placeholder="Max" class="form-control" name="project_duration_max" value="{{ Session::get('post_project_data')['project_duration_max'] }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Project Summary</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="project_summary" rows="3" required>{{ Session::get('post_project_data')['project_summary'] }}</textarea>
                                    </div>

                                    <div class="basic-info mb-3">
                                        <label>Type of Project</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="maintenance" class="custom-control-input" name="type_of_project" value="1" {{ (Session::get('post_project_data')['type_of_project']=='1')? "checked" : "" }}>
                                                <label class="custom-control-label" for="maintenance">Maintenance</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="development" class="custom-control-input" name="type_of_project" value="2" {{ (Session::get('post_project_data')['type_of_project']=='2')? "checked" : "" }}>
                                                <label class="custom-control-label" for="development">New Development</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="both" class="custom-control-input" name="type_of_project" value="3" {{ (Session::get('post_project_data')['type_of_project']=='3')? "checked" : "" }}>
                                                <label class="custom-control-label" for="both">Maintenance Cum New Development</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Total Experience</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <select class="form-control" name="experience_year" required>
                                                        @for ($i = 0; $i < 21; $i++)
                                                        <option value="{{ $i }}" {{ (Session::get('post_project_data')['experience_year']==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select class="form-control" name="experience_month" required>
                                                        @for ($i = 1; $i < 21; $i++)
                                                        <option value="{{ $i }}" {{ (Session::get('post_project_data')['experience_month']==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="form-group col-6">
                                            <label>Customer Industry</label>
                                            <select name="customer_industry" class="form-control" required>
                                                <option value=""></option>
                                                @foreach ($customerindustries as $industry)
                                                <option value="{{ $industry->customer_industry_id }}">{{ $industry->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>--}}
                                        <div class="form-group col-6">
                                            <label>Product Industry Exprience</label>
                                            <select name="product_industry_exprience" class="form-control" required>
                                                <option value=""></option>
                                                @foreach ($customerindustries as $industry)
                                                <option value="{{ $industry->customer_industry_id }}" {{ (Session::get('post_project_data')['product_industry_exprience']==$industry->customer_industry_id)? "selected" : "" }}>{{ $industry->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group text-right mt-5">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-primary" onclick="location.href='/post-project'">Back</button>
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
    changePricingModel();
});
function changePricingModel() {
    var engagement = $('input[name="model_engagement"]:checked').attr('value');
    if (engagement == '1') {
        $('.hourly').removeClass("d-none");
        $('.retainership').addClass("d-none");
        $('.project-based').addClass("d-none");
    } else if (engagement == '2') {
        $('.hourly').addClass("d-none");
        $('.retainership').removeClass("d-none");
        $('.project-based').addClass("d-none");
    } else {
        $('.hourly').addClass("d-none");
        $('.retainership').addClass("d-none");
        $('.project-based').removeClass("d-none");
    }
}
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
        $(".btn-copy-q1").on('click', function(){
            var element = '<div class="question1-3">'+$('.question1').html()+'</div>';
            $('.question1-1').append(element);
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
