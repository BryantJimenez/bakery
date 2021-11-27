@extends('layouts.error')

@section('title', 'Error 400')

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">400</h1>
		<p class="mini-text">Error loading page!</p>
		<p class="error-text mb-4 mt-1">Please try again later!</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">Home</a>
	</div>
</div>

@endsection