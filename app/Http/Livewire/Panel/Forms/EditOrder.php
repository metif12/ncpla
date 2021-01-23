<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class EditOrder extends Component
{
    public Order $order;
    public Product $product;

    public array $attrs = [];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->product = $order->product;
        $this->attrs = $order->attrs;
    }

    public function updated()
    {
        $this->validate();
    }

    protected function getRules()
    {
        foreach ($this->order->attrs as $i => $attr) {

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

        $this->order->update([

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
