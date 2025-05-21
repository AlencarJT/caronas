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
        Schema::create('pais', function (Blueprint $table) {
            $table->id('cd_pais');
            $table->string('nm_pais');
            $table->string('nr_pais');
            $table->string('ds_sigla');
            $table->string('ds_moeda');
            $table->string('nr_bacen');
            $table->timestamp('dt_atualizacao')->useCurrent()->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pais');
    }
};
