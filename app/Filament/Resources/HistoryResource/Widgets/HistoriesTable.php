<?php

namespace App\Filament\Resources\HistoryResource\Widgets;

use App\Enums\ExchangeStatusEnum;
use App\Models\History;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class HistoriesTable extends BaseWidget
{

    public function table(Table $table): Table
    {
        return $table
            ->query(
                History::query()->orderBy('reclaimed_at')->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => fn ($state): bool => $state === ExchangeStatusEnum::Pending,
                        'success' => fn ($state): bool => $state === ExchangeStatusEnum::Claimed,
                        'danger'  => fn ($state): bool => $state === ExchangeStatusEnum::Unclaimed,
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('reclaimed_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ]);
    }
}
