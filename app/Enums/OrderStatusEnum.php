<?php

namespace App\Enums;

enum OrderStatusEnum:string
{
    case COMPLETED = 'COMPLETED';
    case PROGRESS  = 'PROGRESS';
    case CANCELLED = 'CANCELLED';
}
