<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movement extends Model
{
    use HasUlids,HasFactory;

    protected $fillable = [
        'type',
        'amount',
        'description',
        'date',
        'end_date',
        'fixed',
        'frequency',
        'user_id',
        'account_id',
        'categories',
    ];

    /**
     * Casts
     */
     protected $casts = [
        'date'     => 'date',
        'end_date' => 'date',
        'fixed'    => 'boolean',
        'amount'   => 'decimal:2',
    ];

    /**
     * Relations
     */
     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
