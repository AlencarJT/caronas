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
        Schema::create('veiculo', function (Blueprint $table) {
            $table->id("cd_veiculo");
            $table->unsignedBigInteger("cd_cidade");
            $table->string("ds_chassi")->nullable();
            $table->string("ds_cor");
            $table->string("ds_marca");
            $table->string("ds_modelo");
            $table->integer("nr_vagas");
            $table->integer("cd_proprietario");
            $table->integer("nr_ano");
            $table->string("ds_placa");
            $table->foreign("cd_cidade")->references("cd_cidade")->on("cidade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculo');
    }
};
