<?php

namespace Database\Seeders;

use App\Models\statususer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class statususerseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints(); //Baris ini digunakan untuk menonaktifkan pengecekan foreign key constraints oleh database. Ini berguna jika Anda ingin melakukan operasi seperti truncate yang biasanya akan diblokir jika ada foreign key constraints.
        statususer::truncate(); // Baris ini digunakan untuk menghapus semua data dari tabel roles. Fungsi truncate() menghapus semua baris dan mengatur ulang auto-increment ID kembali ke 0.
        Schema::enableForeignKeyConstraints(); // - Setelah operasi truncate, baris ini digunakan untuk mengaktifkan kembali pengecekan foreign key constraints oleh database.P
        $data = [
             'Non-Active','Active'
 
        ];
        foreach ($data as $value) {
            statususer::insert(['name_status'=>$value]);
 
        }
    }
}
