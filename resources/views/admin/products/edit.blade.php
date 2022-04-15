@extends('layouts.admin')

@section('title', trans('admin.products.titles.edit'))

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
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
						<h4>@lang('admin.products.titles.edit')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('products.update', ['product' => $product->slug]) }}" method="POST" class="form" id="formProductEdit" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $locales)
								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.name.label') ({{ $locales['native'] }})<b class="text-danger">*</b></label>
									<input class="form-control @error('name.'.$localeCode) is-invalid @enderror" type="text" name="name[{{ $localeCode }}]" required placeholder="@lang('form.name.placeholder')" value="{{ $product->translate('name', $localeCode) }}" id="{{ 'name_'.$localeCode }}">
								</div>
								@endforeach

								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.image.label') (@lang('form.labels.optional'))</label>
									<input type="file" name="image" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/products/', $product->image, false, false) }}" />
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.category.label')<b class="text-danger">*</b></label>
									<select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
										<option value="">@lang('form.select.select')</option>
										@foreach($categories as $category)
										<option value="{{ $category->slug }}" @if($product->category_id==$category->id) selected @endif>{{ $category->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.price.label')<b class="text-danger">*</b></label>
									<input class="form-control min-decimal @error('price') is-invalid @enderror" type="text" name="price" required placeholder="@lang('form.price.placeholder')" value="{{ $product->price }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.state.label')<b class="text-danger">*</b></label>
									<select class="form-control" name="state" required>
										<option value="1" @if($product->state==trans('admin.values_attributes.states.active')) selected @endif>@lang('admin.values_attributes.states.active')</option>
										<option value="2" @if($product->state==trans('admin.values_attributes.states.products.not available')) selected @endif>@lang('admin.values_attributes.states.products.not available')</option>
										<option value="3" @if($product->state==trans('admin.values_attributes.states.products.out of stock')) selected @endif>@lang('admin.values_attributes.states.products.out of stock')</option>
										<option value="0" @if($product->state==trans('admin.values_attributes.states.inactive')) selected @endif>@lang('admin.values_attributes.states.inactive')</option>
									</select>
								</div>

								@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $locales)
								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.description.label') ({{ $locales['native'] }}) (@lang('form.labels.optional'))</label>
									<textarea class="form-control @error('description.'.$localeCode) is-invalid @enderror" name="description[{{ $localeCode }}]" placeholder="@lang('form.description.placeholder')" rows="2" id="{{ 'description_'.$localeCode }}">{{ $product->translate('description', $localeCode) }}</textarea>
								</div>
								@endforeach

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="product">@lang('form.buttons.update')</button>
										<a href="{{ route('products.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
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
<script src="{{ asset('/admins/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection