@extends('layouts.admin')

@section('title', trans('admin.schedules.titles.create'))

@section('links')
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>@lang('admin.schedules.titles.create')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('schedules.store') }}" method="POST" class="form" id="formSchedule">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.start_time.label')<b class="text-danger">*</b></label>
									<input class="form-control @error('start') is-invalid @enderror" type="text" name="start" required placeholder="@lang('form.start_time.placeholder')" value="{{ old('start') }}" id="startTimeFlatpickr">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">@lang('form.end_time.label')<b class="text-danger">*</b></label>
									<input class="form-control @error('end') is-invalid @enderror" type="text" name="end" required placeholder="@lang('form.end_time.placeholder')" value="{{ old('end') }}" id="endTimeFlatpickr">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">@lang('form.days.label')<b class="text-danger">*</b></label>
									@if(is_null(old('days')))
									<select class="form-control selectpicker" name="days[]" required title="Seleccione" multiple>
										<option value="1">@lang('admin.values_attributes.days.1')</option>
										<option value="2">@lang('admin.values_attributes.days.2')</option>
										<option value="3">@lang('admin.values_attributes.days.3')</option>
										<option value="4">@lang('admin.values_attributes.days.4')</option>
										<option value="5">@lang('admin.values_attributes.days.5')</option>
										<option value="6">@lang('admin.values_attributes.days.6')</option>
										<option value="7">@lang('admin.values_attributes.days.7')</option>
									</select>
									@else
									<select class="form-control selectpicker" name="days[]" required title="Seleccione" multiple>
										{!! selectArrayDays(old('days')) !!}
									</select>
									@endif
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="schedule">@lang('form.buttons.save')</button>
										<a href="{{ route('schedules.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
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
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection