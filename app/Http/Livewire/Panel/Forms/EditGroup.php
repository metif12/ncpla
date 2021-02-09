<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Junges\ACL\Http\Models\Group;
use Junges\ACL\Http\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class EditGroup extends Component
{
    use WithPagination;

    public Group $group;

    public string $searchUsers = '';
    public string $searchPermissions = '';
    public string $name = '';

    public function mount(Group $group)
    {
        $this->group = $group;
        $this->name = $group->name;
    }

    protected function getRules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('groups', 'name')->ignore(($this->group ?? new Group())->slug, 'slug')]
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function storeGroup()
    {
        $this->validate();

        $this->group->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name, '-', 'fa'),
        ]);

        $this->group->refresh();
        $this->emitSelf('saved');
    }

    public function delete(User $user)
    {
        $user->revokeGroup($this->group);
    }

    public function revoke(Permission $per)
    {
        $this->group->revokePermissions($per);
    }

    public function toggleAdmin(User $user)
    {
        if (!$user->hasGroup($this->group))
            $user->assignGroup($this->group);
        else
            $user->revokeGroup($this->group);

        $user->refresh();
        $this->group->refresh();
    }

    public function togglePermission(Permission $permission)
    {
        if (!$this->group->hasPermission($permission))
            $this->group->assignPermissions($permission);
        else
            $this->group->revokePermissions($permission);

        $permission->refresh();
        $this->group->refresh();
    }

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', "%{$this->searchUsers}%")
            ->orWhere('mobile', 'like', "%{$this->searchUsers}%")
            ->orWhere('national_code', 'like', "%{$this->searchUsers}%");

        $permissions = Permission::query()
            ->where('name', 'like', "%{$this->searchPermissions}%")
            ->orWhere('description', 'like', "%{$this->searchPermissions}%");

        return view('livewire.panel.forms.edit-group', [

            'members' => $this->group->users()->paginate(12),
            'granted' => $this->group->permissions()->paginate(12),
            'permissions' => $this->searchPermissions ? $permissions->limit(5)->get() : [],
            'users' => $this->searchUsers ? $users->limit(5)->get() : []
        ])
            ->layout('panel.layout');

    }
}
