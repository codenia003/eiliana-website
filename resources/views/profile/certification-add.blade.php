@extends('profile/layout')

@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Certification</h4>
        <div class="card-body p-4">
            <form [formGroup]="addInfoForm" (ngSubmit)="onSubmit()">
		        <div class="form-row">
		            <div class="form-group col">
		                <label>Certification Id</label>
		                <input type="text" formControlName="certificationId" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.certificationId.errors }" />
		                <div *ngIf="submitted && f.certificationId.errors" class="invalid-feedback">
		                    <div *ngIf="f.certificationId.errors.required">Certification Id is required</div>
		                </div>
		            </div>
		            <div class="form-group col">
		                <label>Certification Name</label>
		                <input type="text" formControlName="certificationName" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.certificationName.errors }" />
		                <div *ngIf="submitted && f.certificationName.errors" class="invalid-feedback">
		                    <div *ngIf="f.certificationName.errors.required">Certification Name is required</div>
		                </div>
		            </div>
		        </div>
		        <div class="form-group">
                    <label for="isactive">Valid Till</label>
                    <input type="date" formControlName="validTill" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.validTill.errors }" />
                    <div *ngIf="submitted && f.validTill.errors" class="invalid-feedback">
                        <div *ngIf="f.validTill.errors.required">Valid Till is required</div>
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