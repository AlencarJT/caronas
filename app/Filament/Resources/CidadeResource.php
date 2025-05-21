<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CidadeResource\Pages;
use App\Filament\Resources\CidadeResource\RelationManagers;
use App\Models\Cidade;
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

class CidadeResource extends Resource
{
    protected static ?string $model = Cidade::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nm_cidade')
                    ->label('Cidade'),
                select::make('cd_uf')
                    ->label('Uf')
                    ->relationship('uf', 'ds_sigla')
                    ->required(),
                TextInput::make('nr_ibge')
                    ->label('Nº IBGE')
                    ->numeric(),
                TextInput::make('nr_ddd')
                    ->label('DDD')
                    ->numeric(),
                TextInput::make('nr_cep')
                    ->label('CEP')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cd_cidade')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nm_cidade')
                    ->label('Nm. Cidade')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('uf.ds_sigla')
                    ->label('Uf')
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
            'index' => Pages\ListCidades::route('/'),
            'create' => Pages\CreateCidade::route('/create'),
            'edit' => Pages\EditCidade::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): string
    {
        return 'Cadastro';
    }
}
