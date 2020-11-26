@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Certification</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registerEducation') }}" method="POST" id="educationForm">
                @csrf
                <div class="certification-1">
                    <div class="certification-2">
                        <div class="certification-3">
                            <h4 class="text-left mt-3 mb-4">Certification</h4>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>Education Type</label>
                                    <select name="education_type" class="form-control">
                                        <option value=""></option>
                                        <option value="NA">NAC</option>
                                    </select>
                                </div>
                                <div class="form-group col-1">
                                </div>
                                <div class="form-group col-7">
                                    <label>Institute Name</label>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>Year of Graduation</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <select name="month" class="form-control" required>
                                                <option value=""></option>
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="year" class="form-control" required>
                                                <option value=""></option>
                                                <option value="2016">2016</option>
                                                <option value="2016">2016</option>
                                                <option value="2016">2016</option>
                                                <option value="2016">2016</option>
                                                <option value="2016">2016</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-1">
                                </div>
                                <div class="form-group col-7">
                                    <label>Certification</label>
                                    <!-- <input type="text" name="degree" class="form-control" /> -->
                                    <select name="degree" class="form-control">
                                        <option value=""></option>
                                        <option value="NA">NAC</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-md btn-info btn-copy-c" type="button">Add More Certification</button>
                    <button class="btn btn-md btn-danger btn-copy-c" type="button"><span class="fa fa-plus"></span></button>
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
@stop