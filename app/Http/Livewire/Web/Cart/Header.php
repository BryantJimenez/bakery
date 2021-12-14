<?php

namespace App\Http\Livewire\Web\Cart;

use App\Models\Setting;
use App\Traits\CartTrait;
use Livewire\Component;

class Header extends Component
{
	use CartTrait;

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
        $this->count=$this->counterCart();
		$this->total=$this->calculateCart();
	}

	public function render()
	{
		$cart=$this->getCart();
		return view('livewire.web.cart.header', compact('cart'));
	}
}
