<?php

namespace App\Http\Livewire\Panel;

use App\Models\Line;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class LinesList extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        return view('livewire.panel.lines-list', [

            'products' => $this->getLineQuery()->paginate(15),
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
    private function getLineQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Line::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('code', 'like', "%{$this->search}%");
    }
}
