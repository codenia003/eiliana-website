@extends('profile/layout')

@section('profile_content')
<div class="education-basic">
    <div class="card mb-3 mb-lg-5">
        <div class="card-header">
            <h5 class="card-title">Certification
                <a routerLink="./certification-add" class="btn btn-primary bg-orange float-right">Add Certification</a>
            </h5>
        </div>
        <!-- Body -->
        <div class="card-body">
            <div class="card-body" style="min-height: 15rem;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Valid Till</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr *ngIf="!users">
                            <td colspan="4" class="text-center">
                                <span class="spinner-border spinner-border-lg align-center"></span>
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