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
	public $title='Categorías';
	public $category='';

	public function render()
	{
		$categories=Category::with(['products'])->where('state', '1')->get();
		return view('livewire.web.shop.shop', compact('categories'));
	}

	public function products($category) {
		$category=Category::with(['products'])->where('slug', $category)->first();
		if (!is_null($category)) {
			$this->align='left';
			$this->undo=true;
			$this->history='home';
			$this->view='products';
			$this->title=$category->name;
			$this->category=$category->slug;
			$this->emit('categoryProducts', $category->slug);
		} else {
            session()->flash('type', 'error');
            session()->flash('title', 'Categoría No Encontrada');
            session()->flash('msg', 'Ha ocurrido un error durante el proceso, intentelo nuevamente.');
        }
		$this->dispatchBrowserEvent('contentChanged');
	}

	public function undo($history) {
		$this->reset();
		$this->dispatchBrowserEvent('contentChanged');
	}
}
