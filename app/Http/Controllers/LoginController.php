<?php

namespace App\Http\Controllers;

use App\Models\Appreq;
use App\Models\Commodity;
use App\Models\Permitwork;
use App\Models\Region;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $chartpengajuan = [];
        foreach (Stat::all() as $stat) {
            for ($i = 1; $i <= 12; $i++) {
                $chartpengajuan[$stat->name_stat][] = Appreq::whereMonth('created_at', $i)->where('stat_id', $stat->id)->count();
            }
        }

        $linktautan = [
            [
                'name' => "DESDM Kalteng",
                'link' => "https://desdm.kalteng.go.id/",
            ],
            [
                'name' => "MOMI",
                'link' => "https://momi.minerba.esdm.go.id/gisportal/home/",
            ],
            [
                'name' => "MODI",
                'link' => "https://modi.esdm.go.id/",
            ],
            [
                'name' => "E-PNBP MINERBA",
                'link' => "https://epnbpminerba.esdm.go.id/landing/",
            ],
            [
                'name' => "Perizinan MINERBA",
                'link' => "https://perizinan.esdm.go.id/minerba/",
            ],
            [
                'name' => "Pemprov Kalteng",
                'link' => "https://kalteng.go.id/",
            ],
            [
                'name' => "Simponi Kemenkeu",
                'link' => "https://www.simponi.kemenkeu.go.id/",
            ],
        ];
        // dd($chartpengajuan);
        return view('login', [
            'commodities' => Commodity::all(),
            'permitworks' => Permitwork::where('aktif', 1)->get(),
            'all_kab' => Region::where('parent_region', '62')->get(),
            'chartpengajuan' => $chartpengajuan,
            'linktautan' => $linktautan
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            session()->regenerate();
            $list_role = ['adminutama', 'evaluator'];
            if (in_array(Auth::user()->role, $list_role)) {
                return redirect()->route('admin.appreq', 'disposisi');
            } elseif (Auth::user()->role == 'operator') {
                return redirect()->route('admin.appreq', 'diajukan');
            } else {
                return redirect()->route('appreq.create');
            }
        } else {
            session()->flash('error', 'Username atau Password salah');
            return redirect()->route('login');
        }
    }

    public function daftar()
    {
        return view('daftar', [
            'commodities' => Commodity::all(),
            'all_kab' => Region::where('parent_region', '62')->get(),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
