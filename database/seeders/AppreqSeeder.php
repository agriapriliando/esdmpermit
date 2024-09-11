<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppreqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appreqs')->insert([
            [
                'user_id' => 2, //user pemohon
                'company_id' => 1, // company pemohon
                'stat_id' => 1, // Diajukan
                'permitwork_id' => 1, // jenis izin yang diminta
                'ver_code' => Str::uuid(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2, //user pemohon
                'company_id' => 1, // company pemohon
                'stat_id' => 1, // Diajukan
                'permitwork_id' => 2, // jenis izin yang diminta
                'ver_code' => Str::uuid(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
