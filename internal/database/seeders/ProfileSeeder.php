<?php

namespace Database\Seeders;

use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $profiles = json_decode($json, true);

        foreach ($profiles as $profile) {
            // Pastikan field nullable tetap null jika kosong
            $tgl_terbit_izin = !empty($profile['tgl_terbit_izin'])
                ? Carbon::createFromFormat('d/m/Y', $profile['tgl_terbit_izin'])->format('Y-m-d')
                : null;
            $tgl_berakhir_izin = !empty($profile['tgl_berakhir_izin'])
                ? Carbon::createFromFormat('d/m/Y', $profile['tgl_berakhir_izin'])->format('Y-m-d')
                : null;
            $data = [
                'id'               => $profile['profile_id'],
                'nama_pemegang_perizinan'               => $profile['nama_pemegang_perizinan'] ?? null,
                'kabupaten_kota'                        => $profile['kabupaten_kota'] ?? null,
                'kecamatan'                             => $profile['kecamatan'] ?? null,
                'desa_kelurahan'                        => $profile['desa_kelurahan'] ?? null,
                'luas_ha'                               => $profile['luas_ha'] ?? null,
                'tahapan_iup'                           => $profile['tahapan_iup'] ?? null,
                'komoditas'                             => $profile['komoditas'] ?? null,
                'nomor_induk_berusaha_nib'              => $profile['nomor_induk_berusaha_nib'] ?? null,
                'nomor_npwp'                            => $profile['nomor_npwp'] ?? null,
                'status_npwp'                           => $profile['status_npwp'] ?? null,
                'jenis_izin'                            => $profile['jenis_izin'] ?? null,
                'nomor_sk_izin'                         => $profile['nomor_sk_izin'] ?? null,
                'tgl_terbit_izin'                       => $tgl_terbit_izin,
                'tgl_berakhir_izin'                     => $tgl_berakhir_izin,
                'alamat_perusahaan_berdasarkan_sk_izin' => $profile['alamat_perusahaan_berdasarkan_sk_izin'] ?? null,
                'nama_direktur_sesuai_sk_izin'          => $profile['nama_direktur_sesuai_sk_izin'] ?? null,
                'dewan_direksi_bod'                     => $profile['dewan_direksi_bod'] ?? null,
                'modal_kerja'                           => $profile['modal_kerja'] ?? null,
                'nama_pic'                              => $profile['nama_pic'] ?? null,
                'no_hp_pic'                             => $profile['no_hp_pic'] ?? null,
                'email_resmi_perusahaan'                => $profile['email_resmi_perusahaan'] ?? null,
                'nib_email_oss'                         => $profile['nib_email_oss'] ?? null,
                'nib_nomor_hp_oss'                      => $profile['nib_nomor_hp_oss'] ?? null,
                'keterangan'                            => $profile['keterangan'] ?? null,
            ];

            Profile::create($data);
        }
    }
}
