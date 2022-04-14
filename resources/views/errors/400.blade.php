@extends('layouts.error')

@section('title', trans('errors.400.title'))

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">@lang('errors.400.number')</h1>
		<p class="mini-text">@lang('errors.400.subtitle')</p>
		<p class="error-text mb-4 mt-1">@lang('errors.400.text')</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">@lang('errors.400.button')</a>
	</div>
</div>

@endsection