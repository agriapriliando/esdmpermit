<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $data_region = Http::get('http://wilayah.test/wilayah.json');
        $data_region = Http::withHeaders([
            'User-Agent' => 'curl/7.65.3'
        ])->retry(3, 3000)->get(url('/wilayah'));
        $chunk_data = array_chunk($data_region->json(), 1000);
        if (isset($chunk_data) && !empty($chunk_data)) {
            foreach ($chunk_data as $chunk_data_val) {
                DB::table('regions')->insert($chunk_data_val);
            }
        }
    }
}
