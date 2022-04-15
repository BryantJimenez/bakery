@extends('layouts.admin')

@section('title', trans('admin.agencies.titles.edit'))

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>@lang('admin.agencies.titles.edit')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('agencies.update', ['agency' => $agency->slug]) }}" method="POST" class="form" id="formAgency">
							@csrf
							@method('PUT')
							<div class="row">
								@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $locales)
								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.name.label') ({{ $locales['native'] }})<b class="text-danger">*</b></label>
									<input class="form-control @error('name.'.$localeCode) is-invalid @enderror" type="text" name="name[{{ $localeCode }}]" required placeholder="@lang('form.name.placeholder')" value="{{ $agency->translate('name', $localeCode) }}" id="{{ 'name_'.$localeCode }}">
								</div>
								@endforeach

								@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $locales)
								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.route.label') ({{ $locales['native'] }})<b class="text-danger">*</b></label>
									<input class="form-control @error('route.'.$localeCode) is-invalid @enderror" type="text" name="route[{{ $localeCode }}]" required placeholder="@lang('form.route.placeholder')" value="{{ $agency->translate('route', $localeCode) }}" id="{{ 'name_'.$localeCode }}">
								</div>
								@endforeach

								@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $locales)
								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.description.label') ({{ $locales['native'] }}) (@lang('form.labels.optional'))</label>
									<textarea class="form-control @error('description.'.$localeCode) is-invalid @enderror" name="description[{{ $localeCode }}]" placeholder="@lang('form.description.placeholder')" rows="2" id="{{ 'description_'.$localeCode }}">{{ $agency->translate('description', $localeCode) }}</textarea>
								</div>
								@endforeach

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.price.label')<b class="text-danger">*</b></label>
									<input class="form-control min-decimal @error('price') is-invalid @enderror" type="text" name="price" required placeholder="@lang('form.price.placeholder')" value="{{ $agency->price }}">
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="agency">@lang('form.buttons.update')</button>
										<a href="{{ route('agencies.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
									</div>
								</div> 
							</div>
						</form>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection