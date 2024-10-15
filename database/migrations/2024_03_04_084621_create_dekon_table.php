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
        Schema::create('dekons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_kelompok_id');
            $table->date('persiapan_pelaksanaan_a')->nullable();
            $table->date('persiapan_pelaksanaan_b')->nullable();
            $table->date('sosialisasi_juknis_a')->nullable();
            $table->date('sosialisasi_juknis_b')->nullable();
            $table->date('koordinasi_a')->nullable();
            $table->date('koordinasi_b')->nullable();
            $table->date('pelaksanaan_kegiatan_a')->nullable();
            $table->date('pelaksanaan_kegiatan_b')->nullable();
            $table->date('pembinaan_monitoring_a')->nullable();
            $table->date('pembinaan_monitoring_b')->nullable();
            $table->date('pelaporan_a')->nullable();
            $table->date('pelaporan_b')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dekons');
    }
};
