<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Junges\ACL\Http\Models\Group;
use Junges\ACL\Http\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class EditPermission extends Component
{
    use WithPagination;

    public Permission $permission;

    public string $searchGroups = '';
    public string $searchUsers = '';
    public string $description = '';

    public function mount(Permission $permission)
    {
        $this->permission = $permission;
        $this->description = $permission->description;
    }

    protected function getRules(): array
    {
        return [
            'description' => ['required', 'string']
        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function storePermission()
    {
        $this->validate();

        $this->permission->update([
            'description' => $this->description,
        ]);

        $this->permission->refresh();
        $this->emitSelf('saved');
    }

//    public function updatingSearch()
//    {
//        $this->resetPage();
//    }

    public function revokeGroup(Group $group)
    {
        $group->revokePermissions($this->permission);
    }

    public function revokeUser(User $user)
    {
        $user->revokePermissions($this->permission);
    }

    public function toggleUser(User $user)
    {
        if (!$user->hasPermission($this->permission))
            $user->assignPermissions($this->permission);
        else
            $user->revokePermissions($this->permission);

        $this->permission->refresh();
        $user->refresh();
    }

    public function toggleGroup(Group $group)
    {
        if (!$group->hasPermission($this->permission))
            $group->assignPermissions($this->permission);
        else
            $group->revokePermissions($this->permission);

        $this->permission->refresh();
        $group->refresh();
    }

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', "%{$this->searchUsers}%")
            ->orWhere('mobile', 'like', "%{$this->searchUsers}%")
            ->orWhere('national_code', 'like', "%{$this->searchUsers}%");

        $groups = Group::query()
            ->where('name', 'like', "%{$this->searchGroups}%")
            ->orWhere('description', 'like', "%{$this->searchGroups}%");

        return view('livewire.panel.forms.edit-permission', [

            'members' => $this->permission->users()->paginate(12),
            'groups' => $this->permission->groups()->paginate(12),

            'searchedUsers' => $this->searchUsers ? $users->limit(5)->get() : [],
            'searchedGroups' => $this->searchGroups ? $groups->limit(5)->get() : []
        ])
            ->layout('panel.layout');

    }
}
