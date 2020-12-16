@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Employer</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registeremployer') }}" method="POST" id="certificateForm">
                @csrf
                <div class="certification-1">
                    
                        <div class="certification-3">
                            <span class="h4 text-left mt-3 mb-4 d-inline-block">Employer</span>
                            <input type="hidden" name="certificate_id[]" value="0">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>Employer Number</label>
                                    <input type="text" name="certificate_no[]" class="form-control" required/>
                                </div>
                                <div class="form-group col-1">
                                </div>
                                <div class="form-group col-7">
                                    <label>Employer Name</label>
                                    <input type="text" name="name[]" class="form-control" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Valid Till</label>
                                <input type="date" name="valid_till[]" class="form-control" required/>
                            </div>
                        </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-md btn-info btn-copy-c" type="button">Add Employer <span class="fa fa-plus"></span></button>
                    <!-- <button class="btn btn-md btn-danger btn-copy-c" type="button"></button> -->
                    <button type="button" class="remove-c btn btn-md btn-info ml-3 rounded-0">Erase Employer <span class="fas fa-times"></span></button>
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
    <span class="h4 text-left mt-3 mb-4 d-inline-block">Employer</span>
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