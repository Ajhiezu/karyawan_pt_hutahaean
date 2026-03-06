<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained()->cascadeOnDelete();

            $table->string('periode_cuti')->nullable();
            $table->integer('hak_cuti')->nullable()->default(12);
            $table->integer('cuti_dijalani')->nullable()->default(0);
            $table->integer('cuti_diusulkan')->nullable()->default(0);
            $table->integer('sisa_cuti')->nullable()->default(12);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cutis');
    }
};
