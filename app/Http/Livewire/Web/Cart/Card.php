<?php

namespace App\Http\Livewire\Web\Cart;

use App\Models\Setting;
use Livewire\Component;

class Card extends Component
{
	public $total;
	public $currency=NULL;

	protected $listeners=['cartCard' => 'mount'];

	public function mount()
	{
		$setting=Setting::with(['currency'])->first();
		if (!is_null($setting)) {
			$this->currency=$setting['currency'];
		}
		$this->calculating();
	}

	public function render()
	{
		$cart=[];
		if (session()->has('cart')) {
			$cart=session('cart');
		}
		return view('livewire.web.cart.card', compact('cart'));
	}

	public function calculating() {
		$this->total=0.00;
		if (session()->has('cart')) {
			$cart=session('cart');
			foreach($cart as $item) {
				$this->total+=$item['price']*$item['qty'];
			}
		}
	}

	public function remove($code) {
		if (session()->has('cart')) {
			$cart=session('cart');

			if (array_search($code, array_column($cart, 'code'))!==false) {
				session()->forget('cart');
				foreach ($cart as $item) {
					if ($code!=$item['code']) {
						if (!session()->has('cart')) {
							session()->put('cart', array(0 => $item));
						} else {
							session()->push('cart', $item);
						}
					}
				}
			}
			$this->emit('cartCounterHeader');
			$this->calculating();
		}
	}
}
