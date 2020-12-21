@extends('search/layout')

@section('search_content')
<div class="advance-search singup-body login-body">
    <form action="{{ url('/advance-search/contract-staffing') }}" method="GET">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="basic-info">
                    <label>Type of Project</label>
                    <div class="form-check form-check-inline ml-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="support" class="custom-control-input" name="top" value="1" checked="">
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
                            <label class="custom-control-label" for="both">Support Cum Development</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="form-group">
                    <label>Any Keyword(Key Skills)</label>
                    <input type="text" name="keyword" class="form-control" value="" required />
                </div>
                <div class="form-row">
                    <div class="form-group col-8">
                        <label>Total Experience</label>
                        <div class="form-row">
                            <div class="col-5">
                                <select class="form-control" name="experience_year">
                                    @for ($i = 0; $i < 21; $i++)
                                    <option value="{{ $i }}">{{ $i }} Years</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="experience_month">
                                    @for ($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ $i }} Months</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label>Technology Preference</label>
                        <select name="technologty_pre" class="form-control" required>
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label>Framework</label>
                        {!! Form::selectRange('framework', 1, 20, null, ['class' => 'form-control','required' =>'']) !!}
                    </div>
                    <div class="form-group col">
                        <label>Industry that Product was designed for</label>
                        <select name="industry" class="form-control">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label>Current Location</label>
                        <select name="current_location" class="form-control">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label>Preferred Location</label>
                        <select name="preferred_location" class="form-control">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-8">
                        <label>Salary Ranage</label>
                        <div class="form-row">
                            <div class="col-5 pr-1">
                                <select class="form-control" name="range_salary_from">
                                    <option value="">From</option>
                                    @for ($i = 0; $i < 51; $i++)
                                    <option value="{{ $i }}">{{ $i }} Lacs</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-5 ml-3">
                                <select class="form-control" name="range_salary_to">
                                    <option value="">To</option>
                                    @for ($i = 0; $i < 51; $i++)
                                    <option value="{{ $i }}">{{ $i }} Lacs</option>
                                    @endfor
                                </select>
                                <!-- <select class="form-control" name="range_salary_thousand">
                                    <option value=""></option>
                                    @for ($i = 0; $i < 100; $i+=5)
                                    <option value="{{ $i }}">{{ $i }} Thousand</option>
                                    @endfor
                                </select> -->
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="text-left">Education Details</h4>
                <div class="ug-qualification">
                    <span class="h4 text-left mt-3 mb-4 d-inline-block">UG Qualification</span>
                    <input type="hidden" name="graduation_type" value="3">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>UG Qualification</label>
                            <select name="degree" class="form-control" >
                                <option value=""></option>
                                @foreach ($qualifications as $qualification)
                                @if ($qualification->type == 'UG')
                                <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-1">
                        </div>
                        <div class="form-group col-7">
                            <label>University Name</label>
                            <select name="name" class="form-control">
                                <option value=""></option>
                                @foreach ($universities as $university)
                                <option value="{{ $university->university_id }}">{{ $university->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Year of Graduation</label>
                            <div class="form-row">
                                <div class="col">
                                    <select class="form-control" name="month">
                                        <option value="">From</option>
                                        @for ($i = 2000; $i < 2021; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" name="year">
                                        <option value="">Till</option>
                                        @for ($i = 2000; $i < 2021; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-1">
                        </div>
                        <div class="form-group col-7">
                            <label>Education Type</label>
                            <select name="education_type" class="form-control">
                                <option value=""></option>
                                @foreach ($educationtype as $etype)
                                <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="pg-qualification">
                    <span class="h4 text-left mt-3 mb-4 d-inline-block">PG Qualification</span>
                    <input type="hidden" name="graduation_type" value="4">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>PG Qualification</label>
                            <select name="degree" class="form-control">
                                <option value=""></option>
                                @foreach ($qualifications as $qualification)
                                @if ($qualification->type == 'UG')
                                <option value="{{ $qualification->qualification_id }}">{{ $qualification->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-1">
                        </div>
                        <div class="form-group col-7">
                            <label>University Name</label>
                            <select name="name" class="form-control">
                                <option value=""></option>
                                @foreach ($universities as $university)
                                <option value="{{ $university->university_id }}">{{ $university->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Year of Graduation</label>
                            <div class="form-row">
                                <div class="col">
                                    <select class="form-control" name="month">
                                        <option value="">From</option>
                                        @for ($i = 2000; $i < 2021; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" name="year">
                                        <option value="">Till</option>
                                        @for ($i = 2000; $i < 2021; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-1">
                        </div>
                        <div class="form-group col-7">
                            <label>Education Type</label>
                            <select name="education_type" class="form-control">
                                <option value=""></option>
                                @foreach ($educationtype as $etype)
                                <option value="{{ $etype->education_type_id }}">{{ $etype->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="certification-3">
                    <span class="h4 text-left mt-3 mb-4 d-inline-block">Certification</span>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Certification Number</label>
                            <input type="text" name="certificate_no" class="form-control"/>
                        </div>
                        <div class="form-group col-1">
                        </div>
                        <div class="form-group col-7">
                            <label>Certification Name</label>
                            <input type="text" name="name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Valid Till</label>
                        <input type="date" name="valid_till" class="form-control"/>
                    </div>
                </div>
                <div class="form-group text-right mt-5">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" type="submit">
                           Search & Find the Relevant Candidates
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@stop