<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
       Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id_rol');
            $table->string('name', 50)->unique(); // admin, cliente
            $table->timestamps();
});

    }

    public function down(): void {
        Schema::dropIfExists('roles');
    }
};

