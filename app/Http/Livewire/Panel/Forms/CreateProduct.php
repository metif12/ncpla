<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Product;
use App\Models\ProductAttribute;
use Livewire\Component;

class CreateProduct extends Component
{
    public string $name = '';

    public array $attrs = [];

    protected function getRules()
    {
        return [
            'name' => 'required|string|unique:products,name',

            'attrs.*.name' => 'required|string',
            'attrs.*.type' => 'required|string',
            'attrs.*.default' => 'nullable',
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function addAttr()
    {
        $this->attrs [] = [

            'name' => '',
            'type' => Product::$types[0]['value'],
            'unit' => '',
            'default' => '',
            'merge_type' => Product::$merge_types[0]['value'],

        ];
    }

    public function remAttr($i)
    {
        array_splice($this->attrs, $i,1);
    }

    public function storeProduct()
    {
        $this->validate();

        $product = Product::query()->create([

            'name' => $this->name,
            'code' => strtoupper(dechex(time())),
        ]);

        foreach ($this->attrs as $attr){

            $attr['product_id'] = $product->id;
            ProductAttribute::query()->create($attr);
        }

        $this->redirectRoute('panel.products');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-product')
            ->layout('panel.layout');

    }
}
