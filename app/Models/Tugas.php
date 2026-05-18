<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';

    protected $fillable = [
        'kategori_id',
        'judul',
        'status',
        'tenggat_waktu',
        'pengulangan',
        'hari_kustom',
        'durasi_menit',
    ];

    // relationship dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // relationship dengan sesi fokus
    public function sesiFokus()
    {
        return $this->hasMany(SesiFokus::class);
    }
}