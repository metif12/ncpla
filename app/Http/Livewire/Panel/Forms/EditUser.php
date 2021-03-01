<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditUser extends Component
{
    public string $name = '';
    public string $email = '';
    public string $mobile = '';
    public string $national_code = '';
    public string $address = '';

    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile ?? '';
        $this->national_code = $user->national_code;
        $this->address = $user->address ?? '';
    }

    protected function getRules(): array
    {
        return [

            'name' => 'required|string',
            'mobile' => 'nullable|mobile',
            'email' => 'required|email',
            'national_code' => ['required', 'string', Rule::unique('users', 'national_code')->ignore($this->user?$this->user->id :0)],
            'address' => 'nullable|string',

        ];
    }

    public function updated()
    {
        $this->validate();
    }

    public function storeUser()
    {
        $this->validate();

        $this->user->update([

            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'national_code' => $this->national_code,
            'address' => $this->address,

        ]);

        $this->redirectRoute('panel.users');
    }

    public function render()
    {
        return view('livewire.panel.forms.edit-user')
            ->layout('panel.layout');
    }
}
