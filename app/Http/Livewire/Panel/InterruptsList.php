<?php

namespace App\Http\Livewire\Panel;

use App\Models\Interrupt;
use Livewire\Component;
use Livewire\WithPagination;

class InterruptsList extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        return view('livewire.panel.interrupts-list', [

            'interrupts' => $this->getInterruptQuery()->paginate(15),
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
    private function getInterruptQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Interrupt::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('code', 'like', "%{$this->search}%");
    }
}
