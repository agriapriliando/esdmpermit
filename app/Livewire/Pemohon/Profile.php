<?php

namespace App\Livewire\Pemohon;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Profile extends Component
{
    public $user;
    #[Validate('required', message: 'Nama tidak boleh kosong')]
    public $name;
    #[Validate('required', message: 'Username tidak boleh kosong')]
    public $username;
    #[Validate('required', message: 'No HP tidak boleh kosong')]
    public $nohp;
    #[Validate('required', message: 'Email tidak boleh kosong')]
    #[Validate('email', message: 'Email tidak valid')]
    public $email;

    public $password;

    public $password_confirmation;

    public function mount()
    {
        $user = User::find(Auth()->user()->id);
        $this->user = $user;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->nohp = $user->nohp;
        $this->email = $user->email;
    }

    public function updatedUsername()
    {
        $this->validate(
            [
                'username' => 'unique:users,username,' . Auth::user()->id
            ],
            [
                'username.unique' => 'Username sudah terdaftar'
            ]
        );
    }

    public function update()
    {
        $user = User::find(Auth()->user()->id);
        $user->update([
            'name' => $this->name,
            'username' => $this->username,
            'nohp' => $this->nohp,
            'email' => $this->email,
        ]);
        if ($this->password != null) {
            $this->validate([
                'password' => 'confirmed',
                'password_confirmation' => 'required'
            ], [
                'password.confirmed' => 'Password tidak cocok',
            ]);
            $user->update([
                'password' => bcrypt($this->password),
            ]);
            $this->password = null;
            $this->password_confirmation = null;
        }
        session()->flash('message', 'Profile Anda Berhasil Diperbaharui');
        $this->dispatch('profile-updated', message: 'Profile Anda Berhasil Diperbaharui');
    }
    public function render()
    {
        return view('livewire.pemohon.profile');
    }
}
