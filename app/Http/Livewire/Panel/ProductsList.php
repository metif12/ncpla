<?php

namespace App\Http\Livewire\Panel;

use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        return view('livewire.panel.products-list');
    }

    public function updatingSearch($value)
    {
        $this->resetPage();
    }
}
