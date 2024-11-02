<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class DaftarController extends Controller
{
    public function __invoke(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'nohp' => 'required',
            'name_company' => 'required',
            'type_company' => 'required',
            'commodity_id' => 'required',
            'region_id' => 'required',
        ]);
        $data['role'] = 'newuser';
        $data['password'] = bcrypt($data['password']);
        $data_company = [
            'commodity_id' => $data['commodity_id'],
            'region_id' => $data['region_id'],
            'name_company' => strtoupper($data['type_company']) . ' ' . strtoupper($data['name_company']),
            'province_company' => "KALIMANTAN TENGAH",
            'kab_kota_company' => Region::find(substr($data['region_id'], 0, 5))->name_region,
        ];
        // dd($data_company);
        try {
            $user = User::create($data);
            $data_company['user_id'] = $user->id;
            Company::create($data_company);
            session()->flash('success', 'Pendaftaran Akun ' . $data_company['name_company'] . ' Berhasil');
            session()->flash('email', $data['email']);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return redirect()->route('login');
    }
}
