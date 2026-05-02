<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $fillable = [
        'permintaan_id', 'user_id', 'tanggal_pengeluaran', 'keterangan'
    ];
}
