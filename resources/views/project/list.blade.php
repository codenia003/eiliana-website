@extends('my-project/layout')

@section('project_content')
<div class="card mb-3 mb-lg-5">
  <div class="card-header">
    <h5 class="card-title">Project
    <a routerLink="add" class="btn btn-primary bg-orange float-right">Add Project</a>
    </h5>
  </div>
  <!-- Body -->
  <div class="card-body">
    <div class="card-body" style="min-height: 15rem;">
      <table class="table">
          <thead>
            <tr>
              <th>Project Name</th>
              <th>Project Description</th>
              <th>Expiry Datetime</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            {{-- <tr *ngFor="let project of projects">
              <td>{{project.project_name}}</td>
              <td>{{project.project_description}}</td>
              <td>{{project.expiry_datetime}}</td>
              <td style="white-space: nowrap">
                <a routerLink="edit/{{project.id}}" class="btn btn-sm btn-primary mr-1">Edit</a>
              </td>
            </tr>--}}
            <tr *ngIf="!projects">
              <td colspan="4" class="text-center">
                <span  *ngIf="loading" class="spinner-border spinner-border-lg align-center"></span>
                <span  *ngIf="!loading">Project list is empty</span>
              </td>
            </tr>
          </tbody>
      </table>
    </div>
  </div>
  <!-- End Body -->
</div>
@stop