<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Pedidos;
use App\Models\pedidosProdutos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PedidosController extends Controller
{
    public function index()
    {
        $data['Frutas'] = Produto::select('idProduto', 'Nome', 'Padrao')->where(['Tipos' => 'Frutas', 'Ocultar' => 'N'])->orderBy('Nome', 'asc')->get();
        $data['Legumes'] = Produto::select('idProduto', 'Nome', 'Padrao')->where(['Tipos' => 'Legumes', 'Ocultar' => 'N'])->orderBy('Nome', 'asc')->get();
        $data['Verduras'] = Produto::select('idProduto', 'Nome', 'Padrao')->where(['Tipos' => 'Verduras', 'Ocultar' => 'N'])->orderBy('Nome', 'asc')->get();
        $data['mensagem'] = session('mensagem');
        return view('pedidos.index', $data);
    }
    public function create(Request $request)
    {
        //Frutas
        $idProdutoFrutas = $request->get('idProdutoFrutas');
        $quantidadeFrutas = $request->get('quantidadeFrutas');
        $unidadeFrutas = $request->get('unidadeFrutas');

        //Legumes
        $idProdutoLegumes = $request->get('idProdutoLegumes');
        $quantidadeLegumes = $request->get('quantidadeLegumes');
        $unidadeLegumes = $request->get('unidadeLegumes');

        //Verduras
        $idProdutoVerduras = $request->get('idProdutoVerduras');
        $quantidadeVerduras = $request->get('quantidadeVerduras');
        $unidadeVerduras = $request->get('unidadeVerduras');

        $erros = [];

        if (!$erros) {
            
            $idPedido = Pedidos::create([
                'idLoja' => Auth::user()->idLoja,
                'idUsuario' => Auth::id(),
            ]);

            //FOREACH PARA FRUTAS
            foreach ($idProdutoFrutas as $index => $value) {
                if (strlen($quantidadeFrutas[$index]) > 0) {
                    $idPedidoProduto = pedidosProdutos::create([
                        'idProduto' => $idProdutoFrutas[$index],
                        'idPedido' => $idPedido->id,
                        'Quantidade' => $quantidadeFrutas[$index],
                        'Unidade' => $unidadeFrutas[$index],
                    ]);
                }
            }

            //FOREACH PARA LEGUMES
            foreach ($idProdutoLegumes as $index => $value) {
                if(strlen($quantidadeLegumes[$index]) > 0){
                    $idPedidoProduto = pedidosProdutos::create([
                        'idProduto' => $idProdutoLegumes[$index],
                        'idPedido' => $idPedido->id,
                        'Quantidade' => $quantidadeLegumes[$index],
                        'Unidade' => $unidadeLegumes[$index],
                    ]);
                }
                
            }

            //FOREACH PARA VERDURAS
            foreach ($idProdutoVerduras as $index => $value) {
                if (strlen($quantidadeVerduras[$index]) > 0) {
                    $idPedidoProduto = pedidosProdutos::create([
                        'idProduto' => $idProdutoVerduras[$index],
                        'idPedido' => $idPedido->id,
                        'Quantidade' => $quantidadeVerduras[$index],
                        'Unidade' => $unidadeVerduras[$index],
                    ]);
                }
            }
            Session::flash('mensagem', 'Pedido inserido com sucesso');
            return back();
        
        }
    }
}
