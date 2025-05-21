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
        Schema::table('endereco', function (Blueprint $table) {
            $table->foreign('cd_pessoa')
                ->references('cd_pessoa')
                ->on('pessoa')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('endereco', function (Blueprint $table) {
            $table->dropForeign(['cd_pessoa']);
        });
    }
};
