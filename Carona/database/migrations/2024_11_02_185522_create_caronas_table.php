<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaronasTable extends Migration
{
    public function up()
    {
        Schema::create('caronas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('dt_carona');
            $table->integer('nr_passageiros')->max(4);
            $table->tinyInteger('id_destino')->default(0);
            $table->string('ds_observacao')->nullable();
            $table->float('vl_total');
            $table->timestamps(); // Isso adiciona as colunas created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('caronas');
    }
}
