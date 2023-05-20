<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PedidosProdutosPosCompras extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProduto',
        'idPedido',
        'Quantidade',
        'Unidade',
        'Valor'
    ];

    public function listarPedidosConfirmados($dataPedido, $idLoja)
    {
        $parametros = array();

        $sql =
        "SELECT
        pd.Nome
        , pp.idPedido
        , pp.idProduto
        ,pp.Quantidade
      	, pp.Unidade
      	,l.Nome AS NomeLoja
      	,pp.Valor
        ,DATE(pp.created_at) AS DataPedido
        FROM pedidos_produtos_pos_compras pp
        INNER JOIN produtos pd ON pp.idProduto = pd.idProduto
        INNER JOIN pedidos p ON pp.idPedido = p.idPedido
        INNER JOIN lojas l ON p.idLoja = l.idLoja
        WHERE pp.deleted_at IS NULL
        AND pd.deleted_at IS NULL
        AND p.deleted_at IS NULL
        AND p.idLoja = ?
        AND DATE(p.created_at) = ?
        AND p.Status = 'Confirmado'
        ORDER BY 
    CASE
        WHEN pd.Tipos = 'Frutas' THEN 1
        WHEN pd.Tipos = 'Legumes' THEN 2
        WHEN pd.Tipos = 'Verduras' THEN 3
    END,
    pd.Tipos, -- Adicionado para ordenação alfabética
    pd.Nome";
        $parametros[] = $idLoja;
        $parametros[] = $dataPedido;

        return DB::select($sql, $parametros);
    }
    public function ChecaPedidoConfirmado($idPedido)
    {

        $sql =
            "SELECT pp.idPedido
        FROM pedidos_produtos_pos_compras pp
        INNER JOIN pedidos p ON pp.idPedido = p.idPedido
        WHERE p.deleted_at IS NULL
        AND p.idPedido IN ($idPedido)";
        // $parametros[] = $idPedido;

        return DB::select($sql);
    }
    public function deletaprodutosPedidoConfirmado($listaPedido){

        $sql = "UPDATE pedidos_produtos_pos_compras SET deleted_at = NOW() WHERE idPedido IN ($listaPedido)";

        return DB::update($sql);
    }

    public function listarValorTotal($dataPedido, $idLoja)
    {
        $parametros = array();

        $sql =
            "SELECT
        SUM(pp.Valor) AS ValorTotal
        FROM pedidos_produtos_pos_compras pp
        INNER JOIN produtos pd ON pp.idProduto = pd.idProduto
        INNER JOIN pedidos p ON pp.idPedido = p.idPedido
        INNER JOIN lojas l ON p.idLoja = l.idLoja
        WHERE pp.deleted_at IS NULL
        AND pd.deleted_at IS NULL
        AND p.deleted_at IS NULL
        AND p.idLoja = ?
        AND DATE(p.created_at) = ?
        AND p.Status = 'Confirmado'";
        $parametros[] = $idLoja;
        $parametros[] = $dataPedido;

        return DB::select($sql, $parametros);
    }
}
