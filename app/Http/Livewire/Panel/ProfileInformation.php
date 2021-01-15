<?php

namespace App\Http\Livewire\Panel;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileInformation extends Component
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

            $profile_photo = 'profile_photos/' . date('YmdHis') . '-' . md5_file($this->photo->getRealPath()) . '.' . $this->photo->getClientOriginalExtension();
            move_uploaded_file($this->photo->getRealPath(), public_path($profile_photo));
        }

        $this->user->forceFill([

            'profile_photo' => $profile_photo,

        ])->save();

        $this->emitSelf('saved');
    }

    public function render()
    {
        return view('livewire.panel.profile-information');
    }
}
