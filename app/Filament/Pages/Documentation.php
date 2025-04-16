<?php

namespace App\Filament\Pages;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;

class Documentation extends Page
{
    protected static string $view = 'filament.pages.documentation';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'informations' => [
                    'route'    => 'http://passapi.local/api/v1/',
                    'required' => 'Aucun paramètre (Token) n\'est requis pour communiquer avec l\'API',
                ],
                'routes' => [
//                    'historique' =>
//                        [
//                            'http://passapi.local/api/v1/history/',
//                            'http://passapi.local/api/v1/history/{id}/getExchange'
//                        ],
//
//                    'echange' =>
//                        [
//                            'http://passapi.local/api/v1/exchange/',
//                            'http://passapi.local/api/v1/exchange/{id}/getHistories',
//                            'http://passapi.local/api/v1/exchange/{access}/claim'
//                        ],

                    'order' =>
                        [
                            'http://passapi.local/api/v1/order/',

                            'http://passapi.local/api/v1/order/group-by-status',
                            'http://passapi.local/api/v1/order/{userId}/group-by-status',

                            'http://passapi.local/api/v1/order/{status}/orders-status',
                            'http://passapi.local/api/v1/order/{userId}/{status}/latest',

                        ],

                    'product' =>
                        [
                            'http://passapi.local/api/v1/product/',

                            'http://passapi.local/api/v1/product/{category}/products-category',
                            'http://passapi.local/api/v1/product/group-by-category'
                        ],
                ],
            ])

            ->schema([
                Section::make('Informations')
                    ->description('Informations générales sur l\'API')
                    ->aside()
                    ->icon('heroicon-m-building-office')
                    ->schema([
                        TextEntry::make('informations.route')
                            ->label('Route')
                            ->badge()
                            ->color('success'),
                        TextEntry::make('informations.required')
                            ->label('Détails'),
                    ]),

                Section::make('Routes disponibles')
                    ->description('Routes accessible')
                    ->aside()
                    ->icon('heroicon-m-question-mark-circle')
                    ->schema([
                        TextEntry::make('routes.order')
                            ->label('Commandes')
                            ->listWithLineBreaks()
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('routes.product')
                            ->label('Produits')
                            ->listWithLineBreaks()
                            ->badge()
                            ->color('info'),
                    ]),



            ]);
    }

}
