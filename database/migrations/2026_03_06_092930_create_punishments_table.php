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
        Schema::create('punishments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained()->cascadeOnDelete();

            $table->date('teguran_tgl')->nullable();
            $table->string('teguran_no')->nullable();

            $table->date('sp1_tgl')->nullable();
            $table->string('sp1_no')->nullable();

            $table->date('sp2_tgl')->nullable();
            $table->string('sp2_no')->nullable();

            $table->date('sp3_tgl')->nullable();
            $table->string('sp3_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punishments');
    }
};
