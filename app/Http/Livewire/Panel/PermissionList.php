<?php

namespace App\Http\Livewire\Panel;

use Junges\ACL\Http\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionList extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Permission $permission)
    {
        $permission->delete();
    }

    public function render()
    {
        return view('livewire.panel.permission-list', [

            'permissions' => $this->permissionsQuery()->paginate(12),
        ])
            ->layout('panel.layout');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function permissionsQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $permissions = Permission::query();

        if (!empty($this->search)) {
            $permissions
                ->where('name', 'like', "%$this->search%")
                ->orWhere('description', 'like', "%$this->search%");
        }
        return $permissions;
    }
}
