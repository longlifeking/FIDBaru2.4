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
            // cara menganti big interger jadi decimal

            $table->decimal('nilai_afe', 18, 2)->change();
            // $$table->varchar('nilai_closing')->change('decimal', 18, 2);
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
            $table->bigInteger('nilai_afe')->change('bigInteger');
            // $table->varchar('nilai_closing')->change('varchar');
        });
    }
};
