<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category',
        'price',

        'highlight',
        'fidelity_program',
        'proposed',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public const CATEGORIES = [
        'ACCOMPAGNEMENT',
        'BOISSON CHAUDE',
        'BOISSON FROIDE',
        'DESSERT',
        'PLAT',
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, OrderProduct::class);
    }
}
