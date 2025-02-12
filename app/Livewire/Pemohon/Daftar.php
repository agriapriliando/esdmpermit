<?php

namespace App\Livewire\Pemohon;

use App\Models\Company;
use App\Models\Region;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AktivasiAkun;
use App\Models\Commodity;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.applogin')]
class Daftar extends Component
{
    #[Validate('required', message: 'Nama harus diisi')]
    public $name;

    #[Validate('required', message: 'Username harus diisi')]
    #[Validate('unique:users,username', message: 'Username telah digunakan')]
    public $username;
    #[Validate('required', message: 'Email harus diisi')]
    #[Validate('unique:users,email', message: 'Email telah digunakan')]
    public $email;
    #[Validate('required', message: 'Password harus diisi')]
    public $password;
    #[Validate('required', message: 'No HP harus diisi')]
    #[Validate('numeric', message: 'No HP harus angka')]
    public $nohp;

    #[Validate('required', message: 'Nama Perusahaan harus diisi')]
    public $name_company;
    #[Validate('required', message: 'Tipe Perusahaan harus diisi')]
    public $type_company;
    #[Validate('required')]
    public $commodity_id;
    #[Validate('required')]
    public $region_id;

    public function daftar()
    {
        // dd($request->all());
        $datauser = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'nohp' => $this->nohp,
        ];
        $data_company = [
            'name_company' => $this->name_company,
            'type_company' => $this->type_company,
            'commodity_id' => $this->commodity_id,
            'region_id' => $this->region_id,
        ];

        $datauser['role'] = 'newuser';
        $datauser['nohp'] = '62' . $datauser['nohp'];
        $datauser['password'] = bcrypt($datauser['password']);
        $token = Str::random(60);
        $datauser['api_token'] = $token;

        $data_company['name_company'] = strtoupper($data_company['type_company']) . ' ' . strtoupper($data_company['name_company']);
        $data_company['province_company'] = "KALIMANTAN TENGAH";
        $name_region = Region::find(substr($data_company['region_id'], 0, 5));
        $data_company['kab_kota_company'] = $name_region['name_region'];
        unset($data_company['type_company']);
        // dd($url);
        try {
            $url = route("aktivasi", $datauser['api_token']);
            $user = User::create($datauser);
            $data_company['user_id'] = $user->id;
            Company::create($data_company);
            Mail::to($datauser['email'])->send(new AktivasiAkun($user['name'], $datauser['username'], $this->password, $url));
            session()->flash('successdaftar', 'Pendaftaran Akun ' . $data_company['name_company'] . ' Dengan Email ' . $datauser['email'] . ' Berhasil.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return redirect()->route('daftar');
    }

    public function render()
    {
        return view('livewire.pemohon.daftar', [
            'commodities' => Commodity::all(),
            'all_kab' => Region::where('parent_region', '62')->get(),
        ]);
    }
}
