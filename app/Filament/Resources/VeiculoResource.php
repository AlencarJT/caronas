<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VeiculoResource\Pages;
use App\Filament\Resources\VeiculoResource\RelationManagers;
use App\Models\Cidade;
use App\Models\Veiculo;
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

class VeiculoResource extends Resource
{
    protected static ?string $model = Veiculo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('ds_marca')
                    ->label('Marca')
                    ->required(),
                TextInput::make('ds_modelo')
                    ->label('Modelo')
                    ->required(),
                TextInput::make('ds_chassi')
                    ->label('Chassi')
                    ->required(),
                TextInput::make('ds_cor')
                    ->label('Cor')
                    ->required(),
                TextInput::make('ds_placa')
                    ->label('Placa')
                    ->required(),
                TextInput::make('cd_proprietario')
                    ->label('Proprietário')
                    ->numeric()
                    ->required(),
                TextInput::make('nr_ano')
                    ->label('Ano Fabricação')
                    ->numeric()
                    ->required(),
                Select::make('cd_cidade')
                    ->relationship('cidadeRegistro', 'nm_cidade')
                    ->required(),
                TextInput::make('nr_vagas')
                    ->label('Vagas')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cd_veiculo')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ds_marca')
                    ->label('Marca')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ds_modelo')
                    ->label('Modelo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ds_placa')
                    ->label('Placa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('obter_nm_cidade_formatado')
                    ->label('Cidade')
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
            'index' => Pages\ListVeiculos::route('/'),
            'create' => Pages\CreateVeiculo::route('/create'),
            'edit' => Pages\EditVeiculo::route('/{record}/edit'),
        ];
    }

    /**
     * GPT me ensinou que isso é importante para melhorar  performance;
     * Segundo o chat, isso já carrega diretamente em uma única query toda a inforamção desejada;
     * @return Builder
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['cidadeRegistro.uf']);
    }

    public static function getNavigationGroup(): string
    {
        return 'Cadastro';
    }
}
