<?php

namespace App\Filament\Resources\CaronaResource\Pages;

use App\Filament\Resources\CaronaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCaronas extends ManageRecords
{
    protected static string $resource = CaronaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}