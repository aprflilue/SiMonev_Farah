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
        Schema::create('anggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_kelompok_id');
            $table->string('kegiatan')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('pagu')->nullable();
            $table->integer('rel_keuangan')->nullable();
            $table->integer('rel_keuangan_persen')->nullable();
            $table->integer('rel_fisik_persen')->nullable();
            $table->string('progres')->nullable();
            $table->string('kendala')->nullable();
            $table->string('tindakan')->nullable();
            $table->string('file_upload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mon_anggarans');
    }
};
