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
                'username' => 'admin',
                'nohp' => '6285249441182',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pemohon 1',
                'username' => 'pemohon1',
                'nohp' => '6285249441182',
                'email' => 'pemohon1@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'pemohon',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pemohon 2',
                'username' => 'pemohon2',
                'nohp' => '6285249441182',
                'email' => 'pemohon2@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'pemohon',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pemohon 3',
                'username' => 'pemohon3',
                'nohp' => '6285249441182',
                'email' => 'pemohon3@gmail.com',
                'password' => bcrypt('123'),
                'role' => 'pemohon',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        // \App\Models\User::factory(20)->create();
    }
}
