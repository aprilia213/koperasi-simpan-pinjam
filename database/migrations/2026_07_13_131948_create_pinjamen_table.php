<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pinjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->bigInteger('jumlah_pinjaman')
                ->default(0);
            $table->integer('lama_angsuran')
                ->default(0);
            // Bunga (%)
            $table->decimal('bunga', 5, 2)
                ->default(0);
            // Total pinjaman + bunga
            $table->bigInteger('total_pinjaman')
                ->default(0);
            // Cicilan per bulan
            $table->bigInteger('angsuran_per_bulan')
                ->default(0);
            $table->enum('status', [
                'menunggu',
                'disetujui',
                'ditolak',
                'lunas'
            ])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pinjamans');
    }
};