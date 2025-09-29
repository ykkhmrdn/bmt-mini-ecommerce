<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relationship with transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Calculate subtotal for this item
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    // Get formatted subtotal
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    // Get formatted price
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
