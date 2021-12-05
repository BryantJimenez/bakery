@extends('layouts.admin')

@section('title', 'Edit Product')

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
						<h4>Edit Product</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Required fields (<b class="text-danger">*</b>)</p>
						<form action="{{ route('products.update', ['product' => $product->slug]) }}" method="POST" class="form" id="formProductEdit" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Name<b class="text-danger">*</b></label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Enter a name" value="{{ $product->name }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Price<b class="text-danger">*</b></label>
									<input class="form-control min-decimal @error('price') is-invalid @enderror" type="text" name="price" required placeholder="Enter a price" value="{{ $product->price }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Image (Optional)</label>
									<input type="file" name="image" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/products/', $product->image, false, false) }}" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Category<b class="text-danger">*</b></label>
									<select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
										<option value="">Select</option>
										@foreach($categories as $category)
										<option value="{{ $category->slug }}" @if($product->category_id==$category->id) selected @endif>{{ $category->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">State<b class="text-danger">*</b></label>
									<select class="form-control" name="state" required>
										<option value="1" @if($product->state=="Active") selected @endif>Active</option>
										<option value="2" @if($product->state=="Not Available") selected @endif>Not Available</option>
										<option value="3" @if($product->state=="Out of Stock") selected @endif>Out of Stock</option>
										<option value="0" @if($product->state=="Inactive") selected @endif>Inactive</option>
									</select>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Description (Optional)</label>
									<textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter a description" rows="2">{{ $product->description }}</textarea>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="product">Update</button>
										<a href="{{ route('products.index') }}" class="btn btn-secondary">Return</a>
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
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection