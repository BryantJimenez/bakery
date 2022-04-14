@extends('layouts.admin')

@section('title', trans('admin.complements.titles.show'))

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="">@lang('admin.complements.subtitles.show.data')</h3>
					@can('complements.edit')
					<a href="{{ route('complements.edit', ['complement' => $complement->slug]) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
					@endcan
				</div>
				<div class="text-center user-info">
					<img src="{{ image_exist('/admins/img/complements/', $complement->image, false, false) }}" width="90" height="90" alt="{{ $complement->name }}" title="{{ $complement->name }}">
					<p class="mb-0">{{ $complement->name }}</p>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled">
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>{!! state($complement->state) !!}
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.complements.subtitles.show.aditional')</h3>
				</div>
				<div class="user-info-list">
					<div class="row">
						<div class="col-12">
							<ul class="contacts-block list-unstyled mw-100 mx-2 mt-0">
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('form.price.label'):</b> {{ number_format($complement->price, 2, ',', '.') }}</span>
								</li>
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('form.description.label'):</b> @if(!is_null($complement->description)){{ $complement->description }}@else{{ trans('admin.not added') }}@endif</span>
								</li>
								<li class="contacts-block__item">
									<a href="{{ route('complements.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
								</li>
							</ul>
						</div>      
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection