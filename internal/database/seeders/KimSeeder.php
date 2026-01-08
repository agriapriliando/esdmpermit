<?php

namespace Database\Seeders;

use App\Models\Kim;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class KimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $kim_tgl_persetujuan = !empty($item['kim_tgl_persetujuan']) && ($item['kim_tgl_persetujuan'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['kim_tgl_persetujuan'])->format('Y-m-d')
                : null;
            $kim_tgl_mulai = !empty($item['kim_tgl_mulai']) && ($item['kim_tgl_mulai'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['kim_tgl_mulai'])->format('Y-m-d')
                : null;
            $kim_tgl_selesai = !empty($item['kim_tgl_selesai']) && ($item['kim_tgl_selesai'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['kim_tgl_selesai'])->format('Y-m-d')
                : null;

            Kim::create([
                'profile_id'            => $item['profile_id'],
                'kim_no_persetujuan'    => $item['kim_no_persetujuan'],
                'kim_tgl_persetujuan'   => $kim_tgl_persetujuan,
                'kim_nama_juru_ledak'   => $item['kim_nama_juru_ledak'] ?? null,
                'kim_tgl_mulai'         => $kim_tgl_mulai,
                'kim_tgl_selesai'       => $kim_tgl_selesai,
            ]);
        }
    }
}
