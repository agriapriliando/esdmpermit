<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdminProfile extends Component
{
    // form user
    #[Validate('required', message: 'Nama tidak boleh kosong')]
    public $name;
    #[Validate('required', message: 'Username tidak boleh kosong')]
    #[Validate('alpha_dash', message: 'Username Tidak Boleh Memakai Spasi')]
    public $username;
    #[Validate('required', message: 'No HP tidak boleh kosong')]
    public $nohp;
    #[Validate('required', message: 'Email tidak boleh kosong')]
    #[Validate('email', message: 'Format Email Belum Benar, gunakan @')]
    public $email;
    #[Validate('confirmed', message: 'Password yang dimasukan belum sesuai')]
    public $password;
    public $password_confirmation;
    public $role;

    public $passCheck = false;

    public function mount()
    {
        $user = User::where('id', Auth::id())->first();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->nohp = $user->nohp;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function updatedPasswordConfirmation()
    {
        $this->validate(
            [
                'password' => 'confirmed'
            ],
            [
                'password.confirmed' => 'Password yang dimasukan tidak sesuai'
            ]
        );
    }

    public function updatedUsername()
    {
        $this->validate(
            [
                'username' => 'unique:users,username,' . Auth::user()->id
            ],
            [
                'username.unique' => 'Username sudah digunakan'
            ]
        );
        $this->username = strtolower($this->username);
    }

    public function update()
    {
        // validation unique data
        $this->validate();
        // ambil data form user
        $data = $this->only('name', 'username', 'nohp');
        // cek checkbox password
        if ($this->passCheck) {
            if ($this->password != null) {
                // ganti password sesuai inputan password
                $data['password'] = bcrypt($this->password);
            }
        }
        try {
            User::find(Auth::id())->update($data);
            $this->dispatch('profile-updated', message: 'Profile Anda Berhasil Diperbaharui');
        } catch (\Exception $e) {
            $this->dispatch('fail-updated', message: $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-profile');
    }
}
