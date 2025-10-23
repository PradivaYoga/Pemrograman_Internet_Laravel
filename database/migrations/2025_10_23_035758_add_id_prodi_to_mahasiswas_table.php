<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            if (!Schema::hasColumn('mahasiswas', 'id_prodi')) {
                $table->foreignId('id_prodi')->nullable()->constrained('prodis')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            if (Schema::hasColumn('mahasiswas', 'id_prodi')) {
                $table->dropForeign([$table->getConnection()->getSchemaGrammar()->wrap('id_prodi')]);
                $table->dropColumn('id_prodi');
            }
        });
    }
};
