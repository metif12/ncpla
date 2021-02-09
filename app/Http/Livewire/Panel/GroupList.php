<?php

namespace App\Http\Livewire\Panel;

use Junges\ACL\Http\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class GroupList extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Group $group)
    {
        $group->delete();
    }

    public function render()
    {
        return view('livewire.panel.group-list', [

            'groups' => $this->groupsQuery()->paginate(12),
        ])
            ->layout('panel.layout');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function groupsQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $groups = Group::query();

        if (!empty($this->search)) {
            $groups
                ->where('name', 'like', "%$this->search%")
                ->orWhere('description', 'like', "%$this->search%");
        }
        return $groups;
    }
}
