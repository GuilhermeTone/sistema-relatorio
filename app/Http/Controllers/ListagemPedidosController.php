<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lojas;
use App\Models\pedidosProdutos;
use App\Models\ListagemPedidos;

class ListagemPedidosController extends Controller
{
    public function index()
    {
        $dataAtual = date("Y-m-d");
        $idLoja = [];
        $pedidosProdutosModel = new pedidosProdutos();

        $data['lojas'] = Lojas::select('idLoja', 'Nome')->where('deleted_at', NULL)->get();
        foreach ($data['lojas'] as $loja) {
            $idLoja[] = $loja->idLoja;
        }
        $data['produtosPedido'] = $pedidosProdutosModel->listagemProdutos($dataAtual, $idLoja);
        
        $objeto = $data['produtosPedido'][0];

        $chaves = array_keys((array) $objeto);

        $data['arrayPedido'] = $chaves;
        return view('listagemPedidos.index', $data);
    }
}
