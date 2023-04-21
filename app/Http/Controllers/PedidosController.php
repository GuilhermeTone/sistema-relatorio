<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Pedidos;
use App\Models\Lojas;
use App\Models\pedidosProdutos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PedidosController extends Controller
{
    public function index()
    {
        $data['Frutas'] = Produto::select('idProduto', 'Nome', 'Padrao')->where(['Tipos' => 'Frutas', 'Ocultar' => 'N', 'deleted_at' => NULL])->orderBy('Nome', 'asc')->get();
        $data['Legumes'] = Produto::select('idProduto', 'Nome', 'Padrao')->where(['Tipos' => 'Legumes', 'Ocultar' =>'N', 'deleted_at' => NULL])->orderBy('Nome', 'asc')->get();
        $data['Verduras'] = Produto::select('idProduto', 'Nome', 'Padrao')->where(['Tipos' => 'Verduras', 'Ocultar' =>'N', 'deleted_at' => NULL])->orderBy('Nome', 'asc')->get();
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
    public function listagemPedidos()
    {
        $dataAtual = date("Y-m-d");
        $tipo = 'Frutas';
        $idLoja = [];
        $data = [];
        $pedidosProdutosModel = new pedidosProdutos();

        $data['lojas'] = Lojas::select('idLoja', 'Nome')->where('deleted_at', NULL)->get();

         $data['arrayPedido'][] = 'Nome';
        foreach ($data['lojas'] as $loja) {
            $data['arrayPedido'][] = "Quantidade_Loja" . $loja->idLoja;
        }

        return view('listagemPedidos.index', $data);
    }
    public function listarPedido(Request $request)
    {
        $dataPedido = $request->get('dataPedido');
        $tipo = $request->get('tipo');
        $idLoja = [];
        $response = [];
        
        if(!isset($dataPedido)){
            $dataPedido = date("Y-m-d");
        }

        if (!isset($tipo)) {
            $tipo = 'Frutas, Legumes, Verduras';
        }

        
        $pedidosProdutosModel = new pedidosProdutos();

        $data['lojas'] = Lojas::select('idLoja', 'Nome')->where('deleted_at', NULL)->get();
        foreach ($data['lojas'] as $loja) {
            $idLoja[] = $loja->idLoja;
        }
        $data['produtosPedido'] = $pedidosProdutosModel->listagemProdutos($dataPedido, $idLoja, $tipo);

        // var_dump($data['produtosPedido']);die;

        if($data['produtosPedido']){
            if (isset($data['produtosPedido'][0])) {
                $objeto = $data['produtosPedido'][0];

                $chaves = array_keys((array) $objeto);

                $data['arrayPedido'] = $chaves;
            }

            $response['produtosPedido'] = $data['produtosPedido'];
            // var_dump($response);die;
            $response['arrayPedido'] = $data['arrayPedido'];
            $response['lojas'] = $data['lojas'];

            return response()->json($response);
        }else{
            return response()->json(['erro' => 'semPedido']);
        }
        // var_dump($data['produtosPedido']);die;

        
    }
    public function listaEdicao()
    {
        $data['lojas'] = Lojas::select('idLoja', 'Nome')->where('deleted_at', NULL)->get();
        // foreach ($data['lojas'] as $loja) {
        //     $lojas[] = $loja->idLoja;
        // }
        return view('edicaoPedidos.index', $data);
    }
    public function tabelaPrecos()
    {
        $data['lojas'] = Lojas::select('idLoja', 'Nome')->where('deleted_at', NULL)->get();
        // foreach ($data['lojas'] as $loja) {
        //     $lojas[] = $loja->idLoja;
        // }
        return view('tabelaPrecos.index', $data);
    }
}
