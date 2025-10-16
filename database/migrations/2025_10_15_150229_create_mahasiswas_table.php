<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 15)->unique();
            $table->string('nama', 100);
            $table->string('prodi', 50);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('mahasiswas');
    }
};
