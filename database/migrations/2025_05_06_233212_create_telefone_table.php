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
        Schema::create('telefone', function (Blueprint $table) {
            $table->id('cd_telefone');
            $table->unsignedBigInteger('cd_pessoa');
            $table->unsignedBigInteger('id_operadora')->nullable();
            $table->unsignedBigInteger('id_mensageiro')->nullable();
            $table->string('ds_mensageiro')->nullable();
            $table->string('nr_telefone', 15);
            $table->timestamps();

            $table->foreign('cd_pessoa')->references('cd_pessoa')->on('pessoa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telefone');
    }
};
