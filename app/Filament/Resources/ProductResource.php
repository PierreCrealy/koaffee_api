<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Bar/Café';
    protected static ?string $navigationLabel = 'Produits';
    protected static ?string $label = 'Produits';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(150),
                Forms\Components\Select::make('category')
                    ->options([
                        'ACCOMPAGNEMENT' => 'ACCOMPAGNEMENT',
                        'BOISSON CHAUDE' => 'BOISSON CHAUDE',
                        'BOISSON FROIDE' => 'BOISSON FROIDE',
                        'DESSERT'        => 'DESSERT',
                        'PLAT'           => 'PLAT',
                    ]),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                Forms\Components\Section::make()
                    ->schema([

                        Forms\Components\Split::make([
                            Forms\Components\Toggle::make('highlight')
                                ->required(),
                            Forms\Components\Toggle::make('fidelity_program')
                                ->required(),
                            Forms\Components\Toggle::make('proposed')
                                ->required(),
                        ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(35)
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\IconColumn::make('highlight')
                    ->boolean(),
                Tables\Columns\IconColumn::make('fidelity_program')
                    ->boolean(),
                Tables\Columns\IconColumn::make('proposed')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
