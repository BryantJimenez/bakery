<?php

namespace App\Http\Livewire\Web\Home;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;

class Products extends Component
{
    public $selected='';
	public $category=NULL;
	public $products=[];

    public function mount()
    {
    	$category=Category::where('slug', $this->category)->first();
        if (!is_null($category)) {
            $this->products=$category->products()->where('state', '1')->inRandomOrder()->take(6)->get();
        } else {
        	$this->products=Product::where('state', '1')->inRandomOrder()->take(6)->get();
        }
    }

    public function render() {
        $selected=$this->selected;
    	$products=$this->products;
    	$categories=Category::has('products')->where('state', '1')->take(5)->get();
        return view('livewire.web.home.products', compact('categories', 'products', 'selected'));
    }

    public function category($category) {
    	$this->category=$category;
        $this->selected=$category;
    	$this->mount();
    }

    public function modal($product) {
        $product=Product::with(['category', 'groups.complements'])->where('slug', $product)->first();
        if (!is_null($product)) {
            $this->emit('productModal', $product->id);
        } else {
            session()->flash('type', 'error');
            session()->flash('title', trans('web.notifications.error.messages.products.404.title'));
            session()->flash('msg', trans('web.notifications.error.messages.products.404.msg'));
        }
    }
}
