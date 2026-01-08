<?php

namespace Database\Seeders;

use App\Models\Ktt;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class KttSeeder extends Seeder
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
            $ktt_tgl_pengesahan = !empty($item['ktt_tgl_pengesahan']) && ($item['ktt_tgl_pengesahan'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['ktt_tgl_pengesahan'])->format('Y-m-d')
                : null;
            Ktt::create([
                'profile_id' => $item['profile_id'],
                'ktt_no_pengesahan'    => $item['ktt_no_pengesahan'],
                'ktt_tgl_pengesahan'   => $ktt_tgl_pengesahan,
                'nama_ktt'             => $item['nama_ktt'] ?? null,
            ]);
        }
    }
}
