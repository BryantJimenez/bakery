@extends('layouts.admin')

@section('title', trans('admin.products.titles.show'))

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="">@lang('admin.products.subtitles.show.data')</h3>
					@can('products.edit')
					<a href="{{ route('products.edit', ['product' => $product->slug]) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
					@endcan
				</div>
				<div class="text-center user-info">
					<img src="{{ image_exist('/admins/img/products/', $product->image, false, false) }}" width="90" height="90" alt="{{ $product->name }}" title="{{ $product->name }}">
					<p class="mb-0">{{ $product->name }}</p>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled">
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>{!! stateProduct($product->state) !!}
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.products.subtitles.show.aditional')</h3>
				</div>
				<div class="user-info-list">
					<div class="row">
						<div class="col-12">
							<ul class="contacts-block list-unstyled mw-100 mx-2 mt-0">
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('form.price.label'):</b> {{ number_format($product->price, 2, ',', '.') }}</span>
								</li>
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('form.description.label'):</b> @if(!is_null($product->description)){{ $product->description }}@else{{ trans('admin.not added') }}@endif</span>
								</li>
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('form.category.label'):</b> @if(!is_null($product['category'])){{ $product['category']->name }}@else{{ trans('admin.not added') }}@endif</span>
								</li>
								<li class="contacts-block__item">
									<span class="h6 text-black"><b>@lang('admin.products.info.qty groups'):</b> {{ $product['groups']->count() }}</span>
								</li>
								<li class="contacts-block__item">
									<a href="{{ route('products.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
								</li>
							</ul>
						</div>      
					</div>
				</div>

			</div>
		</div>
	</div>

	@if($product['groups']->count()>0)
	<div class="col-12 layout-top-spacing">
		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.products.subtitles.show.groups')</h3>
				</div>
				<div class="user-info-list">
					@foreach($product['groups'] as $group)
					<div class="row">
						<div class="col-12 my-2">
							<h6 class="font-weight-bold">{{ $group->name }}</h6>
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
					@endforeach
				</div>
			</div>
		</div>
	</div>
	@endif
</div>

@endsection