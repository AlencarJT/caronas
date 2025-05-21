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
        Schema::create('cidade', function (Blueprint $table) {
            $table->id('cd_cidade');
            $table->unsignedBigInteger('cd_uf')->nullable(false);
            $table->string('nm_cidade')->nullable(false);
            $table->integer('nr_ibge');
            $table->smallInteger('nr_ddd');
            $table->integer('nr_cep');
            $table->timestamp('dt_atualizacao')->useCurrent()->nullable(false);
            $table->unique(['cd_uf', 'nm_cidade'], 'un_cidade_nm_cidade');
            $table->foreign('cd_uf')->references('cd_uf')->on('uf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cidade');
    }
};
