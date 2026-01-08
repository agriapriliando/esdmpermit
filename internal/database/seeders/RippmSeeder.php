<?php

namespace Database\Seeders;

use App\Models\Rippm;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RippmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $rippm_tgl_persetujuan = !empty($item['rippm_tgl_persetujuan']) && ($item['rippm_tgl_persetujuan'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['rippm_tgl_persetujuan'])->format('Y-m-d')
                : null;

            Rippm::create([
                'profile_id'              => $item['profile_id'],
                'rippm_no_persetujuan'    => $item['rippm_no_persetujuan'],
                'rippm_tgl_persetujuan'   => $rippm_tgl_persetujuan,
                'rippm_keterangan'        => $item['rippm_keterangan'] ?? null,
            ]);
        }
    }
}
