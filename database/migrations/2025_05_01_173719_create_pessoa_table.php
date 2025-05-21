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
        Schema::create('pessoa', function (Blueprint $table) {
            $table->id("cd_pessoa");
            $table->timestamp('dt_cadastro')->useCurrent();
            $table->timestamp('dt_atualizacao')->useCurrent()->useCurrentOnUpdate();
            $table->string("nm_pessoa");
            $table->unsignedBigInteger('cd_cidade');
            $table->string('nr_cpf', 11)->unique();
            $table->string('nr_rg')->nullable();
            $table->smallInteger("id_sexo");
            $table->date("dt_nascimento");
            $table->text("ds_observacao")->nullable();
            $table->boolean("id_ativo")->default(1);

            $table->foreign('cd_cidade')->references('cd_cidade')->on('cidade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa');
    }
};
