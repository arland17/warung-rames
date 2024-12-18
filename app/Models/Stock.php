<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'category',
        'description',
        'category_paket',
        'stock',
        'price',
        'image',
    ];

    // Tentukan tipe data untuk kolom 'category' (ENUM)
    protected $casts = [
        'category' => 'string',
    ];

    // Jika Anda ingin mengakses kategori dengan lebih mudah
    const CATEGORIES = ['Paket', 'Bungkus'];

    // Method untuk mendapatkan kategori sebagai array
    public static function categories()
    {
        return self::CATEGORIES;
    }
}
