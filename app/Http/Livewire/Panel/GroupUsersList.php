<?php

namespace App\Http\Livewire\Panel;

use App\Models\User;
use Junges\ACL\Http\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class GroupUsersList extends Component
{
    use WithPagination;

    public Group $group;

    public string $search = '';

    protected $listeners = [

        'group_users_updated' => 'groupUsersUpdated'
    ];

    public function mount(Group $group)
    {
        $this->group = $group;
    }

    public function groupUsersUpdated()
    {
        $this->group->refresh();
    }

    public function delete(User $user)
    {
        $user->revokeGroup($this->group);

        $this->emit('group_users_updated');
    }

    public function render()
    {
        return view('livewire.panel.group-users-list', [

            'users' => $this->getGroupUsersQuery()->paginate(15),
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
    private function getGroupUsersQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return User::query()
            ->where(function ($query) {

                return $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('national_code', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('mobile', 'like', "%{$this->search}%");
            })
            ->leftJoin('user_has_groups', 'users.id', '=', 'user_has_groups.user_id')
            ->where('user_has_groups.group_id', $this->group->id);
    }
}
