<?php

namespace App\Http\Livewire\Panel;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersList extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        return view('livewire.panel.orders-list', [

            'orders' => $this->getOrderQuery()->with(['product','line'])->paginate(15),
        ])
        ->layout('panel.layout');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getOrderQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Order::query()
            ->Where('code', 'like', "%{$this->search}%");
    }
}
