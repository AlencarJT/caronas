<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'cd_uf';

    protected $table = 'uf';

    protected $fillable = [
        'cd_pais',
        'nm_uf',
        'ds_sigla',
        'nr_ibge',
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'cd_pais');
    }
}
