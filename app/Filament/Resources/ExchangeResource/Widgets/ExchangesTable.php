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
                Exchange::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('access')
                    ->label('Code d\'accès')
                    ->formatStateUsing(function (Exchange $exchange) {
                        return $exchange->access . ' => ' . ExchangeServices::decryptAES($exchange->access);
                    })
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('initiated_at')
                    ->label('Initié le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ]);
    }
}
