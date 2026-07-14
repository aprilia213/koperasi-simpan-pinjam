<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model {
    protected $table = 'pinjamans';
    protected $fillable = [
        'user_id',
        'jumlah_pinjaman',
        'lama_angsuran',
        'bunga',
        'total_pinjaman',
        'angsuran_per_bulan',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}