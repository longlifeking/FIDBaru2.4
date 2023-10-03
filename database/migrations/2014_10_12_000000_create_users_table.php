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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->nullable()->unique();
            $table->string('email');
            $table->string('slug', 255)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('phonenumber', 100)->nullable()->unique();
            $table->string('address', 255);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_token', 60)->nullable();
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
        Schema::dropIfExists('users');
    }
};
