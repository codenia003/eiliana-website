@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Primary Information</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/updateProfile') }}" method="POST" id="basic_form">
                @csrf
                <!-- <div class="form-group">
                    <label for="applyas">Apply As</label>
                     <select name="applyas" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.applyas.errors }" >
                            <option value="">--Select--</option>
                            <option value="2">Individual</option>
                            <option value="3">Company</option>
                        </select>
                    <div *ngIf="submitted && f.applyas.errors" class="invalid-feedback">
                        <div *ngIf="f.applyas.errors.required">Email id is required</div>
                    </div>
                </div> -->
                <div class="form-group basic-info mb-3">
                    <label>Do you keep your profile anonymous?</label>
                    <div class="form-check form-check-inline ml-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="public" name="anonymous" class="custom-control-input" value="0" {{ (Sentinel::getUser()->anonymous=="0")? "checked" : "" }} onchange="changeAnonymus(event)">
                            <label class="custom-control-label" for="public">Public</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="anonymous" name="anonymous" class="custom-control-input" value="1" {{ (Sentinel::getUser()->anonymous=="1")? "checked" : "" }} onchange="changeAnonymus(event)">
                            <label class="custom-control-label" for="anonymous">Anonymus</label>
                        </div>
                    </div>
                </div>
                <div class="form-group d-none">
                    <label>User Id</label>
                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" />
                </div>
                <div class="form-group basic-info">
                    <label>Title</label>
                    <div class="form-check form-check-inline ml-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="mr" class="custom-control-input" name="title" value="Mr" {{ ($user->title=="Mr")? "checked" : "" }}>
                            <label class="custom-control-label" for="mr">Mr.</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="mrs" class="custom-control-input" name="title" value="Mrs" {{ ($user->title=="Mrs")? "checked" : "" }}>
                            <label class="custom-control-label" for="mrs">Mrs.</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" />
                    </div>
                    <!-- <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" class="form-control"/>
                    </div> -->
                    <div class="form-group col">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label>DOB</label>
                        <input type="date" placeholder="DD/MM/YYYY" name="dob" class="form-control" value="{{ $user->dob }}" />
                    </div>
                    <div class="form-group col anonymousShow {{ ($user->anonymous=='0')? 'd-none' : '' }}">
                        <label>Alias</label>
                        <input type="text" name="pseudoName" class="form-control" value="{{ $user->pseudoName }}" />
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="govtID">Govt. ID Proof</label>
                    <select name="govtID" class="form-control" >
                        <option value="">--Select--</option>
                        <option value="">--Select--</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Govt. ID Number</label>
                    <input type="text" name="idProofNo" class="form-control" />
                </div> -->
                <div class="form-group">
                    <label for="country">Country</label>
                    <select name="country" class="form-control">
                        <option value="">--Select--</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ ($user->country==$country->id)? "selected" : "" }} >{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group basic-info">
                    <label>Interested In</label>
                    <div class="form-check form-check-inline ml-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Freelance" class="custom-control-input" name="interested" onchange="changeInterested(event)" value="1" {{ ($user->interested=="1")? "checked" : "" }}>
                            <label class="custom-control-label" for="Freelance">Freelance Projects</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Contractual" class="custom-control-input" name="interested"  value="2" {{ ($user->interested=="2")? "checked" : "" }}>
                            <label class="custom-control-label" for="Contractual">Contractual Staffing</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Both" class="custom-control-input" name="interested" value="3" {{ ($user->interested=="3")? "checked" : "" }}>
                            <label class="custom-control-label" for="Both">Both</label>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                       <div class="modal-content">
                           <div class="modal-header bg-warning text-white">
                               <h4 class="modal-title" id="exampleModalLabel">Do you want to fill it?</h4>
                               <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                               </button>
                           </div>
                           <div class="modal-body">
                                <div class="form-group basic-info">
                                <!-- <label>Interested In</label> -->
                                <div class="form-check form-check-inline ml-3">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="Education" class="custom-control-input" name="wanttofill" value="1" {{ ($user->wanttofill=="1")? "checked" : "" }}>
                                        <label class="custom-control-label" for="Education">Education</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="Certification" class="custom-control-input" name="wanttofill" value="2" {{ ($user->wanttofill=="2")? "checked" : "" }}>
                                        <label class="custom-control-label" for="Certification">Certification</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="popBoth" class="custom-control-input" name="wanttofill" value="3" {{ ($user->wanttofill=="3")? "checked" : "" }}>
                                        <label class="custom-control-label" for="popBoth">Both</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="No" class="custom-control-input" name="wanttofill" value="4" {{ ($user->wanttofill=="4")? "checked" : "" }}>
                                        <label class="custom-control-label" for="No">No</label>
                                    </div>
                                </div>
                            </div>
                           </div>
                           <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">
                                    <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                                    Next >>>
                                </button>
                           </div>
                       </div>
                   </div>
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