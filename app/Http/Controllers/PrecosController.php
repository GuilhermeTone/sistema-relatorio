<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\PrecosProdutos;
use Illuminate\Support\Facades\Session;

class PrecosController extends Controller
{
    public function index(){
        $produtos = Produto::select('idProduto', 'Nome', 'Tipos',)->get();
        $data['produtos'] = $produtos;
        $data['retornos'] = session('retornos');
        return view('precos.index', $data);
    }
    public function cadastrarPrecos(Request $request)
    {
        $idProdutos = $request->get('idProduto');
        $ProdutosPrecos = $request->get('valorProduto');
        
        // var_dump($idProdutos);
        // var_dump($ProdutosPrecos);die;

        foreach ($idProdutos as $index => $value) {

            foreach($ProdutosPrecos as $index2 => $ProdutosPreco){

                if(strlen($ProdutosPreco[$index]) > 0){
                    $idPrecoProdutoExiste = PrecosProdutos::select('precos_produtos.idProduto', 'produtos.Nome', 'precos_produtos.tipoPreco',)
                    ->join('produtos', 'produtos.idProduto', '=', 'precos_produtos.idProduto')
                    ->where('precos_produtos.idProduto', $idProdutos[$index])
                        ->where('precos_produtos.tipoPreco', $index2)
                        ->where('precos_produtos.deleted_at', NUll)->get();
            
                    if (count($idPrecoProdutoExiste) == 0) {
                        $idPedidoProduto = PrecosProdutos::create([
                            'idProduto' => $idProdutos[$index],
                            'tipoPreco' => $index2,
                            'Valor' => str_replace(',', '.', $ProdutosPreco[$index]),
                        ]);
                        $idPrecoProdutoExiste = PrecosProdutos::select('precos_produtos.idProduto', 'produtos.Nome', 'precos_produtos.tipoPreco',)
                        ->join('produtos', 'produtos.idProduto', '=', 'precos_produtos.idProduto')
                        ->where('precos_produtos.idProduto', $idProdutos[$index])
                        ->where('precos_produtos.tipoPreco', $index2)
                        ->where('precos_produtos.deleted_at', NUll)->get();
                        $data['retornos'][] = 'Preço do produto: ' . $idPrecoProdutoExiste[0]->Nome . ' no Tipo:' . $idPrecoProdutoExiste[0]->tipoPreco . ', Foi Inserido com sucesso';
                    } else {
                        // var_dump($idPrecoProdutoExiste);die;
                        $data['retornos'][] = 'Preço do produto: ' . $idPrecoProdutoExiste[0]->Nome . ' no Tipo:' . $idPrecoProdutoExiste[0]->tipoPreco . ' já existe, para editá-lo utilize a tela de edição de preços';
                        
                    }
                }
            }
            
        }
        $produtos = Produto::select('idProduto', 'Nome', 'Tipos',)->get();
        $data['produtos'] = $produtos;
        Session::flash('retornos', $data['retornos']);
        return back();
    }
    public function editarPrecos()
    {
        $Precoprodutos = PrecosProdutos::select('precos_produtos.idPrecoProduto', 'produtos.Nome', 'produtos.Tipos', 'precos_produtos.tipoPreco', 'precos_produtos.Valor')
        ->join('produtos', 'produtos.idProduto', '=', 'precos_produtos.idProduto')
        ->where('precos_produtos.deleted_at', NUll)->get();

        $data['precosProdutos'] = $Precoprodutos;

        return view('precos.editarPrecos', $data);
    }
    public function listarEditarPrecos()
    {
        $Precoprodutos = PrecosProdutos::select('precos_produtos.idPrecoProduto', 'produtos.Nome', 'produtos.Tipos', 'precos_produtos.tipoPreco', 'precos_produtos.Valor')
        ->join('produtos', 'produtos.idProduto', '=', 'precos_produtos.idProduto')
        ->where('precos_produtos.deleted_at', NUll)->get();

        return response()->json($Precoprodutos);
    }
    public function listarinfoPreco(Request $request)
    {
        $idPrecoProduto = $request->get('idPrecoProduto');
        // var_dump($idPrecoProduto);die;

        $Precoprodutos = PrecosProdutos::select('precos_produtos.idPrecoProduto', 'produtos.Nome', 'precos_produtos.tipoPreco', 'precos_produtos.Valor')
        ->join('produtos', 'produtos.idProduto', '=', 'precos_produtos.idProduto')
        ->where('precos_produtos.idPrecoProduto', $idPrecoProduto)
        ->where('precos_produtos.deleted_at', NUll)->get();

        return response()->json($Precoprodutos);

    }
    public function editarPrecoProduto(Request $request)
    {
        $idPrecoProduto = $request->get('idPrecoProduto');
        $ValorProduto = $request->get('ValorProduto');
        
        $ValorProduto = str_replace(',', '.', $ValorProduto);
        

        $idPrecoProduto = PrecosProdutos::where('idPrecoProduto', $idPrecoProduto)->update(['Valor' => $ValorProduto]);

        return response()->json('Sucesso');
    }
     
}
