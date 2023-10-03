<?php

namespace Database\Seeders;

use App\Models\statu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class statusseeder extends Seeder
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
        statu::truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            'AFE Telah Disetujui','Inprogress Pekerjaan', 'Pekerjaan Selesai', 'PIS / PPP', 'Sudah Closing'
        ];
        foreach ($data as $value) {
            statu::insert(['name'=>$value]);
 
        }
    }
}
