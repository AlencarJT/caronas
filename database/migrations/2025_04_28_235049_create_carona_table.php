<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carona', function (Blueprint $table) {
            $table->id('cd_carona');
            $table->unsignedBigInteger('cd_veiculo');
            $table->unsignedBigInteger('cd_cidade_origem');
            $table->unsignedBigInteger('cd_cidade_destino');
            $table->date('dt_carona');
            $table->time('hr_carona');
            $table->integer('nr_vagas');
            $table->text('ds_observacao')->nullable();
            $table->timestamps();

            $table->foreign('cd_veiculo')->references('cd_veiculo')->on('veiculo');
            $table->foreign('cd_cidade_origem')->references('cd_cidade')->on('cidade');
            $table->foreign('cd_cidade_destino')->references('cd_cidade')->on('cidade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carona');
    }
};
