<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Calculate subtotal for this cart item
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->product->price;
    }

    // Get formatted subtotal
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}
