<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
    const ID_ENDERECO_RESIDENCIAL = 0;
    const ID_ENDERECO_COMERCIAL   = 1;

    public static $opIdEndereco = [
        self::ID_ENDERECO_RESIDENCIAL => "Residencial",
        self::ID_ENDERECO_COMERCIAL   => "Comercial"
    ];

    public $timestamps = false;

    protected $primaryKey = 'cd_endereco';

    protected $table = 'endereco';

    protected $fillable = [
        'cd_pessoa',
        'cd_cidade',
        'ds_rua',
        'ds_bairro',
        'nr_endereco',
        'nr_cep',
        'id_tipo',
        'id_recebe_correspondencia',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'cd_pessoa', 'cd_pessoa');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cd_cidade', 'cd_cidade');
    }
}
