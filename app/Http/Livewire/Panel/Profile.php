<?php

namespace App\Http\Livewire\Panel;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $state;
    public $photo;

    protected $rules = [
        'photo' => ['nullable', 'image', 'max:1024'],

        'state.name' => ['required', 'string', 'max:255'],
        'state.email' => ['required', 'email', 'max:255', 'unique:users'],
        'state.mobile' => ['required', 'mobile', 'max:255', 'unique:users'],
        'state.address' => ['nullable', 'string', 'max:255'],
    ];

    public function mount()
    {
        $this->user = auth()->user();
        $this->state = auth()->user();
    }

    public function deleteProfilePhoto()
    {
        $this->user->forceFill(['profile_photo'=> 'img/profile.png'])->save();
    }

    public function updateProfileInformation()
    {
        $this->validate();

        $this->user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'national_code' => $input['national_code'],
        ])->save();
    }

    public function render()
    {
        return view('livewire.panel.profile')->extends('panel.layout');
    }
}
