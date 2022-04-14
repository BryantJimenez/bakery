@extends('layouts.admin')

@section('title', trans('admin.products.titles.create'))

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>@lang('admin.products.titles.create')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('products.store') }}" method="POST" class="form" id="formProduct" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.name.label')<b class="text-danger">*</b></label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="@lang('form.name.placeholder')" value="{{ old('name') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.price.label')<b class="text-danger">*</b></label>
									<input class="form-control min-decimal @error('price') is-invalid @enderror" type="text" name="price" required placeholder="@lang('form.price.placeholder')" value="@if(!is_null(old('price'))){{ old('price') }}@else{{ '0' }}@endif">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.image.label')<b class="text-danger">*</b></label>
									<input type="file" name="image" required accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.category.label')<b class="text-danger">*</b></label>
									<select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
										<option value="">@lang('form.select.select')</option>
										@foreach($categories as $category)
										<option value="{{ $category->slug }}" @if(old('category_id')==$category->slug) selected @endif>{{ $category->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.state.label')<b class="text-danger">*</b></label>
									<select class="form-control" name="state" required>
										<option value="1" @if(old('state')=="1") selected @endif>@lang('admin.values_attributes.states.active')</option>
										<option value="2" @if(old('state')=="2") selected @endif>@lang('admin.values_attributes.states.products.not available')</option>
										<option value="3" @if(old('state')=="3") selected @endif>@lang('admin.values_attributes.states.products.out of stock')</option>
										<option value="0" @if(old('state')=="0") selected @endif>@lang('admin.values_attributes.states.inactive')</option>
									</select>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.description.label') (@lang('form.labels.optional'))</label>
									<textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="@lang('form.description.placeholder')" rows="2">{{ old('description') }}</textarea>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="product">@lang('form.buttons.save')</button>
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
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection