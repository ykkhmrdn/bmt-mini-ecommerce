<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relationship with cart items
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    // Relationship with transaction items
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Helper method to format price
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Check if product is in stock
    public function isInStock($quantity = 1)
    {
        return $this->stock >= $quantity;
    }
}
