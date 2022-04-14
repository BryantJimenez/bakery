@extends('layouts.error')

@section('title', trans('errors.419.title'))

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">@lang('errors.419.number')</h1>
		<p class="mini-text">@lang('errors.419.subtitle')</p>
		<p class="error-text mb-4 mt-1">@lang('errors.419.text')</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">@lang('errors.419.button')</a>
	</div>
</div>

@endsection