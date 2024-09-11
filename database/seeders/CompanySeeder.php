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
                'user_id' => 2,
                'name_company' => 'PT Sejahtera Abadi',
                'type_company' => 'PT',
                'npwp_company' => '198230912386723',
                'act_company' => 'Pasir Kuarsa',
                'city_company' => 'Palangka Raya',
                'kecamatan_company' => 'Kec. Pahandut',
                'address_company' => 'Jalan Bukit Bahagia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
