<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transaksi_simpanans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('jenis',[
                'pokok',
                'wajib',
                'sukarela'
            ]);

            $table->bigInteger('jumlah');

            $table->enum('status',[
                'menunggu',
                'diterima'
            ])->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transaksi_simpanans');
    }
};