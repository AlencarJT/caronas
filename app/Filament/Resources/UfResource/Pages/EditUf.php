<?php

namespace App\Filament\Resources\UfResource\Pages;

use App\Filament\Resources\UfResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUf extends EditRecord
{
    protected static string $resource = UfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
