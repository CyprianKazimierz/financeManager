<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasUlids,HasFactory;

    protected $fillable = [
        'name',
        'balance',
        'monetary_currency',
        'user_id',
    ];

    /**
     * Relations
     */
    public function user() :BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function movements() : HasMany
    {
        return $this->hasMany(Movement::class);
    }
}
