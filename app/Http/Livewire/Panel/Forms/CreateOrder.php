<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\Product;
use Livewire\Component;

class CreateOrder extends Component
{
    public Product $product;

    public array $attrs = [];

    public int $line;

    public function mount(Product $product)
    {
        $this->product = $product;

        foreach ($this->product->product_attributes ?? [] as $attr) {

            $attr['value'] = $attr['default'];
            $attr['product_id'] = $this->product->id;

            $this->attrs[$this->product->id] = $attr;
        }

        $first_line = $product->lines()->first();

        $this->line = $first_line?->id ?? 0;

        $lines[] = $first_line;

        while (!empty($lines)){

            $line = array_pop($lines);

            foreach ($line->inputs as $input){

                $input_product = $input->product;
                foreach ($input_product->product_attributes ?? [] as $attr) {

                    $attr['value'] = $attr['default'];
                    $attr['product_id'] = $input_product->id;

                    $this->attrs[$input_product->id] = $attr;
                }

                $lines[] = $product->lines()->first();
            }
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
            'code' => strtoupper(dechex(time())),
        ]);

        foreach ($this->attrs as $attr){

            OrderAttribute::query()->create([

                'order_id' => $order->id,
                'name' => $attr['name'],
                'type' => $attr['type'],
                'value' => $attr['value'],
                'product_id' => $attr['product_id'],
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
