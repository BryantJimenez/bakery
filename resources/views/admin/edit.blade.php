@extends('layouts.admin')

@section('title', trans('admin.profile.titles.edit'))

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
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
						<h4>@lang('admin.profile.titles.edit')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('profile.update', ['slug' => Auth::user()->slug]) }}" method="POST" class="form" id="formProfile" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.photo.label') (@lang('form.labels.optional'))</label>
									<input type="file" name="photo" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/users/', Auth::user()->photo, true) }}" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<div class="row">
										<div class="form-group col-lg-12 col-md-12 col-12">
											<label class="col-form-label">@lang('form.name.label')<b class="text-danger">*</b></label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="@lang('form.name.placeholder')" value="{{ Auth::user()->name }}">
										</div>

										<div class="form-group col-lg-12 col-md-12 col-12">
											<label class="col-form-label">@lang('form.lastname.label')<b class="text-danger">*</b></label>
											<input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="@lang('form.lastname.placeholder')" value="{{ Auth::user()->lastname }}">
										</div>
									</div> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.email.label')</label>
									<input class="form-control" type="text" disabled value="{{ Auth::user()->email }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.phone.label')<b class="text-danger">*</b></label>
									<input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="@lang('form.phone.placeholder')" value="{{ Auth::user()->phone }}" id="phone">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.address.label')<b class="text-danger">*</b></label>
									<input class="form-control @error('address') is-invalid @enderror" type="text" name="address" placeholder="@lang('form.address.placeholder')" value="{{ Auth::user()->address }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.language.label')<b class="text-danger">*</b></label>
									<select class="form-control @error('language_id') is-invalid @enderror" name="language_id" required>
										<option value="">@lang('form.select.select')</option>
										@foreach($languages as $language)
										<option value="{{ $language->id }}" @if(Auth::user()->language_id==$language->id) selected @endif>{{ $language->name.' ('.$language->language.')' }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.password.label') (@lang('form.labels.optional'))</label>
									<input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="********" id="password">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.password confirmation.label') (@lang('form.labels.optional'))</label>
									<input class="form-control" type="password" name="password_confirmation" placeholder="********">
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="profile">@lang('form.buttons.update')</button>
										<a href="{{ route('profile') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
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
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection