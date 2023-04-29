<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PedidosProdutosPosCompras;
use App\Models\Lojas;

class PedidosConfirmadosController extends Controller
{
    public function index()
    {
        $data['lojas'] = Lojas::select('idLoja', 'Nome')->where('deleted_at', NULL)->get();
        return view('pedidosConfirmados.index', $data);
    }
    public function listarPedidosConfirmados(Request $request)
    {

        $pedidosConfirmadosModel = new PedidosProdutosPosCompras();

        $dataPedido = $request->get('dataPedido');
        $idLoja = $request->get('idLoja');
        $response = [];

        if (!isset($dataPedido)) {
            $dataPedido = date("Y-m-d");
        }

        $response['Pedidos'] = $pedidosConfirmadosModel->listarPedidosConfirmados($dataPedido, $idLoja);
        $response['ValorTotal'] = $pedidosConfirmadosModel->listarValorTotal($dataPedido, $idLoja);

        if ($response) {

            return response()->json($response);
        } else {
            return response()->json(['erro' => 'semPedido']);
        }
    }
}
