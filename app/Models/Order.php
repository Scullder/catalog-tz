<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'created_at',
        'status',
        'comment',
        'product_id',
        'quantity',
        'user_id',
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['product_name', 'price', 'quantity'])
            ->using(OrderProduct::class);
    }

    // public function getTotalPriceAttribute()
    // {
    //     return $this->product->price * $this->quantity;
    // }
}
