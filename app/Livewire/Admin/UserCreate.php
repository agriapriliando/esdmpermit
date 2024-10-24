<?php

namespace App\Livewire\Admin;

use App\Models\Commodity;
use App\Models\Company;
use App\Models\Region;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserCreate extends Component
{
    // form user
    #[Validate('required', message: 'Nama tidak boleh kosong')]
    public $name;
    #[Validate('required', message: 'Username tidak boleh kosong')]
    #[Validate('alpha_dash', message: 'Username Tidak Boleh Memakai Spasi')]
    #[Validate('unique:users,username', message: 'Username Telah Digunakan')]
    public $username;
    #[Validate('required', message: 'No HP tidak boleh kosong')]
    #[Validate('unique:users,nohp', message: 'No HP Telah Digunakan')]
    public $nohp;
    #[Validate('required', message: 'Email tidak boleh kosong')]
    #[Validate('email', message: 'Format Email Belum Benar, gunakan @')]
    #[Validate('unique:users,email', message: 'Email telah digunakan')]
    public $email;
    public $password;
    public $role;

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

    // untuk select option
    public $kab_kota_list = [];
    public $kecamatan_list = [];

    // untuk form edit
    public $id_user;
    public $dataUser;
    public $dataCompany;

    public function mount()
    {
        // isi region id
        // $this->region_id = $this->kecamatan_company == null ? $this->kab_kota_company : $this->kecamatan_company;
        $this->kab_kota_list = Region::where('parent_region', '62')->get();
    }

    public function resetForm()
    {
        $this->reset();
    }

    public function updatedKabKotaCompany()
    {
        $this->region_id = $this->kecamatan_company == null ? $this->kab_kota_company : $this->kecamatan_company;
        $this->kecamatan_list = Region::where('parent_region', $this->kab_kota_company)->get();
    }

    public function updatedKecamatanCompany()
    {
        $this->region_id = $this->kecamatan_company == null ? $this->kab_kota_company : $this->kecamatan_company;
    }

    public function save()
    {
        // validation unique data
        $this->validate();
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
            'region_id' => $this->region_id,
            'name_company' => strtoupper($this->name_company),
            'province_company' => "KALIMANTAN TENGAH",
            'kab_kota_company' => Region::find(substr($this->region_id, 0, 5))->name_region,
            'kecamatan_company' => $this->kecamatan_company == null ? null : Region::where('id', $this->kecamatan_company)->first()->name_region,
            'kel_desa_company' => $this->kel_desa_company,
            'address_sk_company' => $this->address_sk_company,
            'notes_company' => $this->notes_company,
        ];
        try {
            $user = User::create($data);
            $data_company['user_id'] = $user->id;
            Company::create($data_company);
            session()->flash('success', 'Akun ' . $data['name'] . ' Berhasil Ditambahkan');
            return $this->redirectRoute('users.list', navigate: true);
        } catch (\Exception $e) {
            session()->flash('success', 'Akun Gagal Ditambahkan : ' . $e->getMessage());
            return $this->redirectRoute('users.list', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.user-create', [
            'commoditys' => Commodity::all(),
            'regions' => Region::where('parent_region', '62')->get(),
        ]);
    }
}
