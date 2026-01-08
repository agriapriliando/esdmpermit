<?php

namespace Database\Seeders;

use App\Models\Pl;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $persetujuan_lingkungan_tgl = !empty($item['persetujuan_lingkungan_tgl']) && ($item['persetujuan_lingkungan_tgl'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['persetujuan_lingkungan_tgl'])->format('Y-m-d')
                : null;

            Pl::create([ // atau Pls::create([
                'profile_id'                            => $item['profile_id'],
                'persetujuan_lingkungan_nomor'          => $item['persetujuan_lingkungan_nomor'],
                'persetujuan_lingkungan_tgl'            => $persetujuan_lingkungan_tgl,
                'persetujuan_lingkungan_target_produksi' => $item['persetujuan_lingkungan_target_produksi'] ?? null,
                'persetujuan_lingkungan_wilayah_izin'   => $item['persetujuan_lingkungan_wilayah_izin'] ?? null,
                'persetujuan_lingkungan_area_penunjang' => $item['persetujuan_lingkungan_area_penunjang'] ?? null,
            ]);
        }
    }
}
