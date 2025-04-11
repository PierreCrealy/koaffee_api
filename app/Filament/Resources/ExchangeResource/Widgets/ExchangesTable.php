<?php

namespace App\Filament\Resources\ExchangeResource\Widgets;

use App\Models\Exchange;
use App\Services\ExchangeServices;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ExchangesTable extends BaseWidget
{

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Exchange::query()->orderBy('created_at')->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('access')
                    ->label('Code d\'accès')
                    ->formatStateUsing(function (Exchange $exchange) {
                        return $exchange->access . ' => ' . ExchangeServices::decryptAES($exchange->access);
                    })
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Initié le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ]);
    }
}
