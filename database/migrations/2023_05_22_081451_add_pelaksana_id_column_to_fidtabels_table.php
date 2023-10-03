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
        Schema::table('fidtabels', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('pelaksana_id');
            $table->foreign('pelaksana_id')->references('id')->on('pelaksanas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fidtabels', function (Blueprint $table) {
            //
            $table->dropForeign('fidtabels_pelaksana_id_foreign');
            $table->dropColumn('pelaksana_id');
        });
    }
};
