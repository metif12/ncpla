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
        foreach ($this->product->attrs as $attr) $this->attrs[$attr['name']] = null;
    }

    public function updated()
    {
        $this->validate();
    }

    protected function getRules()
    {
        $rules = ['product.id' => 'required|number',];

        foreach ($this->product->attrs as $attr) {

            switch ($attr['type']){

                case 'text' :
                    $rules["attrs.{$attr['name']}"] = "required|string";
                    break;

                case 'number' :
                    $rules["attrs.{$attr['name']}"] = "required|numeric";
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

        $this->redirectRoute('panel.products');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-order')
            ->layout('panel.layout');
    }
}
