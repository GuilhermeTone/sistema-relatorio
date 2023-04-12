<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Session;

class ProdutosController extends Controller
{
   public function index()
   {
      $data['mensagem'] = session('mensagem');
      return view('produtos.index', $data);
   }
   public function create(Request $request)
   {
      $tipo = $request->get('tipo');
      $produtos = $request->get('produto');
      $padrao = $request->get('padrao');

      // var_dump($padrao);die;

      $erros = [];

      foreach ($produtos as $index => $value){
         if (strlen($tipo[$index]) == 0) {
            $erros[] = 'Unidade na linha ' . $index . ' não pode estar em branco';
         }
         if (strlen($produtos[$index]) == 0) {
            $erros[] = 'Unidade na linha ' . $index . ' não pode estar em branco';
         }
      }

      if (!$erros) {

         foreach ($produtos as $index => $value) {

            
            $idPedidoProduto = Produto::create([
               'Nome' => $produtos[$index],
               'Tipos' => $tipo[$index],
               'Padrao' => $padrao[$index],
               'Ocultar' => 'N',
            ]);

            
         }
       
         Session::flash('mensagem', 'Pedido inserido com sucesso');
         return back();
      }
   }
   public function indexEditar()
   {
      $data['produtos'] = Produto::select('idProduto', 'Nome','Tipos','Padrao', 'Ocultar')->get();
      $data['mensagem'] = session('mensagem');
      return view('produtos.editar', $data);
   }
   public function info(Request $request)
   {
      $idProduto = $request->get('idProduto');

      $produto = Produto::select('idProduto', 'Nome', 'Tipos', 'Padrao', 'Ocultar')->where('idProduto', $idProduto)->get();
      return response()->json($produto);
   }
   public function update(Request $request)
   {
      $idProduto = $request->get('idProduto');
      $produtos = $request->get('Produto');
      $tipo = $request->get('tipo');
      $unidade = $request->get('unidade');
      $ocultar = $request->get('ocultar');

      Produto::where('idProduto', $idProduto)->update(['Nome' => $produtos, 'Tipos' =>  $tipo, 'Padrao' =>  $unidade, 'Ocultar' => $ocultar]);
         
      Session::flash('mensagem', 'Pedido inserido com sucesso');
      return back();
   }
}
