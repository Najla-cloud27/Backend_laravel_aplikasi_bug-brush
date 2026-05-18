<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kutipan extends Model
{
    protected $table = 'kutipan';

    protected $fillable = [
        'isi_kutipan',
        'penulis',
    ];
}