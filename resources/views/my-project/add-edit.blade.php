@extends('my-project/layout')

@section('project_content')
<div class="card mb-3 mb-lg-5">
  <div class="card-header">
    <h5 class="card-title" *ngIf="isAddMode">Add Project</h5>
    <h5 class="card-title" *ngIf="!isAddMode">Edit Project</h5>
  </div>
  <!-- Body -->
  <div class="card-body">
    <div class="card-body p-4" style="min-height: 15rem;">
        <form [formGroup]="form" (ngSubmit)="onSubmit()">
            <div class="form-group">
                <label>Project Name</label>
                <input type="text" formControlName="project_name" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.project_name.errors }" />
                <div *ngIf="submitted && f.project_name.errors" class="invalid-feedback">
                    <div *ngIf="f.project_name.errors.required">Project Name is required</div>
                </div>
            </div>
            <div class="form-group">
                <label>Project Description</label>
                <input type="text" formControlName="project_description" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.project_description.errors }" />
                <div *ngIf="submitted && f.project_description.errors" class="invalid-feedback">
                    <div *ngIf="f.project_description.errors.required">Project Description is required</div>
                </div>
            </div>
            <div class="form-group">
                <label for="payment_type">Payment Type</label>
                <select formControlName="payment_type" class="form-control" [ngClass]="{ 'is-invalid': submitted && f.payment_type.errors }" >
                        <option value="">--Select--</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 1</option>
                    </select>
                <div *ngIf="submitted && f.payment_type.errors" class="invalid-feedback">
                    <div *ngIf="f.payment_type.errors.required">Payment Type is required</div>
                </div>
            </div>
            <div class="form-group text-right mt-5 singup-body">
                <div class="btn-group" role="group">
                    <button [disabled]="loading" class="btn btn-primary">
                        <span *ngIf="loading" class="spinner-border spinner-border-sm mr-1"></span>
                        Next <i class="fa fa-angle-right"></i>
                    </button>
                    <button class="btn btn-outline-primary" routerLink="/my-project">Cancel</button>
                </div>
            </div>
        </form>
    </div>
  </div>
  <!-- End Body -->
</div>
@stop