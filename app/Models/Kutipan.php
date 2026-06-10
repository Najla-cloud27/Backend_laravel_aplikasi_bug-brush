<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kutipan extends Model
{
    use HasFactory;
    protected $table = 'kutipan';

    protected $fillable = [
        'isi_kutipan',
        'penulis',
    ];
}