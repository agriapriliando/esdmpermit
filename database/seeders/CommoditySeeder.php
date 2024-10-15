<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommoditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = array(
            array("name_commodity" => "Kaolin", "notes_commodity" => "", "group" => "MINERAL BUKAN LOGAM"),
            array("name_commodity" => "Pasir Kuarsa", "notes_commodity" => "", "group" => "MINERAL BUKAN LOGAM JENIS TERTENTU"),
            array("name_commodity" => "Zirkon", "notes_commodity" => "", "group" => "MINERAL BUKAN LOGAM JENIS TERTENTU"),
            array("name_commodity" => "Zirkon DMP", "notes_commodity" => "", "group" => "MINERAL BUKAN LOGAM JENIS TERTENTU"),
            array("name_commodity" => "Kuarsa", "notes_commodity" => "", "group" => "MINERAL BUKAN LOGAM JENIS TERTENTU"),
            array("name_commodity" => "Ball Clay", "notes_commodity" => "", "group" => "MINERAL BUKAN LOGAM JENIS TERTENTU"),
            array("name_commodity" => "Pasir Pasang", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Kerikil Berpasir Alami / Sirtu", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Sirtu", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Tanah Merah (Laterit)", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Batu Gunung Quarry Besar", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Andesit", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Batu Gunung Kuari Besar", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Pasir pasang", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Pasir", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Laterit", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Granit", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Pasir Urug", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Kerikil Berpasir Alami (Sirtu)", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Tanah Urug", "notes_commodity" => "", "group" => "BATUAN"),
            array("name_commodity" => "Pasir Laut", "notes_commodity" => "", "group" => "BATUAN")
        );
        DB::table('commodities')->insert($array);
    }
}
