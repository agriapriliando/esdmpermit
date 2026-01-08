<?php

namespace Database\Seeders;

use App\Models\Pelabuhan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PelabuhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $pelabuhan_tgl_persetujuan = !empty($item['pelabuhan_tgl_persetujuan']) && ($item['pelabuhan_tgl_persetujuan'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['pelabuhan_tgl_persetujuan'])->format('Y-m-d')
                : null;

            Pelabuhan::create([
                'profile_id'                   => $item['profile_id'],
                'pelabuhan_no_persetujuan'     => $item['pelabuhan_no_persetujuan'],
                'pelabuhan_tgl_persetujuan'    => $pelabuhan_tgl_persetujuan,
                'pelabuhan_status_tuks_terum'  => $item['pelabuhan_status_tuks_terum'] ?? null,
            ]);
        }
    }
}
