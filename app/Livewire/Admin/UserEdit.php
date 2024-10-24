<?php

namespace App\Livewire\Admin;

use App\Models\Commodity;
use App\Models\Company;
use App\Models\Region;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserEdit extends Component
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

    // form company
    public $user_id;
    public $commodity_id;
    public $region_id;
    #[Validate('required', message: 'Nama Perusahaan tidak boleh kosong')]
    public $name_company;
    public $province_company;
    #[Validate('required', message: 'Pilih Kabupaten / Kota')]
    public $kab_kota_company;
    public $kecamatan_company;
    public $kel_desa_company;
    public $address_sk_company;
    public $notes_company;

    // untuk select option
    public $kab_kota_list = [];
    public $kecamatan_list = [];

    // untuk form edit
    public $id_user;
    public $dataUser;
    public $dataCompany;

    public function mount($id_user)
    {
        $this->id_user = $id_user;
        // dd($id_user);
        $this->dataUser = User::where('id', $id_user)->first();
        $this->name = $this->dataUser->name;
        $this->username = $this->dataUser->username;
        $this->nohp = $this->dataUser->nohp;
        $this->email = $this->dataUser->email;

        $this->dataCompany = Company::with('commodity')->where('user_id', $id_user)->first();
        $this->user_id = $this->dataCompany->user_id;
        $this->commodity_id = $this->dataCompany->commodity_id;

        $this->name_company = $this->dataCompany->name_company;
        $this->province_company = $this->dataCompany->province_company;
        // cari kabupaten berdasarkan db, tampilkan id
        $this->kab_kota_company = substr(Region::find($this->dataCompany->region_id)->id, 0, 5);
        // cari kecamatan
        if (strlen($this->dataCompany->region_id) == 5) {
            $this->kecamatan_company = '';
        } else {
            $this->kecamatan_company = Region::find($this->dataCompany->region_id)->id;
        }
        // isi region id
        $this->region_id = $this->kecamatan_company == null ? $this->kab_kota_company : $this->kecamatan_company;
        $this->kel_desa_company = $this->dataCompany->kel_desa_company;
        $this->address_sk_company = $this->dataCompany->address_sk_company;
        $this->notes_company = $this->dataCompany->notes_company;

        $this->kab_kota_list = Region::where('parent_region', '62')->get();
        $this->updatedKabKotaCompany();
    }

    public function updatedKabKotaCompany()
    {
        $this->kecamatan_list = Region::where('parent_region', $this->kab_kota_company)->get();
    }

    public function save()
    {
        // validation unique data
        $this->validate([
            'username' => 'unique:users,username,' . $this->dataUser->id,
            'email' => 'email|unique:users,email,' . $this->dataUser->id,
            'name_company' => 'required',
            'kab_kota_company' => 'required',
        ]);
        // ambil data form user
        $data = $this->only('name', 'username', 'nohp', 'email');
        // cek checkbox password
        if ($this->password == null) {
            // jadikan username sebagai password
            $data['password'] = bcrypt($this->username);
        } else {
            $data['password'] = bcrypt($this->password);
        }
        $data['role'] = 'pemohon';
        $data_company = [
            'commodity_id' => $this->commodity_id,
            'region_id' => $this->kecamatan_company == null ? $this->kab_kota_company : $this->kecamatan_company,
            'name_company' => strtoupper($this->name_company),
            'province_company' => "KALIMANTAN TENGAH",
            'kab_kota_company' => Region::find(substr($this->region_id, 0, 5))->name_region,
            'kecamatan_company' => $this->kecamatan_company == null ? null : Region::where('id', $this->kecamatan_company)->first()->name_region,
            'kel_desa_company' => $this->kel_desa_company,
            'address_sk_company' => $this->address_sk_company,
            'notes_company' => $this->notes_company,
        ];
        try {
            $this->dataUser->update($data);
            $this->dataCompany->update($data_company);
            session()->flash('success', 'Akun ' . $data['name'] . ' Berhasil Diubah');
            return $this->redirectRoute('users.list', navigate: true);
        } catch (\Exception $e) {
            session()->flash('success', 'Akun Gagal Diubah : ' . $e->getMessage());
            return $this->redirectRoute('users.list', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.user-edit', [
            'commoditys' => Commodity::all(),
            'regions' => Region::where('parent_region', '62')->get(),
        ]);
    }
}
