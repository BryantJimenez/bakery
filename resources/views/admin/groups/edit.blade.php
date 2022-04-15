@extends('layouts.admin')

@section('title', trans('admin.groups.titles.edit'))

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
						<h4>@lang('admin.groups.titles.edit')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('groups.update', ['group' => $group->slug]) }}" method="POST" class="form" id="formGroup">
							@csrf
							@method('PUT')
							<div class="row">
								@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $locales)
								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.name.label') ({{ $locales['native'] }})<b class="text-danger">*</b></label>
									<input class="form-control @error('name.'.$localeCode) is-invalid @enderror" type="text" name="name[{{ $localeCode }}]" required placeholder="@lang('form.name.placeholder')" value="{{ $group->translate('name', $localeCode) }}" id="{{ 'name_'.$localeCode }}">
								</div>
								@endforeach

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.condition.label')<b class="text-danger">*</b></label>
									<select class="form-control @error('condition') is-invalid @enderror" name="condition" required>
										<option value="1" @if($group->condition==trans('admin.values_attributes.conditions.required')) selected @endif>@lang('admin.values_attributes.conditions.required')</option>
										<option value="0" @if($group->condition==trans('admin.values_attributes.conditions.optional')) selected @endif>@lang('admin.values_attributes.conditions.optional')</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.minimum.label')<b class="text-danger">*</b></label>
									<input class="form-control int-max-100 @error('min') is-invalid @enderror" type="text" name="min" required placeholder="@lang('form.minimum.placeholder')" value="{{ $group->min }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.maximum.label')<b class="text-danger">*</b></label>
									<input class="form-control int-max-100 @error('max') is-invalid @enderror" type="text" name="max" required placeholder="@lang('form.maximum.placeholder')" value="{{ $group->max }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.attribute.label')<b class="text-danger">*</b></label>
									<select class="form-control @error('attribute_id') is-invalid @enderror" name="attribute_id">
										<option value="">@lang('form.select.select')</option>
										@foreach($attributes as $attribute)
										<option value="{{ $attribute->slug }}" @if($group->attribute_id==$attribute->id) selected @endif>{{ $attribute->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.state.label')<b class="text-danger">*</b></label>
									<select class="form-control @error('state') is-invalid @enderror" name="state" required>
										<option value="1" @if($group->state==trans('admin.values_attributes.states.active')) selected @endif>@lang('admin.values_attributes.states.active')</option>
										<option value="0" @if($group->state==trans('admin.values_attributes.states.inactive')) selected @endif>@lang('admin.values_attributes.states.inactive')</option>
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="group">@lang('form.buttons.update')</button>
										<a href="{{ route('groups.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
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