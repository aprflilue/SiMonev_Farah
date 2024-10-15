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
        Schema::create('evaluasi_b_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_kelompok_id');

            $table->integer('produksi')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('pendapatan')->nullable();
            $table->string('akses_pasar')->nullable();
            $table->string('izin_edar')->nullable();
            $table->string('jenis_izin')->nullable();
            $table->string('sertifikat')->nullable();

            $table->integer('produksi_af')->nullable();
            $table->integer('harga_af')->nullable();
            $table->integer('pendapatan_af')->nullable();
            $table->string('akses_pasar_af')->nullable();
            $table->string('izin_edar_af')->nullable();
            $table->string('jenis_izin_af')->nullable();
            $table->string('sertifikat_af')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi_b_s');
    }
};
