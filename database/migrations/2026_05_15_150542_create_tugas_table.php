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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                ->constrained('kategori')
                ->onDelete('cascade');
            $table->string('judul');
            $table->string('status')->default('belum');
            $table->timestamp('tenggat_waktu');
            $table->boolean('pengulangan')->default(false);
            $table->string('hari_kustom')->nullable();
            $table->integer('durasi_menit');
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};