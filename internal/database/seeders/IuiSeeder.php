<?php

namespace Database\Seeders;

use App\Models\Iui;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class IuiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $iui_tgl_izin = !empty($item['iui_tgl_izin']) && ($item['iui_tgl_izin'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['iui_tgl_izin'])->format('Y-m-d')
                : null;

            Iui::create([
                'profile_id'                      => $item['profile_id'],
                'iui_no_izin'                     => $item['iui_no_izin'],
                'iui_tgl_izin'                    => $iui_tgl_izin,
                'iui_status_permodalan_pmdn_pma'  => $item['iui_status_permodalan_pmdn_pma'] ?? null,
                'iui_kontrak_kerja_sama'          => $item['iui_kontrak_kerja_sama'] ?? null,
            ]);
        }
    }
}
