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
        Schema::create('evaluasi_a_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_kelompok_id');
            $table->boolean('A1');
            $table->boolean('A2');
            $table->boolean('A3');
            $table->boolean('A4');
            $table->boolean('B1');
            $table->boolean('B2');
            $table->boolean('B3');
            $table->boolean('B4');
            $table->boolean('B5');
            $table->boolean('B6');
            $table->boolean('B7');
            $table->boolean('B8');
            
            $table->string('ket_A1')->nullable();
            $table->string('ket_A2')->nullable();
            $table->string('ket_A3')->nullable();
            $table->string('ket_A4')->nullable();
            $table->string('ket_B1')->nullable();
            $table->string('ket_B2')->nullable();
            $table->string('ket_B3')->nullable();
            $table->string('ket_B4')->nullable();
            $table->string('ket_B5')->nullable();
            $table->string('ket_B6')->nullable();
            $table->string('ket_B7')->nullable();
            $table->string('ket_B8')->nullable();
            
            $table->string('foto_bast')->nullable();
            $table->string('foto_bangunan')->nullable();
            $table->string('foto_peralatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi_a_s');
    }
};
