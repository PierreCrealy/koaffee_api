<?php

namespace App\Filament\Widgets;

use App\Enums\ExchangeStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Models\History;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';
    protected function getStats(): array
    {
        return [
            Stat::make('Commandes complétés', Order::where('status', OrderStatusEnum::COMPLETED)->count())
//                ->description('32k increase')
//                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Commandes en préparation', Order::where('status', OrderStatusEnum::PROGRESS)->count())
                ->color('warning'),
            Stat::make('Commandes annulées',  Order::where('status', OrderStatusEnum::CANCELLED)->count())
                ->color('danger'),
        ];
    }
}
