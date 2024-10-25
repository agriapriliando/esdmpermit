<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UseradminEdit extends Component
{
    // form user
    #[Validate('required', message: 'Nama tidak boleh kosong')]
    public $name;
    #[Validate('required', message: 'Username tidak boleh kosong')]
    #[Validate('alpha_dash', message: 'Username Tidak Boleh Memakai Spasi')]
    public $username;
    #[Validate('required', message: 'No HP tidak boleh kosong')]
    // #[Validate('unique:users,nohp', message: 'No HP Telah Digunakan')]
    public $nohp;
    #[Validate('required', message: 'Email tidak boleh kosong')]
    #[Validate('email', message: 'Format Email Belum Benar, gunakan @')]
    public $email;
    public $password;
    public $role;
    public $dataUser;

    public $passCheck = false;

    public function mount($id_user)
    {
        $this->dataUser = User::where('id', $id_user)->first();
        $this->name = $this->dataUser->name;
        $this->username = $this->dataUser->username;
        $this->nohp = $this->dataUser->nohp;
        $this->email = $this->dataUser->email;
        $this->role = $this->dataUser->role;
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
            $this->dataUser->update($data);
            $this->dispatch('profile-updated', message: 'Profile Anda Berhasil Diperbaharui');
        } catch (\Exception $e) {
            $this->dispatch('fail-updated', message: $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.useradmin-edit');
    }
}
