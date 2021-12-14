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
					<form @if($finish) wire:submit.prevent="add" @else wire:submit.prevent="next" @endif>
						<div class="modal-body content">
							<p>{{ $product->description }}</p>

							<div class="row">
								<div class="col-12" condition="{{ $groups[$current]->name }}" min="{{ $groups[$current]->min }}" max="{{ $groups[$current]->max }}" slug="slug">
									<h5>Elige {{ $groups[$current]->max." ".$groups[$current]['attribute']->name }}</h5>
									<ul class="clearfix mb-0">
										@foreach($groups[$current]['complements'] as $key => $complement)
										@if($complement['pivot']->state!='0')
										@if($groups[$current]->max>1)
										<li>
											<label class="container_check">
												<img src="{{ image_exist('/admins/img/complements/', $complement->image, false, false) }}" class="rounded-circle mr-2" width="30" height="30" title="{{ $complement->name }}" alt="{{ $complement->name }}">
												{{ $complement->name }}
												@if($complement['pivot']->state=='2' || $complement['pivot']->state=='3')
												<i class="badge badge-pill badge-danger font-weight-normal px-2 py-1 ml-1">No Disponible</i>
												@endif
												<span>+ {{ number_format($complement['pivot']->price, 2, ',', '.').currencySymbol($currency) }}</span>
												<input type="checkbox" value="{{ $complement['pivot']->id }}" @if($complement['pivot']->state=='2' || $complement['pivot']->state=='3') disabled @endif wire:model="extra.{{ $current }}.{{ $key }}" wire:click="price(true)">
												<span class="checkmark mt-1"></span>
											</label>
										</li>
										@else
										<li>
											<label class="container_radio">
												<img src="{{ image_exist('/admins/img/complements/', $complement->image, false, false) }}" class="rounded-circle mr-2" width="30" height="30" title="{{ $complement->name }}" alt="{{ $complement->name }}">
												{{ $complement->name }}
												@if($complement['pivot']->state=='2' || $complement['pivot']->state=='3')
												<i class="badge badge-pill badge-danger font-weight-normal px-2 py-1 ml-1">No Disponible</i>
												@endif
												<span>+ {{ number_format($complement['pivot']->price, 2, ',', '.').currencySymbol($currency) }}</span>
												<input type="radio" value="{{ $complement['pivot']->id }}" name="{{ $groups[$current]->slug }}" @if($complement['pivot']->state=='2' || $complement['pivot']->state=='3') disabled @endif wire:model="extra.{{ $current }}" wire:click="price">
												<span class="checkmark mt-1"></span>
											</label>
										</li>
										@endif
										@endif
										@endforeach
									</ul>
									{{-- @error('extra') <span class="text-danger">{{ $extra }}</span> @enderror --}}
									{{-- <p class="text-danger font-weight-bold"></p> --}}
								</div>
							</div>
						</div>
						<div class="footer">
							<div class="row small-gutters">
								@if($undo)
								<div class="col-md-4">
									<button type="button" class="btn_1 outline full-width mb-mobile" aria-label="Close" wire:click.prevent="undo">Volver</button>
								</div>
								@else
								<div class="col-md-4">
									<button type="button" class="btn_1 outline full-width mb-mobile" aria-label="Close" wire:click.prevent="close">Cancelar</button>
								</div>
								@endif
								@if($finish)
								<div class="col-md-8">
									<button type="submit" class="btn_1 full-width">Agregar al Carrito</button>
								</div>
								@else
								<div class="col-md-8">
									<button type="submit" class="btn_1 full-width">Continuar</button>
								</div>
								@endif
							</div>
						</div>
					</form>
					@else
					<div class="modal-body content">
						<p>{{ $product->description }}</p>
					</div>
					<div class="footer">
						<div class="row small-gutters">
							<div class="col-md-4">
								<button type="button" class="btn_1 outline full-width mb-mobile" aria-label="Close" wire:click.prevent="close">Cancelar</button>
							</div>
							<div class="col-md-8">
								<button type="button" class="btn_1 full-width" wire:click="add">Agregar al Carrito</button>
							</div>
						</div>
					</div>
					@endif
					@endif

					<div wire:loading wire:target="next">
						@include("web.partials.livewire_loader")
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal-backdrop fade show" id="backdrop" style="display: @if($show===true) block @else none @endif;"></div>
</div>