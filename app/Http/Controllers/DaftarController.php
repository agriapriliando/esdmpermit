<?php

namespace App\Http\Controllers;

use App\Mail\AktivasiAkun;
use App\Models\Company;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Throwable;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class DaftarController extends Controller
{
    public function __invoke(Request $request)
    {
        // dd($request->all());
        $datauser = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'nohp' => 'required',
        ], [
            'username.unique' => 'Username sudah terdaftar',
            'email.unique' => 'Email sudah terdaftar',
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
            DB::beginTransaction();

            $user = User::create($datauser);

            $data_company['user_id'] = $user->id;
            Company::create($data_company);

            $url = route('aktivasi', $user->api_token ?? $datauser['api_token']);

            // Kirim email sinkron. Jika gagal, akan lempar exception.
            Mail::to($datauser['email'])->send(
                new AktivasiAkun($user->name, $user->username, $request->password, $url)
            );

            DB::commit();

            session()->flash(
                'successdaftar',
                'Pendaftaran Akun ' . $data_company['name_company'] . ' Dengan Email ' . $datauser['email'] . ' Berhasil.'
            );
            return redirect()->route('login');
        } catch (Throwable $e) {
            DB::rollBack();

            // Bedakan error pengiriman email vs error lain
            if ($e instanceof TransportExceptionInterface) {
                session()->flash('error_mail', 'Gagal mengirim email aktivasi. Pendaftaran dibatalkan. Silakan coba lagi atau hubungi admin.');
                // Opsional: detail teknis (sembunyikan di production UI)
                session()->flash('error_mail_detail', $e->getMessage());
            } else {
                session()->flash('error', 'Terjadi kesalahan saat pendaftaran. Pendaftaran dibatalkan. ' . $e->getMessage());
            }
            return redirect()->route('daftar');
        }
        // try {
        //     $url = route("aktivasi", $datauser['api_token']);
        //     $user = User::create($datauser);
        //     $data_company['user_id'] = $user->id;
        //     Company::create($data_company);
        //     Mail::to($datauser['email'])->send(new AktivasiAkun($user['name'], $datauser['username'], $request->password, $url));
        //     session()->flash('successdaftar', 'Pendaftaran Akun ' . $data_company['name_company'] . ' Dengan Email ' . $datauser['email'] . ' Berhasil.');
        //     return redirect()->route('login');
        // } catch (\Exception $e) {
        //     session()->flash('error', $e->getMessage());
        // }
        return redirect()->route('login');
    }
}
