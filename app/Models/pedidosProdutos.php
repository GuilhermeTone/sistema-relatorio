<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pedidosProdutos extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProduto',
        'idPedido',
        'Quantidade',
        'Unidade',
    ];

    public function listagemProdutos($dataPedido, $idLojas, $tipo)
    {
        $parametros = array();

        $sql = "SELECT
        pd.Nome";
        foreach($idLojas as $idLoja){
            $sql .= "
            , IFNULL((SELECT SUM(pp" . $idLoja . ".Quantidade) 
            FROM pedidos_produtos pp" . $idLoja . "
            INNER JOIN pedidos p" . $idLoja . " ON pp" . $idLoja . ".idPedido = p" . $idLoja . ".idPedido
            INNER JOIN produtos pd" . $idLoja . " ON pp" . $idLoja . ".idProduto = pd" . $idLoja . ".idProduto
            WHERE pp" . $idLoja . ".idProduto = pp.idProduto AND p" . $idLoja . ".idLoja = " . $idLoja . "
            AND DATE(p" . $idLoja . ".created_at) = ? 
            AND pp" . $idLoja . ".deleted_at IS NULL
            AND pd" . $idLoja . ".deleted_at IS NULL";
            $parametros[] = $dataPedido;
            if($tipo != 'Frutas, Legumes, Verduras'){
                $sql .= " AND pd" . $idLoja . ".Tipos = ?";
                $parametros[] = $tipo;
            }
            $sql .= " AND p" . $idLoja . ".deleted_at IS NULL
            GROUP BY pd" . $idLoja . ".idProduto), 0) AS Quantidade_Loja" . $idLoja;
            
           

            $sql .= " -- , (SELECT pp' . $idLoja . '.Unidade FROM pedidos_produtos pp' . $idLoja . '
         --   INNER JOIN pedidos p' . $idLoja . ' ON pp' . $idLoja . '.idPedido = p' . $idLoja . '.idPedido
         --   WHERE pp' . $idLoja . '.idProduto = pp.idProduto AND p' . $idLoja . '.idLoja = ' . $idLoja . '
         --   AND DATE(p' . $idLoja . '.created_at) = '2023-04-16' AND pp' . $idLoja . '.deleted_at IS NULL
         --   AND p' . $idLoja . '.deleted_at IS NULL) AS Unidade_Loja' . $idLoja";

        }
       
        $sql .=
        "
        FROM pedidos_produtos pp
        INNER JOIN produtos pd ON pp.idProduto = pd.idProduto
        INNER JOIN pedidos p ON pp.idPedido = p.idPedido
        INNER JOIN lojas l ON p.idLoja = l.idLoja
        WHERE pp.deleted_at IS NULL
        AND pd.deleted_at IS NULL
        AND p.deleted_at IS NULL
        AND  DATE(p.created_at) = ?
        GROUP BY pd.idProduto, pd.Nome, pp.idProduto";
        
       
        $parametros[] = $dataPedido;
        // $parametros[] = $tipo;

        // var_dump($parametros);
        // var_dump($sql);die;

        return DB::select($sql, $parametros);
    }
    public function listagemProdutosPosCompra($dataPedido, $tipo)
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
        FROM pedidos_produtos pp
        INNER JOIN produtos pd ON pp.idProduto = pd.idProduto
        INNER JOIN pedidos p ON pp.idPedido = p.idPedido
        INNER JOIN lojas l ON p.idLoja = l.idLoja
        WHERE pp.deleted_at IS NULL
        AND pd.deleted_at IS NULL
        AND p.deleted_at IS NULL
        AND DATE(p.created_at) = ?
        AND p.Status = 'NaoConfirmado'";
        $parametros[] = $dataPedido;
        if ($tipo != 'Frutas, Legumes, Verduras') {
            $sql .= " AND pd.Tipos = ?";
            $parametros[] = $tipo;
        }

        return DB::select($sql, $parametros);
    }
}
