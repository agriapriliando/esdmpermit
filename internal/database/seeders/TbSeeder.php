<?php

namespace Database\Seeders;

use App\Models\Tb;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/all.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $tgl_sk_tanda_batas = !empty($item['tgl_sk_tanda_batas']) && ($item['tgl_sk_tanda_batas'] != '-')
                ? Carbon::createFromFormat('d/m/Y', $item['tgl_sk_tanda_batas'])->format('Y-m-d')
                : null;

            Tb::create([
                'profile_id'                    => $item['profile_id'],
                'no_sk_tanda_batas'             => $item['no_sk_tanda_batas'],
                'tgl_sk_tanda_batas'            => $tgl_sk_tanda_batas,
                'tanda_batas_laporan_pemeliharaan' => $item['tanda_batas_laporan_pemeliharaan'] ?? null,
            ]);
        }
    }
}
