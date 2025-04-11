<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ExchangeResource\Widgets\ExchangesTable;
use App\Filament\Resources\HistoryResource\Widgets\HistoriesTable;
use Filament\Facades\Filament;
use Filament\Pages\BasePage;

class Dashboard extends BasePage
{
    protected function getWidgets(): array
    {
        return Filament::getWidgets();
    }
}
