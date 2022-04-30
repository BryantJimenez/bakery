@extends('layouts.admin')

@section('title', trans('admin.coupons.titles.create'))

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
						<h4>@lang('admin.coupons.titles.create')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('coupons.store') }}" method="POST" class="form" id="formCoupon">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.type.label')<b class="text-danger">*</b></label>
									<select class="form-control @error('type') is-invalid @enderror" name="type" required id="typeCoupon">
										<option value="">@lang('form.select.select')</option>
										<option value="1" @if(old('type')=='1') selected @endif>@lang('admin.values_attributes.types.coupons.percentage')</option>
										<option value="2" @if(old('type')=='2') selected @endif>@lang('admin.values_attributes.types.coupons.fixed')</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.limit.label')<b class="text-danger">*</b></label>
									<input class="form-control number int-positive @error('limit') is-invalid @enderror" type="text" name="limit" required placeholder="@lang('form.limit.placeholder')" value="@if(!is_null(old('limit'))){{ old('limit') }}@else{{ '1' }}@endif">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.discount.label')<b class="text-danger">*</b></label>
									<input class="form-control discount @error('discount') is-invalid @enderror" type="text" name="discount" required placeholder="@lang('form.discount.placeholder')" value="@if(!is_null(old('discount'))){{ old('discount') }}@else{{ '1' }}@endif">
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="coupon">@lang('form.buttons.save')</button>
										<a href="{{ route('coupons.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
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
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection