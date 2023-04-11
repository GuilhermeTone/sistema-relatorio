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

      $erros = [];

      for ($i = 0; $i < count($produtos); $i++) {
         if (strlen($tipo[$i]) == 0) {
            $erros[] = 'Unidade na linha ' . $i . ' não pode estar em branco';
         }
         if (strlen($produtos[$i]) == 0) {
            $erros[] = 'Unidade na linha ' . $i . ' não pode estar em branco';
         }
      }

      if (!$erros) {

         foreach ($produtos as $index => $value) {

            $idPedidoProduto = Produto::create([
               'Nome' => $produtos[$index],
               'Tipos' => $tipo[$index],
            ]);
         }
         Session::flash('mensagem', 'Pedido inserido com sucesso');
         return back();
      }
   }
}
