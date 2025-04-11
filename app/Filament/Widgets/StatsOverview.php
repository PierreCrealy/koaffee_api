<?php

namespace App\Filament\Widgets;

use App\Enums\ExchangeStatusEnum;
use App\Models\History;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';
    protected function getStats(): array
    {
        return [
            Stat::make('Codes récupérés', History::where('status', ExchangeStatusEnum::Claimed)->count())
//                ->description('32k increase')
//                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Codes en attente', History::where('status', ExchangeStatusEnum::Pending)->count())
                ->color('warning'),
            Stat::make('Codes non récupérés', History::where('status', ExchangeStatusEnum::Unclaimed)->count())
                ->color('danger'),
        ];
    }
}
