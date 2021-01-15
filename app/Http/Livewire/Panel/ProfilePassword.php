<?php

namespace App\Http\Livewire\Panel;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfilePassword extends Component
{
    public $password = '';
    public $current_password = '';
    public $password_confirmation = '';

    public function updatePassword()
    {
        $this->validate([

            'password' => ['required', 'string', 'confirmed'],
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) {

                if (! Hash::check($value, auth()->user()->password)) {
                    $fail("$attribute فعلی صحیح نیست!");
                }
            }],

        ]);

        auth()->user()->update(['password'=>Hash::make($this->password)]);

        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';

        $this->emitSelf('saved');
    }

    public function render()
    {
        return view('livewire.panel.profile-password');
    }
}
