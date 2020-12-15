@extends('search/layout')

@section('search_content')
<div class="advance-search singup-body login-body">
    <form action="{{ url('/advance-search/updateProfile') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="basic-info">
                    <label>Type of Project</label>
                    <div class="form-check form-check-inline ml-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="support" class="custom-control-input" name="top" value="1">
                            <label class="custom-control-label" for="support">Support</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="development" class="custom-control-input" name="top" value="2">
                            <label class="custom-control-label" for="development">Development</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="both" class="custom-control-input" name="top" value="3">
                            <label class="custom-control-label" for="both">Both</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="form-group">
                    <label>Looking to develope</label>
                    <input type="text" name="username" class="form-control" value="" />
                </div>
                <div class="form-group basic-info">
                    <label>Model Of Engagement</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="model_engagement" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Hourly</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="model_engagement" value="2">
                        <label class="form-check-label" for="inlineCheckbox2">Retainership</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="model_engagement" value="3">
                        <label class="form-check-label" for="inlineCheckbox3">Project-based</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Technology Preference</label>
                    <select name="technologty_pre" class="form-control" required>
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-8">
                        <label>Total Experience</label>
                        <div class="form-row">
                            <div class="col">
                                <select class="form-control" name="experience_year">
                                    @for ($i = 1; $i < 21; $i++)
                                    <option value="{{ $i }}">{{ $i }} Years</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-control" name="experience_month">
                                    @for ($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ $i }} Months</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Industry that Product was designed for</label>
                    <select name="industry" class="form-control">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="form-group basic-info mb-3">
                    <label>Sort By</label>
                    <div class="form-check form-check-inline ml-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Relevance" name="sortby" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="Relevance">Relevance</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Resume" name="sortby" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="Resume">Resume Fresher</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Last" name="sortby" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="Last">Last Active Date</label>
                        </div>
                    </div>
                </div>
                <div class="form-group text-right mt-5">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            Search and find the relevant projects
                        </button>
                        <!-- <button class="btn btn-outline-primary" type="reset">Discard</button> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@stop