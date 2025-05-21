<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $primaryKey = 'cd_pessoa';

    protected $table = 'pessoa';

    const CREATED_AT = 'dt_cadastro';

    const UPDATED_AT = 'dt_atualizacao';

    protected $fillable = [
        'cd_pessoa',
        'dt_cadastro',
        'dt_atualizacao',
        'nm_pessoa',
        'cd_cidade',
        'nr_cpf',
        'nr_rg',
        'id_sexo',
        'dt_nascimento',
        'ds_observacao',
        'id_ativo',
    ];

    public function endereco()
    {
        return $this->hasMany(Endereco::class, 'cd_pessoa', 'cd_pessoa');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cd_cidade', 'cd_cidade');
    }

    public function telefone()
    {
        return $this->hasMany(Telefone::class, 'cd_pessoa');
    }
}
