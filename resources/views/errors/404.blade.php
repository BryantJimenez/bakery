@extends('layouts.error')

@section('title', 'Error 404')

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">404</h1>
		<p class="mini-text">Page not found!</p>
		<p class="error-text mb-4 mt-1">What you are looking for you will not find here!</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">Home</a>
	</div>
</div>

@endsection