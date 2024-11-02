<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carona extends Model
{
    use HasFactory;

    protected $fillable = [
        'dt_carona',
        'nr_passageiros',
        'id_destino',
        'ds_observacao',
        'vl_total',
    ];
}
