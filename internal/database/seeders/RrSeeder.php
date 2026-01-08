<?php

namespace Database\Seeders;

use App\Models\Rr;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $rr_tgl_persetujuan = !empty($item['rr_tgl_persetujuan']) && ($item['rr_tgl_persetujuan'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['rr_tgl_persetujuan'])->format('Y-m-d')
                : null;

            Rr::create([
                'profile_id'                 => $item['profile_id'],
                'rr_no_persetujuan'          => $item['rr_no_persetujuan'],
                'rr_tgl_persetujuan'         => $rr_tgl_persetujuan,
                'rr_tahun'                   => $item['rr_tahun'] ?? null,
                'rr_nominal_yang_ditetapkan' => $item['rr_nominal_yang_ditetapkan'] ?? null,
                'rr_nominal_yang_ditempatkan' => $item['rr_nominal_yang_ditempatkan'] ?? null,
            ]);
        }
    }
}
