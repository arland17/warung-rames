<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $primaryKey = 'orderdetails_id';

    protected $fillable = [
        'users_id',
        'product_name',
        'quantity',
        'price',
        'image',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

}
