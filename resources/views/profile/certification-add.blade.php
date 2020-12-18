@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Certification</span>
            <!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Certification</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registercertification') }}" method="POST" id="certificateForm">
                @csrf
                <div class="certification-1">
                    @forelse ($certificates as $certificate)
                        <div class="certification-3 remove-qual-{{ $certificate->certificate_id }}">
                            <span class="h4 text-left mt-3 mb-4 d-inline-block">Certification</span>
                            <!-- <button type="button" onclick="ConfirmDelete('{{ $certificate->certificate_id }}','2')" class="btn btn-outline-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button> -->
                            <input type="hidden" name="certificate_id[]" id="certificate_id" value="{{ $certificate-> certificate_id }}">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>Certification Number</label>
                                    <input type="text" name="certificate_no[]" class="form-control" value="{{ $certificate->certificate_no }}" required />
                                </div>
                                <div class="form-group col-1">
                                </div>
                                <div class="form-group col-7">
                                    <label>Certification Name</label>
                                    <input type="text" name="name[]" class="form-control" value="{{ $certificate->name }}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Valid Till</label>
                                <input type="date" name="valid_till[]" class="form-control" value="{{ $certificate->valid_till }}" required/>
                            </div>
                        </div>
                    @empty
                        <div class="certification-3">
                            <span class="h4 text-left mt-3 mb-4 d-inline-block">Certification</span>
                            <input type="hidden" name="certificate_id[]" value="0">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>Certification Number</label>
                                    <input type="text" name="certificate_no[]" class="form-control" required/>
                                </div>
                                <div class="form-group col-1">
                                </div>
                                <div class="form-group col-7">
                                    <label>Certification Name</label>
                                    <input type="text" name="name[]" class="form-control" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Valid Till</label>
                                <input type="date" name="valid_till[]" class="form-control" required/>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="mt-3">
                    <button class="btn btn-md btn-info btn-copy-c" type="button">Add Certification <span class="fa fa-plus"></span></button>
                    <!-- <button class="btn btn-md btn-danger btn-copy-c" type="button"></button> -->
                    <button type="button" class="remove-c btn btn-md btn-info ml-3 rounded-0">Erase Certification <span class="fas fa-times"></span></button>
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
<div class="certification-2 d-none">
    <span class="h4 text-left mt-3 mb-4 d-inline-block">Certification</span>
   <!--  <button type="button" class="remove-c btn btn-outline-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button> -->
    <input type="hidden" name="certificate_id[]" id="certificate_id" value="0">
    <div class="form-row">
        <div class="form-group col-4">
            <label>Certification Number</label>
            <input type="text" name="certificate_no[]" class="form-control" required/>
        </div>
        <div class="form-group col-1">
        </div>
        <div class="form-group col-7">
            <label>Certification Name</label>
            <input type="text" name="name[]" class="form-control" required/>
        </div>
    </div>
    <div class="form-group">
        <label>Valid Till</label>
        <input type="date" name="valid_till[]" class="form-control" required/>
    </div>
</div>
@stop