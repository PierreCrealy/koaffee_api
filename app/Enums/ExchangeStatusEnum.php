<?php

namespace App\Enums;

enum ExchangeStatusEnum:string
{
    case Pending   = 'pending';
    case Claimed   = 'claimed';
    case Unclaimed = 'unclaimed';
}
