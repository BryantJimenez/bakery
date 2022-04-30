<?php

namespace App\Http\Livewire\Web\Cart;

use App\Models\Coupon;
use App\Models\Agency;
use App\Models\Setting;
use App\Traits\CartTrait;
use Livewire\Component;
use Auth;

class Card extends Component
{
	use CartTrait;

	public $subtotal=0.00;
	public $delivery=0.00;
	public $discount=0.00;
	public $total=0.00;
	public $currency=NULL;
	public $coupon=NULL;

	protected $listeners=['cartCard' => 'mount', 'cartDelivery' => 'delivery', 'cartCoupon' => 'coupon'];

	public function mount()
	{
		$setting=Setting::with(['currency'])->first();
		if (!is_null($setting)) {
			$this->currency=$setting['currency'];
		}
		$this->subtotal=$this->calculateCart();

		if (session()->has('coupon') && is_null($this->coupon)) {
			$this->coupon(session('coupon')['coupon']->slug);
		}

		if (!is_null($this->coupon)) {
			if ($this->coupon->type==trans('admin.values_attributes.types.coupons.percentage')) {
				$this->discount=(($this->subtotal+$this->delivery)*$this->coupon->discount)/100;
			} elseif ($this->coupon->type==trans('admin.values_attributes.types.coupons.fixed')) {
				$this->discount=$this->coupon->discount;
			}
		} else {
			$this->discount=0.00;
		}
		$this->total=$this->subtotal+$this->delivery-$this->discount;
	}

	public function render()
	{
		$cart=$this->getCart();
		return view('livewire.web.cart.card', compact('cart'));
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

	public function coupon($coupon) {
		$coupon=Coupon::where([['slug', $coupon], ['state', '1']])->first();
		if (!is_null($coupon)) {
			$this->coupon=$coupon;
		} else {
			$this->coupon=NULL;
		}
		$this->mount();
	}

	public function plus($code) {
		if (Auth::check()) {
			$this->plusCartDatabase($code);
		} else {
			if (session()->has('cart')) {
				$this->plusCartSession($code);
			}
		}

		$this->subtotal=$this->calculateCart();
		if (!is_null($this->coupon)) {
			if ($this->coupon->type==trans('admin.values_attributes.types.coupons.percentage')) {
				$this->discount=(($this->subtotal+$this->delivery)*$this->coupon->discount)/100;
			} elseif ($this->coupon->type==trans('admin.values_attributes.types.coupons.fixed')) {
				$this->discount=$this->coupon->discount;
			}
		} else {
			$this->discount=0.00;
		}
		$this->total=$this->subtotal+$this->delivery-$this->discount;
		$this->emit('cartCounterHeader');
	}

	public function minus($code) {
		if (Auth::check()) {
			$this->minusCartDatabase($code);
		} else {
			if (session()->has('cart')) {
				$this->minusCartSession($code);
			}
		}

		$this->subtotal=$this->calculateCart();
		if (!is_null($this->coupon)) {
			if ($this->coupon->type==trans('admin.values_attributes.types.coupons.percentage')) {
				$this->discount=(($this->subtotal+$this->delivery)*$this->coupon->discount)/100;
			} elseif ($this->coupon->type==trans('admin.values_attributes.types.coupons.fixed')) {
				$this->discount=$this->coupon->discount;
			}
		} else {
			$this->discount=0.00;
		}
		$this->total=$this->subtotal+$this->delivery-$this->discount;
		$this->emit('cartCounterHeader');
	}

	public function remove($code) {
		if (Auth::check()) {
			$this->removeCartDatabase($code);
		} else {
			if (session()->has('cart')) {
				$this->removeCartSession($code);
			}
		}

		$this->subtotal=$this->calculateCart();
		if (!is_null($this->coupon)) {
			if ($this->coupon->type==trans('admin.values_attributes.types.coupons.percentage')) {
				$this->discount=(($this->subtotal+$this->delivery)*$this->coupon->discount)/100;
			} elseif ($this->coupon->type==trans('admin.values_attributes.types.coupons.fixed')) {
				$this->discount=$this->coupon->discount;
			}
		} else {
			$this->discount=0.00;
		}
		$this->total=$this->subtotal+$this->delivery-$this->discount;
		$this->emit('cartCounterHeader');
	}
}
