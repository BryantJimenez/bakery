<div>
	<div class="modal fade @if($show===true) show @endif" id="modal-product" style="display: @if($show===true) block @else none @endif;" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="background zoom-anim-dialog">
				<div class="modal-content">
					@if(!is_null($product))
					<div class="modal-header small-dialog-header">
						<h5 class="modal-title">[<span class="font-weigt-bold">{{ number_format($price, 2, ',', '.') }}</span>] {{ $product['category']->name.": ".$product->name }}</h5>
						<button type="button" class="mfp-close" aria-label="Close" wire:click.prevent="close"></button>
					</div>
					<div class="modal-body content">
						<p class="modal-description text-justify">{{ $product->description }}</p>


						{{-- <p>{{ $current }}</p> --}}


						{{-- <form> --}}
							{{-- <h5>Tamaño</h5>
							<ul class="clearfix">
								<li>
									<label class="container_radio">Name<span>$0,00</span>
										<input type="radio" value="slug" name="size_id" price="0.00" checked>
										<span class="checkmark"></span>
									</label>
								</li>
								<li>
									<label class="container_radio">Name<span>$0,00</span>
										<input type="radio" value="slug-2" name="size_id" price="0.00">
										<span class="checkmark"></span>
									</label>
								</li>
							</ul> --}}

							@if($steps)
							<div class="row">
								{{-- @foreach($groups as $group) --}}
								<div class="col-12" group="{{ $current }}" condition="{{ $groups[$current]->name }}" min="{{ $groups[$current]->min }}" max="{{ $groups[$current]->max }}" slug="slug">
									<h5>{{ $groups[$current]->name }}</h5>
									<ul class="clearfix mb-0">
										@foreach($groups[$current]['complements'] as $complement)
										<li>
											<label class="container_check">{{ $complement->name }}<span>+ ${{ number_format($complement['pivot']->price, 2, ',', '.') }}</span>
												<input type="checkbox" value="slug" price="{{ $complement['pivot']->price }}" group="{{ $current }}">
												<span class="checkmark"></span>
											</label>
										</li>
										@endforeach
									</ul>
									<p class="text-danger font-weight-bold"></p>
								</div>
								{{-- @endforeach --}}
							</div>
							@endif

						{{-- </form> --}}
					</div>
					<div class="footer">
						<div class="row small-gutters">
							<div class="col-md-4">
								<button type="button" class="btn_1 outline full-width mb-mobile" aria-label="Close" wire:click.prevent="close">Cancel</button>
							</div>
							@if($finish)
							<div class="col-md-8">
								<button type="button" class="btn_1 full-width" wire:click="cartAdd">Add to Order</button>
							</div>
							@else
							<div class="col-md-8">
								<button type="button" class="btn_1 full-width" wire:click="next">Continue</button>
							</div>
							@endif
						</div>
					</div>
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