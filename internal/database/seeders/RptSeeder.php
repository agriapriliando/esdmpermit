<?php

namespace Database\Seeders;

use App\Models\Rpt;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $rpt_tgl_persetujuan = !empty($item['rpt_tgl_persetujuan']) && ($item['rpt_tgl_persetujuan'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['rpt_tgl_persetujuan'])->format('Y-m-d')
                : null;

            Rpt::create([
                'profile_id'                 => $item['profile_id'],
                'rpt_no_persetujuan'         => $item['rpt_no_persetujuan'],
                'rpt_tgl_persetujuan'        => $rpt_tgl_persetujuan,
                'rpt_nominal_yang_ditetapkan' => $item['rpt_nominal_yang_ditetapkan'] ?? null,
                'rpt_nominal_yang_ditempatkan' => $item['rpt_nominal_yang_ditempatkan'] ?? null,
                'rpt_tahun_pembayaran'       => $item['rpt_tahun_pembayaran'] ?? null,
            ]);
        }
    }
}
