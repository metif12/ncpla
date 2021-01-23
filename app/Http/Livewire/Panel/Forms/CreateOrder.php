<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class CreateOrder extends Component
{
    public Product $product;

    public array $attrs = [];

    public function mount(Product $product)
    {
        $this->product = $product;

        foreach ($this->product->attrs as $attr) {

            $attr['value'] = $attr['default'];

            $this->attrs[] = $attr;
        }
    }

    public function updated()
    {
        $this->validate();
    }

    protected function getRules()
    {
        foreach ($this->product->attrs as $i => $attr) {

            switch ($attr['type']){

                case 'text' :
                    $rules["attrs.*.value"] = "required|string";
                    break;

                case 'number' :
                    $rules["attrs.*.value"] = "required|regex:/^\d+(\.\d+)?$/";
                    break;

            }

        }

        return $rules;
    }

    public function storeOrder()
    {
        $this->validate();

        Order::query()->create([

            'product_id' => $this->product->id,
            'code' => strtoupper(dechex(time())),
            'attrs' => $this->attrs,
        ]);

        $this->redirectRoute('panel.orders');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-order')
            ->layout('panel.layout');
    }
}
