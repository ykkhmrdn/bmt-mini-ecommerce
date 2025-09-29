<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status'
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with transaction items
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Get formatted total
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    // Check if transaction is completed
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Check if transaction is pending
    public function isPending()
    {
        return $this->status === 'pending';
    }
}
