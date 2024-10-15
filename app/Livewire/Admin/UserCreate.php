<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use App\Models\Region;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserCreate extends Component
{
    public $title = 'Tambah Akun';

    #[Validate('required', message: 'Nama tidak boleh kosong')]
    public $name;
    #[Validate('required', message: 'Username tidak boleh kosong')]
    #[Validate('unique:users,username', message: 'Username Telah Terdaftar')]
    #[Validate('alpha_dash', message: 'Username Tidak Boleh Memakai Spasi')]
    public $username;
    #[Validate('required', message: 'No HP tidak boleh kosong')]
    #[Validate('unique:users,nohp', message: 'No HP Telah Digunakan')]
    public $nohp;
    #[Validate('required', message: 'Email tidak boleh kosong')]
    #[Validate('unique:users,email', message: 'Email Telah digunakan')]
    #[Validate('email', message: 'Format Email Belum Benar, gunakan @')]
    public $email;
    public $password;
    public $role;
    public $id;

    public $jenis_role;

    // public User $user;

    public $company_id;

    #[Validate('required', message: 'Nama Perusahaan tidak boleh kosong')]
    public $name_company;
    #[Validate('required', message: 'Jenis Perusahaan tidak boleh kosong')]
    public $type_company;
    #[Validate('required', message: 'NPWP Perusahaan tidak boleh kosong')]
    #[Validate('numeric', message: 'NPWP Perusahaan hanya boleh diisi angka')]
    public $npwp_company;
    #[Validate('required', message: 'Jenis Aktivitas Perusahaan tidak boleh kosong')]
    public $act_company;
    #[Validate('required', message: 'Pilih Lokasi Perusahaan')]
    public $city_company;
    #[Validate('required', message: 'Pilih Lokasi Perusahaan')]
    public $kecamatan_company;
    #[Validate('required', message: 'Isi Alamat Lengkap Perusahaan')]
    public $address_company;

    public $companycheckbox = true;

    public $kecamatan = [];
    public $cities = [];

    public function mount()
    {
        $this->cities = Region::where('parent_region', '62')->get();
    }

    public function resetForm()
    {
        $this->reset();
        $this->title = 'Tambah Akun';
        // $this->companycheckbox = true;
        // $this->cities = Region::where('parent_region', '62')->get();
    }

    public function save($id = null)
    {
        // cek judul form
        if ($this->title == 'Tambah Akun') {
            $this->validate();
        } else {
            $dataUser = User::where('id', $id)->first();
            $this->validate([
                'name' => 'required',
                'username' => 'required|unique:users,username,' . $dataUser->id,
                'nohp' => 'required|numeric',
                'email' => 'required|email|unique:users,email,' . $dataUser->id,
            ]);
            if ($this->companycheckbox == true) {
                $dataCompany = Company::where('user_id', $id)->first();
                $this->validate([
                    'name_company' => 'required',
                    'type_company' => 'required',
                    'npwp_company' => 'required|numeric',
                    'act_company' => 'required',
                    'city_company' => 'required',
                    'kecamatan_company' => 'required',
                    'address_company' => 'required',
                ]);
            }
        }
        // cek checkbox password
        if ($this->password == null) {
            $data = $this->only('name', 'username', 'nohp', 'email');
            $data['password'] = bcrypt($this->username);
        } else {
            $data = $this->only('name', 'username', 'nohp', 'email');
            $data['password'] = bcrypt($this->password);
        }
        //cek checkbox perusahaan
        if ($this->companycheckbox == true) {
            $data['role'] = 'pemohon';
        } else {
            $data['role'] = 'admin';
        }
        // cek judul form
        if ($this->title == 'Tambah Akun') {
            $data_company = [
                'name_company' => $this->name_company,
                'type_company' => $this->type_company,
                'npwp_company' => $this->npwp_company,
                'act_company' => $this->act_company,
                'city_company' => Region::where('id_region', $this->city_company)->first()->name_region,
                'kecamatan_company' => Region::where('id_region', $this->kecamatan_company)->first()->name_region,
                'address_company' => $this->address_company
            ];
        } else {
            $data_company = [
                'name_company' => $this->name_company,
                'type_company' => $this->type_company,
                'npwp_company' => $this->npwp_company,
                'act_company' => $this->act_company,
                'city_company' => Region::where('name_region', $this->city_company)->first()->name_region,
                'kecamatan_company' => Region::where('name_region', $this->kecamatan_company)->first()->name_region,
                'address_company' => $this->address_company
            ];
        }

        if ($this->title == 'Tambah Akun') {
            try {
                $data_user = User::create($data);
                if ($this->companycheckbox == true) {
                    $data_company['user_id'] = $data_user->id;
                    Company::create($data_company);
                }
                session('success', 'Akun ' . $data['name'] . ' Berhasil Ditambahkan');
                return redirect()->route('admin.users.list');
            } catch (\Exception $e) {
                $this->dispatch('user-add-error', message: 'Created User Error ' . $e->getMessage() . ' ERROR');
            }
        } else {
            try {
                $dataUser->update($data);
                if ($this->companycheckbox == true) {
                    $dataCompany->update($data_company);
                }
                session('success', 'Akun ' . $data['name'] . ' Berhasil Diubah');
                return redirect()->route('admin.users.list');
            } catch (\Exception $e) {
                $this->dispatch('user-add-error', message: 'Updated User Error ' . $e->getMessage() . ' ERROR');
            }
        }
    }

    public function edit(User $user)
    {
        $this->title = 'Edit Akun';
        $this->id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->nohp = $user->nohp;
        $this->email = $user->email;

        if ($user->role == 'pemohon') {
            $this->companycheckbox = true;
            $this->cities = Region::where('parent_region', '62')->get();

            $dataCompany = Company::where('user_id', $user->id)->first();
            $this->name_company = $dataCompany->name_company;
            $this->type_company = $dataCompany->type_company;
            $this->npwp_company = $dataCompany->npwp_company;
            $this->act_company = $dataCompany->act_company;
            // cari region city berdasarkan id_region
            $city = Region::where('id_region', $dataCompany->city_company)->first();
            // letakan id region city ke wire model city_company
            $this->city_company = $city->id_region;
            // cari data daftar kecamatan
            $this->kecamatan = Region::where('parent_region', $city->id_region)->get();
            // cari data kecamatan di database
            $datakecamatan = Region::where('parent_region', $city->id_region)->first();
            $this->kecamatan_company = $dataCompany->kecamatan_company;
            $this->address_company = $dataCompany->address_company;
        } else {
            $this->companycheckbox = false;
        }
    }

    public function updatedCityCompany()
    {
        $this->kecamatan = Region::where('parent_region', $this->city_company)->get();
    }

    public function render()
    {
        return view('livewire.admin.user-create', [
            'cities' => Region::where('parent_region', '62')->get()
        ]);
    }
}
