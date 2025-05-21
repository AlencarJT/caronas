<?php

namespace App\Filament\Resources\PessoaResource\Pages;

use App\Filament\Resources\PessoaResource;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\HtmlString;

class EditPessoa extends EditRecord
{
    protected static string $resource = PessoaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return "Pessoa";
    }

    public function getTitle(): HtmlString
    {
        $arrDados = $this->getRecord()->attributesToArray();

        return new HtmlString("{$arrDados["cd_pessoa"]} / {$arrDados["nm_pessoa"]}");
    }
}
