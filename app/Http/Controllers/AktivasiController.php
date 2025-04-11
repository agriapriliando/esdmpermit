<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AktivasiController extends Controller
{
    public function __invoke($token)
    {
        $user = User::where('api_token', $token)->firstOrFail();
        $user->update([
            'role' => 'pemohon',
            'email_verified_at' => now(),
            'api_token' => $token,
        ]);
        session()->flash('aktivasi', 'Aktivasi Akun ' . $user->email . ' Berhasil, silahkan login');
        return redirect('/login');
    }
}
