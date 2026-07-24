<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pinjaman extends Model {
    protected $table = 'pinjamans';
    protected $fillable = [
        'user_id',
        'jumlah_pinjaman',
        'lama_angsuran', // Ini digunakan sebagai Tenor (Total bulan)
        'bunga',
        'total_pinjaman',
        'angsuran_per_bulan',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Transaksi Pembayaran
    public function transaksi() {
        return $this->hasMany(TransaksiPinjaman::class, 'pinjaman_id');
    }

    // Menghitung jumlah pembayaran yang SUDAH DISETUJUI oleh Admin
    public function getPembayaranLunasAttribute() {
        return $this->transaksi()->where('status', 'disetujui')->count();
    }

    // Menghitung sisa angsuran
    public function getSisaAngsuranAttribute() {
        // Mengambil tenor dari kolom lama_angsuran
        $tenor = $this->lama_angsuran;
        $terbayar = $this->getPembayaranLunasAttribute();
        
        return max(0, $tenor - $terbayar);
    }

    // Menghitung Tanggal Jatuh Tempo Berdasarkan Angsuran Berikutnya
    public function getJatuhTempoBerikutnyaAttribute() {
        $terbayar = $this->getPembayaranLunasAttribute();
        
        // Contoh: Pinjam tanggal 19 Juli, pembayaran ke-1 jatuh tempo tanggal 19 Agustus, dst.
        $bulanKe = $terbayar + 1;
        
        if ($bulanKe > $this->lama_angsuran) {
            return 'Lunas';
        }

        return Carbon::parse($this->created_at)->addMonths($bulanKe);
    }

    // Menghitung Denda Keterlambatan Otomatis Per Hari (Misal: Rp 5.000 / hari)
    public function getDendaAttribute() {
        if ($this->status == 'lunas' || $this->status != 'disetujui') {
            return 0;
        }

        $jatuhTempo = $this->getJatuhTempoBerikutnyaAttribute();
        if ($jatuhTempo === 'Lunas') return 0;

        $sekarang = Carbon::now();
        
        // Jika hari ini melewati tanggal jatuh tempo
        if ($sekarang->greaterThan($jatuhTempo)) {
            $selisihHari = $sekarang->diffInDays($jatuhTempo);
            $tarifDendaPerHari = 5000; // Anda bisa ubah nominal denda per hari di sini
            
            return $selisihHari * $tarifDendaPerHari;
        }

        return 0;
    }
}