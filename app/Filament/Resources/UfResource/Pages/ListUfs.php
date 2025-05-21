<?php

namespace App\Filament\Resources\UfResource\Pages;

use App\Filament\Resources\UfResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUfs extends ListRecords
{
    protected static string $resource = UfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
