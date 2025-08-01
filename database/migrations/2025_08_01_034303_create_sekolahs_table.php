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
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('npsn')->unique();
            $table->enum('bentuk_pendidikan', ['tk', 'sd', 'smp', 'sma', 'smk', 'lainnya']);
            $table->enum('status_sekolah', ['negeri', 'swasta']);
            $table->text('alamat');
            $table->foreignId('desa_id')->constrained('desas');
            $table->foreignId('kecamatan_id')->constrained('kecamatans');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolahs');
    }
};
