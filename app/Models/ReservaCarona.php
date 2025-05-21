<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class ReservaCarona extends Model
    {
        protected $table = 'reserva_carona';
        protected $primaryKey = 'cd_reserva';
        public $timestamps = false;

        protected $fillable = [
            'cd_carona',
            'cd_pessoa',
            'qt_vagas',
            'dt_reserva',
            'hr_reserva',
        ];

        public function carona()
        {
            return $this->belongsTo(Carona::class, 'cd_carona');
        }

        public function pessoa()
        {
            return $this->belongsTo(Pessoa::class, 'cd_pessoa');
        }
    }
