<?php

namespace App\Filament\Resources\PessoaResource\Pages;

use App\Filament\Resources\PessoaResource;
use App\Models\Cidade;
use App\Models\Endereco;
use Faker\Provider\Text;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ManageEndereco extends ManageRelatedRecords
{
    protected static string $resource = PessoaResource::class;

    protected static string $relationship = 'endereco';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Endereços';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('cd_cidade')
                    ->label('Cidade')
                    ->options(function () {
                        return Cidade::with('uf')
                            ->get()
                            ->mapWithKeys(function ($cidade) {
                                return [
                                    $cidade->cd_cidade => "{$cidade->nm_cidade} / {$cidade->uf->ds_sigla}",
                                ];
                            });
                    })
                    ->required(),

                TextInput::make('ds_rua')
                    ->label('Rua')
                    ->required(),

                TextInput::make('nr_endereco')
                    ->label('Nº')
                    ->numeric()
                    ->required(),

                TextInput::make('ds_bairro')
                    ->label('Bairro')
                    ->required(),

                TextInput::make('nr_cep')
                    ->label('CEP')
                    ->numeric()
                    ->required(),

                Select::make("id_tipo")
                    ->label('Tipo')
                    ->options(Endereco::$opIdEndereco)
                    ->required(),

                Select::make("id_recebe_correspondencia")
                    ->label("Recebe Correspondencia")
                    ->options([
                        0 => "Não",
                        1 => "Sim",
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nm_pessoa')
            ->columns([
                TextColumn::make('cd_endereco')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('cd_cidade')
                    ->label('Cidade')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state, $record) => ($record->cidade->nm_cidade . " / " . $record->cidade->uf->ds_sigla)),

                TextColumn::make('id_tipo')
                    ->label('Tipo')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        Endereco::ID_ENDERECO_COMERCIAL   => 'Comercial',
                        Endereco::ID_ENDERECO_RESIDENCIAL => 'Residencial',
                        3 => 'Outro',
                        default => 'Não informado',
                    }),

                TextColumn::make('ds_rua')
                    ->label('Rua'),

                TextColumn::make('nr_endereco')
                    ->label("Nº")
            ])
            ->headerActions([
                CreateAction::make()
                    ->label("Inserir Endereço")
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make('delete')
                ]),
            ]);
    }

    public function getTitle(): string
    {
        $arrDados = $this->getOwnerRecord()->attributesToArray();

        return "Endereços de {$arrDados["nm_pessoa"]}";
    }
}
