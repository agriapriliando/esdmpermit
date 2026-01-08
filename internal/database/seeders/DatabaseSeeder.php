<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\{
    Profile,
    Ktt,
    Kim,
    Handak,
    Bbc,
    Le,
    Stk,
    Rr,
    Rpt,
    Rippm,
    RippmContent,
    Rkabop,
    RkabopPeralatan,
    Reportmonth,
    Triwulan,
    Iuran,
    Tb,
    Pa,
    Pl,
    Pelabuhan,
    Iui,
};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            ProfileSeeder::class,
            KttSeeder::class,
            KimSeeder::class,
            HandakSeeder::class,
            BbcSeeder::class,
            LeSeeder::class,
            StkSeeder::class,
            RrSeeder::class,
            RptSeeder::class,
            RippmSeeder::class,
            RippmDetailSeeder::class,
            // RkabopSeeder::class,
            // RkabopPeralatanSeeder::class,
            ReportmonthSeeder::class,
            TriwulanSeeder::class,
            IuranSeeder::class,
            TbSeeder::class,
            PaSeeder::class,
            PlSeeder::class,
            PelabuhanSeeder::class,
            IuiSeeder::class,
        ]);
    }
}
