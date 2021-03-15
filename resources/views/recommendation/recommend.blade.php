@extends('recommendation/layout')
@section('recommendation_css')
@stop

@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2">Recommendation Project </span>
        </div>
    </div>
</div>
@stop
@section('recommendation_content')
<div class="advance-search singup-body login-body">
    <div class="card">
        <form action="{{ url('/freelancer/recommandStore') }}" method="POST">
            @csrf
            <div class="card-body p-4">
                <div class="form-row">
                    <div class="form-group col">
                        <label>Project ID</label>
                        <input type="text" name="project_id" class="form-control" value="1" readonly/>
                    </div>
                    <div class="form-group col">
                        <label>Proposal ID </label>
                        <input type="text" name="project_proposal_id" value="2" class="form-control" readonly/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label>Message</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                
                <div class="form-group mt-5">
                    <div class="stafflead-basic">
                        <button class="btn btn-md btn-info bg-light-blue" type="submit">Recommand To Project</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@stop

