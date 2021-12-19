<?php

namespace App\Http\Livewire\Web\Cart;

use App\Models\Agency;
use App\Models\Setting;
use App\Traits\CartTrait;
use Livewire\Component;

class Header extends Component
{
	use CartTrait;

	public $count=0;
	public $subtotal=0.00;
	public $delivery=0.00;
	public $total=0.00;
	public $currency=NULL;

	protected $listeners=['cartCounterHeader' => 'mount', 'cartDelivery' => 'delivery'];

	public function mount()
	{
		$setting=Setting::with(['currency'])->first();
        if (!is_null($setting)) {
            $this->currency=$setting['currency'];
        }
        $this->count=$this->counterCart();
		$this->subtotal=$this->calculateCart();
		$this->total=$this->subtotal+$this->delivery;
	}

	public function render()
	{
		$cart=$this->getCart();
		return view('livewire.web.cart.header', compact('cart'));
	}

	public function delivery($agency) {
		$agency=Agency::where([['slug', $agency], ['state', '1']])->first();
		if (!is_null($agency)) {
			$this->delivery=$agency->price;
		} else {
			$this->delivery=0.00;
		}
		$this->mount();
	}
}
