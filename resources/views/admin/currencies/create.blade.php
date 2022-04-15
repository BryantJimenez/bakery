@extends('layouts.admin')

@section('title', trans('admin.currencies.titles.create'))

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>@lang('admin.currencies.titles.create')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('currencies.store') }}" method="POST" class="form" id="formCurrency">
							@csrf
							<div class="row">
								@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $locales)
                                <div class="form-group col-12">
									<label class="col-form-label">@lang('form.name.label') ({{ $locales['native'] }})<b class="text-danger">*</b></label>
									<input class="form-control @error('name.'.$localeCode) is-invalid @enderror" type="text" name="name[{{ $localeCode }}]" required placeholder="@lang('form.name.placeholder')" value="{{ old('name.'.$localeCode) }}" id="{{ 'name_'.$localeCode }}">
								</div>
                                @endforeach

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.iso.label')<b class="text-danger">*</b></label>
									<input class="form-control @error('iso') is-invalid @enderror" type="text" name="iso" required placeholder="@lang('form.iso.placeholder')" value="{{ old('iso') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.symbol.label')<b class="text-danger">*</b></label>
									<input class="form-control @error('symbol') is-invalid @enderror" type="text" name="symbol" required placeholder="@lang('form.symbol.placeholder')" value="{{ old('symbol') }}">
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="currency">@lang('form.buttons.save')</button>
										<a href="{{ route('currencies.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
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
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection