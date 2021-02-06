<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateOrder extends Component
{
    public Product $product;

    public array $attrs = [];

    public int $line;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->line = $product->lines()->value('id');

        foreach ($this->product->product_attributes ?? [] as $attr) {

            $attr['value'] = $attr['default'];

            $this->attrs[$this->product->id] = $attr;
        }
    }


    public function updated()
    {
        $this->validate();
    }

    protected function getRules()
    {
        $rules = [];

        foreach ($this->product->product_attributes ?? [] as $i => $attr) {

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

        $order = Order::query()->create([

            'product_id' => $this->product->id,
            'line_id' => $this->line,
            'code' => generateCode(),
        ]);

        foreach ($this->attrs as $attr){

            OrderAttribute::query()->create([

                'order_id' => $order->id,
                'name' => $attr['name'],
                'type' => $attr['type'],
                'value' => $attr['value'],
            ]);
        }

        $this->redirectRoute('panel.orders');
    }

    public function render()
    {
        return view('livewire.panel.forms.create-order')
            ->layout('panel.layout');
    }
}
