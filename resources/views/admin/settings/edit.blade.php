@extends('layouts.admin')

@section('title', trans('admin.settings.titles.edit'))

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
						<h4>@lang('admin.settings.titles.edit')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('settings.update') }}" method="POST" class="form" id="formSetting">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.currency.label')<b class="text-danger">*</b></label>
									<select class="form-control @error('currency_id') is-invalid @enderror" name="currency_id" required>
										<option value="">@lang('form.select.select')</option>
										@foreach($currencies as $currency)
										<option value="{{ $currency->slug }}" @if($setting->currency_id==$currency->id) selected @endif>{{ $currency->name." - ".$currency->iso." (".$currency->symbol.")" }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.terms.label') (@lang('form.labels.optional'))</label>
									<textarea class="form-control @error('terms') is-invalid @enderror" name="terms" placeholder="@lang('form.terms.placeholder')" id="content-term">{{ $setting->terms }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.privacity.label') (@lang('form.labels.optional'))</label>
									<textarea class="form-control @error('privacity') is-invalid @enderror" name="privacity" placeholder="@lang('form.privacity.placeholder')" id="content-privacity">{{ $setting->privacity }}</textarea>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.stripe_public.label') (@lang('form.labels.optional'))</label>
									<input class="form-control @error('stripe_public') is-invalid @enderror" name="stripe_public" placeholder="@lang('form.stripe_public.placeholder')" value="{{ $setting->stripe_public }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.stripe_secret.label') (@lang('form.labels.optional'))</label>
									<input class="form-control @error('stripe_secret') is-invalid @enderror" name="stripe_secret" placeholder="@lang('form.stripe_secret.placeholder')" value="{{ $setting->stripe_secret }}">
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="setting">@lang('form.buttons.update')</button>
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
<script src="{{ asset('/admins/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection