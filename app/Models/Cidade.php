<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'cd_cidade';

    protected $table = 'cidade';

    protected $fillable = [
        'cd_uf',
        'nm_cidade',
        'nr_ibge',
        'nr_ddd',
        'nr_cep',
    ];

    public function uf()
    {
        return $this->belongsTo(Uf::class, 'cd_uf');
    }

    public function pessoas()
    {
        return $this->hasMany(Pessoa::class, 'cd_cidade');
    }
}
