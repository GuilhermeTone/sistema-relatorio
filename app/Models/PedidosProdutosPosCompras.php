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

    public function listarPedidosConfirmados($dataPedido)
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
        FROM pedidos_produtos_pos_compras pp
        INNER JOIN produtos pd ON pp.idProduto = pd.idProduto
        INNER JOIN pedidos p ON pp.idPedido = p.idPedido
        INNER JOIN lojas l ON p.idLoja = l.idLoja
        WHERE pp.deleted_at IS NULL
        AND pd.deleted_at IS NULL
        AND p.deleted_at IS NULL
        AND DATE(p.created_at) = ?
        AND p.Status = 'Confirmado'";
        $parametros[] = $dataPedido;

        return DB::select($sql, $parametros);
    }
}
