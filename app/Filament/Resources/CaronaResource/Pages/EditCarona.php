<?php

namespace App\Filament\Resources\CaronaResource\Pages;

use App\Filament\Resources\CaronaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarona extends EditRecord
{
    protected static string $resource = CaronaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
