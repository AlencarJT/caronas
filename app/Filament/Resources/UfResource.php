<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UfResource\Pages;
use App\Filament\Resources\UfResource\RelationManagers;
use App\Models\Uf;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UfResource extends Resource
{
    protected static ?string $model = Uf::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                select::make('cd_pais')
                    ->label('País')
                    ->relationship('pais', 'nm_pais')
                    ->required(),
                TextInput::make('nm_uf')
                    ->label('Uf'),
                TextInput::make('ds_sigla')
                    ->label('Sigla'),
                TextInput::make('nr_ibge')
                    ->label('Cód. IBGE'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cd_uf')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nm_uf')
                    ->label('Nm. Estado')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ds_sigla')
                    ->label('Sigla')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pais.nm_pais')
                    ->formatStateUsing(fn ($state, $record) => "{$record->pais->nm_pais} ({$record->pais->ds_sigla})")
                    ->label('País')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            "index" => Pages\ListUfs::route('/'),
            "create" => Pages\CreateUf::route('/create'),
            "edit" => Pages\EditUf::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): string
    {
        return "Cadastro";
    }
}
