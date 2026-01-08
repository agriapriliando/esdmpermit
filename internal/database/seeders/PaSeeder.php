<?php

namespace Database\Seeders;

use App\Models\Pa;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $project_area_tgl = !empty($item['project_area_tgl']) && ($item['project_area_tgl'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['project_area_tgl'])->format('Y-m-d')
                : null;

            Pa::create([ // atau Pas::create([
                'profile_id'              => $item['profile_id'],
                'project_area_nomor'      => $item['project_area_nomor'],
                'project_area_tgl'        => $project_area_tgl,
                'project_area_penggunaan' => $item['project_area_penggunaan'] ?? null,
                'project_area_luas'       => $item['project_area_luas'] ?? null,
                'project_area_keterangan' => $item['project_area_keterangan'] ?? null,
            ]);
        }
    }
}
