<?php

namespace App\Http\Livewire\Panel;

use App\Models\Line;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class LineUsersList extends Component
{
    use WithPagination;

    public Line $line;

    public string $search = '';

    protected $listeners = [

        'line_users_updated' => 'lineUsersUpdated'
    ];

    public function mount(Line $line)
    {
        $this->line = $line;
    }

    public function lineUsersUpdated()
    {
        $this->line->refresh();
    }

    public function delete(User $user)
    {
        DB::table('line_users')
            ->where('user_id', $user->id)
            ->where('line_id', $this->line->id)
            ->delete();

        $user->refresh();
        $this->line->refresh();

        $this->emit('line_users_updated');
    }

    public function render()
    {
        return view('livewire.panel.line-users-list', [

            'users' => $this->getLineUsersQuery()->paginate(15),
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
    private function getLineUsersQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return User::query()
            ->where(function ($query) {

                return $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('national_code', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('mobile', 'like', "%{$this->search}%");
            })
            ->leftJoin('line_users', 'users.id', '=', 'line_users.user_id')
            ->where('line_users.line_id', $this->line->id);
    }
}
