<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'cd_pais';

    protected $table = 'pais';

    protected $fillable = [
        'nm_pais',
        'nr_pais',
        'ds_sigla',
        'ds_moeda',
        'nr_bacen',
    ];
}
