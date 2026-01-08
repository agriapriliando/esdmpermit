<?php

namespace Database\Seeders;

use App\Models\Rkabop;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RkabopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $rkab_tgl_persetujuan = !empty($item['rkab_tgl_persetujuan']) && ($item['rkab_tgl_persetujuan'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['rkab_tgl_persetujuan'])->format('Y-m-d')
                : null;

            Rkabop::create([
                'profile_id'                              => $item['profile_id'],
                'rkab_no_persetujuan'                     => $item['rkab_no_persetujuan'],
                'rkab_tgl_persetujuan'                    => $rkab_tgl_persetujuan,
                // Sumber Daya Tahun I
                'rkab_sd_thn_i_m3_tereka'                 => $item['rkab_sd_thn_i_m3_tereka'] ?? null,
                'rkab_sd_thn_i_m3_tertunjuk'              => $item['rkab_sd_thn_i_m3_tertunjuk'] ?? null,
                'rkab_sd_thn_i_m3_terukur'                => $item['rkab_sd_thn_i_m3_terukur'] ?? null,
                'rkab_sd_thn_i_mt_tereka'                 => $item['rkab_sd_thn_i_mt_tereka'] ?? null,
                'rkab_sd_thn_i_mt_tertunjuk'              => $item['rkab_sd_thn_i_mt_tertunjuk'] ?? null,
                'rkab_sd_thn_i_mt_terukur'                => $item['rkab_sd_thn_i_mt_terukur'] ?? null,
                // Sumber Daya Tahun II
                'rkab_sd_thn_ii_m3_tereka'                => $item['rkab_sd_thn_ii_m3_tereka'] ?? null,
                'rkab_sd_thn_ii_m3_tertunjuk'             => $item['rkab_sd_thn_ii_m3_tertunjuk'] ?? null,
                'rkab_sd_thn_ii_m3_terukur'               => $item['rkab_sd_thn_ii_m3_terukur'] ?? null,
                'rkab_sd_thn_ii_mt_tereka'                => $item['rkab_sd_thn_ii_mt_tereka'] ?? null,
                'rkab_sd_thn_ii_mt_tertunjuk'             => $item['rkab_sd_thn_ii_mt_tertunjuk'] ?? null,
                'rkab_sd_thn_ii_mt_terukur'               => $item['rkab_sd_thn_ii_mt_terukur'] ?? null,
                // Sumber Daya Tahun III
                'rkab_sd_thn_iii_m3_tereka'               => $item['rkab_sd_thn_iii_m3_tereka'] ?? null,
                'rkab_sd_thn_iii_m3_tertunjuk'            => $item['rkab_sd_thn_iii_m3_tertunjuk'] ?? null,
                'rkab_sd_thn_iii_m3_terukur'              => $item['rkab_sd_thn_iii_m3_terukur'] ?? null,
                'rkab_sd_thn_iii_mt_tereka'               => $item['rkab_sd_thn_iii_mt_tereka'] ?? null,
                'rkab_sd_thn_iii_mt_tertunjuk'            => $item['rkab_sd_thn_iii_mt_tertunjuk'] ?? null,
                'rkab_sd_thn_iii_mt_terukur'              => $item['rkab_sd_thn_iii_mt_terukur'] ?? null,
                // Tenaga Ahli
                'rkab_sd_tenaga_ahli_competent_person'       => $item['rkab_sd_tenaga_ahli_competent_person'] ?? null,
                // Cadangan
                'rkab_cadangan_thn_i_terkira'             => $item['rkab_cadangan_thn_i_terkira'] ?? null,
                'rkab_cadangan_thn_i_terbukti'            => $item['rkab_cadangan_thn_i_terbukti'] ?? null,
                'rkab_cadangan_thn_ii_terkira'            => $item['rkab_cadangan_thn_ii_terkira'] ?? null,
                'rkab_cadangan_thn_ii_terbukti'           => $item['rkab_cadangan_thn_ii_terbukti'] ?? null,
                'rkab_cadangan_thn_iii_terkira'           => $item['rkab_cadangan_thn_iii_terkira'] ?? null,
                'rkab_cadangan_thn_iii_terbukti'          => $item['rkab_cadangan_thn_iii_terbukti'] ?? null,
                // Tenaga Ahli
                'rkab_cadangan_tenaga_ahli_competent_person'       => $item['rkab_cadangan_tenaga_ahli_competent_person'] ?? null,
                // Produksi Tahun I
                'rkab_prod_thn_i_target_m3_utama'         => $item['rkab_prod_thn_i_target_m3_utama'] ?? null,
                'rkab_prod_thn_i_target_m3_sampingan'     => $item['rkab_prod_thn_i_target_m3_sampingan'] ?? null,
                'rkab_prod_thn_i_realisasi_m3_utama'      => $item['rkab_prod_thn_i_realisasi_m3_utama'] ?? null,
                'rkab_prod_thn_i_realisasi_m3_sampingan'  => $item['rkab_prod_thn_i_realisasi_m3_sampingan'] ?? null,
                'rkab_prod_thn_i_target_mt_utama'         => $item['rkab_prod_thn_i_target_mt_utama'] ?? null,
                'rkab_prod_thn_i_target_my_sampingan'     => $item['rkab_prod_thn_i_target_my_sampingan'] ?? null,
                'rkab_prod_thn_i_realisasi_mt_utama'      => $item['rkab_prod_thn_i_realisasi_mt_utama'] ?? null,
                'rkab_prod_thn_i_realisasi_mt_sampingan'  => $item['rkab_prod_thn_i_realisasi_mt_sampingan'] ?? null,
                // Produksi Tahun II
                'rkab_prod_thn_ii_target_m3_utama'        => $item['rkab_prod_thn_ii_target_m3_utama'] ?? null,
                'rkab_prod_thn_ii_target_m3_sampingan'    => $item['rkab_prod_thn_ii_target_m3_sampingan'] ?? null,
                'rkab_prod_thn_ii_realisasi_m3_utama'     => $item['rkab_prod_thn_ii_realisasi_m3_utama'] ?? null,
                'rkab_prod_thn_ii_realisasi_m3_sampingan' => $item['rkab_prod_thn_ii_realisasi_m3_sampingan'] ?? null,
                'rkab_prod_thn_ii_target_mt_utama'        => $item['rkab_prod_thn_ii_target_mt_utama'] ?? null,
                'rkab_prod_thn_ii_target_my_sampingan'    => $item['rkab_prod_thn_ii_target_my_sampingan'] ?? null,
                'rkab_prod_thn_ii_realisasi_mt_utama'     => $item['rkab_prod_thn_ii_realisasi_mt_utama'] ?? null,
                'rkab_prod_thn_ii_realisasi_mt_sampingan' => $item['rkab_prod_thn_ii_realisasi_mt_sampingan'] ?? null,
                // Produksi Tahun III
                'rkab_prod_thn_iii_target_m3_utama'        => $item['rkab_prod_thn_iii_target_m3_utama'] ?? null,
                'rkab_prod_thn_iii_target_m3_sampingan'    => $item['rkab_prod_thn_iii_target_m3_sampingan'] ?? null,
                'rkab_prod_thn_iii_realisasi_m3_utama'     => $item['rkab_prod_thn_iii_realisasi_m3_utama'] ?? null,
                'rkab_prod_thn_iii_realisasi_m3_sampingan' => $item['rkab_prod_thn_iii_realisasi_m3_sampingan'] ?? null,
                'rkab_prod_thn_iii_target_mt_utama'        => $item['rkab_prod_thn_iii_target_mt_utama'] ?? null,
                'rkab_prod_thn_iii_target_my_sampingan'    => $item['rkab_prod_thn_iii_target_my_sampingan'] ?? null,
                'rkab_prod_thn_iii_realisasi_mt_utama'     => $item['rkab_prod_thn_iii_realisasi_mt_utama'] ?? null,
                'rkab_prod_thn_iii_realisasi_mt_sampingan' => $item['rkab_prod_thn_iii_realisasi_mt_sampingan'] ?? null,
                // Pajak
                'rkab_pajak_thn_i_daerah'     => $item['rkab_pajak_thn_i_daerah'] ?? null,
                'rkab_pajak_thn_i_opsen'      => $item['rkab_pajak_thn_i_opsen'] ?? null,
                'rkab_pajak_thn_ii_daerah'    => $item['rkab_pajak_thn_ii_daerah'] ?? null,
                'rkab_pajak_thn_ii_opsen'     => $item['rkab_pajak_thn_ii_opsen'] ?? null,
                'rkab_pajak_thn_iii_daerah'   => $item['rkab_pajak_thn_iii_daerah'] ?? null,
                'rkab_pajak_thn_iii_opsen'    => $item['rkab_pajak_thn_iii_opsen'] ?? null,
                // Tenaga Kerja Tahun I
                'rkab_tenaga_kerja_thn_i_lokal'      => $item['rkab_tenaga_kerja_thn_i_lokal'] ?? null,
                'rkab_tenaga_kerja_thn_i_non_lokal'  => $item['rkab_tenaga_kerja_thn_i_non_lokal'] ?? null,
                'rkab_tenaga_kerja_thn_i_tka'        => $item['rkab_tenaga_kerja_thn_i_tka'] ?? null,
                // Tenaga Kerja Tahun II
                'rkab_tenaga_kerja_thn_ii_lokal'     => $item['rkab_tenaga_kerja_thn_ii_lokal'] ?? null,
                'rkab_tenaga_kerja_thn_ii_non_lokal' => $item['rkab_tenaga_kerja_thn_ii_non_lokal'] ?? null,
                'rkab_tenaga_kerja_thn_ii_tka'       => $item['rkab_tenaga_kerja_thn_ii_tka'] ?? null,
                // Tenaga Kerja Tahun III
                'rkab_tenaga_kerja_thn_iii_lokal'     => $item['rkab_tenaga_kerja_thn_iii_lokal'] ?? null,
                'rkab_tenaga_kerja_thn_iii_non_lokal' => $item['rkab_tenaga_kerja_thn_iii_non_lokal'] ?? null,
                'rkab_tenaga_kerja_thn_iii_tka'       => $item['rkab_tenaga_kerja_thn_iii_tka'] ?? null,
            ]);
        }
    }
}
