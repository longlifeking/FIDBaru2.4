<?php

namespace Database\Seeders;

use App\Models\quartercor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class quarterseed extends Seeder
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
        quartercor::truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
             'Q1 (Januari - Maret)','Q2 (April - Juni)', 'Q3 (Juli - September)','Q4 (Oktober - Desember)'
 
        ];
        foreach ($data as $value) {
            quartercor::insert(['name_quarter'=>$value]);
        }
    }
}
