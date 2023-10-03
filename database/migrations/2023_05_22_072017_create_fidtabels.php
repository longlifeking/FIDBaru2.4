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
        Schema::create('fidtabels', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100)->unique();
            $table->string('slug', 255)->nullable();
            $table->date('tgl');
            $table->bigInteger('nilaifid');
            $table->foreign('fields_id')->references('id')->on('fields');
            $table->unsignedBigInteger('fields_id');
            $table->string('filepath');
            $table->string('filepod');
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
        Schema::dropIfExists('fidtabels');
    }
};
