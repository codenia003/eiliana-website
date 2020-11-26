@extends('profile/layout')

@section('profile_content')
<div class="education-basic">
    <div class="card mb-3 mb-lg-5">
        <div class="card-header">
            <h5 class="card-title">Educations
                <a routerLink="./education-add" class="btn btn-primary bg-orange float-right">Add Educations</a>
            </h5>
        </div>
        <!-- Body -->
        <div class="card-body">
            <div class="card-body" style="min-height: 15rem;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Education</th>
                            <th>College Name</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Area</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr *ngFor="let education of educations">
                            <td>{{education.educationtype.name}}</td>
                            <td>{{education.name}}</td>
                            <td>{{education.from_date}}</td>
                            <td>{{education.to_date}}</td>
                            <td>{{education.area_of_education}}</td>
                            <td style="white-space: nowrap">
                                <a routerLink="./education-edit/{{education.education_id}}" class="btn btn-sm btn-primary mr-1">Edit</a>
                            </td>
                        </tr> --}}
                        <tr *ngIf="!educations">
                            <td colspan="6" class="text-center">
                                <!-- <span  *ngIf="loading" class="spinner-border spinner-border-lg align-center"></span> -->
                                <span  *ngIf="!loading">Education list is empty</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Body -->
    </div>
</div>

@stop