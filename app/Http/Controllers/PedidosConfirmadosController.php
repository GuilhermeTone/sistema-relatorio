<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PedidosProdutosPosCompras;

class PedidosConfirmadosController extends Controller
{
    public function index()
    {
        return view('pedidosConfirmados.index');
    }
    public function listarPedidosConfirmados(Request $request)
    {

        $pedidosConfirmadosModel = new PedidosProdutosPosCompras();

        $dataPedido = $request->get('dataPedido');
        $response = [];

        if (!isset($dataPedido)) {
            $dataPedido = date("Y-m-d");
        }

        $idLoja = Auth::user()->idLoja;

        $response = $pedidosConfirmadosModel->listarPedidosConfirmados($dataPedido, $idLoja);
        

        // var_dump($response);die;

        if ($response) {

            return response()->json($response);
        } else {
            return response()->json(['erro' => 'semPedido']);
        }
    }
}
