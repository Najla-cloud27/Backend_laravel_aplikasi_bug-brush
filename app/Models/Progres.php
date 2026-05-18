<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progres extends Model
{
     protected $table = 'progres';

    protected $fillable = [
        'user_id',
        'total_fokus',
        'total_tugas_selesai',
        'tanggal',
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}