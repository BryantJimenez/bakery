@extends('layouts.admin')

@section('title', trans('admin.groups.titles.complements'))

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
						<h4>@lang('admin.groups.titles.complements')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>@lang('form.required fields') (<b class="text-danger">*</b>)</p>
						<form action="{{ route('groups.assign.complements', ['group' => $group->slug]) }}" method="POST" class="form" id="formAssignGroupComplement">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="col-12">
									<button type="button" class="btn btn-primary" id="add-complements"><i class="fa fa-plus"></i> @lang('form.buttons.add')</button>
								</div>

								<div class="col-12" id="group-complements">
									@foreach($group['complements'] as $complement)
									<div class="row" complement="{{ $loop->index }}">
										@if($loop->index>0)
										<div class="col-12">
											<hr class="my-2">
										</div>
										@endif

										<div class="form-group col-xl-4 col-lg-4 col-md-4 col-12">
											<label class="col-form-label">@lang('form.complement.label')<b class="text-danger">*</b></label>
											<select class="form-control @error('complement_id') is-invalid @enderror" name="complement_id[]" complement="{{ $loop->index }}" id="{{ 'complement_'.$loop->index }}">
												<option value="">@lang('form.select.select')</option>
												@foreach($complements as $extra)
												<option value="{{ $extra->slug }}" price="{{ $extra->price }}" @if($complement->id==$extra->id) selected @endif>{{ $extra->name }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-5 col-12">
											<label class="col-form-label">@lang('form.price.label')<b class="text-danger">*</b></label>
											<input class="form-control min-decimal @error('price') is-invalid @enderror" type="text" name="price[]" required placeholder="@lang('form.price.placeholder')" value="{{ $complement['pivot']->price }}" complement="{{ $loop->index }}" id="{{ 'price_'.$loop->index }}">
										</div>

										<div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-5 col-10">
											<label class="col-form-label">@lang('form.state.label')<b class="text-danger">*</b></label>
											<select class="form-control" name="state[]" required id="{{ 'state_'.$loop->index }}">
												<option value="1" @if($complement['pivot']->state=="1") selected @endif>@lang('admin.values_attributes.states.complements.available')</option>
												<option value="2" @if($complement['pivot']->state=="2") selected @endif>@lang('admin.values_attributes.states.complements.not available')</option>
												<option value="3" @if($complement['pivot']->state=="3") selected @endif>@lang('admin.values_attributes.states.complements.out of stock')</option>
												<option value="0" @if($complement['pivot']->state=="0") selected @endif>@lang('admin.values_attributes.states.complements.not visible')</option>
											</select>
										</div>
										
										<div class="form-group col-xl-1 col-lg-1 col-md-1 col-2 d-flex align-items-end">
											<a href="javascript:void(0);" class="text-danger complement-remove mb-3" complement="{{ $loop->index }}">
												<i class="fa fa-trash"></i>
											</a>
										</div>
									</div>
									@endforeach
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