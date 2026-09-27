<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Mengizinkan kolom ini diisi secara massal dari form
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok'
    ];
}