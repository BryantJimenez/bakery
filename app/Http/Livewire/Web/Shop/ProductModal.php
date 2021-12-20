<?php

namespace App\Http\Livewire\Web\Shop;

use App\Models\Product;
use App\Models\Setting;
use App\Models\Group\ComplementGroup;
use App\Traits\CartTrait;
use Livewire\Component;

class ProductModal extends Component
{
	use CartTrait;

	public $show=false;
	public $currency=NULL;
	public $product=NULL;
	public $price=0.00;
	public $price_aditional=0.00;
	public $groups=[];
	public $current_step=0;
	public $steps=0;
	public $current=0;
	public $undo=false;
	public $finish=false;
	public $extras=[];

	protected $listeners=['productModal' => 'open', 'nextStepComplements' => 'next', 'addCart' => 'add'];

	public function mount()
	{
		$setting=Setting::with(['currency'])->first();
		if (!is_null($setting)) {
			$this->currency=$setting['currency'];
		}
	}

	public function render()
	{
		return view('livewire.web.shop.product-modal');
	}

	public function open($product) {
		$product=Product::with(['category', 'groups.complements'])->where('id', $product)->first();
		$this->product=$product;
		$this->price=$product->price;
		$this->groups=$product['groups'];
		$this->steps=$product['groups']->count();
		$this->current_step=($this->steps>0) ? 1 : 0;
		$this->show=true;
		if ($this->current_step==$this->steps) {
			$this->finish=true;
		}
	}

	public function close() {
		$this->resetExcept(['currency']);
		$this->dispatchBrowserEvent('contentChanged');
	}

	public function next($data=NULL) {
		if (!is_null($data)) {
			$extras_error=$this->extras($data['complements']);
			if ($extras_error) {
				return true;
			}
		}

		$this->price=$this->price+$this->price_aditional;
		$this->price_aditional=0.00;

		if ($this->current_step==$this->steps) {
			$this->close();
		} else {
			$this->current++;
			$this->current_step++;
			$this->undo=true;
			if ($this->current_step==$this->steps) {
				$this->finish=true;
			}
		}
	}

	public function undo() {
		$this->current--;
		$this->current_step--;
		$this->undo=($this->current>0) ? true : false;
		$this->finish=false;

		$this->price=$this->product->price;
		$this->price_aditional=0.00;
		for ($i=0; $i < $this->current; $i++) {
			$price_error=$this->price($this->extras[$i]);
			if ($price_error) {
				return true;
			}
		}
		$this->price=$this->price+$this->price_aditional;
		$this->price_aditional=0.00;
	}

	public function add($data=NULL) {
		if (!is_null($data)) {
			$extras_error=$this->extras($data['complements']);
			if ($extras_error) {
				return true;
			}
		}

		if (!is_null($this->product)) {
			$this->addCart($this->product, $this->extras);
		}

		$this->emit('cartCounterHeader');
		$this->emit('cartCard');
		$this->close();
	}

	public function extras($data) {
		$this->price_aditional=0.00;
		$price_error=$this->price($data);
		if ($price_error) {
			return true;
		}
		$count=count($this->extras);
		$this->extras[$count]=$data;
		return false;
	}

	public function price($data) {
		$price=0.00;
		foreach ($data as $value) {
			$complement_group=ComplementGroup::where([['id', $value], ['state', '!=', '2'], ['state', '!=', '3']])->first();
			if (!is_null($complement_group)) {
				$price+=$complement_group->price;
			} else {
				session()->flash('type', 'error');
				session()->flash('title', 'Complemento No Disponible');
				session()->flash('msg', 'Ha ocurrido un error durante el proceso, intentelo nuevamente.');
				return true;
			}
		}
		$this->price_aditional+=$price;
		return false;
	}
}
