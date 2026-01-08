<?php

namespace Database\Seeders;

use App\Models\Iuran;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class IuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $tgl_bayar = !empty($item['iuran_tetap_per_tahun_tgl_bayar']) && ($item['iuran_tetap_per_tahun_tgl_bayar'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['iuran_tetap_per_tahun_tgl_bayar'])->format('Y-m-d')
                : null;

            Iuran::create([
                'profile_id'                       => $item['profile_id'],
                'iuran_tetap_per_tahun_nominal'    => $item['iuran_tetap_per_tahun_nominal'] ?? null,
                'iuran_tetap_per_tahun_tgl_bayar'  => $tgl_bayar,
            ]);
        }
    }
}
