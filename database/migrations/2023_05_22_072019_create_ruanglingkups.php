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
        Schema::create('ruanglingkups', function (Blueprint $table) {
            $table->foreign('fid_id')->references('id')->on('fidtabels');
            $table->unsignedBigInteger('fid_id');
            $table->id();
            $table->string('judulrl',2000); // haarus hapus unique
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruanglingkups');
    }
};
