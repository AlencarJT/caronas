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
        Schema::create('reserva_carona', function (Blueprint $table) {
            $table->id('cd_reserva');
            $table->unsignedBigInteger('cd_carona');
            $table->unsignedBigInteger('cd_pessoa');
            $table->integer('qt_vagas');
            $table->date('dt_reserva');
            $table->time('hr_reserva');

            $table->foreign('cd_pessoa')->references('cd_pessoa')->on('pessoa')->onDelete('cascade');
            $table->foreign('cd_carona')->references('cd_carona')->on('carona')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_carona');
    }
};
