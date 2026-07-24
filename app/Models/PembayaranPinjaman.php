<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranPinjaman extends Model
{
    protected $table = 'pembayaran_pinjamans'; 

    protected $guarded = [];

    public function pinjaman()
    {
        // Diubah dari 'transaksi_pinjaman_id' menjadi 'pinjaman_id'
        // agar sesuai dengan nama kolom yang ada di database Anda
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id'); 
    }
}