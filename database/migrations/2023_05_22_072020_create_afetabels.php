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
        Schema::create('afetabels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ruang_id');
            $table->foreign('ruang_id')->references('id')->on('ruanglingkups');
            $table->string('no_afe', 100)->unique();
            $table->string('judul_afe', 100)->unique();
            $table->string('slug', 255)->nullable();
            $table->bigInteger('nilai_afe');
            $table->bigInteger('nilai_closing');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status');
            $table->date('targetcor');
            $table->date('targetpekerajaan');
            $table->string('PS');
            $table->string('BS');
            $table->string('PISPPP');
            $table->string('COR');
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
        Schema::dropIfExists('afetabels');
    }
};
