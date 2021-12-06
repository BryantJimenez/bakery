<?php

namespace App\Http\Livewire\Web\Cart;

use App\Models\Setting;
use Livewire\Component;

class Header extends Component
{
	public $count;
	public $total;
	public $currency=NULL;

	protected $listeners=['cartCounterHeader' => 'mount'];

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
		return view('livewire.web.cart.header', compact('cart'));
	}

	public function calculating() {
		$counter=0;
		$this->total=0.00;
		if (session()->has('cart')) {
			$counter=count(session('cart'));
			$cart=session('cart');
			foreach($cart as $item) {
				$this->total+=$item['price']*$item['qty'];
			}
		}
		$this->count=$counter;
	}
}
