<?php

namespace Database\Seeders;

use App\Models\pelaksana;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Pelaksanasseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        pelaksana::truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
             'PT. Pertamina EP (PEP)','PT. Pertamina Hulu Rokan','PT. Pertamina Hulu Energi (PHE)'
 
        ];
        foreach ($data as $value) {
            pelaksana::insert(['nama_pelaksana'=>$value]);
 
        }
    }
}
