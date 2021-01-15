<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Product;
use Livewire\Component;

class CreateProduct extends Component
{
    public string $name = '';

    public function storeProduct()
    {
        $this->validate([
            'name' => 'required|string|unique:products,name'
        ]);

        Product::query()->create([

            'name' => $this->name,
            'code' => strtoupper(dechex(time())),
        ]);

        $this->redirectRoute('panel.products');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-product');
    }
}
