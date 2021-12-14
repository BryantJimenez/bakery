<?php

namespace App\Http\Livewire\Web\Shop;

use App\Models\Category;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
	use WithPagination;

	public $category;
    public $currency=NULL;
	protected $paginationTheme='bootstrap';

	protected $listeners=['categoryProducts' => 'category'];

	public function mount($category)
    {
        $setting=Setting::with(['currency'])->first();
        if (!is_null($setting)) {
            $this->currency=$setting['currency'];
        }
        $this->category=$category;
    }

    public function render()
    {
    	$products=[];
        $category_name='';
    	$category=Category::where('slug', $this->category)->first();
    	if (!is_null($category)) {
            $category_name=$category->name;
    		$products=$category->products()->with(['groups.attribute'])->paginate(12);
    	}
        return view('livewire.web.shop.products', compact('category_name', 'products'));
    }

    public function category($category) {
    	$this->category=$category;
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function modal($product) {
        $this->emit('productModal', $product);
    }
}
