<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class veiculo extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'cd_veiculo';

    protected $table = 'veiculo';

    protected $fillable = [
        'cd_cidade',
        'ds_chassi',
        'ds_cor',
        'ds_marca',
        'ds_modelo',
        'nr_vagas',
        'cd_proprietario',
        'nr_ano',
        'ds_placa',
    ];

    public static function validarQtdVagas($arrDados, $cdVeiculo)
    {
        if (!$arrDados["nr_vagas"] || !$cdVeiculo)
            return true;

        $Veiculo = Veiculo::findOrFail($cdVeiculo);

        if ($Veiculo->nr_vagas < $arrDados["nr_vagas"])
        {
            Notification::make()
                ->title('Erro')
                ->body('O número máximo de vagas disponíveis para o Veículo ' . $Veiculo->ds_marca . " " . $Veiculo->ds_modelo .  " é " .  $Veiculo->nr_vagas)
                ->danger()
                ->send();

            return false;
        }

        return true;
    }

    public function cidadeRegistro()
    {
        return $this->belongsTo(Cidade::class, 'cd_cidade', "cd_cidade");
    }

    /**
     * Importante dizer, aqui, chama-se obterNmCidadeFormatado, lá no VeiculoResource é chamado como obter_nm_cidade_formatado,
     * o filament/eloquent usa uma técnica que converte camelCase em _ para essa parte.
     * Essa é uma ideia de uso de Accessors, segue sua definição:
     * Junção de diferentes informações, presentes ou não no BD, nada mais é do que uma formatação dos dados que julgarmos necessários para compor o campo da listagem.
     * @return Attribute
     */
    protected function obterNmCidadeFormatado(): Attribute
    {
        return Attribute::get(
            fn () => $this->cidadeRegistro && $this->cidadeRegistro->uf
                ? "{$this->cidadeRegistro->nm_cidade} / {$this->cidadeRegistro->uf->ds_sigla}"
                : '-'
        );
    }
}
