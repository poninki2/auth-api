<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
       Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id_person');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('avatar')->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->timestamps();   
});

    }

    public function down(): void {
        Schema::dropIfExists('personas');
    }
};

