@extends('layouts.web')

@section('title', trans('admin.name'))

@section('content')

<section class="container">
	<div class="row">
		<div class="col-12 mb-lg-0 my-4">
			<h1>@lang('web.offline.text')</h1>
		</div>
	</div>
</section>

<div id="toTop"></div>

@endsection