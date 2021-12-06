@extends('layouts.error')

@section('title', 'Error 503')

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">503</h1>
		<p class="mini-text">¡Este sitio se cargará en unos minutos!</p>
		<p class="error-text mb-4 mt-1">¡Por favor, inténtelo de nuevo más tarde!</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">Inicio</a>
	</div>
</div>

@endsection