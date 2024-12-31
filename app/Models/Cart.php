<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika menggunakan nama tabel 'carts')
    protected $table = 'carts';

    // Primary key (opsional jika menggunakan id default)
    protected $primaryKey = 'carts_id';

    // Kolom yang dapat diisi
    protected $fillable = [
        'users_id',
        'price',
        'product_name',
        'image',
        'quantity',
        'total_price',
        'ManagedByAdminID',
        'payment_method',
    ];

    /**
     * Relasi ke model User (Many-to-One)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Hitung total harga berdasarkan harga dan kuantitas
     */
    public function calculateTotalPrice()
    {
        return $this->quantity * $this->price;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($cart) {
            $cart->total_price = $cart->calculateTotalPrice(); // Pastikan total_price selalu diperbarui
        });
    }
}
