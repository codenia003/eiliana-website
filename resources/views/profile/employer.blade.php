@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Employer Details</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registeremployer') }}" method="POST" id="certificateForm">
                @csrf
                <div class="employer-1">
                    @forelse ($employers as $employer)
                    <div class="employer-3 remove-qual-{{ $employer->employer_id }}">
                        <!-- <span class="h4 text-left mt-3 mb-4 d-inline-block">Employer</span> -->
                        <input type="hidden" name="employer_id[]" id="employer_id" value="{{ $employer->employer_id }}">
                        @if ($employer->current == "1")
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
                        @endif
                        <div class="form-row">
                            <div class="form-group col-11">
                                <label>Employer Name</label>
                                <input type="text" name="employer_name[]" class="form-control" value="{{ $employer->employer_name }}" required/>
                            </div>
                            <div class="form-group col-5">
                                <label>Designation</label>
                                <select name="designation[]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($designations as $designation)
                                    <option value="{{ $designation->designation_id }}" {{ ($employer->designation==$designation->designation_id)? "selected" : "" }}>{{ $designation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-5 ml-5" style="margin-left: 3.5rem !important;">
                                <label>Employment Type</label>
                                <input type="text" name="employment_type[]" class="form-control" value="{{ $employer->employment_type }}" required/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Employment Duration</label>
                                <div class="form-row">
                                    <div class="col-5 pr-1">
                                        <select class="form-control" required="" name="duration_year[]">
                                            <option value=""></option>
                                            @for ($i = 0; $i < 21; $i++)
                                            <option value="{{ $i }}" {{ ($employer->duration_year==$i)? "selected" : "" }}>{{ $i }} Years</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-5 ml-3">
                                        <select class="form-control" required="" name="duration_month[]">
                                            <option value=""></option>
                                            @for ($i = 1; $i < 13; $i++)
                                            <option value="{{ $i }}" {{ ($employer->duration_month==$i)? "selected" : "" }}>{{ $i }} Months</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Job Profile</label>
                            <textarea class="form-control" name="job_profile[]" rows="4" cols="50" required>{{ $employer->job_profile }}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-8">
                                <label>Notice Period</label>
                                <select class="form-control" required="" name="notice_period[]">
                                    <option value=""></option>
                                    @for ($i = 15; $i < 180; $i+=15)
                                    <option value="{{ $i }}" {{ ($employer->notice_period==$i)? "selected" : "" }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="employer-3">
                        <!-- <span class="h4 text-left mt-3 mb-4 d-inline-block">Employer</span> -->
                        <input type="hidden" name="employer_id[]" value="0">
                        <div class="form-group basic-info mb-3">
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
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Employer Name</label>
                                <input type="text" name="employer_name[]" class="form-control" required/>
                            </div>
                            <div class="form-group col-6">
                                <label>Designation</label>
                                <select name="designation[]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($designations as $designation)
                                    <option value="{{ $designation->designation_id }}">{{ $designation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
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
                            <div class="form-group col-6">
                                <label>Employment Type</label>
                                <input type="text" name="employment_type[]" class="form-control" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Job Profile</label>
                            <textarea class="form-control" name="job_profile[]" rows="4" cols="50" required></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-8">
                                <label>Notice Period</label>
                                <select class="form-control" required="" name="notice_period[]">
                                    <option value=""></option>
                                    @for ($i = 15; $i < 180; $i+=15)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <div class="mt-3">
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
    <input type="hidden" name="employer_id[]" value="0">
    <div class="form-row">
        <div class="form-group col-6">
            <label>Employer Name</label>
            <input type="text" name="employer_name[]" class="form-control" required/>
        </div>
        <div class="form-group col-6">
            <label>Designation</label>
            <select name="designation[]" class="form-control" required>
                <option value=""></option>
                @foreach ($designations as $designation)
                <option value="{{ $designation->designation_id }}" >{{ $designation->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-6">
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
        <div class="form-group col-6">
            <label>Employment Type</label>
            <input type="text" name="employment_type[]" class="form-control" required/>
        </div>
    </div>
    <div class="form-group">
        <label>Job Profile</label>
        <textarea class="form-control" name="job_profile[]" rows="4" cols="50" required></textarea>
    </div>
    <div class="form-row">
        <div class="form-group col-8">
            <label>Notice Period</label>
            <select class="form-control" required="" name="notice_period[]">
                <option value=""></option>
                @for ($i = 15; $i < 181; $i+=15)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
</div>
@stop