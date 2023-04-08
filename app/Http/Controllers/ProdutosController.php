<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
   public function index()
   {
        //$data['usuarios'] = Produto::select('idUsuario', 'name')->get();

        return view('produtos.index');
   }
}
