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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('nik')->unique();
            $table->string('jabatan');
            $table->string('pendidikan');
            $table->enum('status_kerja', ['PERMANEN', 'PKWT']);
            $table->enum('jenis_kelamin', ['LAKI LAKI', 'PEREMPUAN']);
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->string('kode_status')->nullable();
            $table->text('alamat');
            $table->boolean('disabilitas')->default(false);
            $table->boolean('masih_bekerja')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
