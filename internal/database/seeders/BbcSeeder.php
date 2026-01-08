<?php

namespace Database\Seeders;

use App\Models\Bbc;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BbcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $bbc_tgl = !empty($item['bbc_tgl']) && ($item['bbc_tgl'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['bbc_tgl'])->format('Y-m-d')
                : null;
            $bbc_tgl_mulai = !empty($item['bbc_tgl_mulai']) && ($item['bbc_tgl_mulai'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['bbc_tgl_mulai'])->format('Y-m-d')
                : null;
            $bbc_tgl_selesai = !empty($item['bbc_tgl_selesai']) && ($item['bbc_tgl_selesai'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['bbc_tgl_selesai'])->format('Y-m-d')
                : null;
            Bbc::create([
                'profile_id'                  => $item['profile_id'],
                'bbc_tangki_no_persetujuan'   => $item['bbc_tangki_no_persetujuan'],
                'bbc_tgl'                     => $bbc_tgl,
                'bbc_kapasitas_tangki'        => $item['bbc_kapasitas_tangki'] ?? null,
                'bbc_tgl_mulai'               => $bbc_tgl_mulai,
                'bbc_tgl_selesai'             => $bbc_tgl_selesai,
            ]);
        }
    }
}
