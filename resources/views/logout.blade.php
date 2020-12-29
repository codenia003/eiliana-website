@extends('layouts/default')

{{-- Page title --}}
@section('title')
Logout
@parent
@stop


{{-- content --}}
@section('content')
<div class="logout">
	<img src="/assets/img/logout.png" class="img-fluid" alt="logout">
	<div class="shadow"></div>
</div>
@stop