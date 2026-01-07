<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pohon extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pohon',
        'deskripsi',
        'gambar',
        'harga',
        'status'
    ];
}



