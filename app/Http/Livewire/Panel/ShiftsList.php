<?php

namespace App\Http\Livewire\Panel;

use App\Models\Shift;
use Livewire\Component;
use Livewire\WithPagination;

class ShiftsList extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        return view('livewire.panel.shifts-list', [

            'shifts' => $this->getShiftQuery()->paginate(15),
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
    private function getShiftQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Shift::query()
            ->where('start', 'like', "%{$this->search}%")
            ->orWhere('end', 'like', "%{$this->search}%");
    }
}
