<?php

namespace Database\Seeders;

use App\Models\Le;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class LeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            // Konversi tanggal dari format d/m/Y ke Y-m-d untuk MySQL
            $le_tgl_persetujuan = !empty($item['le_tgl_persetujuan']) && ($item['le_tgl_persetujuan'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['le_tgl_persetujuan'])->format('Y-m-d')
                : null;

            Le::create([
                'profile_id'           => $item['profile_id'],
                'le_no_persetujuan'    => $item['le_no_persetujuan'],
                'le_tgl_persetujuan'   => $le_tgl_persetujuan,
                'le_sd_m3_tereka'      => $item['le_sd_m3_tereka'] ?? null,
                'le_sd_m3_tertunjuk'   => $item['le_sd_m3_tertunjuk'] ?? null,
                'le_sd_m3_terukur'     => $item['le_sd_m3_terukur'] ?? null,
                'le_sd_mt_tereka'      => $item['le_sd_mt_tereka'] ?? null,
                'le_sd_mt_tertunjuk'   => $item['le_sd_mt_tertunjuk'] ?? null,
                'le_sd_mt_terukur'     => $item['le_sd_mt_terukur'] ?? null,
            ]);
        }
    }
}
