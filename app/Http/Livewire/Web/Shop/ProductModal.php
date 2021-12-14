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
	public $extra=[];
	public $extras=[];

	protected $listeners=['productModal' => 'open'];

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
		$product=Product::with(['category', 'groups.complements'])->where('slug', $product)->first();
		$this->product=$product;
		$this->price=$product->price;
		$this->price_aditional=0.00;
		$this->groups=$product['groups'];
		$this->steps=$product['groups']->count();
		$this->extras=[];
		$this->current=0;
		$this->current_step=($this->steps>0) ? 1 : 0;
		$this->show=true;
		$this->undo=false;
		$this->finish=false;
		if ($this->current_step==$this->steps) {
			$this->finish=true;
		}
	}

	public function close() {
		$this->show=false;
		$this->dispatchBrowserEvent('contentChanged');
	}

	public function price($multi=false) {
		if ($multi) {
			$this->price_aditional=0.0;
			foreach ($this->extra[$this->current] as $value) {
				$complement_group=ComplementGroup::where('id', $value)->first();
				if (!is_null($complement_group)) {
					$this->price_aditional+=$complement_group->price;
				}
			}
		} else {
			$complement_group=ComplementGroup::where('id', $this->extra[$this->current])->first();
			if (!is_null($complement_group)) {
				$this->price_aditional=$complement_group->price;
			}
		}
	}

	public function extras() {
		// $complement_group=ComplementGroup::where('id', $this->extra[$this->current])->first();
		if (!empty($this->extra)) {
			$count=count($this->extras);
			$this->extras[$count]=$this->extra[$this->current];
			$this->extra=[];
		}
	}

	public function next() {
		// $data = $this->validate([
  		//    'extra' => 'required.array'
  		// ]);

        // dd($data);

		$this->extras();
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
		$this->finish=($this->current_step==$this->steps) ? true : false;



		// if (!empty($this->extra)) {
		// 	$count=count($this->extras);
		// 	$this->extras[$count]=$this->extra[$this->current];
		// 	$this->extra=[];
		// }		
		// $this->price=$this->price+$this->price_aditional;
		// $this->price_aditional=0.00;
	}

	public function add() {
		$this->extras();

		if (!is_null($this->product)) {
			$this->addCart($this->product, $this->extras);
		}

		$this->emit('cartCounterHeader');
		$this->emit('cartCard');
		$this->close();
	}
}
