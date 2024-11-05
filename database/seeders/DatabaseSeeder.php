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
                'name' => 'Adi Nainggolan',
                'username' => 'evaluator',
                'nohp' => '-',
                'email' => 'evaluator@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
