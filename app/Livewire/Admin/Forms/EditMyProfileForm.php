<?php

namespace App\Livewire\Admin\Forms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditMyProfileForm extends Component
{
    use WithFileUploads;

    // User fields
    public $f_name;

    public $l_name;

    public $email;

    public $phone;

    public $bio;

    public $avatar;

    public $currentAvatar;

    public $placeholderImg;

    // Address fields
    public $address_line1;

    public $address_line2;

    public $city;

    public $state;

    public $postal_code;

    public $country;

    public function mount()
    {
        $user = Auth::user();
        $this->f_name = $user->f_name;
        $this->l_name = $user->l_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->bio = $user->bio;
        $this->currentAvatar = $user->avatar;
        $this->placeholderImg = 'https://ui-avatars.com/api/?name='.urlencode($this->f_name.' '.$this->l_name).'&color=F4F9F9&background=1F2A44';

        $address = $user->address; // Assumes relationship is defined in User model
        if ($address) {
            // Use ?? instead of || to prevent boolean return
            $this->address_line1 = $address->address_line1 ?? null;
            $this->address_line2 = $address->address_line2 ?? null;
            $this->city = $address->city ?? null;
            $this->state = $address->state ?? null;
            $this->postal_code = $address->postal_code ?? null;
            $this->country = $address->country ?? null;
        }
    }

    protected $rules = [
        'f_name' => 'required|string|max:50',
        'l_name' => 'required|string|max:50',
        'phone' => 'nullable|string|max:20',
        'bio' => 'nullable|string|max:500',
        'avatar' => 'nullable|image|max:2048',
        'address_line1' => 'nullable|string|max:255',
        'address_line2' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'postal_code' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:100',
    ];

    public function updatedAvatar()
    {
        $this->validateOnly('avatar');
    }

    public function saveProfile()
    {
        $this->validate();

        $user = Auth::user();

        // Handle avatar upload
        if ($this->avatar) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $this->avatar->store('avatars', 'public');
            $user->avatar = $path;
            $this->currentAvatar = $path; // Update UI reference
        }

        $user->f_name = $this->f_name;
        $user->l_name = $this->l_name;
        $user->phone = $this->phone;
        $user->bio = $this->bio;
        $user->save();

        // Update or create address
        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'address_line1' => $this->address_line1,
                'address_line2' => $this->address_line2,
                'city' => $this->city,
                'state' => $this->state,
                'postal_code' => $this->postal_code,
                'country' => $this->country,
            ]
        );

        $this->avatar = null; // Clear the file input
        session()->flash('success', 'Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.edit-my-profile-form');
    }
}
