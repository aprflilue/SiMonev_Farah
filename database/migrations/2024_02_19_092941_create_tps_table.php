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
        Schema::create('tps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_kelompok_id');

            $table->boolean('proposal')->default("0");
            $table->boolean('eproposal')->default("0");
            $table->boolean('uji_lab')->default("0");
            $table->boolean('pengajuan_sertif')->default("0");
            $table->boolean('foodgrade')->default("0");
            $table->boolean('test_report')->default("0");
            $table->string('cpcl')->nullable();
            $table->string('sk_penetapan')->nullable();
            $table->string('workshop')->nullable();
            $table->string('spk')->nullable();
            $table->string('status_lahan')->nullable();
            $table->string('penyusunan_sop')->nullable();
            $table->string('bast_sarana')->nullable();
            $table->string('bast_prasarana')->nullable();
            $table->string('foto_pop')->nullable();
            $table->string('foto_bimtek')->nullable();
            $table->string('laporan_bimtek')->nullable();
            $table->string('foto_produksi')->nullable();
            $table->string('surat_bebas_hukum')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tps');
    }
};
