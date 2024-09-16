<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorrespondenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('correspondences')->insert([
            [
                'user_id' => 1,
                'topic_id' => 1,
                'appreq_id' => 1,
                'desc' => 'Tulisan pada dokumen perjanjian kurang jelas / buram, silahkan upload ulang ',
                'viewed' => 0,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'user_id' => 2,
                'topic_id' => 1,
                'appreq_id' => 1,
                'desc' => 'Berikut ini kami sampaikan dokumen perjanjian perbaikan',
                'viewed' => 0,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => 1,
                'topic_id' => 1,
                'appreq_id' => 1,
                'desc' => 'Berkas Lengkap, Surat Izin Diterbitkan',
                'viewed' => 0,
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
            ],
        ]);
    }
}
