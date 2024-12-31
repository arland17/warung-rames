<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // Menentukan primary key yang digunakan
    protected $primaryKey = 'stocks_id';

    // Jika nama tabel tidak sesuai dengan konvensi, tentukan nama tabel
    protected $table = 'stocks';

    // Menentukan kolom yang bisa diisi secara massal (mass assignment)
    protected $fillable = [
        'product_name',
        'category',
        'description',
        'category_paket',
        'stock',
        'price',
        'image',
    ];
    // Jika Anda tidak ingin menggunakan timestamp default 'created_at' dan 'updated_at', bisa menambahkan:
    // public $timestamps = false;
}
