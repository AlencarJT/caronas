<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaronaResource\Pages;
use App\Models\Carona;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
//use Filament\Navigation\NavigationItem;

class CaronaResource extends Resource
{
    protected static ?string $model = Carona::class;
    //protected static ?string $navigationIcon = 'academic-cap';
    protected static ?string $label = 'Carona';
    protected static ?string $pluralLabel = 'Caronas';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\DateTimePicker::make('dt_carona')
                ->required(),
            Forms\Components\TextInput::make('nr_passageiros')
                ->required()
                ->numeric()
                ->rules(['integer', 'min:0', 'max:4'])
                ->helperText('Número de passageiros deve ser entre 0 e 4'),
            Forms\Components\Select::make('id_destino')
                ->options([
                    0 => 'Marau - Passo Fundo',
                    1 => 'Passo Fundo - Marau',
                ])
                ->required(),
            Forms\Components\TextInput::make('ds_observacao'),
            Forms\Components\TextInput::make('vl_total')
                ->required()
                ->numeric(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dt_carona')
                  ->label('Dt. Carona')
                  ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('d/m/Y H:i')),
                Tables\Columns\TextColumn::make('nr_passageiros')
                  ->label('Qt. Passageiros'),
                Tables\Columns\TextColumn::make('id_destino')
                  ->label('Rota')
                  ->formatStateUsing(function ($state) {
                    return $state === 0 ? 'Marau - Passo Fundo' : 'Passo Fundo - Marau';}),
                Tables\Columns\TextColumn::make('ds_observacao')
                  ->label('Obs.'),
                Tables\Columns\TextColumn::make('vl_total')
                  ->label('Valor')
                  ->formatStateUsing(fn ($state) => 'R$ ' . number_format($state, 2, ',', '.')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([
                // Adicione filtros se necessário
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCaronas::route('/'),
        ];
    }
}