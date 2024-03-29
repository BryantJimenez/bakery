@extends('layouts.admin')

@section('title', trans('admin.groups.titles.show'))

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
	<div class="col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.groups.subtitles.show.data')</h3>
					@can('groups.edit')
					<a href="{{ route('groups.edit', ['group' => $group->slug]) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
					@endcan
				</div>
				<div class="user-info-list">
					<div class="row">
						<div class="col-12">
							<ul class="contacts-block list-unstyled mw-100 mx-2 mt-0">
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('form.name.label'):</b> {{ $group->name }}</span>
								</li>
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('form.condition.label'):</b> {{ $group->condition }}</span>
								</li>
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('admin.groups.info.min'):</b> {{ $group->min }}</span>
								</li>
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('admin.groups.info.max'):</b> {{ $group->max }}</span>
								</li>
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('form.attribute.label'):</b> @if(!is_null($group['attribute'])){{ $group['attribute']->name }}@else{{ trans('admin.not added') }}@endif</span>
								</li>
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('admin.groups.info.qty complements'):</b> {{ $group['complements']->count() }}</span>
								</li>
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('form.state.label'):</b> {!! state($group->state) !!}</span>
								</li>
								<li class="contacts-block__item">
									<a href="{{ route('groups.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
								</li>
							</ul>
						</div>      
					</div>
				</div>

			</div>
		</div>
	</div>

	@if($group['complements']->count()>0)
	<div class="col-12 layout-top-spacing">
		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.groups.subtitles.show.complements')</h3>
				</div>
				<div class="user-info-list">
					<div class="row">
						@foreach($group['complements'] as $complement)
						<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
							<div class="card card-complement mb-3">
								<img class="card-img-top" src="{{ image_exist('/admins/img/complements/', $complement->image, false, false) }}" alt="{{ $complement->name }}" title="{{ $complement->name }}">
								<div class="card-body p-2">
									<h5 class="card-title mb-1">{{ $complement->name }}</h5>
									<p class="card-text mb-0">@lang('form.price.label'): {{ number_format($complement['pivot']->price, 2, ',', '.') }}</p>
									<p class="card-text mb-0">@lang('form.state.label'): {!! stateComplement($complement['pivot']->state) !!}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>

@endsection