<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermitworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permitworks')->insert([
            [
                'name_permit' => 'Dokumen Teknis',
                'desc_permit' => 'Dokumen Teknis',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_permit' => 'Surat Angkut Asal Barang',
                'desc_permit' => 'Surat Angkut Asal Barang',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_permit' => 'Gudang Bahan Peledak',
                'desc_permit' => 'Gudang Bahan Peledak',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_permit' => 'Kepala Teknik Tambang',
                'desc_permit' => 'Kepala Teknik Tambang',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
