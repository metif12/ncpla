<?php

namespace App\Http\Livewire\Panel;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $photo;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function deleteProfilePhoto()
    {
        $this->user->forceFill(['profile_photo'=> 'img/profile.png'])->save();
    }

    protected function getRules()
    {
        return [
            'photo' => ['nullable', 'image', 'max:1024'],

            'user.name' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore(auth()->id())],
            'user.national_code' => ['required', 'national_code', 'max:255', Rule::unique('users', 'national_code')->ignore(auth()->id())],
            'user.mobile' => ['nullable', 'mobile', 'max:255',],
            'user.address' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function updateProfileInformation()
    {

        $profile_photo = 'img/profile.png';

        if ($this->photo) {

            $name = date('YmdHis') . '-' . md5_file($this->photo->getRealPath()) . '-' . random_bytes(10) . '.' . $this->photo->getClientOriginalExtension();
            $profile_photo = $this->photo->storeAs('profile_photos', $name);
        }

        $this->user->forceFill([

            'profile_photo' => $profile_photo,

        ])->save();

        $this->emitSelf('saved');
    }

    public function render()
    {
        return view('livewire.panel.profile')
            ->layout('panel.layout');
    }
}
