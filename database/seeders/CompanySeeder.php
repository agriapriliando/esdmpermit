<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'user_id' => 1,
                'name_company' => 'Abadi Teknologi Kalimantan',
                'type_company' => 'PT',
                'npwp_company' => '19823091567562386723',
                'act_company' => 'Pasir Kuarsa',
                'city_company' => 'Palangka Raya',
                'kecamatan_company' => 'Kec. Pahandut',
                'address_company' => 'Jalan Bukit Bahagia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'name_company' => 'Sukacita Sentosa Sejahtera',
                'type_company' => 'PT',
                'npwp_company' => '198230912223226723',
                'act_company' => 'Pasir',
                'city_company' => 'Palangka Raya',
                'kecamatan_company' => 'Kec. Pahandut',
                'address_company' => 'Jalan Bukit Bahagia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'name_company' => 'Berkat Sejatera Abadi',
                'type_company' => 'CV',
                'npwp_company' => '198230912212312',
                'act_company' => 'Pasir',
                'city_company' => 'Palangka Raya',
                'kecamatan_company' => 'Kec. Pahandut',
                'address_company' => 'Jalan Bukit Bahagia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 4,
                'name_company' => 'Teknologi Makmur Sejahtera',
                'type_company' => 'CV',
                'npwp_company' => '198230912322226723',
                'act_company' => 'Pasir',
                'city_company' => 'Palangka Raya',
                'kecamatan_company' => 'Kec. Pahandut',
                'address_company' => 'Jalan Bukit Bahagia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
