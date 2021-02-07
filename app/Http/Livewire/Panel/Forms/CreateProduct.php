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
        $rules = [
            'name' => 'required|string|unique:products,name',
        ];

        foreach ($this->attrs ?? [] as $i => $attr) {

            $rules["attrs.$i.name"] = "required|string";
            $rules["attrs.$i.unit"] = "nullable|string";
            $rules["attrs.$i.merge_type"] = "required|string";

            switch ($attr['type']){

                case 'text' :
                    $rules["attrs.$i.default"] = "nullable|string";
                    break;

                case 'number' :
                    $rules["attrs.$i.default"] = "nullable|regex:/^\d+(\.\d+)?$/";
                    break;

            }

        }

        return $rules;
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
            'code' => generateCode(),
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
