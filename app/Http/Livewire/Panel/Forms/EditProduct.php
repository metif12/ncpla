<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditProduct extends Component
{
    public string $name = '';

    public array $attrs = [];

    public array  $types = [

        [
            'name' => 'متنی',
            'value' => 'text',
        ],
        [
            'name' => 'عددی',
            'value' => 'number',
        ],
    ];

    public Product $product;

    public function mount(Product $product)
    {
        $this->product = $product;

        $this->name = $product->name;
        $this->attrs = $product->attrs;
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

            'name' => 'عنوان ويژگی',
            'type' => 'text',
            'unit' => '',
            'default' => '',

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
            'attrs' => $this->attrs,
        ]);

        $this->redirectRoute('panel.products');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-product')
            ->layout('panel.layout');

    }
}
