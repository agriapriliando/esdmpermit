<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'ver_code' => Carbon::now()->format('mYj') . rand(111, 999),
                'date_submitted' => Carbon::now(),
                'date_processed' => null,
                'date_finished' => null,
                'date_rejected' => null,
                'reason_rejected' => null,
                'notes' => 'Syarat Dokumen Izin AAAA sedang dalam proses, dan akan selesai dalam waktu 1 bulan Mohon agar dipertimbangkan. Terima kasih.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
