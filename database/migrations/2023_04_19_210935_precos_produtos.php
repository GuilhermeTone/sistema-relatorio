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
        Schema::create('precos_produtos', function (Blueprint $table) {
            $table->id('idPrecoProduto');
            $table->unsignedBigInteger('idProduto');
            $table->foreign('idProduto')->references('idProduto')->on('produtos');
            $table->enum('tipoPreco', ['Caixa', 'Unidade', 'Saco', 'Maco', 'Kilo']);
            $table->float('Valor');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precos_produtos');
    }
};
