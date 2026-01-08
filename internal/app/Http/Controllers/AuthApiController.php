<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthApiController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // buat blade login
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Panggil API login dari miners.kalteng.go.id
        $response = Http::withoutVerifying()
            ->timeout(30)
            ->post('https://miners.kalteng.go.id/api/login', [
                'username' => $request->username,
                'password' => $request->password,
            ]);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['status'] != 'success') {
                return redirect()->route('login.form')->with('status', $data['message']);
            }

            // Simpan token & user di session
            session([
                'api_token' => $data['token'],
                'user'      => $data['user'],
            ]);

            // Jika centang "Ingat saya", simpan juga di cookie (7 hari misalnya)
            if ($request->filled('remember')) {
                cookie()->queue('api_token', $data['token'], 60 * 24 * 7); // 7 hari
                cookie()->queue('user', json_encode($data['user']), 60 * 24 * 7);
            }

            return redirect()->route('home')->with('status', 'Login berhasil');
        }
        return redirect()->route('login.form')->with('status', 'Sistem Sedang Galat, tidak bisa Login');
    }
    public function logout(Request $request)
    {
        // Ambil token dari session
        $token = session('api_token');

        // if ($token) {
        //     try {
        //         // Panggil API logout
        //         Http::withToken($token)->post('https://miners.kalteng.go.id/api/logout');
        //     } catch (\Exception $e) {
        //         // Kalau API tidak bisa diakses, tetap lanjut hapus session
        //         \Log::error('API logout gagal: ' . $e->getMessage());
        //     }
        // }

        // Hapus session
        $request->session()->flush();

        // Hapus cookie
        cookie()->queue(cookie()->forget('api_token'));
        cookie()->queue(cookie()->forget('user'));

        return redirect()->route('login.form')->with('status', 'Logout berhasil');
    }
}
