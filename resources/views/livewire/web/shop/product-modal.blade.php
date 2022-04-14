<div>
	<div class="modal fade @if($show===true) show @endif" id="modal-product" style="display: @if($show===true) block @else none @endif;" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="background zoom-anim-dialog">
				<div class="modal-content">
					@if(!is_null($product))
					<div class="modal-header small-dialog-header">
						<h5 class="modal-title">[<span class="font-weigt-bold">{{ number_format($price+$price_aditional, 2, ',', '.').currencySymbol($currency) }}</span>] {{ $product['category']->name.": ".$product->name }}</h5>
						<button type="button" class="mfp-close" aria-label="Close" wire:click.prevent="close"></button>
					</div>
					@if($steps)
					<div class="modal-body content">
						<p>{{ $product->description }}</p>

						<div class="row">
							<div class="modal-complements col-12" current="{{ $current }}" condition="{{ $groups[$current]->condition }}" min="{{ $groups[$current]->min }}" max="{{ $groups[$current]->max }}">

								@if($groups[$current]->condition==trans('admin.values_attributes.conditions.required'))

								@if($groups[$current]->min==$groups[$current]->max)
								<h5>@lang('web.shop.modal.choices.choose', ['max' => $groups[$current]->max, 'attribute' => $groups[$current]['attribute']->name])</h5>
								@else
								<h5>@lang('web.shop.modal.choices.choose at least', ['min' => $groups[$current]->min, 'attribute' => $groups[$current]['attribute']->name, 'max' => $groups[$current]->max])</h5>
								@endif

								@else

								@if($groups[$current]->min==$groups[$current]->max)
								<h5>@lang('web.shop.modal.choices.choose', ['max' => $groups[$current]->max, 'attribute' => $groups[$current]['attribute']->name])</h5>
								@elseif($groups[$current]->min>0)
								<h5>@lang('web.shop.modal.choices.choose at least', ['min' => $groups[$current]->min, 'attribute' => $groups[$current]['attribute']->name, 'max' => $groups[$current]->max])</h5>
								@else
								<h5>@lang('web.shop.modal.choices.choose maximum', ['max' => $groups[$current]->max, 'attribute' => $groups[$current]['attribute']->name])</h5>
								@endif

								@endif

								<ul class="clearfix mb-0">
									@foreach($groups[$current]['complements'] as $key => $complement)
									@if($complement['pivot']->state!='0')
									<li>
										<label class="container_check">
											<img src="{{ image_exist('/admins/img/complements/', $complement->image, false, false) }}" class="rounded-circle mr-2" width="30" height="30" title="{{ $complement->name }}" alt="{{ $complement->name }}">
											{{ $complement->name }}
											@if($complement['pivot']->state=='2' || $complement['pivot']->state=='3')
											<i class="badge badge-pill badge-danger font-weight-normal px-2 py-1 ml-1">@lang('web.shop.not available')</i>
											@endif
											<span>+ {{ number_format($complement['pivot']->price, 2, ',', '.').currencySymbol($currency) }}</span>
											<input type="checkbox" value="{{ $complement['pivot']->id }}" @if($complement['pivot']->state=='2' || $complement['pivot']->state=='3') class="disabled" disabled @endif onclick="validationModalComplements({{ $complement['pivot']->id }});">
											<span class="checkmark mt-1"></span>
										</label>
									</li>
									@endif
									@endforeach
								</ul>

								<p class="text-danger"></p>
							</div>
						</div>
					</div>
					<div class="footer">
						<div class="row small-gutters">
							@if($undo)
							<div class="col-md-4">
								<button type="button" class="btn_1 outline full-width mb-mobile" aria-label="Close" wire:click.prevent="undo">@lang('web.shop.modal.buttons.undo')</button>
							</div>
							@else
							<div class="col-md-4">
								<button type="button" class="btn_1 outline full-width mb-mobile" aria-label="Close" wire:click.prevent="close">@lang('web.shop.modal.buttons.cancel')</button>
							</div>
							@endif
							@if($finish)
							<div class="col-md-8">
								<button type="button" class="btn_1 full-width" onclick="addProductCart();">@lang('web.shop.modal.buttons.add cart')</button>
							</div>
							@else
							<div class="col-md-8">
								<button type="button" class="btn_1 full-width" onclick="nextModalComplements();">@lang('web.shop.modal.buttons.continue')</button>
							</div>
							@endif
						</div>
					</div>
					@else
					<div class="modal-body content">
						<p>{{ $product->description }}</p>
					</div>
					<div class="footer">
						<div class="row small-gutters">
							<div class="col-md-4">
								<button type="button" class="btn_1 outline full-width mb-mobile" aria-label="Close" wire:click.prevent="close">@lang('web.shop.modal.buttons.cancel')</button>
							</div>
							<div class="col-md-8">
								<button type="button" class="btn_1 full-width" wire:click="add">@lang('web.shop.modal.buttons.add cart')</button>
							</div>
						</div>
					</div>
					@endif
					@endif

					<div wire:loading wire:target="next">
						@include("web.partials.livewire_loader")
					</div>

					<div wire:loading wire:target="undo">
						@include("web.partials.livewire_loader")
					</div>

					<div wire:loading wire:target="close">
						@include("web.partials.livewire_loader")
					</div>

					<div wire:loading wire:target="add">
						@include("web.partials.livewire_loader")
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal-backdrop fade show" id="backdrop" style="display: @if($show===true) block @else none @endif;"></div>

	@include('web.partials.notifications')
</div>