<?php

namespace App\Livewire\Pemohon;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Profile extends Component
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

    // form company
    public $user_id;
    #[Validate('required', message: 'Pilih Aktivitas Perusahaan')]
    public $commodity_id;
    public $region_id;
    #[Validate('required', message: 'Nama Perusahaan tidak boleh kosong')]
    #[Validate('regex:/^[\pL\s\-]+$/u', message: 'Gunakan Huruf tanpa tanda baca')]
    public $name_company;
    public $province_company;
    #[Validate('required', message: 'Pilih Kabupaten / Kota')]
    public $kab_kota_company;
    public $kecamatan_company;
    public $kel_desa_company;
    public $address_sk_company;
    public $notes_company;

    public function mount()
    {
        $user = User::with('company')->where('id', Auth::id())->first();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->nohp = $user->nohp;
        $this->email = $user->email;

        $this->user_id = $user->id;
        $company = Company::with('commodity')->where('user_id', Auth::id())->first();
        $this->region_id = $company->region_id;
        $this->commodity_id = $company->commodity;
        $this->name_company = $company->name_company;
        $this->province_company = $company->province_company;
        $this->kab_kota_company = $company->kab_kota_company;
        $this->kecamatan_company = $company->kecamatan_company;
        $this->kel_desa_company = $company->kel_desa_company;
        $this->address_sk_company = $company->address_sk_company;
        $this->notes_company = $company->notes_company;
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
    public function updatedNohp()
    {
        $this->validate(
            [
                'nohp' => 'unique:users,nohp,' . Auth::user()->id
            ],
            [
                'nohp.unique' => 'No HP sudah terdaftar'
            ]
        );
    }

    public function updatedPassword()
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
        return view('livewire.pemohon.profile');
    }
}
