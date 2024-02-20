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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_buku')->constrained('bukus')->onDelete('cascade');
            $table->integer('kode')->unique();
            $table->date('tgl_peminjaman')->default(now());
            $table->date('tgl_kembali');
            $table->foreignId('penanggung_jawab')->nullable()->constrained('users')->onDelete('cascade');
            $table->date('dikembalikan')->nullable();
            $table->enum('status', ['diproses', 'dipinjam', 'dikembalikan'])->default('diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
