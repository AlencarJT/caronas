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
        Schema::create('uf', function (Blueprint $table) {
            $table->id('cd_uf');
            $table->unsignedBigInteger('cd_pais');
            $table->string('nm_uf');
            $table->string('ds_sigla');
            $table->integer('nr_ibge');
            $table->timestamp('dt_atualizacao')->useCurrent()->nullable(false);
            $table->foreign('cd_pais')->references('cd_pais')->on('pais');
            $table->unique(['cd_pais', 'ds_sigla'], 'un_uf_ds_sigla');
            $table->unique(['nm_uf'], 'un_uf_nm_uf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uf');
    }
};
