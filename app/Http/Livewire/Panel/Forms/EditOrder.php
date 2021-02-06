<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\Product;
use Livewire\Component;

class EditOrder extends Component
{
    public Order $order;
    public Product $product;
    public int $line;

    public array $attrs = [];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->line = $order->line_id;
        $this->product = $order->product;
        $this->attrs = $order->order_attributes ? $order->order_attributes->toArray() : [];
    }

    public function updated()
    {
        $this->validate();
    }

    protected function getRules()
    {
        $rules['line'] = 'required';

        foreach ($this->order->order_attributes ?? [] as $i => $attr) {

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

        $ids = [];

        $this->order->update([
            'line_id', $this->line,
        ]);

        foreach ($this->attrs as $attr){

            OrderAttribute::query()->updateOrCreate(
                [
                    'order_id' => $this->order->id,
                    'name' => $attr['name'],
                ],
                [
                    'value' => $attr['value'],
                    'type' => $attr['type'],
                ]
            );

            $ids[] = $attr['id'];
        }

        OrderAttribute::query()
            ->where('order_id' , $this->order->id)
            ->whereNotIn('id' , $ids)
            ->delete();

        $this->redirectRoute('panel.orders');
    }

    public function render()
    {
        return view('livewire.panel.forms.edit-order')
            ->layout('panel.layout');
    }
}
