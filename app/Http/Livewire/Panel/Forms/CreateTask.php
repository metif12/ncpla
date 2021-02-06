<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\LineOutputs;
use App\Models\Order;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class CreateTask extends Component
{
    use WithPagination;

    public string $search = '';
    public array $order_list = [];

    public function mount()
    {
        foreach (Order::pluck('id') as $id) $this->order_list[$id] = false;
    }

    protected function getRules()
    {
        return [
            'order_list.*' => 'required'
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updated()
    {
        $this->validate();
    }

    public function storeTask()
    {
        $this->validate();

        $data = [];
        $lines = [];

        foreach ($this->order_list as $id => $cond) {
            if ($cond) {

                $order = Order::find($id);
                $product = $order->product;
                $line = $order->line;


            }
        }

//        Task::query()->create([
//
//            'name' => $this->name,
//            'unit' => $this->unit,
//            'code' => generateCode(),
//        ]);

        $this->redirectRoute('panel.materials');
    }

    protected function processTask($line, $data = []): void
    {

        foreach ($line->inputs as $input) {

            $sub_line = LineOutputs::query()->where('product_id', $input->product_id)->first()->line;

            $this->processTask($sub_line, $data);
        }
    }

    public function render()
    {
        $selected_order_ids = [];

        foreach ($this->order_list as $id => $cond) if($cond) $selected_order_ids[] = $id;

        return view('livewire.panel.forms.create-task',[

            'orders' => Order::where('code', 'like', "%{$this->search}%")->with('line')->paginate(10),
            'selected_orders' => Order::find($selected_order_ids)->load('line'),
        ])
            ->layout('panel.layout');

    }
}
