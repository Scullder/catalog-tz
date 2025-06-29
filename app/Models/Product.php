<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'category_id', 'description', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function inCart(): bool
    {
        $cart = session()->get('cart', []);
        
        return isset($cart[$this->id]);
    }

    public function cartQuantity(): int
    {
        if (!$this->inCart()) {
            return 0;
        }

        $cart = session()->get('cart', []);

        return $cart[$this->id]['quantity'] ?? 0;
    } 
}
