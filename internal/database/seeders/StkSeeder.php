<?php

namespace Database\Seeders;

use App\Models\Stk;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $stk_tgl_persetujuan = !empty($item['stk_tgl_persetujuan']) && ($item['stk_tgl_persetujuan'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['stk_tgl_persetujuan'])->format('Y-m-d')
                : null;

            Stk::create([
                'profile_id'               => $item['profile_id'],
                'stk_no_persetujuan'       => $item['stk_no_persetujuan'],
                'stk_tgl_persetujuan'      => $stk_tgl_persetujuan,
                'stk_sd_m3_tereka'         => $item['stk_sd_m3_tereka'] ?? null,
                'stk_sd_m3_tertunjuk'      => $item['stk_sd_m3_tertunjuk'] ?? null,
                'stk_sd_m3_terukur'        => $item['stk_sd_m3_terukur'] ?? null,
                'stk_sd_mt_tereka'         => $item['stk_sd_mt_tereka'] ?? null,
                'stk_sd_mt_tertunjuk'      => $item['stk_sd_mt_tertunjuk'] ?? null,
                'stk_sd_mt_terukur'        => $item['stk_sd_mt_terukur'] ?? null,
                'stk_luas_sumber_daya'     => $item['stk_luas_sumber_daya'] ?? null,
                'stk_sd_tenaga_ahli'       => $item['stk_sd_tenaga_ahli'] ?? null,
                'stk_cadang_m3_terkira'    => $item['stk_cadang_m3_terkira'] ?? null,
                'stk_cadang_m3_terbukti'   => $item['stk_cadang_m3_terbukti'] ?? null,
                'stk_cadang_mt_terkira'    => $item['stk_cadang_mt_terkira'] ?? null,
                'stk_cadang_mt_terbukti'   => $item['stk_cadang_mt_terbukti'] ?? null,
                'stk_luas_cadangan'        => $item['stk_luas_cadangan'] ?? null,
                'stk_cadang_tenaga_ahli'   => $item['stk_cadang_tenaga_ahli'] ?? null,
                'stk_target_produksi_m3'   => $item['stk_target_produksi_m3'] ?? null,
                'stk_target_produksi_mt'   => $item['stk_target_produksi_mt'] ?? null,
            ]);
        }
    }
}
