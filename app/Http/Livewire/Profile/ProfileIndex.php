<?php

namespace App\Http\Livewire\Profile;

use App\Http\Requests\Profile\ProfileChangePasswordRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileIndex extends Component
{
    use WithFileUploads;

    public $tempImage;

    public $userForm = [
        'name' => '',
        'username' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
        'profile' => [
            'image' => null,
            'phone' => null,
            'address' => null,
        ],
    ];

    public $changePasswordForm = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function mount()
    {
        $this->userForm = auth()->user()->toArray();
        $this->userForm['profile'] = auth()->user()->profile->toArray();
    }

    public function render()
    {
        return view(
            'livewire.profile.profile-index',
            ['userForm' => auth()->user()]
        )->extends('layouts.app');
    }

    public function updateProfileInformation()
    {
        $this->validate((new ProfileUpdateRequest)->rules());

        $profile = $this->userForm['profile'];

        if ($this->tempImage !== null) {
            $this->userForm['profile']['image'] = $this->tempImage->store('profile', 'public');
        }

        // Update user data
        request()->user()->fill($this->userForm);
        request()->user()->profile->fill($profile);

        // Save to database
        request()->user()->save();
        request()->user()->profile->save();

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function updatePassword()
    {
        $this->validate((new ProfileChangePasswordRequest())->rules(), [], (new ProfileChangePasswordRequest())->attributes());

        request()->user()->update([
            'password' => bcrypt($this->changePasswordForm['password']),
        ]);

        $this->reset('changePasswordForm');

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Password updated successfully!'
        ]);
    }

    public function updateImage()
    {
        $this->validate([
            'tempImage' => 'image|max:2048', // 2MB Max
        ]);

        $this->userForm['profile']['image'] = $this->tempImage->store('profile', 'public');

        $this->tempImage = null;

        $this->updateProfileInformation();

        $this->dispatchBrowserEvent('toaster', [
            'type' => 'success',
            'message' => 'Profile image updated successfully!'
        ]);
    }
}
