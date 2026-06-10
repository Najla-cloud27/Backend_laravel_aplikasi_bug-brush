<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';

    protected $fillable = [
        'user_id',
        'nama_kategori',
        'warna',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relationship dengan tugas
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

}