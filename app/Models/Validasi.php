<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $fillable = [
        'permintaan_id', 'user_id', 'status_validasi'
    ];
}
