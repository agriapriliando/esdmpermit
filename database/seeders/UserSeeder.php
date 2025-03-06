<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Utama',
                'username' => 'adminutama',
                'nohp' => '-',
                'email' => 'adminutama@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'adminutama',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Operator',
                'username' => 'operator',
                'nohp' => '-',
                'email' => 'operator@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'operator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Evaluator',
                'username' => 'evaluator',
                'nohp' => '-',
                'email' => 'evaluator@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'evaluator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        $password = bcrypt("123");
        $date_now = Carbon::now();

        $array = array(
            array("name" => "PT Ditaria", "username" => "agri", "nohp" => "-", "email" => "@gmail.com", "password" => $password, "role" => "pemohon", "created_at" => $date_now, "updated_at" => $date_now)
        );

        $arraycompany = array(
            array("user_id" => "4", "commodity_id" => "21", "region_id" => "62.08", "name_company" => "PT KALMIN SEJATI", "province_company" => "KALIMANTAN TENGAH", "kab_kota_company" => "KAB. SUKAMARA", "kecamatan_company" => "", "kel_desa_company" => "", "address_sk_company" => "", "notes_company" => "")
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
