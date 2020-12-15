@extends('search/layout')

@section('search_content')
<div class="advance-search singup-body login-body">
    <form action="{{ url('/advance-search/updateProfile') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="basic-info">
                    <label>Type of Project</label>
                    <div class="form-check form-check-inline ml-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="support" class="custom-control-input" name="top" value="1">
                            <label class="custom-control-label" for="support">Support</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="development" class="custom-control-input" name="top" value="2">
                            <label class="custom-control-label" for="development">Development</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="both" class="custom-control-input" name="top" value="3">
                            <label class="custom-control-label" for="both">Both</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="form-group">
                    <label>Any Keyword(Key Skills)</label>
                    <input type="text" name="username" class="form-control" value="" />
                </div>

            </div>
        </div>
    </form>
</div>
@stop