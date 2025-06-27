<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->unsignedBigInteger('id_person');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_rol');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_rol')->references('id_rol')->on('roles')->onDelete('cascade');
            $table->foreign('id_person')->references('id_person')->on('personas')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
