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
            // CommoditySeeder::class,
            // RegionSeeder::class,
            // CompanySeeder::class,
            // PermitworkSeeder::class,
            // StatSeeder::class,
            // AppreqSeeder::class,
            // CorrespondenceSeeder::class,
            // DocSeeder::class,
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Admin Utama',
                'username' => 'adminutama',
                'nohp' => '-',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'adminutama',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
