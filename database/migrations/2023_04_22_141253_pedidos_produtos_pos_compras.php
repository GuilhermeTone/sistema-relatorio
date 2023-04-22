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
        Schema::create('pedidos_produtos_pos_compras', function (Blueprint $table) {
            $table->id('idPedidoProduto');
            $table->unsignedBigInteger('idProduto');
            $table->foreign('idProduto')->references('idProduto')->on('produtos');
            $table->unsignedBigInteger('idPedido');
            $table->foreign('idPedido')->references('idPedido')->on('pedidos');
            $table->string('Quantidade');
            $table->enum('Unidade', ['Caixa', 'Unidade', 'Saco', 'Maco', 'Kilo']);
            $table->float('Valor')->default(0);
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_produtos_pos_compras');
    }
};
