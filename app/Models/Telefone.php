<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    public static $opIdOperadora = [
        1 => "CLARO",
        2 => "VIVO",
        3 => "TIM",
        4 => "CORREIOS",
        5 => "COPREL",
    ];

    public static $opIdAplicativos = [
        1 => "WhatsApp",
        2 => "Telegram",
        3 => "Mensageiro Padrão"
    ];

    public $timestamps = false;

    protected $primaryKey = 'cd_telefone';

    protected $table = 'telefone';

    protected $fillable = [
        'cd_pessoa',
        'id_operadora',
        'id_mensageiro',
        'ds_mensageiro',
        'nr_telefone',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'cd_pessoa', 'cd_pessoa');
    }
}
