<?php

namespace Database\Seeders;

use App\Models\RippmDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RippmDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            RippmDetail::create([
                'profile_id'              => $item['profile_id'],
                'rippm_id'                        => $item['profile_id'],
                'rippm_tahun'                     => $item['rippm_tahun'],
                'rippm_pendidikan_rencana'        => $item['rippm_pendidikan_rencana'] ?? null,
                'rippm_pendidikan_realisasi'      => $item['rippm_pendidikan_realisasi'] ?? null,
                'rippm_kesehatan_rencana'         => $item['rippm_kesehatan_rencana'] ?? null,
                'rippm_kesehatan_realisasi'       => $item['rippm_kesehatan_realisasi'] ?? null,
                'rippm_kemandirian_rencana'       => $item['rippm_kemandirian_rencana'] ?? null,
                'rippm_kemandirian_realisasi'     => $item['rippm_kemandirian_realisasi'] ?? null,
                'rippm_tenaga_kerja_rencana'      => $item['rippm_tenaga_kerja_rencana'] ?? null,
                'rippm_tenaga_kerja_realisasi'    => $item['rippm_tenaga_kerja_realisasi'] ?? null,
                'rippm_sosbud_rencana'            => $item['rippm_sosbud_rencana'] ?? null,
                'rippm_sosbud_realisasi'          => $item['rippm_sosbud_realisasi'] ?? null,
                'rippm_lingkungan_rencana'        => $item['rippm_lingkungan_rencana'] ?? null,
                'rippm_lingkungan_realisasi'      => $item['rippm_lingkungan_realisasi'] ?? null,
                'rippm_lembaga_komunitas_rencana' => $item['rippm_lembaga_komunitas_rencana'] ?? null,
                'rippm_lembaga_komunitas_realisasi' => $item['rippm_lembaga_komunitas_realisasi'] ?? null,
                'rippm_infrastruktur_rencana'     => $item['rippm_infrastruktur_rencana'] ?? null,
                'rippm_infrastruktur_realisasi'   => $item['rippm_infrastruktur_realisasi'] ?? null,
            ]);
        }
    }
}
