<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revisi extends Model
{
    protected $fillable = [
        'permintaan_id', 'user_id', 'catatan_revisi'
    ];
}
