<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stats')->insert([
            [
                'no_urut' => 1,
                'name_stat' => 'diajukan',
                'desc_stat' => 'Diajukan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_urut' => 2,
                'name_stat' => 'diproses',
                'desc_stat' => 'Diproses',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_urut' => 3,
                'name_stat' => 'perbaikan',
                'desc_stat' => 'Perbaikan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_urut' => 4,
                'name_stat' => 'selesai',
                'desc_stat' => 'Selesai, Izin Telah Terbit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
