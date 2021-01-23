<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Product;
use Livewire\Component;

class CreateProduct extends Component
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

        Product::query()->create([

            'name' => $this->name,
            'code' => strtoupper(dechex(time())),
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
