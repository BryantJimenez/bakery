@extends('layouts.admin')

@section('title', trans('admin.attributes.titles.edit'))

@section('links')
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
						<h4>@lang('admin.attributes.titles.edit')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('attributes.update', ['attribute' => $attribute->slug]) }}" method="POST" class="form" id="formAttribute">
							@csrf
							@method('PUT')
							<div class="row">
								@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $locales)
								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.name.label') ({{ $locales['native'] }})<b class="text-danger">*</b></label>
									<input class="form-control @error('name.'.$localeCode) is-invalid @enderror" type="text" name="name[{{ $localeCode }}]" required placeholder="@lang('form.name.placeholder')" value="{{ $attribute->translate('name', $localeCode) }}" id="{{ 'name_'.$localeCode }}">
								</div>
								@endforeach

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="attribute">@lang('form.buttons.update')</button>
										<a href="{{ route('attributes.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
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
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection