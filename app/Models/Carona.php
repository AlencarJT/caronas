<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carona extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'cd_carona';

    protected $table = 'carona';

    protected $fillable = [
        'cd_veiculo',
        'dt_carona',
        'hr_carona',
        'nr_vagas',
        'ds_observacao',
        'cd_cidade_origem',
        'cd_cidade_destino',
    ];

    public function cidadeOrigem()
    {
        return $this->belongsTo(Cidade::class, 'cd_cidade_origem', 'cd_cidade');
    }

    public function cidadeDestino()
    {
        return $this->belongsTo(Cidade::class, 'cd_cidade_destino', 'cd_cidade');
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'cd_veiculo', 'cd_veiculo');
    }
}
