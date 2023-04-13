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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id('idProduto');
            $table->string('Nome');
            $table->enum('Tipos', ['Frutas', 'Legumes', 'Verduras']);
            $table->enum('Padrao', ['Caixa', 'Unidade', 'Saco', 'Maco' ,'Kilo']);
            $table->enum('Ocultar', ['N', 'S']);
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
