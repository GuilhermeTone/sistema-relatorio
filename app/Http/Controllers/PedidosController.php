<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Pedidos;
use App\Models\pedidosProdutos;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    public function index()
    {
        $data['produtos'] = Produto::select('idProduto', 'Nome')->get();

        return view('produtos.index', $data);
    }
    public function create(Request $request)
    {
        $unidades = $request->get('unidade');
        $quantidades = $request->get('quantidade');
        $produtos = $request->get('produto');

        $erros = [];

        for ($i = 0; $i < count($unidades); $i++) {
            if (strlen($unidades[$i]) == 0) {
                $erros[] = 'Unidade na linha ' . $i . ' não pode estar em branco';
            }
            if (strlen($quantidades[$i]) == 0) {
                $erros[] = 'Unidade na linha ' . $i . ' não pode estar em branco';
            }
            if (strlen($produtos[$i]) == 0) {
                $erros[] = 'Unidade na linha ' . $i . ' não pode estar em branco';
            }
        }

        if (!$erros) {
            $idPedido = Pedidos::create([
                'idLoja' => Auth::user()->idLoja,
                'idUsuario' => Auth::id(),
            ]);

            foreach ($unidades as $index => $value) {

                $idPedidoProduto = pedidosProdutos::create([
                    'idProduto' => $produtos[$index],
                    'idPedido' => $idPedido->id,
                    'Quantidade' => $quantidades[$index],
                    'Unidade' => $unidades[$index],
                ]);
            }
        }
    }
}
