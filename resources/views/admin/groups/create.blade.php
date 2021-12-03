@extends('layouts.admin')

@section('title', 'Create Groups')

@section('links')
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
						<h4>Create Groups</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Required fields (<b class="text-danger">*</b>)</p>
						<form action="{{ route('groups.store') }}" method="POST" class="form" id="formGroup">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Name<b class="text-danger">*</b></label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Enter a name" value="{{ old('name') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Condition<b class="text-danger">*</b></label>
									<select class="form-control @error('condition') is-invalid @enderror" name="condition" required>
										<option value="1" @if(old('condition')=="1") selected @endif>Required</option>
										<option value="0" @if(old('condition')=="0") selected @endif>Optional</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Min<b class="text-danger">*</b></label>
									<input class="form-control int-max-100 @error('min') is-invalid @enderror" type="text" name="min" required placeholder="Enter a min" value="@if(!is_null(old('min'))){{ old('min') }}@else{{ '0' }}@endif">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Max<b class="text-danger">*</b></label>
									<input class="form-control int-max-100 @error('max') is-invalid @enderror" type="text" name="max" required placeholder="Enter a max" value="@if(!is_null(old('max'))){{ old('max') }}@else{{ '0' }}@endif">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Attribute<b class="text-danger">*</b></label>
									<select class="form-control @error('attribute_id') is-invalid @enderror" name="attribute_id">
										<option value="">Select</option>
										@foreach($attributes as $attribute)
										<option value="{{ $attribute->slug }}" @if(old('attribute_id')==$attribute->slug) selected @endif>{{ $attribute->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">State<b class="text-danger">*</b></label>
									<select class="form-control @error('state') is-invalid @enderror" name="state" required>
										<option value="1" @if(old('state')=="1") selected @endif>Active</option>
										<option value="0" @if(old('state')=="0") selected @endif>Inactive</option>
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="group">Save</button>
										<a href="{{ route('groups.index') }}" class="btn btn-secondary">Return</a>
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
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection