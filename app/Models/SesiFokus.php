<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiFokus extends Model
{
     protected $table = 'sesi_fokus';

    protected $fillable = [
        'tugas_id',
        'waktu_mulai',
        'waktu_selesai',
        'status',
    ];

    // relationship dengan tugass
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}