<?php

namespace App\Http\Livewire\Web\Shop;

use App\Models\Category;
use Livewire\Component;

class Shop extends Component
{
	public $view='categories';
	public $align='center';
	public $undo=false;
	public $history='';
	public $title='Categories';
	public $category='';

	public function render()
	{
		$categories=Category::with(['products'])->where('state', '1')->get();
		return view('livewire.web.shop.shop', compact('categories'));
	}

	public function products($category) {
		$category=Category::with(['products'])->where('slug', $category)->first();
		$this->align='left';
		$this->undo=true;
		$this->history='home';
		$this->view='products';
		$this->title=$category->name;
		$this->category=$category->slug;
		$this->emit('categoryProducts', $category->slug);
	}

	public function undo($history) {
		if ($history=='home') {
			$this->align='center';
			$this->undo=false;
			$this->history='';
			$this->title="Categories";
			$this->view='categories';
		}
	}
}
