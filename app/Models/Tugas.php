<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'status',
        'tenggat_waktu',
        'pengulangan',
        'hari_kustom',
        'durasi_menit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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