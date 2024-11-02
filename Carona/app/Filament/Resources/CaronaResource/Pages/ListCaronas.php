<?php

namespace App\Filament\Resources\CaronaResource\Pages;

use App\Filament\Resources\CaronaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaronas extends ListRecords
{
    protected static string $resource = CaronaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
