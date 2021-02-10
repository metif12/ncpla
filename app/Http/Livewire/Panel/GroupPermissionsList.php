<?php

namespace App\Http\Livewire\Panel;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Junges\ACL\Http\Models\Group;
use Junges\ACL\Http\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class GroupPermissionsList extends Component
{
    use WithPagination;

    public Group $group;

    public string $search = '';

    protected $listeners = [

        'group_permissions_updated' => 'groupPermissionsUpdated'
    ];

    public function mount(Group $group)
    {
        $this->group = $group;
    }

    public function groupPermissionsUpdated()
    {
        $this->group->refresh();
    }

    public function revoke(Permission $per)
    {
        $this->group->revokePermissions($per);

        $per->refresh();
        $this->group->refresh();

        $this->emit('group_permissions_updated');
    }

    public function render()
    {
        return view('livewire.panel.group-permissions-list', [

            'granted' => $this->getGroupPermissionsQuery()->paginate(15),
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
    private function getGroupPermissionsQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Permission::query()
            ->where(function ($query) {

                return $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            })
            ->leftJoin('group_has_permissions', 'permissions.id', '=', 'group_has_permissions.permission_id')
            ->where('group_has_permissions.group_id', $this->group->id);
    }
}
