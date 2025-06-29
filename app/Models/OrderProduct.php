<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    protected $table = 'order_product';

    protected $fillable = [
        'product_name',
        'price',
        'quantity'
    ];
}