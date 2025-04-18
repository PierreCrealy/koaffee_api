<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Commandes';
    protected static ?string $label = 'Commandes';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('total')
                    ->money('EUR')
                    ->searchable(),
                Tables\Columns\TextColumn::make('table')
                    ->prefix('n°')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => fn ($state): bool => $state == 'COMPLETED',
                        'warning' => fn ($state): bool => $state == 'PROGRESS',
                        'danger'  => fn ($state): bool => $state == 'CANCELLED',
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('fidelity_pts_earned')
                    ->suffix(' pts')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Action::make('updateOrder')
                    ->label('Modifier le status')
                    ->icon('heroicon-m-pencil-square')
                    ->form([
                        Select::make('status')
                            ->required()
                            ->options([
                                'COMPLETED' => 'COMPLETED',
                                'PROGRESS'  => 'PROGRESS',
                                'CANCELLED' => 'CANCELLED',
                            ]),
                    ])
                    ->action(function (array $data, Order $order): void {
                        $order->status = $data['status'];
                        $order->save();

                        Notification::make()
                            ->title('Commande mise à jour !')
                            ->success()
                            ->send();
                    })
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            // 'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
