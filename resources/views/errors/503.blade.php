@extends('layouts.error')

@section('title', trans('errors.503.title'))

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">@lang('errors.503.number')</h1>
		<p class="mini-text">@lang('errors.503.subtitle')</p>
		<p class="error-text mb-4 mt-1">@lang('errors.503.text')</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">@lang('errors.503.button')</a>
	</div>
</div>

@endsection