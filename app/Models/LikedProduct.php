<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LikedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }
}
