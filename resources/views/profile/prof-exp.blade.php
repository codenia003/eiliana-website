@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Professional Experience</h4>
        <div class="card-body p-4">
            <form [formGroup]="addInfoForm" (ngSubmit)="onSubmit()">
            	<div class="form-group">
	                <label>Video Intro URL</label>
	                <input type="text" formControlName="introvideourl" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.introvideourl.errors }" />
	                <div *ngIf="submitted && f.introvideourl.errors" class="invalid-feedback">
	                    <div *ngIf="f.introvideourl.errors.required">Video URL is required</div>
	                </div>
	            </div>

	            <h3 class="form-tittle">Skills Association</h3>
            	<div class="form-row">
		            <div class="form-group col">
		                <label>Skill Id</label>
		                <input type="text" formControlName="skillid" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.skillid.errors }" />
		                <div *ngIf="submitted && f.skillid.errors" class="invalid-feedback">
		                    <div *ngIf="f.skillid.errors.required">Skill Id is required</div>
		                </div>
		            </div>
		            <div class="form-group col">
		                <label>Skill Name</label>
		                <input type="text" formControlName="skillname" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.skillname.errors }" />
		                <div *ngIf="submitted && f.skillname.errors" class="invalid-feedback">
		                    <div *ngIf="f.skillname.errors.required">Skill Name is required</div>
		                </div>
		            </div>
		        </div>
            	<div class="form-group">
                    <label for="skillisactive">Is active</label>
                    <select formControlName="skillisactive" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.skillisactive.errors }" >
                        <option value=""></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
                    </select>
                    <div *ngIf="submitted && f.skillisactive.errors" class="invalid-feedback">
                        <div *ngIf="f.skillisactive.errors.required">Is active is required</div>
                    </div>
                </div>

		        <h3 class="form-tittle">Linked Accounts</h3>
            	<div class="form-row">
		            <div class="form-group col">
		                <label>Type of Account</label>
		                <input type="text" formControlName="typeofaccount" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.typeofaccount.errors }" />
		                <div *ngIf="submitted && f.typeofaccount.errors" class="invalid-feedback">
		                    <div *ngIf="f.typeofaccount.errors.required">Type of Account is required</div>
		                </div>
		            </div>
		            <div class="form-group col">
		                <label>Account Name</label>
		                <input type="text" formControlName="accountName" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.accountName.errors }" />
		                <div *ngIf="submitted && f.accountName.errors" class="invalid-feedback">
		                    <div *ngIf="f.accountName.errors.required">Account Name is required</div>
		                </div>
		            </div>
		        </div>
		        <div class="form-row">
		            <div class="form-group col">
		                <label>Account Username</label>
		                <input type="text" formControlName="accountUsername" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.accountUsername.errors }" />
		                <div *ngIf="submitted && f.accountUsername.errors" class="invalid-feedback">
		                    <div *ngIf="f.accountUsername.errors.required">Account Username is required</div>
		                </div>
		            </div>
		            <div class="form-group col">
		                <label>Account Password</label>
		                <input type="text" formControlName="accountPassword" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.accountPassword.errors }" />
		                <div *ngIf="submitted && f.accountPassword.errors" class="invalid-feedback">
		                    <div *ngIf="f.accountPassword.errors.required">Account Password is required</div>
		                </div>
		            </div>
		        </div>
		        <div class="form-group">
                    <label for="accountisactive">Is active</label>
                    <select formControlName="accountisactive" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.accountisactive.errors }" >
                        <option value=""></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
                    </select>
                    <div *ngIf="submitted && f.accountisactive.errors" class="invalid-feedback">
                        <div *ngIf="f.accountisactive.errors.required">Is active is required</div>
                    </div>
                </div>

		        <h3 class="form-tittle">Professional Experience</h3>
		        <div class="form-row">
		            <div class="form-group col">
		                <label>Company Name</label>
		                <input type="text" formControlName="companyName" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.companyName.errors }" />
		                <div *ngIf="submitted && f.companyName.errors" class="invalid-feedback">
		                    <div *ngIf="f.companyName.errors.required">Company Name is required</div>
		                </div>
		            </div>
		            <div class="form-group col">
		                <label>Location City</label>
		                <input type="text" formControlName="locationCity" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.locationCity.errors }" />
		                <div *ngIf="submitted && f.locationCity.errors" class="invalid-feedback">
		                    <div *ngIf="f.locationCity.errors.required">Location City is required</div>
		                </div>
		            </div>
		        </div> 
		        <div class="form-row">
		            <div class="form-group col">
			            <label for="locationcountry">Location Country</label>
	                    <select formControlName="locationcountry" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.locationcountry.errors }" >
	                        <option value=""></option>
	                        
	                    </select>
	                    <div *ngIf="submitted && f.locationcountry.errors" class="invalid-feedback">
	                        <div *ngIf="f.locationcountry.errors.required">Country is required</div>
	                    </div>
		            </div>
		            <div class="form-group col">
		                <label>Title</label>
		                <input type="text" formControlName="proftitle" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.proftitle.errors }" />
		                <div *ngIf="submitted && f.proftitle.errors" class="invalid-feedback">
		                    <div *ngIf="f.proftitle.errors.required">Title is required</div>
		                </div>
		            </div>
		        </div>
		        <div class="form-row">
		            <div class="form-group col">
			            <label for="fromMonth">From Month</label>
	                    <select formControlName="fromMonth" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.fromMonth.errors }" >
	                       	<option value=""></option>
							<option value="1">Yes</option>
							<option value="0">No</option>
	                    </select>
	                    <div *ngIf="submitted && f.fromMonth.errors" class="invalid-feedback">
	                        <div *ngIf="f.fromMonth.errors.required">From Month is required</div>
	                    </div>
		            </div>
		             <div class="form-group col">
			            <label for="fromYear">From Year</label>
	                    <select formControlName="fromYear" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.fromYear.errors }" >
	                       	<option value=""></option>
							<option value="1">Yes</option>
							<option value="0">No</option>
	                    </select>
	                    <div *ngIf="submitted && f.fromYear.errors" class="invalid-feedback">
	                        <div *ngIf="f.fromYear.errors.required">From Year is required</div>
	                    </div>
		            </div>
		        </div>
		        <div class="form-row">
		            <div class="form-group col">
			            <label for="toMonth">To Month</label>
	                    <select formControlName="toMonth" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.toMonth.errors }" >
	                       	<option value=""></option>
							<option value="1">Yes</option>
							<option value="0">No</option>
	                    </select>
	                    <div *ngIf="submitted && f.toMonth.errors" class="invalid-feedback">
	                        <div *ngIf="f.toMonth.errors.required">To Month is required</div>
	                    </div>
		            </div>
		             <div class="form-group col">
			            <label for="toYear">To Year</label>
	                    <select formControlName="toYear" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.toYear.errors }" >
	                       	<option value=""></option>
							<option value="1">Yes</option>
							<option value="0">No</option>
	                    </select>
	                    <div *ngIf="submitted && f.toYear.errors" class="invalid-feedback">
	                        <div *ngIf="f.toYear.errors.required">To Year is required</div>
	                    </div>
		            </div>
		        </div>
		        <div class="form-group">
                    <label for="isPresent">Is Present</label>
                    <input type="text" formControlName="isPresent" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.isPresent.errors }" />
                    <div *ngIf="submitted && f.isPresent.errors" class="invalid-feedback">
                        <div *ngIf="f.isPresent.errors.required">Is Present is required</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="roleDescription">Role Description</label>
                    <input type="text" formControlName="roleDescription" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.roleDescription.errors }" />
                    <div *ngIf="submitted && f.roleDescription.errors" class="invalid-feedback">
                        <div *ngIf="f.roleDescription.errors.required">Role Description is required</div>
                    </div>
                </div>

                <h3 class="form-tittle">Other Experiences</h3>
                <div class="form-group">
                    <label for="otherExperienceTitle">Title</label>
                    <input type="text" formControlName="otherExperienceTitle" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.otherExperienceTitle.errors }" />
                    <div *ngIf="submitted && f.otherExperienceTitle.errors" class="invalid-feedback">
                        <div *ngIf="f.otherExperienceTitle.errors.required">Other Experiences is required</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="otherExperienceDescription">Description</label>
                    <input type="text" formControlName="otherExperienceDescription" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.otherExperienceDescription.errors }" />
                    <div *ngIf="submitted && f.otherExperienceDescription.errors" class="invalid-feedback">
                        <div *ngIf="f.otherExperienceDescription.errors.required">Description is required</div>
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