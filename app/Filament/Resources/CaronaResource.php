<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaronaResource\Pages;
use App\Filament\Resources\CaronaResource\RelationManagers;
use App\Models\Carona;
use App\Models\Cidade;
use App\Models\Veiculo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{Select, TextInput, DatePicker, TimePicker, Textarea};
use Filament\Tables\Columns\{TextColumn};
use Filament\Notifications\Notification;

class CaronaResource extends Resource
{
    protected static ?string $model = Carona::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('cd_cidade_origem')
                    ->label('Cidade Origem')
                    ->options(function () {
                        return Cidade::with('uf')
                            ->get()
                            ->mapWithKeys(function ($cidade) {
                                return [
                                    $cidade->cd_cidade => "{$cidade->nm_cidade} / {$cidade->uf->ds_sigla}",
                                ];
                            });
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $livewire, $set)
                    {
                        $origem = $livewire->data['cd_cidade_destino'] ?? null;

                        if ($origem && $state == $origem)
                        {
                            $set('cd_cidade_origem', null); // Limpa o destino
                            Notification::make()
                                ->title('Erro')
                                ->body('Cidade de Destino deve ser diferente da Cidade de Origem.')
                                ->danger()
                                ->send();
                        }
                    }),

                Select::make('cd_cidade_destino')
                    ->label('Cidade Destino')
                    ->options(function () {
                        return Cidade::with('uf')
                            ->get()
                            ->mapWithKeys(function ($cidade){
                                return [
                                    $cidade->cd_cidade => "{$cidade->nm_cidade} / {$cidade->uf->ds_sigla}",
                                ];
                            });
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $livewire, $set)
                    {
                        $origem = $livewire->data['cd_cidade_origem'] ?? null;

                        if ($origem && $state == $origem)
                        {
                            $set('cd_cidade_destino', null);
                            Notification::make()
                                ->title('Erro')
                                ->body('Cidade de Destino deve ser diferente da Cidade de Origem.')
                                ->danger()
                                ->send();
                        }
                    }),

                DatePicker::make('dt_carona')
                    ->label('Data')
                    ->required(),

                TimePicker::make('hr_carona')
                    ->label('Horário')
                    ->required(),

                Select::make('cd_veiculo')
                    ->label('Veiculo')
                    ->relationship('veiculo', 'ds_modelo')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return "{$record->ds_marca} / {$record->ds_modelo}";
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $livewire, $set)
                    {
                        if (!Veiculo::validarQtdVagas($livewire->data, $livewire->data['cd_veiculo']))
                            $set('cd_veiculo', null);
                    }),

                TextInput::make('nr_vagas')
                    ->label('Vagas')
                    ->numeric()
                    ->minValue(1)
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $livewire, $set)
                    {
                        if (!Veiculo::validarQtdVagas($livewire->data, $livewire->data['cd_veiculo']))
                            $set('nr_vagas', null);
                    }),

                Textarea::make('ds_observacao')
                    ->label('Observações')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cd_cidade_origem')
                    ->label('Origem')
                    ->formatStateUsing(fn ($state, $record) => "{$record->cidadeOrigem->nm_cidade} / {$record->cidadeOrigem->uf->ds_sigla}")
                    ->searchable()
                    ->sortable(),

                TextColumn::make('cd_cidade_destino')
                    ->label('Destino')
                    ->formatStateUsing(fn ($state, $record) => "{$record->cidadeDestino->nm_cidade} / {$record->cidadeDestino->uf->ds_sigla}")
                    ->searchable()
                    ->sortable(),

                TextColumn::make('dt_carona')
                    ->label('Dt. Criação')
                    ->dateTime(),

                TextColumn::make('hr_carona')
                    ->Time()
                    ->label('Horário'),

                TextColumn::make('nr_vagas')
                    ->label('Vagas')
                    ->sortable(),
            ])
            ->defaultSort('dt_carona', 'asc');
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
            'index' => Pages\ListCaronas::route('/'),
            'create' => Pages\CreateCarona::route('/create'),
            'edit' => Pages\EditCarona::route('/{record}/edit'),
        ];
    }
}
