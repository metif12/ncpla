<?php

namespace App\Http\Livewire\Panel\Forms;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateUser extends Component
{
    public string $name = '';
    public string $email = '';
    public string $mobile = '';
    public string $national_code = '';
    public string $address = '';

    protected function getRules(): array
    {
        return [
            'name' => 'required|string',
            'mobile' => 'nullable|mobile',
            'email' => 'required|email',
            'national_code' => 'required|string|unique:users,national_code',
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

        $user = User::query()->create([

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
        return view('livewire.panel.forms.create-user')
            ->layout('panel.layout');
    }
}
