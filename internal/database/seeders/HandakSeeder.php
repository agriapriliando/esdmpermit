<?php

namespace Database\Seeders;

use App\Models\Handak;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class HandakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $handak_tgl = !empty($item['handak_tgl']) && ($item['handak_tgl'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['handak_tgl'])->format('Y-m-d')
                : null;
            $handak_tgl_mulai = !empty($item['handak_tgl_mulai']) && ($item['handak_tgl_mulai'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['handak_tgl_mulai'])->format('Y-m-d')
                : null;
            $handak_tgl_selesai = !empty($item['handak_tgl_selesai']) && ($item['handak_tgl_selesai'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['handak_tgl_selesai'])->format('Y-m-d')
                : null;
            Handak::create([
                'profile_id'              => $item['profile_id'],
                'handak_no_persetujuan'   => $item['handak_no_persetujuan'],
                'handak_tgl'              => $handak_tgl,
                'handak_jenis_bahan'      => $item['handak_jenis_bahan'] ?? null,
                'handak_kapasitas_gudang' => $item['handak_kapasitas_gudang'] ?? null,
                'handak_tgl_mulai'        => $handak_tgl_mulai,
                'handak_tgl_selesai'      => $handak_tgl_selesai,
            ]);
        }
    }
}
