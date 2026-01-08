<?php

namespace Database\Seeders;

use App\Models\Triwulan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TriwulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $json = File::get(database_path('data/all.json'));
        // $data = json_decode($json, true);

        // foreach ($data as $item) {
        //     Triwulan::create([
        //         'profile_id'           => $item['profile_id'],
        //         'laporan_triwulan_i'   => $item['laporan_triwulan_i'] ?? null,
        //         'laporan_triwulan_ii'  => $item['laporan_triwulan_ii'] ?? null,
        //         'laporan_triwulan_iii' => $item['laporan_triwulan_iii'] ?? null,
        //         'laporan_triwulan_iv'  => $item['laporan_triwulan_iv'] ?? null,
        //     ]);
        // }
    }
}
