<?php

namespace Database\Seeders;

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
                'desc' => 'Berkas Lengkap, Surat Diterbitkan',
                'viewed' => 0,
            ]
        ]);
    }
}
