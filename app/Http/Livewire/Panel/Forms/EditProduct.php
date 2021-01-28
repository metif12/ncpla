<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditProduct extends Component
{
    public string $name = '';

    public array $attrs = [];

    public Product $product;

    public function mount(Product $product)
    {
        $this->product = $product;

        $this->name = $product->name;
        $this->attrs = $product->product_attributes->toArray() ?? [];
    }

    protected function getRules()
    {
        return [
            'name' => ['required', 'string', Rule::unique('products', 'name')->ignore($this->product->id ?? 0)],

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

        $this->product->update([

            'name' => $this->name,
        ]);

        $names = [];

        foreach ($this->attrs as $attr){

            ProductAttribute::query()->updateOrCreate(
                [
                    'product_id' => $this->product->id,
                    'name' => $attr['name'],
                ],
                [
                    'type' => $attr['type'],
                    'merge_type' => $attr['merge_type'],
                    'default' => $attr['default'],
                    'unit' => $attr['unit'],
                ]
            );

            $names[] = $attr['name'];
        }

        ProductAttribute::query()
            ->where('product_id' , $this->product->id)
            ->whereNotIn('name' , $names)
            ->delete();

        $this->redirectRoute('panel.products');
    }

    public function render()
    {
        return view('livewire.panel.forms.edit-product')
            ->layout('panel.layout');

    }
}
