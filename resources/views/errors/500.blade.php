@extends('layouts.error')

@section('title', trans('errors.500.title'))

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">@lang('errors.500.number')</h1>
		<p class="mini-text">@lang('errors.500.subtitle')</p>
		<p class="error-text mb-4 mt-1">@lang('errors.500.text')</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">@lang('errors.500.button')</a>
	</div>
</div>

@endsection