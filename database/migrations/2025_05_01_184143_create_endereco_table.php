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
        Schema::create('endereco', function (Blueprint $table) {
            $table->id("cd_endereco");
            $table->unsignedBigInteger("cd_pessoa");
            $table->unsignedBigInteger("cd_cidade");
            $table->string("ds_rua");
            $table->string("ds_bairro");
            $table->integer("nr_endereco");
            $table->integer("nr_cep");
            $table->integer("id_tipo");
            $table->integer("id_recebe_correspondencia")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endereco');
    }
};
