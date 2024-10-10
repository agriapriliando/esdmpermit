<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;

class CompanyList extends Component
{
    use WithPagination;

    public $search = '';
    public $pagelength = 10;
    public $title = 'Tambah Perusahaan';

    #[Validate('required', message: 'Nama Perusahaan tidak boleh kosong')]
    public $name_company;
    #[Validate('required', message: 'Tipe Perusahaan tidak boleh kosong')]
    public $type_company;
    #[Validate('required', message: 'NPWP tidak boleh kosong')]
    public $npwp_company;
    public $act_company = true; // Default value
    #[Validate('required', message: 'Kota tidak boleh kosong')]
    public $city_company;
    #[Validate('required', message: 'Kecamatan tidak boleh kosong')]
    public $kecamatan_company;
    #[Validate('required', message: 'Alamat tidak boleh kosong')]
    public $address_company;
    public $id;

    public $user_id; // Variabel untuk menyimpan user_id
    public $users; // Variabel untuk menyimpan daftar pengguna

    public $provinces = [];
    public $cities = [];
    public $districts = [];

    public $selectedProvince = '62'; // Default: Kalimantan Tengah (provinsi dengan kode '62')
    public $selectedCity = null;
    public $selectedCityName;
    public $selectedDistrict = null;
    public $selectedKecamatanName;

    // Saat komponen di-mount, ambil data pengguna
    public function mount()
    {
        //$this->users = User::all(); // Ambil semua data pengguna
        $this->getCities(); // Ambil daftar kota ketika komponen dimuat
        $this->users = User::where('role', 'pemohon')->get();

        if ($this->users->isEmpty()) {
            $this->users = collect();  // Mengatur menjadi koleksi kosong jika tidak ada data
        }
    }

    public function getUser()
    {
        $this->users = User::where('role', 'pemohon')->get();
    }

    public function getCities()
    {
        // Ambil data kota berdasarkan provinsi yang dipilih
        if ($this->selectedProvince) {
            $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$this->selectedProvince}.json");
            $this->cities = $response->json();
        }
    }

    public function updatedCityCompany($cityId)
    {
        $this->getDistricts($cityId);
        //cari nama kota kab
        foreach ($this->cities as $city) {
            if ($city['id'] == $cityId) {
                $this->selectedCityName = $city['name'];
            }
        }
    }
    public function updatedKecamatanCompany()
    {
        foreach ($this->districts as $district) {
            if ($district['id'] == $this->kecamatan_company) {
                $this->selectedKecamatanName = $district['name'];
            }
        }
    }

    public function getDistricts($cityId)
    {
        if ($cityId) {
            $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$cityId}.json");
            $this->districts = $response->json();
        }
        // else {
        //     // Jika kota tidak dipilih, reset daftar kecamatan
        //     $this->districts = [];
        //     //dd($this->districts);
        // }
    }

    public function resetSearch()
    {
        $this->reset('search');
    }

    public function resetForm()
    {
        $this->title = 'Tambah Perusahaan';
        $this->reset('name_company', 'type_company', 'npwp_company', 'city_company', 'kecamatan_company', 'address_company', 'act_company');
    }

    public function save($id = null)
    {
        // dd("AAA");
        if ($this->title == 'Tambah Perusahaan') {
            // dd($this->user_id);
            $this->validate();
        } else {
            dd("CCC");
            $this->validate([
                'name_company' => 'required|unique:companies,name_company,' . $dataCompany->id,
                'type_company' => 'required',
                'npwp_company' => 'required',
                'user_id' => 'required', // Validasi user_id
            ]);
        }

        $data = $this->only('name_company', 'type_company', 'npwp_company', 'act_company', 'city_company', 'kecamatan_company', 'address_company', 'user_id');
        $data['city_company'] = $this->selectedCityName;
        $data['kecamatan_company'] = $this->selectedKecamatanName;

        if ($this->title == 'Tambah Perusahaan') {
            try {
                Company::create($data);
                $this->reset();
                $this->getCities();
                $this->getUser();
                $this->dispatch('company-created', message: 'Perusahaan ' . $data['name_company'] . ' Berhasil Ditambahkan');
            } catch (\Exception $e) {
                $this->dispatch('company-add-error', message: 'Created Company Error ' . $e->getMessage() . ' ERROR');
            }
        } else {
            try {
                $dataCompany = Company::find($id);
                $dataCompany->update($data);
                $this->reset();
                $this->getCities();
                $this->getUser();
                $this->dispatch('company-updated', message: 'Perusahaan ' . $data['name_company'] . ' Berhasil Diperbaharui');
            } catch (\Exception $e) {
                $this->dispatch('company-add-error', message: 'Updated Company Error ' . $e->getMessage() . ' ERROR');
            }
        }
    }

    public function edit(Company $company)
    {
        $this->title = 'Edit Perusahaan';
        $this->id = $company->id;
        $this->name_company = $company->name_company;
        $this->type_company = $company->type_company;
        $this->npwp_company = $company->npwp_company;
        $this->act_company = $company->act_company;
        $this->city_company = $company->city_company;
        $this->kecamatan_company = $company->kecamatan_company;
        $this->address_company = $company->address_company;
        $this->user_id = $company->user_id;
    }

    public function getCompanyDelete($id)
    {
        $company = Company::find($id);
        $company->delete();

        $this->dispatch('company-deleted', message: 'Perusahaan ' . $company->name_company . ' Berhasil Dihapus');
    }

    public function render()
    {
        return view('livewire.admin.company-list', [
            // 'companies' => Company::search($this->search)
            'companies' => Company::orderBy('name_company')
                ->paginate($this->pagelength),
            'cities' => $this->cities, // Pastikan cities tersedia di Blade
            'districts' => $this->districts, // Pastikan districts tersedia di Blade
            'users' => $this->users // Pastikan users tersedia di Blade
        ]);
    }
}
