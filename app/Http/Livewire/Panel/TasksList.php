<?php

namespace App\Http\Livewire\Panel;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        return view('livewire.panel.tasks-list', [

            'tasks' => $this->getTaskQuery()->paginate(15),
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
    private function getTaskQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Task::query()
            ->where('code', 'like', "%{$this->search}%");
            //->orWhere('name', 'like', "%{$this->search}%");
    }
}
