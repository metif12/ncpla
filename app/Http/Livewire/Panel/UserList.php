<?php

namespace App\Http\Livewire\Panel;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $queryString = ['search', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleActivation(User $user)
    {
        $user->toggleActivation();
    }

    public function delete(User $user)
    {
        $user->delete();
        $user->refresh();
    }

    public function render()
    {
        $users = User::query()->with('shift');

        if (!empty($this->search)) {
            $users
                ->where('name', 'like', "%$this->search%")
                ->orWhere('mobile', 'like', "%$this->search%");
        }

        return view('livewire.panel.user-list', [

                'users' => $users->paginate(12),
            ])
            ->layout('panel.layout');

    }
}
