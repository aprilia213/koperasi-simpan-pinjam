<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Simpanan extends Model {
    protected $fillable = [
        'user_id',
        'simpanan_pokok',
        'simpanan_wajib',
        'simpanan_sukarela'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}