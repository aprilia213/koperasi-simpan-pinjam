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
        Schema::table('users', function (Blueprint $table) {

            $table->string('nik')->nullable()->after('email');

            $table->string('no_hp')->nullable()->after('nik');

            $table->text('alamat')->nullable()->after('no_hp');

            $table->string('pekerjaan')->nullable()->after('alamat');

            $table->string('nama_bank')->nullable()->after('pekerjaan');

            $table->string('nomor_rekening')->nullable()->after('nama_bank');

            $table->string('nama_pemilik_rekening')->nullable()->after('nomor_rekening');

            $table->string('foto_ktp')->nullable()->after('nama_pemilik_rekening');

            $table->enum('status_profil', [
                'pending',
                'verified',
                'rejected'
            ])->default('pending')->after('foto_ktp');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'nik',
                'no_hp',
                'alamat',
                'pekerjaan',
                'nama_bank',
                'nomor_rekening',
                'nama_pemilik_rekening',
                'foto_ktp',
                'status_profil',
            ]);

        });
    }
};