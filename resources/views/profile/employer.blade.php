@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Employer Details</span>
            <!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
        </div>
    </div>
</div>
<style>
    @media (min-width: 992px){
        .ml-lg-5, .mx-lg-5 {
            margin-left: 0rem !important;
        }
    }
</style>
@stop
@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Employer Details</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registeremployer') }}" method="POST" id="certificateForm">
                @csrf
                <div class="employer">
                    @forelse ($employerdetails as $details)
                    <input type="hidden" name="employer_details_id" id="employer_details_id " value="{{ $details->employer_details_id }}">
                    {{--<div class="form-group basic-info mb-3">
                        <label>Last Employer</label>
                        <div class="form-check form-check-inline ml-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Current" name="current" class="custom-control-input" value="1" {{ ($details->current=="1")? "checked" : "" }}>
                                <label class="custom-control-label" for="Current">Current Employer</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Previous" name="current" class="custom-control-input" value="0" {{ ($details->current=="0")? "checked" : "" }}>
                                <label class="custom-control-label" for="Previous">Previous Employer</label>
                            </div>
                        </div>
                    </div>--}}
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Current Salary</label>
                            <div class="form-row">
                                <div class="col-6 col-sm-6 col-md-5 col-lg-5 pr-1">
                                    <select class="form-control" required="" name="current_salary_lacs">
                                        <option value=""></option>
                                        @for ($i = 0; $i < 51; $i++)
                                        <option value="{{ $i }}" {{ ($details->current_salary_lacs==$i)? "selected" : "" }}>{{ $i }} Lakh</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6 col-sm-6 col-md-5 col-lg-5 ml-lg-3">
                                    <select class="form-control" required="" name="current_salary_thousand">
                                        <option value=""></option>
                                        @for ($i = 0; $i < 100; $i+=5)
                                        <option value="{{ $i }}" {{ ($details->current_salary_thousand==$i)? "selected" : "" }}>{{ $i }} Thousand</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Expected Salary</label>
                            <div class="form-row">
                                <div class="col-6 col-sm-6 col-md-5 col-lg-5 pr-1">
                                    <select class="form-control" required="" name="expected_salary_lacs">
                                        @for ($i = 0; $i < 51; $i++)
                                        <option value="{{ $i }}" {{ ($details->expected_salary_lacs==$i)? "selected" : "" }}>{{ $i }} Lakh</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6 col-sm-6 col-md-5 col-lg-5 ml-lg-3">
                                    <select class="form-control" required="" name="expected_salary_thousand">
                                        @for ($i = 0; $i < 100; $i+=5)
                                        <option value="{{ $i }}" {{ ($details->expected_salary_thousand==$i)? "selected" : "" }}>{{ $i }} Thousand</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-8 col-lg-12">
                            <label>Notice Period</label>
                            <select class="form-control" required="" name="notice_period">
                                <option value=""></option>
                                @for ($i = 15; $i < 180; $i+=15)
                                <option value="{{ $i }}" {{ ($details->notice_period==$i)? "selected" : "" }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    @empty
                    <input type="hidden" name="employer_details_id" id="employer_details_id " value="0">
                    {{--<div class="form-group basic-info mb-3">
                        <label>Last Employer</label>
                        <div class="form-check form-check-inline ml-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Current" name="current" class="custom-control-input" value="1" checked>
                                <label class="custom-control-label" for="Current">Current Employer</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Previous" name="current" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="Previous">Previous Employer</label>
                            </div>
                        </div>
                    </div>--}}
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Current Salary</label>
                            <div class="form-row">
                                <div class="col-6 col-sm-6 col-md-5 col-lg-5 pr-1">
                                    <select class="form-control" required="" name="current_salary_lacs">
                                        @for ($i = 0; $i < 51; $i++)
                                        <option value="{{ $i }}">{{ $i }} Lacs</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6 col-sm-6 col-md-5 col-lg-5 ml-lg-3">
                                    <select class="form-control" required="" name="current_salary_thousand">
                                        @for ($i = 0; $i < 100; $i+=5)
                                        <option value="{{ $i }}">{{ $i }} Thousand</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Expected Salary</label>
                            <div class="form-row">
                                <div class="col-6 col-sm-6 col-md-5 col-lg-5 pr-1">
                                    <select class="form-control" required="" name="expected_salary_lacs">
                                        @for ($i = 0; $i < 51; $i++)
                                        <option value="{{ $i }}">{{ $i }} Lacs</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6 col-sm-6 col-md-5 col-lg-5 ml-lg-3">
                                    <select class="form-control" required="" name="expected_salary_thousand">
                                        @for ($i = 0; $i < 100; $i+=5)
                                        <option value="{{ $i }}">{{ $i }} Thousand</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-12 col-md-7 col-lg-12">
                            <label>Notice Period</label>
                            <select class="form-control" required="" name="notice_period">
                                <option value=""></option>
                                @for ($i = 15; $i < 180; $i+=15)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    @endforelse
                </div>
                <div class="employer-1">
                    @forelse ($employers as $employer)
                    <div class="employer-3 remove-qual-{{ $employer->employer_id }}">
                        <!-- <span class="h4 text-left mt-3 mb-4 d-inline-block">Employer</span> -->
                        <input type="hidden" name="employer_id[]" id="employer_id" value="{{ $employer->employer_id }}">
                        {{-- @if ($employer->current == "1")
                        <div class="form-group basic-info mb-3">
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Current" name="current[]" class="custom-control-input" value="1" {{ ($employer->current=="1")? "checked" : "" }} >
                                    <label class="custom-control-label" for="Current">Current Employer</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Previous" name="current[]" class="custom-control-input" value="0" {{ ($employer->current=="0")? "checked" : "" }} >
                                    <label class="custom-control-label" for="Previous">Previous Employer</label>
                                </div>
                            </div>
                        </div>
                        @endif --}}
                        <div class="form-row">
                            <div class="form-group col-12 col-sm-12 col-md-11 col-lg-12">
                                <label>Employer Name</label>
                                <input type="text" name="employer_name[]" class="form-control" value="{{ $employer->employer_name }}" required/>
                            </div>
                            <div class="form-group col-12 col-sm-12 col-md-5 col-lg-6">
                                <label>Designation</label>
                                <input type="text" name="designation[]" class="form-control" value="{{ $employer->designation }}" required/>
                                {{--<select name="designation[]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($designations as $designation)
                                    <option value="{{ $designation->designation_id }}" {{ ($employer->designation==$designation->designation_id)? "selected" : "" }}>{{ $designation->name }}</option>
                                    @endforeach
                                </select>--}}
                            </div>
                            <div class="form-group col-12 col-sm-12 col-md-5 col-lg-6 ml-lg-5">
                                <label>Employment Type</label>
                                <select name="employment_type[]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($employertype as $type)
                                    <option value="{{ $type->employer_type_id }}" {{ ($employer->employment_type==$type->employer_type_id)? "selected" : "" }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                <label>Employment Duration</label>
                                <div class="form-row">
                                    <div class="col-6 col-sm-6 col-md-5 col-lg-5 pr-1">
                                        <select class="form-control" required="" name="duration_year[]">
                                            <option value=""></option>
                                            @for ($i = 0; $i < 21; $i++)
                                            <option value="{{ $i }}" {{ ($employer->duration_year==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-5 col-lg-5 ml-lg-3">
                                        <select class="form-control" required="" name="duration_month[]">
                                            <option value=""></option>
                                            @for ($i = 1; $i < 13; $i++)
                                            <option value="{{ $i }}" {{ ($employer->duration_month==$i)? "selected" : "" }}>{{ $i }} Months</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-sm-12 col-md-5 col-lg-6 ml-lg-5">
                                <label>Last Employer</label>
                                <select name="current[]" class="form-control" required>
                                    <option value=""></option>
                                    <option value="1" {{ ($employer->current=="1")? "selected" : "" }}>Current Employer</option>
                                    <option value="0" {{ ($employer->current=="0")? "selected" : "" }}>Previous Employer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Job Profile</label>
                            <textarea class="form-control" name="job_profile[]" rows="4" cols="50" required>{{ $employer->job_profile }}</textarea>
                        </div>
                    </div>
                    @empty
                    <div class="employer-3">
                        <!-- <span class="h4 text-left mt-3 mb-4 d-inline-block">Employer</span> -->
                        <input type="hidden" name="employer_id[]" id="employer_id" value="0">
                        {{-- <div class="form-group basic-info mb-3">
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Current" name="current[]" class="custom-control-input" value="1" checked="">
                                    <label class="custom-control-label" for="Current">Current Employer</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Previous" name="current[]" class="custom-control-input" value="0">
                                    <label class="custom-control-label" for="Previous">Previous Employer</label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-row">
                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                <label>Employer Name</label>
                                <input type="text" name="employer_name[]" class="form-control" required/>
                            </div>
                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                <label>Designation/Titile</label>
                                <input type="text" name="designation[]" class="form-control" required/>
                                {{--<select name="designation[]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($designations as $designation)
                                    <option value="{{ $designation->designation_id }}">{{ $designation->name }}</option>
                                    @endforeach
                                </select>--}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                <label>Employment Duration</label>
                                <div class="form-row">
                                    <div class="col">
                                        <select class="form-control" required="" name="duration_year[]">
                                            <option value=""></option>
                                            @for ($i = 0; $i < 21; $i++)
                                            <option value="{{ $i }}">{{ $i }} Years</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" required="" name="duration_month[]">
                                            <option value=""></option>
                                            @for ($i = 1; $i < 13; $i++)
                                            <option value="{{ $i }}">{{ $i }} Months</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                <label>Employment Type</label>
                                <select name="employment_type[]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($employertype as $type)
                                    <option value="{{ $type->employer_type_id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Job Profile</label>
                            <textarea class="form-control" name="job_profile[]" rows="4" cols="50" required></textarea>
                        </div>
                        <!-- <div class="form-row">
                            <div class="form-group col-8">
                                <label>Notice Period</label>
                                <select class="form-control" required="" name="notice_period[]">
                                    <option value=""></option>
                                    @for ($i = 15; $i < 180; $i+=15)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div> -->
                    </div>
                    @endforelse
                </div>
                <div class="btn-group mt-3" role="group">
                    <button class="btn btn-md btn-info btn-copy-e" type="button">Add Employer <span class="fa fa-plus"></span></button>
                    <!-- <button class="btn btn-md btn-danger btn-copy-c" type="button"></button> -->
                    <button type="button" class="remove-e btn btn-md btn-info ml-3 rounded-0">Erase Employer <span class="fas fa-times"></span></button>
                </div>
                <div class="form-group text-right mt-5">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" type="submit">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            Next >>>
                        </button>
                        <!-- <button class="btn btn-outline-primary" type="reset">Discard</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="employer-2 d-none">
    <!-- <span class="h4 text-left mt-3 mb-4 d-inline-block">Employer</span> -->
    <input type="hidden" name="employer_id[]" id="employer_id" value="0">
    <div class="form-row">
        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
            <label>Employer Name</label>
            <input type="text" name="employer_name[]" class="form-control" required/>
        </div>
        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
            <label>Designation</label>
            <input type="text" name="designation[]" class="form-control" required/>
            {{--<select name="designation[]" class="form-control" required>
                <option value=""></option>
                @foreach ($designations as $designation)
                <option value="{{ $designation->designation_id }}" >{{ $designation->name }}</option>
                @endforeach
            </select>--}}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-12 ml-lg-6">
            <label>Last Employer</label>
            <select name="current[]" class="form-control" required>
                <option value=""></option>
                <option value="1">Current Employer</option>
                <option value="0">Previous Employer</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
            <label>Employment Duration</label>
            <div class="form-row">
                <div class="col">
                    <select class="form-control" required="" name="duration_year[]">
                        <option value=""></option>
                        @for ($i = 0; $i < 21; $i++)
                        <option value="{{ $i }}">{{ $i }} Years</option>
                        @endfor
                    </select>
                </div>
                <div class="col">
                    <select class="form-control" required="" name="duration_month[]">
                        <option value=""></option>
                        @for ($i = 1; $i < 13; $i++)
                        <option value="{{ $i }}">{{ $i }} Months</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
            <label>Employment Type</label>
            <select name="employment_type[]" class="form-control" required>
                <option value=""></option>
                @foreach ($employertype as $type)
                <option value="{{ $type->employer_type_id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>Job Profile</label>
        <textarea class="form-control" name="job_profile[]" rows="4" cols="50" required></textarea>
    </div>
    <!-- <div class="form-row">
        <div class="form-group col-8">
            <label>Notice Period</label>
            <select class="form-control" required="" name="notice_period[]">
                <option value=""></option>
                @for ($i = 15; $i < 181; $i+=15)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div> -->
</div>
@stop
