<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PessoaResource\Pages;
use App\Filament\Resources\PessoaResource\Pages\EditPessoa;
use App\Filament\Resources\PessoaResource\RelatedRecords\ManageEndereco;
use App\Models\Cidade;
use App\Models\Pessoa;
use Carbon\Traits\Date;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class PessoaResource extends Resource
{
    protected static ?string $model = Pessoa::class;

    protected static ?string $pluralLabel = 'Pessoas';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nm_pessoa')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),

                TextInput::make('nr_cpf')
                    ->label('CPF')
                    ->required()
                    ->maxLength(14),

                TextInput::make('nr_rg')
                    ->label('RG')
                    ->maxLength(20),

                Select::make('id_sexo')
                    ->label('Sexo')
                    ->options([
                        1 => 'Masculino',
                        2 => 'Feminino',
                        3 => 'Outro',
                    ])
                    ->required(),

                DatePicker::make('dt_nascimento')
                    ->label('Data de Nascimento')
                    ->required(),

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
                    ->searchable()
                    ->required(),

                Textarea::make('ds_observacao')
                    ->label('Observações')
                    ->maxLength(500)
                    ->rows(3),

                Toggle::make('id_ativo')
                    ->label('Ativo')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nm_pessoa')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nr_cpf')
                    ->label('CPF')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nr_rg')
                    ->label('RG')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('id_sexo')
                    ->label('Sexo')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        1 => 'Masculino',
                        2 => 'Feminino',
                        3 => 'Outro',
                        default => 'Não informado',
                    }),

                TextColumn::make('dt_nascimento')
                    ->label('Nascimento')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('cidade.nm_cidade')
                    ->label('Cidade')
                    ->sortable()
                    ->searchable(),

                ToggleColumn::make('id_ativo')
                    ->label('Ativo')
                    ->sortable(),

                TextColumn::make('dt_cadastro')
                    ->label('Cadastro')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('id_sexo')
                    ->label('Sexo')
                    ->options([
                        1 => 'Masculino',
                        2 => 'Feminino',
                        3 => 'Outro',
                    ]),
                TernaryFilter::make('id_ativo')
                    ->label('Ativo'),
            ])
            ->defaultSort('cd_pessoa', 'desc');
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
            'index' => Pages\ListPessoas::route('/'),
            'create' => Pages\CreatePessoa::route('/create'),
            'edit' => Pages\EditPessoa::route('/{record}/edit'),
            'enderecos' => Pages\ManageEndereco::route('/{record}/enderecos'),
            'telefones' => Pages\ManageTelefone::route('/{record}/telefones'),
        ];
    }

    public static function getNavigationGroup(): string
    {
        return 'Cadastro';
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditPessoa::class,
            Pages\ManageEndereco::class,
            Pages\ManageTelefone::class,
        ]);
    }
}
