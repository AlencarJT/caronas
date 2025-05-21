<?php

namespace App\Filament\Resources\PessoaResource\Pages;

use App\Filament\Resources\PessoaResource;
use App\Models\Cidade;
use App\Models\Endereco;
use App\Models\Telefone;
use Faker\Provider\Text;
use Filament\Actions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Toggle;
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
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ManageTelefone extends ManageRelatedRecords
{
    protected static string $resource = PessoaResource::class;

    protected static string $relationship = 'telefone';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Telefones';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("id_operadora")
                    ->label('Operadora')
                    ->options(Telefone::$opIdOperadora)
                    ->required(),

                Toggle::make('id_mensageiro')
                    ->label('Recebe Mensagens?')
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(false),

                Select::make('ds_mensageiro')
                    ->label('Mensageiro')
                    ->options([
                        1 => "WhatsApp",
                        2 => "Telegram",
                        3 => "Mensageiro Padrão"
                    ])
                    ->required(),

                TextInput::make('nr_telefone')
                    ->label('Número')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nm_pessoa')
            ->columns([
                TextColumn::make('cd_telefone')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('id_operadora')
                    ->label('Operadora')
                    ->formatStateUsing(fn ($state) => Telefone::$opIdOperadora[$state] ?? "Desconhecido"),

                TextColumn::make('nr_telefone')
                    ->label('Número'),

                ToggleColumn::make('id_mensageiro')
                    ->label("Recebe Mensagem?")
                    ->sortable(),

                TextColumn::make('ds_mensageiro')
                    ->label('Mensageiro')
                    ->formatStateUsing(fn ($state) => Telefone::$opIdAplicativos[$state] ?? "Desconhecido")
            ])
            ->headerActions([
                CreateAction::make()
                    ->label("Inserir Telefone")
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

        return "Telefones de {$arrDados["nm_pessoa"]}";
    }
}
