@extends('layouts.error')

@section('title', 'Error 503')

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">503</h1>
		<p class="mini-text">This site will load in a few minutes!</p>
		<p class="error-text mb-4 mt-1">Please try again later!</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">Home</a>
	</div>
</div>

@endsection