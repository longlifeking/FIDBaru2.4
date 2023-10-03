<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flowlines', function (Blueprint $table) {
            $table->id();
            // Tambahkan kolom-kolom baru di sini
            $table->unsignedBigInteger('afe_flow');
            $table->foreign('afe_flow')->references('id')->on('afetabels');
            $table->string('slug', 255);
            $table->string('vendor', 255);
            $table->unsignedBigInteger('nama_fields');
            $table->foreign('nama_fields')->references('id')->on('fields');
            $table->bigInteger('hari_project');
            $table->bigInteger('panjang_2inch')->nullable();
            $table->bigInteger('panjang_3inch')->nullable();
            //$table->date('selesai_project');
            $table->bigInteger('Nilai_ProyekRP'); // Ubah menjadi tipe decimal
            $table->decimal('Nilai_ProyekUSD', 18, 2); // Ubah menjadi tipe decimal
            $table->string('Keterangan', 2000)->nullable();
            $table->timestamps();
            
            // Tambahkan relasi dengan tabel afetabels
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flowlines');
    }
};
