<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class UserType extends Model
{
    use HasUlids,HasFactory;

    protected $filleable=[
    'name',
    ];

    /**
     * Relations
     */

    public function user() :HasMany
    {
        return $this->hasMany(User::class);
    }
}
