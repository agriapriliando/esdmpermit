<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('docs')->insert([
            [
                'user_id' => 2,
                'appreq_id' => 1,
                'name_doc' => 'Surat Permohonan / Pengantar',
                'type_doc' => 'Ajuan Awal', // ajunan atau revisi
                'desc_doc' => 'Detail Surat', // nullable
                'file_name' => '73248972378946.docx',
                'sender' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'appreq_id' => 1,
                'name_doc' => 'KTP Pemohon',
                'type_doc' => 'Ajuan Awal', // ajunan atau revisi
                'desc_doc' => 'KTP Pemohon', // nullable
                'file_name' => '232489723781212.jpg',
                'sender' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'appreq_id' => 1,
                'name_doc' => 'NPWP Perusahaan Pemohon',
                'type_doc' => 'Ajuan Awal', // ajunan atau revisi
                'desc_doc' => 'NPWP Perusahaan Pemohon', // nullable
                'file_name' => '232489723781212.jpg',
                'sender' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'appreq_id' => 1,
                'name_doc' => 'Contoh Surat Pengantar',
                'type_doc' => 'By Operator', // ajunan atau revisi
                'desc_doc' => 'Contoh Surat Pengantar', // nullable
                'file_name' => '232489723781212.jpg',
                'sender' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
