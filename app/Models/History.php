<?php

namespace App\Models;

use App\Enums\ExchangeStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'exchange_id',
    ];
    protected $casts = [
        'status' => ExchangeStatusEnum::class,
    ];

    public function exchange(): BelongsTo
    {
        return $this->belongsTo(Exchange::class);
    }

}
