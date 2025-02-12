<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,
            CommoditySeeder::class,
            RegionSeeder::class,
            // CompanySeeder::class,
            PermitworkSeeder::class,
            StatSeeder::class,
            // AppreqSeeder::class,
            // CorrespondenceSeeder::class,
            // DocSeeder::class,
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Wilna',
                'username' => 'adminutama',
                'nohp' => '-',
                'email' => 'adminutama@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'superadmin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jaya',
                'username' => 'operator',
                'nohp' => '-',
                'email' => 'operator@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'disposisi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tutu Nainggolan',
                'username' => 'evaluator',
                'nohp' => '-',
                'email' => 'evaluator@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        $password = bcrypt("123");
        $date_now = Carbon::now();

        $array = array(
            array("name" => "CV CAHAYA BAHAGIA", "username" => "cvcahaya", "nohp" => "-", "email" => "@gmail.com", "password" => $password, "role" => "pemohon", "created_at" => $date_now, "updated_at" => $date_now),
            array("name" => "PT KALMIN SEJATI", "username" => "ptkalminsejati", "nohp" => "-", "email" => "@gmail.com", "password" => $password, "role" => "pemohon", "created_at" => $date_now, "updated_at" => $date_now)
        );

        $arraycompany = array(
            array("user_id" => "4", "commodity_id" => "1", "region_id" => "62.13", "name_company" => "CV CAHAYA FAJAR", "province_company" => "KALIMANTAN TENGAH", "kab_kota_company" => "KAB. BARITO TIMUR", "kecamatan_company" => "", "kel_desa_company" => "", "address_sk_company" => "", "notes_company" => ""),
            array("user_id" => "5", "commodity_id" => "21", "region_id" => "62.08", "name_company" => "PT KALMIN SEJATI", "province_company" => "KALIMANTAN TENGAH", "kab_kota_company" => "KAB. SUKAMARA", "kecamatan_company" => "", "kel_desa_company" => "", "address_sk_company" => "", "notes_company" => "")
        );

        $i = 0;
        foreach ($array as $item) {
            $array[$i]['email'] = $item['username'] . "@gmail.com";
            DB::table('users')->insert($array[$i]);
            DB::table('companies')->insert($arraycompany[$i]);
            $i++;
        }
    }
}
