@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Additional Information</h4>
        <div class="card-body p-4">
            <form [formGroup]="addInfoForm" (ngSubmit)="onSubmit()">
            	<div class="form-row">
		            <div class="form-group col">
		                <label>User Id</label>
		                <input type="text" formControlName="username" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.username.errors }" />
		                <div *ngIf="submitted && f.username.errors" class="invalid-feedback">
		                    <div *ngIf="f.username.errors.required">User Id is required</div>
		                </div>
		            </div>
		            <div class="form-group col">
	                    <label for="typeofpro">Type of Profile</label>
	                     <select formControlName="typeofpro" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.typeofpro.errors }" >
	                            <option value=""></option>
	                            <option value="2">Individual</option>
	                            <option value="3">Company</option>
	                        </select>
	                    <div *ngIf="submitted && f.typeofpro.errors" class="invalid-feedback">
	                        <div *ngIf="f.typeofpro.errors.required">Type of Profile is required</div>
	                    </div>
	                </div>
		        </div>
            	<div class="form-row">
		            <div class="form-group col">
		                <label>Standard Per diem</label>
		                <input type="text" formControlName="standard" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.standard.errors }" />
		                <div *ngIf="submitted && f.standard.errors" class="invalid-feedback">
		                    <div *ngIf="f.standard.errors.required">Standard Per is required</div>
		                </div>
		            </div>
		            <div class="form-group col">
	                    <label for="currency">Default Currency</label>
	                    <select formControlName="currency" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.currency.errors }" >
                            <option value=""></option>
							<option value="INR">Indian Rupee</option>
							<option value="EUR">Euro</option>'
							<option value="USD">United States dollar</option>
                        </select>
	                    <div *ngIf="submitted && f.currency.errors" class="invalid-feedback">
	                        <div *ngIf="f.currency.errors.required">Currency is required</div>
	                    </div>
	                </div>
		        </div>
            	<div class="form-row">
		            <div class="form-group col">
		                <label>Availability Hours</label>
		                <input type="text" formControlName="availabilityHours" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.availabilityHours.errors }" />
		                <div *ngIf="submitted && f.availabilityHours.errors" class="invalid-feedback">
		                    <div *ngIf="f.availabilityHours.errors.required">Hours is required</div>
		                </div>
		            </div>
		            <div class="form-group col">
	                    <label for="availabilityDuration">Availability Duration</label>
	                    <select formControlName="availabilityDuration" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.availabilityDuration.errors }" >
                            <option value=""></option>
                            <option value="1">1 Hours</option>
                            <option value="2">2 Hours</option>
                            <option value="3">4 Hours</option>
                        </select>
	                    <div *ngIf="submitted && f.availabilityDuration.errors" class="invalid-feedback">
	                        <div *ngIf="f.availabilityDuration.errors.required">Duration is required</div>
	                    </div>
	                </div>
		        </div>
		        <h3 class="form-tittle">Language</h3>
		        <div class="form-row">
		            <div class="form-group col">
		                <label>Language Hours</label>
		                <input type="text" formControlName="languageHours" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.languageHours.errors }" />
		                <div *ngIf="submitted && f.languageHours.errors" class="invalid-feedback">
		                    <div *ngIf="f.languageHours.errors.required">Language Hours is required</div>
		                </div>
		            </div>
		            <div class="form-group col">
		                <label>Language Name</label>
		                <input type="text" formControlName="languageName" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.languageName.errors }" />
		                <div *ngIf="submitted && f.languageName.errors" class="invalid-feedback">
		                    <div *ngIf="f.languageName.errors.required">Language Name is required</div>
		                </div>
		            </div>
		        </div>
		        <div class="form-group">
                    <label for="isactive">Is active</label>
                    <select formControlName="isactive" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.isactive.errors }" >
                        <option value=""></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
                    </select>
                    <div *ngIf="submitted && f.isactive.errors" class="invalid-feedback">
                        <div *ngIf="f.isactive.errors.required">Is active is required</div>
                    </div>
                </div>
                <div class="form-group text-right mt-5">
                    <div class="btn-group" role="group">
                        <button [disabled]="loading" class="btn btn-primary">
                            <span *ngIf="loading" class="spinner-border spinner-border-sm mr-1"></span>
                            Save Details
                        </button>
                        <button class="btn btn-outline-primary" type="reset">Discard</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop