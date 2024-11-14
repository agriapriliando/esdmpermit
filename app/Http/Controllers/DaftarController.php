<?php

namespace App\Http\Controllers;

use App\Mail\AktivasiAkun;
use App\Models\Company;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DaftarController extends Controller
{
    public function __invoke(Request $request)
    {
        // dd($request->all());
        $datauser = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email',
            'password' => 'required',
            'nohp' => 'required',
        ]);
        $data_company = $request->validate([
            'name_company' => 'required',
            'type_company' => 'required',
            'commodity_id' => 'required',
            'region_id' => 'required',
        ]);

        $datauser['role'] = 'newuser';
        $datauser['nohp'] = '62' . $datauser['nohp'];
        $datauser['password'] = bcrypt($datauser['password']);
        $token = Str::random(60);
        $datauser['api_token'] = $token;

        $data_company['name_company'] = strtoupper($data_company['type_company']) . ' ' . strtoupper($data_company['name_company']);
        $data_company['province_company'] = "KALIMANTAN TENGAH";
        $data_company['kab_kota_company'] = Region::find(substr($data_company['region_id'], 0, 5))->name_region;
        unset($data_company['type_company']);
        // dd($url);
        try {
            $url = route("aktivasi", $datauser['api_token']);
            $user = User::create($datauser);
            $data_company['user_id'] = $user->id;
            Company::create($data_company);
            Mail::to($datauser['email'])->send(new AktivasiAkun($user['name'], $datauser['username'], $request->password, $url));
            session()->flash('success', 'Pendaftaran Akun ' . $data_company['name_company'] . ' Dengan Email ' . $datauser['email'] . ' Berhasil.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return redirect()->route('login');
    }
}
