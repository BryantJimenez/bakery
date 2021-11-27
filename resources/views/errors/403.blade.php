@extends('layouts.error')

@section('title', 'Error 403')

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">403</h1>
		<p class="mini-text">Prohibition error!</p>
		<p class="error-text mb-4 mt-1">You do not have permission to access this site!</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">Home</a>
	</div>
</div>

@endsection