<?php

namespace Database\Seeders;

use App\Models\field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class fieldseeder extends Seeder
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
        field::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'Jambi','Pangkalan Susu','Rantau','Siak','Kampar'

       ];
       foreach ($data as $value) {
        field::insert(['nama_field'=>$value]);

       }
    }
}
