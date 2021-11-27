@extends('layouts.error')

@section('title', 'Error 419')

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">419</h1>
		<p class="mini-text">Session expired!</p>
		<p class="error-text mb-4 mt-1">Your session has expired!</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">Home</a>
	</div>
</div>

@endsection