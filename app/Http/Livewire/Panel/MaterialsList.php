<?php

namespace App\Http\Livewire\Panel;

use App\Models\Line;
use App\Models\Material;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class MaterialsList extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        return view('livewire.panel.materials-list', [

            'materials' => $this->getMaterialQuery()->paginate(15),
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
    private function getMaterialQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Material::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('code', 'like', "%{$this->search}%");
    }
}
