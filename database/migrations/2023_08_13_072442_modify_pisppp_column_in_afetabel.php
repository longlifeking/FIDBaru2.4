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
        Schema::table('afetabels', function (Blueprint $table) {
            //
            $table->string('PISPPP')->nullable()->change();
            $table->string('COR')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('afetabels', function (Blueprint $table) {
            //
            $table->string('PISPPP')->nullable(false)->change();
            $table->string('COR')->nullable(false)->change();
        });
    }
};
